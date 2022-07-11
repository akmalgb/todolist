<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $completedTodos = $user->Todos()->where('status', 'completed')->orderBy('updated_at', 'asc')->get();
        $uncompletedTodos = $user->Todos()->where('status', 'uncompleted')->orderBy('updated_at', 'asc')->get();

        return view ('todo.index', compact('completedTodos', 'uncompletedTodos'));
    }

    public function store(StoreTodoRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $data['user_id'] = $user->id;

        Todo::create($data);
        return back();
    }

    public function edit(Todo $todo)
    {
        return view('todo.edit', compact('todo'));
    }

    public function update(StoreTodoRequest $request, Todo $todo)
    {
        $data = $request->validated();
        $model = $todo->fill($data);

        $model->save();
        return redirect()->route('todo');
    }

    public function changeStatus($id)
    {
        $todos = Todo::findOrFail($id);
        if ($todos->status == 'uncompleted') {
            $todos->status = 'completed'; //baru ke proses
        } elseif ($todos->status == 'completed') {
            $todos->status = 'uncompleted'; //proses ke selesai
        }

        $todos->save();
        return back();
    }

    public function destroy(Todo $todo)
    {
        Todo::destroy($todo->id);
        return back();
    }
}
