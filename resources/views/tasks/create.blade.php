@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="h4 pb-2 mb-4 border-3 border-bottom border-primary">
            <h1>Criar nova task</h1>
        </div>
        
        @if (session('success'))
            <div class="col-sm-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <label for="daedline" class="form-label">Data de Finalização</label>
                    <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline') }}">
                </div>
                <div class="col">
                    <label for="priority_id" class="form-label">Prioridade</label>
                    <select class="form-select" name="priority_id">
                        <option value="" @if(!old('priority_id')) selected @endif >Selecione a prioridade</option>
                        @foreach($priorities as $priority)
                            <option value="{{ $priority->id }}" @if(old('priority_id') == $priority->id) selected @endif >{{ $priority->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col">
                    <label for="group_id" class="form-label">Grupo</label>
                    <select class="form-select" name="group_id">
                        <option value="" @if(!old('group_id')) selected @endif >Selecione o grupo</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" @if(old('group_id') == $group->id) selected @endif >{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="responsible_id" class="form-label">Responsável</label>
                    <select class="form-select" name="responsible_id">
                        <option value="" @if(!old('responsible_id')) selected @endif >Selecione o responsável</option>
                        @foreach($responsibles as $responsible)
                            <option value="{{ $responsible->id }}" @if(old('responsible_id') == $responsible->id) selected @endif >{{ $responsible->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="tumb_file" class="form-label">Imagem destaque</label>
                <input class="form-control" type="file" id="tumb_file" name="tumb_file">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">CRIAR TASK</button>
            </div>
        </form>

    </div>
</div>
@endsection