
@extends('adminlte::page')
@section('title', 'Cadastrar Nova legislação')

@section('content_header')
    <h1>Cadastrar Nova legislação</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('legislations.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.legislations._partials.form')
            </form>
        </div>
    </div>
@stop
