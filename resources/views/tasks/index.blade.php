@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tasks</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Tasks</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form method="get" action="{{ route('task.index'); }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Grupo:</label>
                                    <select class="form-control" style="width: 100%;" name="group_id">
                                        <option value="">selecione o grupo</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" @if(($search['group_id'] ?? '') == $group->id) selected @endif >{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Respónsavel:</label>
                                    <select class="form-control" style="width: 100%;" name="responsible_id">
                                        <option value="">selecione o responsável</option>
                                        @foreach($responsibles as $responsible)
                                            <option value="{{ $responsible->id }}" @if(($search['responsible_id'] ?? '') == $responsible->id) selected @endif >{{ $responsible->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Prioridade:</label>
                                    <select class="form-control" style="width: 100%;" name="priority_id">
                                        <option value="">selecione a prioridade</option>
                                        @foreach($priorities as $priority)
                                            <option value="{{ $priority->id }}" @if(($search['priority_id'] ?? '') == $priority->id) selected @endif >{{ $priority->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <select class="form-control" style="width: 100%;" name="status_id">
                                        <option value="">selecione o status</option>
                                        @foreach($status as $status_option)
                                            <option value="{{ $status_option->id }}" @if(($search['status_id'] ?? '') == $status_option->id) selected @endif >{{ $status_option->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="title" 
                                               placeholder="digite o título" value="{{ $search['title'] ?? '' }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                <div class="input-group justify-content-center" style="min-width: 138px">
                                    <a class="btn btn-primary" href="{{ route('task.create'); }}">
                                        <i class="fas fa-plus"></i>
                                        Adicionar task
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @if (session('success'))
        <div class="col-sm-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="col-sm-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <section class="content">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">Listagem dos registros cadastrados</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                id
                            </th>
                            <th style="width: 50%">
                                Task
                            </th>
                            <th style="width: 10%">
                                Grupo
                            </th>
                            <th style="width: 10%">
                                Responsável
                            </th>
                            <th style="width: 4%" class="text-center">
                                Prioridade
                            </th>
                            <th style="width: 4%" class="text-center">
                                Status
                            </th>
                            <th style="min-width: 238px;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>
                                    {{ $task->id; }}
                                </td>
                                <td>
                                    <a>
                                        {{ $task->title; }}
                                    </a>
                                    <br/>
                                    <small>
                                        {{ mb_strimwidth($task?->description, 0, 100, "..."); }}
                                    </small>
                                </td>
                                <td>
                                    {{ $task->group?->name; }}
                                </td>
                                <td>
                                    {{ $task->responsible?->name; }}
                                </td>
                                <td class="project-state">
                                    <span class="badge" style="background-color: {{ $task->priority?->color }}">{{ $task->priority?->name }}</span>
                                </td>
                                <td class="project-state">
                                    <span class="badge" style="background-color: {{ $task->status->color }}">{{ $task->status->name }}</span>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        Ver
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('task.edit', ['id' => $task->id]); }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Editar
                                    </a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal{{ $task->id; }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($tasks as $task)
                    <div class="modal fade" id="modal{{ $task->id; }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Tem certeza que deseja deletar a task?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Task: {{ $task->id . ' - ' . $task->title; }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Não</button>
                                    <form action="{{ route('task.delete', ['id' => $task->id]); }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Deletar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
