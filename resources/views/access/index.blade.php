@extends('access._theme')

@section('content')
<form action="{{"/login"}}" method="POST" enctype="multipart/form-data"
      id="login-form">
    @csrf
    <h3 class="mb-5">Bem-vindo!</h3>
    <h6>Ainda não possui conta? <a href="registrar-se">clique aqui</a></h6>
    <div class="form-outline mb-4">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control form-control-lg"
               required/>
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="password">Senha</label>
        <input type="password" id="password" name="password"
               class="form-control form-control-lg" required/>
    </div>
    <button id="button-submit" class="btn btn-primary btn-lg btn-block" type="submit">Acessar</button>
</form>
@endsection

@section('customJS')
    <script src="{{asset("/_assets/js/access/login.js")}}"></script>
@endsection

