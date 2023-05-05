@extends('access._theme')

@section('content')
    <form action="{{"/registrar"}}" method="POST" enctype="multipart/form-data"
          id="signup-form">
        @csrf
        <h3 class="mb-5">Registrar-se!</h3>
        <h6>Já possui conta? <a href="{{"/"}}">clique aqui</a></h6>
        <div class="form-outline mb-3">
            <label class="form-label" for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-control form-control-lg"
                   required/>
        </div>
        <div class="form-outline mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control form-control-lg"
                   required/>
        </div>

        <div class="form-outline mb-3">
            <label class="form-label" for="password">Senha</label>
            <input type="password" id="password" name="password"
                   class="form-control form-control-lg" required/>
        </div>
        <div class="form-outline mb-3">
            <label class="form-label" for="repeat-password">Repetir Senha</label>
            <input type="password" id="repeat-password" name="repeat-password"
                   class="form-control form-control-lg" required/>
        </div>
        <div class="invalid-feedback mb-2" id="invalid-password">
            As senhas devem ser iguais!
        </div>
        <button id="button-submit" class="btn btn-primary btn-lg btn-block" type="submit">Concluir</button>
    </form>
@endsection

@section('customJS')
    <script src="{{asset("/_assets/js/access/signup.js")}}"></script>
@endsection
