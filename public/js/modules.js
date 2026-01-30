// Funciones custom

// Función para mensaje de aviso
export function warning(obj, type) {
    $(`.${type}`).removeClass('hide');
    $(`.${type}`).text((type == 'success') ? obj.success : obj.error);

    setTimeout(() => {
        $(`.${type}`).addClass('hide');
        $(`.${type}`).text("");
    }, 3000);
}

// Función para el cierre de una ventana en el gestor de productos
export function cancelWindow() {
    $('.overlay').css('display', 'none');
    $('.window').css('display', 'none');
    $('body').css('overflow', 'auto');
}

// Función para mostrar la ventana en el gestor de productos
export function showWindow(type, el) {
    $('.overlay').css('display', 'flex');
    $('.window').css('display', 'block');
    $('body').css('overflow', 'hidden');

    // Si queremos editarla
    if (type == 'edit') {
        const productNode = $(el).closest('.product')
        $('.window form').data('type', 'edit');
        $('.window form').attr('data-id', productNode.attr('id'))

        // Mostrar info del producto
        $('.window form input').each(function() {
            const field = $(this).attr('name');
            let value = productNode.find(`.${field}`).text().trim();
            if (field === 'picture' || field === 'link') {
                value = productNode.find(`.${field}`).attr(field === 'picture' ? 'src' : 'href').trim();
            }

            if (field === 'pvp' || field === 'stock') {
                value = (value.match(/\d+(\.\d+)?/g) || []).map(parseFloat);
            }

            $(this).val(value || '');
        });
    } else { // Si queremos agregar uno nuevo
        $('.save').text('Agregar producto')
        $('.window form').data('type', 'add');

        // Vaciar los inputs
        $('.window form input').each(function(i, input) {
            $(input).val('');
        })
    }
}

// Para editar un productor
export function cutomizeProduct(product, data, isAdded) {
    product.attr('id', data?.id)
    product.find(".picture").attr('src', data?.picture);
    product.find(".nombre").text(data?.nombre);
    product.find(".fabricante").text(data?.fabricante);
    product.find(".pvp").text(`Precio: ${data?.pvp}€`);
    product.find(".stock").text(`Stock: ${data?.stock}`);
    product.find(".link").attr('href', data?.link);

    if (isAdded) {
        $(".results").prepend(product);
    } else {
        $(`#${data?.id}`).replaceWith(product)
    }
}

// Obtener la página actual y agregarle la clase active
export function getActualPage() {
    let url = window.location.href.split("/");

    const href = url[url.length - 1];

    const links = $(".navbar a");

    links.each((i, link) => {
        $(link).removeClass("active");
        
        if ($(link).attr('href') == href) {
            $(link).addClass("active");
        } 
    })
}

// Lógica de la vista login y registro (Uso de AJAX)
export function login(form) {
    $.ajax({
        method: 'POST',
        url: 'login-submit',
        data: form.serialize()
    }).then((res) => {
        let data = JSON.parse(res);
       
        // En caso de error
        if (data.error) {
            warning(data, 'error') // En caso de error, mostraremos el mensaje correspondiente
            return
        }

        // En caso de éxito
        if (data.auth) {
            localStorage.setItem('token', data.token);
            loginLangChange(localStorage.getItem('lang'));
            location.href = 'inicio';
        }
    })
}

export function register(form) {
    $.ajax({
        method: 'POST',
        url: 'register-submit',
        data: form.serialize()
    }).then((res) => {
        let data = JSON.parse(res);

        // En caso de error
        if (data.error) {
            warning(data, 'error');
            return;
        }
 
        // En caso de éxito
        if (data.success) {
            warning(data, 'success'); // En caso de hacerse el registro correctamente, mostraremos el mensaje correspondiente
            
            setTimeout(() => { // Habrá un timeout de 2 segundos hasta que redireccione al login
                location.href = 'login'
            }, 2000);
        }
    })
}

// Lógica para el logout
export function logout() {
    $.ajax({
        method: 'GET',
        url: 'logout',
    }).then(() => {
        if (localStorage.getItem('token')) {
            localStorage.removeItem('token');
        }
        
        location.href = 'login'
    })
}

// Lógica para el el cambio de idioma
export function langChange(lang) {
    $.ajax({
        method: 'POST',
        url: 'lang-change',
        data: { lang: lang },
    }).then((res) => {
        location.reload();
    })
}

export function loginLangChange(lang) {
    $.ajax({
        method: 'POST',
        url: 'lang-change',
        data: { lang: lang },
    }).then((res) => {})
}

// Lógica para el CRUD de productos

export function addProduct(form) {
    $.ajax({
        method: 'POST',
        url: 'add-product',
        data: form.serialize()
    }).then((res) => {
        let data = JSON.parse(res);
        const newProduct = data.newData;

        // En caso de error
        if (data.error) {
            warning(data, 'error');

            return
        }

        // En caso de éxito
        warning(data, 'success');

        setTimeout(() => {
            cancelWindow();

            // Recargar el catálogo
            const clone = document.querySelector("#productTemplate").content.cloneNode(true);

            const product = $(clone).find('.product'); // obtener el div .product

            cutomizeProduct(product, newProduct[0], true)
        }, 1500);
    })
}

export function updateProduct(form) {
    let formData = form.serializeArray().reduce((obj, field) => {
        obj[field.name] = field.value;
        return obj;
    }, {});

    formData.id = form.attr('data-id');

    $.ajax({
        method: 'POST',
        url: 'update-product',
        data: formData
    }).then((res) => {
        let data = JSON.parse(res);
        const updatedProduct = data.newData;

        // En caso de error
        if (data.error) {
            warning(data, 'error');

            return
        }

        // En caso de éxito
        warning(data, 'success');

        setTimeout(() => {
            cancelWindow();

            // Recargar el catálogo
            const clone = document.querySelector("#productTemplate").content.cloneNode(true);

            const product = $(clone).find('.product'); // obtener el div .product

            cutomizeProduct(product, updatedProduct[0], false); 
        }, 1500);
    })
}

// Función para eliminar un producto en específico
export function deleteProduct(id) {

    $.ajax({
        method: 'POST',
        url: 'delete-product',
        data: {'id': id}
    }).then((res) => {
        let data = JSON.parse(res);

        if (data.success) {
            // Recargar el catálogo
            const results = $('.results');
            results.find(`#${id}`).remove();
        }
    })
}

// Función para agregar un producto al carrito

export function addShopCart(id) {

    $.ajax({
        method: 'POST',
        url: 'add-shopcart',
        data: {'id': id}
    }).then((res) => {
        let data = JSON.parse(res);

        // console.log(data.success)
    })
}

export function deleteShopCart(id) {

    $.ajax({
        method: 'POST',
        url: 'delete-shopcart',
        data: {'id': id}
    }).then((res) => {
        let data = JSON.parse(res);

        if (data.success) {
            // Recargar el catálogo
            const results = $('.results');
            results.find(`#${id}`).closest('.product').remove();
        }
    })
}