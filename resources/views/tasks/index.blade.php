@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Tasks</h1>
            <figcaption class="blockquote-footer">
               Listagem de todas os registros cadastrados 
            </figcaption>

            <form class="mb-4 border-2 border-bottom border-primary">
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <input type="password" class="form-control" id="inputPassword" placeholder="pesquisar por título">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary mb-3 col-sm-12">Pesquisar</button>
                    </div>

                </div>
              </form>

            @foreach ($tasks as $task)
                <div class="card">
                    <div class="card-header">
                        {{ $task->group->name; }}
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title; }}</h5>
                        <span class="badge rounded-pill" style="background-color: {{ $task->priority->color }}">{{ $task->priority->name }}</span>
                        <p class="card-text">{{ mb_strimwidth($task->description, 0, 200, "..."); }}</p>
                        <div class="row">
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-outline-primary" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .80rem;">Ver</button>
                                <button type="button" class="btn btn-outline-secondary" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .80rem;">Editar</button>
                                <button type="button" class="btn btn-outline-danger" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .80rem;">Excluir</button>
                            </div>
                            <div class="col-sm-4">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-dark" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .80rem;" disabled>Reponsavel: {{ $task->responsible->name }}</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <br>
            @endforeach

        </div>
    </div>
</div>
@endsection