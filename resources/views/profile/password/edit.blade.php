@extends('adminlte::page')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Alterar senha</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('profile.edit'); }}">Meus dados</a></li>
                        <li class="breadcrumb-item active">Alterar senha</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row-md-8 col-6 card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title">Alterar</h3>
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
            <form method="post" action="{{ route('profile.password.update'); }}" id="profile_password_update">
                @method('patch')
                @csrf
                <div class="mb-3 row">
                    <label for="password_current" class="col-sm-3 col-form-label">Senha atual:*</label>
                    <div class="col-sm-9">
                        <input type="password" class="@error('password_current') is-invalid @enderror form-control"
                        id="password_current" name="password_current" required>
                        @error('password_current')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-3 col-form-label">Nova senha:*</label>
                    <div class="col-sm-9">
                        <input type="password" class="@error('password') is-invalid @enderror form-control"
                        id="password" name="password" required>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password_confirmation" class="col-sm-3 col-form-label">Confirmar senha:*</label>
                    <div class="col-sm-9">
                        <input type="password" class="@error('password_confirmation') is-invalid @enderror form-control"
                        id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 card-footer">
            <button type="submit" class="btn btn-primary" form="profile_password_update">Atualizar</button>
        </div>
    </div>
@endsection
