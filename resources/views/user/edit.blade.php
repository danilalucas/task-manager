@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar usuário</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.index'); }}">Listar usuários</a></li>
                        <li class="breadcrumb-item active">Editar usuário</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row-md-8 col-6 card card-outline card-secondary">
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
            <form method="post" action="{{ route('user.update', ['id' => $user->id]); }}" id="user_store">
                @method('patch')
                @csrf
                <div class="mb-3 row">
                    <label for="name" class="col-sm-3 col-form-label">Nome:</label>
                    <div class="col-sm-9">
                        <input type="text" class="@error('name') is-invalid @enderror form-control"
                        id="name" name="name" value="{{ old('name') ?? $user->name }}" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-3 col-form-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="email" class="@error('email') is-invalid @enderror form-control"
                        id="email" name="email" value="{{ old('email') ?? $user->email }}" required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-3 col-form-label">Senha:</label>
                    <div class="col-sm-9">
                        <input type="password" class="@error('password') is-invalid @enderror form-control"
                        id="password" name="password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password_confirmation" class="col-sm-3 col-form-label">Confirmar senha:</label>
                    <div class="col-sm-9">
                        <input type="password" class="@error('password_confirmation') is-invalid @enderror form-control"
                        id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 card-footer">
            <button type="submit" class="btn btn-primary" form="user_store">Atualizar</button>
        </div>
    </div>
@endsection
