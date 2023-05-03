<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Group;
use App\Models\Priority;
use App\Models\User;
use App\Models\Status;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $priorities = Priority::all();
        $groups = Group::all();
        $users = User::all();
        $status = Status::all();

        $search = $request->all();

        if(empty($search)) {
            $tasks = Task::where('filed', '=', false)->paginate();
        }else {
            $query = Task::query();
            $terms = $request->only('group_id', 'responsible_id', 'priority_id', 'status_id', 'filed');
            foreach ($terms as $name => $value) {
                if ($value or $value === '0') {
                    $query->where($name, '=', $value);
                }
            }

            $terms_like = $request->only('title');
            foreach ($terms_like as $name => $value) {
                if ($value) { 
                    $query->where($name, 'LIKE', '%' . $value . '%');
                }
            }

            $tasks = $query->paginate();
        }
        
        return view('tasks.index', compact('tasks', 'priorities', 'groups', 'users', 'status', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priorities = Priority::all();
        $groups = Group::all();
        $users = User::all();
        $status = Status::all();

        return view('tasks.create', compact('priorities', 'groups', 'users', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        if ($request->hasFile('tumb_file') && $request->file('tumb_file')->isValid()) {
            $name_image = uniqid(date('HisYmd'));
            $extension = $request->tumb_file->extension();
            $name_file = "{$name_image}.{$extension}";
            $upload = $request->tumb_file->storeAs('tasks', $name_file);

            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();

            $request->merge(['tumb' => $name_file]);
        }

        try{
            Task::create($request->all());

            return redirect()
                    ->back()
                    ->with('success', 'Nova task criada com sucesso!');
        }catch (Exception $e){
            Log::error($e->getMessage());

            return redirect()
                    ->back()
                    ->with('error', 'Erro na criação da task!');
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);

            return view('tasks.view', compact('task'));
        }catch (Exception $e){
            Log::error($e->getMessage());

            return redirect()
                    ->back()
                    ->with('error', 'Task não encontrada!');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $priorities = Priority::all();
        $groups = Group::all();
        $users = User::all();
        $status = Status::all();
        $task = Task::find($id);

        return view('tasks.edit', compact('priorities', 'groups', 'users', 'status', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, $id)
    {
        if ($request->hasFile('tumb_file') && $request->file('tumb_file')->isValid()) {
            $name_image = uniqid(date('HisYmd'));
            $extension = $request->tumb_file->extension();
            $name_file = "{$name_image}.{$extension}";
            $upload = $request->tumb_file->storeAs('tasks', $name_file);

            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();

            $request->merge(['tumb' => $name_file]);
        }

        try{
            $task = Task::findOrFail($id);
            $old_tumb = $task->tumb;

            $task->title = $request->title;
            $task->description = $request->description;
            $task->tumb = $request->tumb ?? $task->tumb;
            $task->deadline = $request->deadline;
            $task->group_id = $request->group_id;
            $task->priority_id = $request->priority_id;
            $task->user_id = $request->user_id;
            $task->status_id = $request->status_id;
            
            $task->save();

            if ($request->tumb ?? '' && Storage::exists('tasks/' . $old_tumb)) {
                Storage::delete('tasks/' . $old_tumb);
            }

            return redirect()
                    ->back()
                    ->with('success', 'Task atualizada com sucesso!');
        }catch (Exception $e){
            Log::error($e->getMessage());

            return redirect()
                    ->back()
                    ->with('error', 'Erro ao editar a task!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $task = Task::findOrFail($id);
            $task->delete();

            return redirect()
                    ->route('task.index')
                    ->with('success', 'Task deletada com sucesso!');
        }catch (Exception $e){
            Log::error($e->getMessage());

            return redirect()
                    ->back()
                    ->with('error', 'Erro ao deletar a task!');
        }
    }

    public function filedOrUnfiled($id)
    {
        try{
            $task = Task::findOrFail($id);
            $task->filed = !$task->filed;
            $task->save();

            $message = ($task->filed) ? 'Task arquivada com sucesso!' : 'Task desarquivada com sucesso!';

            return redirect()
                    ->route('task.index')
                    ->with('success', $message);
        }catch (Exception $e){
            Log::error($e->getMessage());

            return redirect()
                    ->back()
                    ->with('error', 'Erro ao atualizar a task!');
        }
    }
}
