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
            <form action="enhanced-results.html">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Grupo:</label>
                                    <select class="form-control" style="width: 100%;">
                                        <option value="" @if(!old('group_id')) selected @endif >selecione o grupo</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" @if(old('group_id') == $group->id) selected @endif >{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Respónsavel:</label>
                                    <select class="form-control" style="width: 100%;">
                                        <option value="" @if(!old('responsible_id')) selected @endif >selecione o responsável</option>
                                        @foreach($responsibles as $responsible)
                                            <option value="{{ $responsible->id }}" @if(old('responsible_id') == $responsible->id) selected @endif >{{ $responsible->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Prioridade:</label>
                                    <select class="form-control" style="width: 100%;">
                                        <option value="" @if(!old('responsible_id')) selected @endif >selecione a prioridade</option>
                                        @foreach($priorities as $priority)
                                            <option value="{{ $priority->id }}" @if(old('priority_id') == $priority->id) selected @endif >{{ $priority->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <select class="form-control" style="width: 100%;">
                                        <option selected>Title</option>
                                        <option>Date</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="digite o título">
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
                                <div class="input-group justify-content-center">
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
                                        {{ mb_strimwidth($task->description, 0, 100, "..."); }}
                                    </small>
                                </td>
                                <td>
                                    {{ $task->group->name; }}
                                </td>
                                <td>
                                    {{ $task->responsible->name; }}
                                </td>
                                <td class="project-state">
                                    <span class="badge" style="background-color: {{ $task->priority->color }}">{{ $task->priority->name }}</span>
                                </td>
                                <td class="project-state">
                                    <span class="badge badge-success">Success</span>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        Ver
                                    </a>
                                    <a class="btn btn-info btn-sm" href="#">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Editar
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
