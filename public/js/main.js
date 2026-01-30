import { getActualPage, login, register, logout, addProduct, cancelWindow, showWindow, deleteProduct, updateProduct, addShopCart, deleteShopCart, langChange } from "./modules.js";

$(document).ready(function() {
    // Saber en que página me encuentro y funcionalidad del desplazamiento de esta
    getActualPage();

    $('#themeToggle').on('click', function () {
        const theme = $('main').attr('data-theme') === 'dark'
            ? 'light'
            : 'dark';

        $('main, .navbar, .window').attr('data-theme', theme);

        localStorage.setItem('theme', theme);
        document.cookie = `theme=${theme}; path=/; max-age=31536000`;
    });


    // Lógica para el Login y el Register

    $('.login form').on("submit", (e) => {
        e.preventDefault();
        
        login($(e.currentTarget));
    })

    $('.register form').on("submit", (e) => {
        e.preventDefault();

        register($(e.currentTarget));
    })

    // Logout
    $('#logout').on('click', (e) => {
        logout();
    })

    // Botón de lang
    $('#langBtn').on('change', (e) => {
        const lang = $(e.currentTarget).val();

        // Almacenar en localStorage
        localStorage.setItem('lang', lang);

        langChange(lang);
    })

    // Lógica para el CRUD //

    // Lógica del botón de agregar
    $('.addProduct .button').on('click', (e) => {
        e.preventDefault()

        showWindow('add', e.currentTarget)
    })

    // Lógica del botón de actualizar
    $(document).on('click', '.edit', (e) => {
        e.preventDefault();
        
        showWindow('edit', e.currentTarget)
    })

    // Agregar un producto
    $('.window form').on("submit", (e) => {
        e.preventDefault();
        
        if ($(e.currentTarget).data('type') == 'add') {
            addProduct($(e.currentTarget));
        } else {
            updateProduct($(e.currentTarget));
        }
    })

    // Lógica del botón de cancelar
    $('.window form .buttons .cancel').on('click', (e) => {
        e.preventDefault()

        cancelWindow()
    })

    // Lógica del botón de eliminar
    $(document).on('click', '.delete', (e) => {
        e.preventDefault();
        
        deleteProduct($(e.currentTarget).closest('.product').attr('id'));
    });

    // Lógica del carrito de compras

    $(document).on('click', '.shopCartBtn', (e) => {
        e.preventDefault();
        
        addShopCart($(e.currentTarget).attr('id'));
    });

    $(document).on('click', '.shopCartDelete', (e) => {
        e.preventDefault();
        
        deleteShopCart($(e.currentTarget).attr('id'));
    });
});