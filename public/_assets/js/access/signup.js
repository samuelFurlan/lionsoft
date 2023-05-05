$(document).ready(function () {
    //Conforme o usuário digita a senha, executa a função de validação
    $("#password").keyup(function () {
        let confirm = $("#repeat-password").val();
        if (confirm !== "") {
            confirmPassword();
        }
    });

    //Conforme o usuário digita a senha, executa a função de validação
    $("#repeat-password").keyup(function () {
        confirmPassword();
    });

    $("#signup-form").submit(function (e) {
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
                Swal.fire({
                    title: 'Sucesso!',
                    icon: 'success',
                    html: callback.message,
                    confirmButtonText: 'Continuar',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = callback.redirect;
                    }
                });
            }
        });
    });

});

function confirmPassword() {
    let password = $("#password").val();
    let confirm = $("#repeat-password").val();

    if (password !== confirm) {
        $("#invalid-password").show('slow');
        $("#button-submit").prop('disabled', true);
    } else {
        $("#invalid-password").hide('slow');
        $("#button-submit").prop('disabled', false);
    }
}
