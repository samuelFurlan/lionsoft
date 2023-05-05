$(document).ready(function () {
    loadTasks();
    $("#task-form").submit(function (e) {
        e.preventDefault();
        let btn = $("#button-submit");
        let btnText = btn.html();
        btn.prop('disabled', true);
        btn.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
        let forms = $(this);
        sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
            btn.html(btnText).prop('disabled', false);
            $("#task_id").val("");
            $("#completed").attr("checked", false);
            forms.trigger("reset");
            if (callback.erro) {
                Swal.fire(
                    'Ops!',
                    callback.erro,
                    'error'
                );
            } else if (callback.status) {
                loadTasks();
                Swal.fire({
                    title: 'Sucesso!',
                    icon: 'success',
                    html: callback.message,
                    confirmButtonText: 'OK',
                });
            }
        });
    });
});

function loadTasks() {
    let token = $("input[name='_token']").val();
    sendAjax(window.location.origin + '/tarefas/listar', {"_token": token}, function (callback) {
        $("#list-tasks-div").html("");
        $.each(callback.data, function (key, value) {
            let completed;
            let status;
            let task_id = value.id;
            if (value.completed === 1) {
                completed = "<i onclick='completeTask(" + task_id + ",false)' class='fa-solid fa-ban' data-bs-toggle='tooltip' data-bs-placement='top' title='Concluir' style='cursor: pointer'></i>"
                status = "<span class='badge bg-success'>Concluida</span>";
            } else {
                completed = "<i onclick='completeTask(" + task_id + ",true)' class='fa-solid fa-check' data-bs-toggle='tooltip' data-bs-placement='top' title='Cancelar' style='cursor: pointer'></i>"
                status = "<span class='badge bg-warning text-dark'>Não realizada</span>";
            }
            $("#list-tasks-div").append(
                "<div class='col-md-6 col-lg-4'>\n" +
                "   <div class='card'>\n" +
                "      <div class='card-body'>\n" +
                "         <h5 class='card-title'>" + value.title + "</h5>\n" +
                "         <p class='card-text'>" + value.description + "</p>\n" +
                "         <p>Situação : " + status + "</p>\n" +
                "         <div class='text-end'>\n" +
                "            <i onclick='editTask(" + task_id + ")' class='fa-solid fa-pen' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar' style='cursor: pointer'></i>\n" +
                "            " + completed + "\n" +
                "            <i onclick='removeTask(" + task_id + ")' class='fa-solid fa-trash' data-bs-toggle='tooltip' data-bs-placement='top' title='Remover' style='cursor: pointer'></i>\n" +
                "         </div>\n" +
                "      </div>\n" +
                "   </div>\n" +
                "</div>"
            );
        });

    });
}

function completeTask(task_id, status) {
    let token = $("input[name='_token']").val();
    let title;
    let message;
    if (status){
        title = "Concluir tarefa"
        message = "Tem certeza que deseja marcar como concluido?"
    }else{
        title = "Desfazer conclusão"
        message = "Tem certeza que deseja desfazer a conclusão?"
    }
    Swal.fire({
        title: title,
        icon: "question",
        html: message,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        showConfirmButton: true,
        confirmButtonText: 'Confirmar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            sendAjax(window.location.origin + '/tarefas/atualizar', {
                task_id: task_id,
                status: status,
                "_token": token
            }, function (callback) {
                if (callback.erro) {
                    Swal.fire(
                        'Ops!',
                        callback.erro,
                        'error'
                    );
                } else if (callback.status) {
                    loadTasks();
                    Swal.fire({
                        title: 'Sucesso!',
                        icon: 'success',
                        html: callback.message,
                        confirmButtonText: 'OK',
                    });
                }
            });
        }
    });
}

function editTask(task_id) {
    let token = $("input[name='_token']").val();
    sendAjax(window.location.origin + '/tarefa/carregar', {
        task_id: task_id,
        "_token": token
    }, function (callback) {
        if (callback.erro) {
            Swal.fire(
                'Ops!',
                callback.erro,
                'error'
            );
        } else if (callback.status) {
            $("#task_id").val(callback.id);
            $("#title").val(callback.title);
            $("#description").val(callback.description);
            if (callback.completed === 1){
                $("#completed").attr("checked", true);
            }else{
                $("#completed").attr("checked", false);
            }
        }
    });
}

function removeTask(task_id) {
    let token = $("input[name='_token']").val();
    Swal.fire({
        title: "Remover Tarefa",
        icon: "error",
        html: "Tem certeza que deseja remover a tarefa?",
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        showConfirmButton: true,
        confirmButtonText: 'Confirmar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            sendAjax(window.location.origin + '/tarefas/atualizar', {
                task_id: task_id,
                remover: true,
                "_token": token
            }, function (callback) {
                if (callback.erro) {
                    Swal.fire(
                        'Ops!',
                        callback.erro,
                        'error'
                    );
                } else if (callback.status) {
                    loadTasks();
                    Swal.fire({
                        title: 'Sucesso!',
                        icon: 'success',
                        html: callback.message,
                        confirmButtonText: 'OK',
                    });
                }
            });
        }
    });
}
