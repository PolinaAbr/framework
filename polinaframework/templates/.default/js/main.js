$(document).ready(function() {

    /* submenu */
    $("body").on("click", ".submenu__btn", function() {
        $(this).parent().toggleClass("active").siblings(".submenu").slideToggle("normal");
        return false;
    });

    /* fancybox*/

    $(".text-img").fancybox();

});