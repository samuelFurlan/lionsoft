<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('panel.dashboard');
    }

    /**
     * @param Request $request
     */
    public function newTask(Request $request)
    {
        $callback["status"] = false;
        if (!empty($request->input("title"))) {
            try {
                if (!empty($request->input("task_id"))) {
                    $task = Tasks::find($request->input("task_id"));
                } else {
                    $task = new Tasks();
                }

                $task->title = $request->input("title");
                $task->description = $request->input("description");
                if (!empty($request->input("completed"))) {
                    $task->completed = true;
                } else {
                    $task->completed = false;
                }

                if (empty($request->input("task_id"))) {
                    $task->user_id = Auth::id();
                }
                $task->save();

                $callback["status"] = true;
                $callback["message"] = "Cadastro realizado com sucesso!";

            } catch (\Exception $e) {
                //Caso erro no bloco try/catch, retorna erro
                $callback["erro"] = "Erro: " . $e->getMessage();
            }
        } else {
            $callback["erro"] = "O título da tarefa é obrigatório!";
        }
        echo json_encode($callback);

    }

    public function listTask()
    {
        $tasks = Tasks::where('user_id', Auth::id())->get();
        $callback  = array();
        foreach ($tasks as $task) {
            $callback["data"][$task["id"]] = [
                "id" => $task["id"],
                "title" => $task["title"],
                "description" => $task["description"],
                "completed" => $task["completed"],
            ];
        }

        echo json_encode($callback);
    }

    /**
     * @param Request $request
     */
    public function updateTask(Request $request)
    {
        $callback["status"] = false;
        if (!empty($request->input("task_id"))){
            try {
                $task = Tasks::where('id',$request->input("task_id"))->where('user_id', Auth::id())->first();
                if (!empty($task)){
                    if (!empty($request->input("status"))){
                        if ($request->input("status") == "true"){
                            $task->completed = true;
                        }else{
                            $task->completed = false;
                        }
                        $task->save();
                        $callback["message"] = "Atualização realizado com sucesso!";
                    }
                    if (!empty($request->input("remover"))){
                        $task->delete();
                        $callback["message"] = "Remoção realizado com sucesso!";
                    }
                    $callback["status"] = true;
                }else{
                    $callback["erro"] = "Ops, aconteceu algo errado, atualize e tente novamente!";
                }
            }catch (\Exception $e){
                //Caso erro no bloco try/catch, retorna erro
                $callback["erro"] = "Erro: " . $e->getMessage();
            }
        }else{
            $callback["erro"] = "Ops, aconteceu algo errado, atualize e tente novamente!";
        }
        echo json_encode($callback);
    }

    /**
     * @param Request $request
     */
    public function loadTask(Request $request)
    {
        if (!empty($request->input("task_id"))){
            try {
                $task = Tasks::where('id',$request->input("task_id"))->where('user_id', Auth::id())->first();
                if (!empty($task)){

                    $callback["id"] = $task["id"];
                    $callback["title"] = $task["title"];
                    $callback["description"] = $task["description"];
                    $callback["completed"] = $task["completed"];

                    $callback["status"] = true;
                }else{
                    $callback["erro"] = "Ops, aconteceu algo errado, atualize e tente novamente!";
                }
            }catch (\Exception $e){
                //Caso erro no bloco try/catch, retorna erro
                $callback["erro"] = "Erro: " . $e->getMessage();
            }
        }else{
            $callback["erro"] = "Ops, aconteceu algo errado, atualize e tente novamente!";
        }
        echo json_encode($callback);
    }
}
