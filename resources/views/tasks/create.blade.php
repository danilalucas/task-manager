@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Criar nova task</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('task.index'); }}">Tasks</a></li>
                        <li class="breadcrumb-item active">Criar task</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row-md-8 card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title">Nova task</h3>
        </div>
        <div class="card-body">

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

            <form method="post" action="{{ route('task.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título *</label>
                    <input type="text" class="@error('title') is-invalid @enderror form-control"
                        id="title" name="title" max="120" value="{{ old('title') }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="group_id" class="form-label">Grupo</label>
                        <select class="form-control" name="group_id">
                            <option value="" @if(!old('group_id')) selected @endif >Selecione o grupo</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" @if(old('group_id') == $group->id) selected @endif >{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="user_id" class="form-label">Responsável</label>
                        <select class="form-control" name="user_id">
                            <option value="" @if(!old('user_id')) selected @endif >Selecione o responsável</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif >{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="daedline" class="form-label">Data de Finalização</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline') }}">
                    </div>
                    <div class="col">
                        <label for="priority_id" class="form-label">Prioridade</label>
                        <select class="form-control" name="priority_id">
                            <option value="" @if(!old('priority_id')) selected @endif >Selecione a prioridade</option>
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}" @if(old('priority_id') == $priority->id) selected @endif >{{ $priority->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="status_id" class="form-label">Status *</label>
                        <select class="form-control" name="status_id">
                            <option value="" @if(!old('status_id')) selected @endif >Selecione o status</option>
                            @foreach($status as $status_option)
                                <option value="{{ $status_option->id }}" @if(old('status_id') == $status_option->id) selected @endif >{{ $status_option->name }}</option>
                            @endforeach
                        </select>
                        @error('status_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tumb_file" class="form-label">Imagem destaque</label>
                    <input class="" type="file" id="tumb_file" name="tumb_file">
                </div>
            </div>
            <div class="col-12 card-footer">
                <button type="submit" class="btn btn-primary">Criar task</button>
            </div>
        </form>
    </div>
@endsection
