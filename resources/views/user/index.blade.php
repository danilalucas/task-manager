@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listagem Usuários</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Usuários</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form method="get" action="{{ route('user.index'); }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="name" 
                                               placeholder="digite o nome do usuário" value="{{ $search['name'] ?? '' }}">
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
                                    <a class="btn btn-primary" href="{{ route('user.create'); }}">
                                        <i class="fas fa-plus"></i>
                                        Adicionar usuario
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
                                Nome
                            </th>
                            <th style="width: 10%">
                                Email
                            </th>
                            <th style="min-width: 238px;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id; }}
                                </td>
                                <td>
                                    {{ $user->name; }}
                                </td>
                                <td>
                                    {{ $user->email; }}
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('user.edit', ['id' => $user->id]); }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Editar
                                    </a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal{{ $user->id; }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($users as $user)
                    <div class="modal fade" id="modal{{ $user->id; }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Tem certeza que deseja deletar o usuário?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Usuário: {{ $user->id . ' - ' . $user->name; }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Não</button>
                                    <form action="{{ route('user.delete', ['id' => $user->id]); }}" method="post">
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
