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
                @include('tasks._partials.form')
            </form>
        </div>
        <div class="col-12 card-footer">
            <button type="submit" class="btn btn-primary" form="task_update">Atualizar</button>
            <a href="{{ route('task.index') }}" class="btn btn-secondary">Cancelar</a>
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
@endsection
