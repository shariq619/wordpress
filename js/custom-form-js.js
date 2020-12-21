// Disable form submissions if there are invalid fields
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });





    }, false);









})();


jQuery(document).on('click', '.submit_bttn', function (e) {
    e.preventDefault();
    jQuery.ajax({
        url: my_ajax_url.ajaxurl,
        type: 'post',
        data: {
            action: 'my_ajax_action',
            name: $('#name').val(),
            message: $('#message').val(),
        },
        success: function (response) {
            console.log(response);
        }
    });
});