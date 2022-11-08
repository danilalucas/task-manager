<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Group;
use App\Models\Priority;
use App\Models\Responsible;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        $priorities = Priority::all();
        $groups = Group::all();
        $responsibles = Responsible::all();
        
        return view('tasks.index', compact('tasks', 'priorities', 'groups', 'responsibles'));
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
        $responsibles = Responsible::all();

        return view('tasks.create', compact('priorities', 'groups', 'responsibles'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
