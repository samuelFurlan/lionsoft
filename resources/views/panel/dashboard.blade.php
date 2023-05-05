<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LionSoft</title>

    <link href="{{asset("/vendor/bootstrap5/bootstrap.css")}}" rel="stylesheet">
    <link href="{{asset("/vendor/sweetalert2/dist/sweetalert2.min.css")}}" rel="stylesheet">

</head>
<body>
<main>
    <header class="p-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{"/inicio"}}" class="nav-link px-2 link-secondary">Início</a></li>
                </ul>

                <div class="dropdown text-end">
                    <h5>Bem-vindo {{session('user_name')}}</h5>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid bg-light pt-4">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Adicionar tarefa</h4>
                        <form action="{{"/tarefa/adicionar"}}" method="POST" enctype="multipart/form-data"
                              id="task-form">
                            @csrf
                            <input type="hidden" id="task_id" name="task_id" value="">
                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       maxlength="200">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="completed" name="completed">
                                <label class="form-check-label" for="completed">Tarefa completada</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row" id="list-tasks-div">
                </div>
            </div>
        </div>
    </div>

</main>


<!-- Pills content -->
<script src="{{asset("/vendor/bootstrap5/bootstrap.js")}}"></script>
<script src="{{asset("/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("/vendor/sweetalert2/dist/sweetalert2.min.js")}}"></script>
<script src="{{asset("/_assets/js/utils/utils.js")}}"></script>
<script src="https://kit.fontawesome.com/873f5533a9.js" crossorigin="anonymous"></script>
<script src="{{asset("/_assets/js/panel/dashboard.js")}}"></script>

</body>
</html>
