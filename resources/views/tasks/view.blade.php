@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visualizar task</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('task.index'); }}">Tasks</a></li>
                        <li class="breadcrumb-item active">Visualizar task</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class=" card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title">Detalhes</h3>
        </div>
        <div class="card-body">

            <div class="row align-items-start">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <h3 class="text-primary">{{ $task->title; }}</h3>
                    <p>{{ $task->description; }}</p>
                    <br>
                    <div class="text-muted">
                        <p>Responsável <b class="d-block">{{ $task->user->name ?? '--'; }}</b></p>
                    </div>
                    <h5 class="mt-5 text-muted">Thumbnail</h5>
                    @if( $task->tumb )
                        <div class="col-4 small-box" data-toggle="modal" data-target="#modalTumb{{ $task->id; }}">
                            <img class="card-img-top" src="{{ url("tumb_task/{$task->tumb}") }}" alt="{{ $task->tumb }}">
                            <div class="d-flex flex-column justify-content-end align-items-end small-box-footer bg-white">
                                <i class="p-1 text-gray fas fa-expand"></i>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                    <div class="row justify-content-end">
                        <div class="col-12 col-sm-8">
                            <div class="info-box bg-light">
                              <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Grupo:</span>
                                <span class="info-box-number text-center text-muted mb-0">{{ $task->group->name ?? '--'; }}</span>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-12 col-sm-8">
                            <div class="info-box bg-light">
                              <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Prioridade</span>
                                <span class="info-box-number text-center mb-0 rounded-pill {{ $task->priority?->color }}">{{ $task->priority->name ?? '--'; }}</span>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-12 col-sm-8">
                            <div class="info-box bg-light">
                              <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Status:</span>
                                <span class="info-box-number text-center mb-0 rounded-pill {{ $task->status?->color }}">{{ $task->status->name ?? '--'; }}</span>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>  
        </div>
        <div class="card-footer bg-transparent">
            <div class="row justify-content-end">
                <div class="text-center mt-5 mb-3">
                    <a href="{{ route('task.edit', ['id' => $task->id]); }}" class="btn btn-sm btn-info">
                        <i class="fas fa-pencil-alt"></i>
                        Editar
                    </a>
                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal{{ $task->id; }}">
                        <i class="fas fa-trash"></i>
                        Excluir
                    </a>
                    <a class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalFiled{{ $task->id; }}">
                        <i class="fas fa-file"></i>
                        @if($task->filed) Desarquivar @else Arquivar @endif
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTumb{{ $task->id; }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img class="img-thumbnail" src="{{ url("tumb_task/{$task->tumb}") }}" alt="{{ $task->tumb }}">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal{{ $task->id; }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        @if($task->filed) 
                            Tem certeza que deseja desarquivar a task? 
                        @else
                            Tem certeza que deseja arquivar a task? 
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Task: {{ $task->id . ' - ' . $task->title; }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Não</button>
                    <form action="{{ route('task.filedOrUnfiled', ['id' => $task->id]); }}" method="post">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">@if($task->filed) Desarquivar @else Arquivar @endif</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFiled{{ $task->id; }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        @if($task->filed) 
                            Tem certeza que deseja desarquivar a task? 
                        @else
                            Tem certeza que deseja arquivar a task? 
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Task: {{ $task->id . ' - ' . $task->title; }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Não</button>
                    <form action="{{ route('task.filedOrUnfiled', ['id' => $task->id]); }}" method="post">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">@if($task->filed) Desarquivar @else Arquivar @endif</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
