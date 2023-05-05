<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('access.index');
    }

    /**
     * @param Request $request
     */
    public function validateLogin(Request $request)
    {
        //Inicia o retorno de status como falso
        $callback["status"] = false;

        //Válida se todos os campos do formulário estão preenchidos
        if (!empty($request->email) && !empty($request->password)) {
            //Consulta se email está cadastrado na base
            $user = User::where("email", $request->email)->first();
            //Se email cadastrado, continua a função
            if (!empty($user)) {
                //Valida senha do usuário
                if (Hash::check($request->password, $user->password)) {

                    //Inicia a sessão autenticada do usuário
                    if (Auth::attempt(
                        ['email' => $request->post("email"), 'password' => $request->post("password")])) {

                        session(["user_name" => $user["name"]]);
                        //Caso sessão iniciada com sucesso, retorna status, caminho do redirect, e mensagem
                        $callback["status"] = true;
                        $callback["redirect"] = "/inicio";
                        $callback["message"] = "";
                    } else {
                        //Caso erro ao iniciar sessão, retorna erro
                        $callback["erro"] = "Não foi concluir login.";
                    }
                }else{
                    //Caso email ou senha incorreta, retorna erro
                    $callback["erro"] = "Email ou senha incorretos.";
                }
            } else {
                //Caso email ou senha incorreta, retorna erro
                $callback["erro"] = "Email ou senha incorretos.";
            }
        } else {
            //Caso formulário não preenchido, retorna erro
            $callback["erro"] = "Todos os campos são obrigatórios.";
        }

        //Retorna resultado da função Void, para a função ajax
        echo json_encode($callback);
    }

    /**
     * @return Application|Factory|View
     */
    public function signup()
    {
        return view('access.signup');
    }

    /**
     * @param Request $request
     */
    public function validateSignup(Request $request): void
    {
        //Inicia o retorno de status como falso
        $callback["status"] = false;
        //Válida se todos os campos do formulário estão preenchidos
        if (!in_array("", $request->post())) {
            //Validação redundante caso as senhas informadas são iguais
            if ($request->post("password") != $request->post("repeat-password")) {
                //Caso senhas não coincidem, retorna erro
                $callback["erro"] = "As senhas não são iguais, verifique.";
            } else {
                //Consulta se email já está cadastrado na base
                $verifyEmail = User::where("email", $request->email)->first();
                //Se email ainda não cadastrado, continua a função
                if (empty($verifyEmail)) {
                    try {
                        //Salva o usuário no BD
                        $user = new User();
                        $user->name = $request->post("name");
                        $user->email = $request->email;
                        $user->password = Hash::make($request->post("password"));
                        $user->save();

                        //Inicia a sessão autenticada do usuário
                        if (Auth::attempt(
                            ['email' => $request->post("email"),
                                'password' => $request->post("password")
                            ])) {
                            //Enviar email de validação de conta aqui

                            session(["user_name" => $user["name"]]);
                            //Caso sessão iniciada com sucesso, retorna status, caminho do redirect, e mensagem
                            $callback["status"] = true;
                            $callback["redirect"] = "/inincio";
                            $callback["message"] = "Cadastro efetuado com sucesso!";
                        } else {
                            //Caso erro ao iniciar sessão, retorna erro
                            $callback["erro"] = "Não foi possivel concluir o cadastro.";
                        }
                    } catch (\Exception $e) {
                        //Caso erro no bloco try/catch, retorna erro
                        $callback["erro"] = "Erro: " . $e->getMessage();
                    }
                } else {
                    //Caso email já cadastrado, retorna erro
                    $callback["erro"] = "Parece que você já possui uma conta, <a href='/'> clique aqui </a> e faça login.";
                }
            }
        } else {
            //Caso formulário não preenchido, retorna erro
            $callback["erro"] = "Todos os campos são obrigatórios.";
        }
        //Retorna resultado da função Void, para a função ajax
        echo json_encode($callback);
    }
}
