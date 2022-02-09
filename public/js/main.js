function ajaxForm(tag) {
    tag = tag || "main";
    $(tag).find('form.validate').validate({

        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            var elem = $(element);
            elem.parents('form').addClass("was-validated");
        },
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            elem.parents('form').removeClass("was-validate");
        }
    });
}

const configUser = window.matchMedia('(prefers-color-scheme: dark)');
const localConfig = localStorage.getItem('tema');

$(function () {

    const boton = $('#switch');

    if (localConfig === 'dark') {
        // $('body').addClass('dark-theme');
        boton.addClass('active');

    } else if (localConfig === 'light') {
        // $('body').addClass('light-theme');
        boton.removeClass('active');

    }
});

function applyFormats() {
    $('.alphanum').alphanum();
    $('.alpha').alpha();
    $('.number').numeric();
    $('.email').inputmask("email");
    $('.phone').inputmask("(999)-999-9999");
}