$(document).ready(function () {
    $("#login-form").submit(function (e) {
        e.preventDefault();
        let btn = $("#button-submit");
        let btnText = btn.html();
        btn.prop('disabled', true);
        btn.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
        let forms = $(this);
        sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
            btn.html(btnText).prop('disabled', false);
            if (callback.erro) {
                Swal.fire(
                    'Ops!',
                    callback.erro,
                    'error'
                );
            } else if (callback.status) {
                window.location.href = callback.redirect;
            }
        });
    });
});
