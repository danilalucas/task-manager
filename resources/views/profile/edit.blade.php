@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar meus dados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Editar meus dados</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row-md-8 col-6 card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title">Editar dados</h3>
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
            <form method="post" action="{{ route('profile.update'); }}" id="profile_update">
                @method('patch')
                @csrf
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nome:*</label>
                    <div class="col-sm-10">
                        <input type="text" class="@error('name') is-invalid @enderror form-control"
                        id="name" name="name" max="120" value="{{ old('name') ?? $user->name }}" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email:*</label>
                    <div class="col-sm-10">
                        <input type="email" class="@error('email') is-invalid @enderror form-control"
                        id="email" name="email" max="120" value="{{ old('email') ?? $user->email }}" required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Senha:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"
                        id="password" name="password" value="********" disabled>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 card-footer">
            <button type="submit" class="btn btn-primary" form="profile_update">Atualizar</button>
        </div>
    </div>
@endsection
