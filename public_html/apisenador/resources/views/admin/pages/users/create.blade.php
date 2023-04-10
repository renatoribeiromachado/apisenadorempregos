
@extends('adminlte::page')
@section('title', 'Cadastrar Novo usuario')

@section('content_header')
    <h1>Cadastrar Novo usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop
