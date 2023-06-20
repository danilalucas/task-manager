@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar task</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('task.index'); }}">Tasks</a></li>
                        <li class="breadcrumb-item active">Editar task</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row-md-8 card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title">Editar</h3>
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

            <form method="post" action="{{ route('task.update', ['id' => $task->id]); }}" enctype="multipart/form-data" id="task_update">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título*</label>
                    <input type="text" class="@error('title') is-invalid @enderror form-control"
                        id="title" name="title" max="120" value="{{ old('title') ?? $task->title }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') ?? $task->description }}</textarea>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="group_id" class="form-label">Grupo</label>
                        <select class="form-control" name="group_id">
                            @php($group_value = old('group_id') ?? $task->group_id)
                            <option value="" @if(!$group_value) selected @endif >Selecione o grupo</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" @if($group_value == $group->id) selected @endif >{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="user_id" class="form-label">Responsável</label>
                        <select class="form-control" name="user_id">
                            @php($user_value = old('user_id') ?? $task->user_id)
                            <option value="" @if(!$user_value) selected @endif >Selecione o responsável</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($user_value == $user->id) selected @endif >{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="daedline" class="form-label">Data de Finalização</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline') ??  $task->deadline }}">
                    </div>
                    <div class="col">
                        <label for="priority_id" class="form-label">Prioridade</label>
                        <select class="form-control" name="priority_id">
                            @php($priority_value = old('priority_id') ?? $task->priority_id)
                            <option value="" @if(!$priority_value) selected @endif >Selecione a prioridade</option>
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}" @if($priority_value == $priority->id) selected @endif >{{ $priority->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="status_id" class="form-label">Status*</label>
                        <select class="form-control" name="status_id">
                            @php($status_value = old('status_id') ?? $task->status_id)
                            <option value="" @if(!$status_value) selected @endif >Selecione o status</option>
                            @foreach($status as $status_option)
                                <option value="{{ $status_option->id }}" @if($status_value == $status_option->id) selected @endif >{{ $status_option->name }}</option>
                            @endforeach
                        </select>
                        @error('status_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tumb_file" class="form-label">Imagem destaque</label>
                    <input class="" type="file" id="tumb_file" name="tumb_file" onchange="previewImagem(event)">
                </div>
                <div class="col-2 small-box" data-toggle="modal" data-target="#modalTumb{{ $task->id; }}"
                     id="card_image" @if(!$task->tumb) style="display: none;" @endif>
                    <img id="preview" class="card-img-top" 
                         src="@if($task->tumb) {{ url("tumb_task/{$task->tumb}") }} @endif" alt="Image task">
                    <div class="d-flex flex-column justify-content-end align-items-end small-box-footer bg-white">
                        <i class="p-1 text-gray fas fa-expand"></i>
                    </div>
                </div>
                <input id="remove_tumb" style="display: none;" name="remove_tumb" value="false">
                <button type="button" class="btn btn-light btn-sm" onclick="removeImage()" @if(!$task->tumb) style="display: none;" @endif id="remove_image">
                    Remover imagem
                </button>
            </form>
        </div>    
        <div class="col-12 card-footer">
            <button type="submit" class="btn btn-primary" form="task_update">Atualizar</button>
        </div>
        
        <div class="modal fade" id="modalTumb{{ $task->id; }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <img id="preview_thumbnail" class="img-thumbnail" src="@if($task->tumb) {{ url("tumb_task/{$task->tumb}") }} @endif" alt="Image task">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImagem(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('preview');
                var preview_thumbnail = document.getElementById('preview_thumbnail');
                var card_image = document.getElementById('card_image');
                var remove_image = document.getElementById('remove_image');
                var remove_tumb = document.getElementById('remove_tumb');
                remove_tumb.value = 'false';
                card_image.style.display = 'block';
                remove_image.style.display = 'block';
                preview.src = reader.result;
                preview_thumbnail.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function removeImage(){
            var tumb_file = document.getElementById('tumb_file');
            var card_image = document.getElementById('card_image');
            var remove_image = document.getElementById('remove_image');
            var remove_tumb = document.getElementById('remove_tumb');
            remove_tumb.value = 'true';
            tumb_file.value = '';
            card_image.style.display = 'none';
            remove_image.style.display = 'none';
        }
    </script>
@endsection
