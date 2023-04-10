
@extends('adminlte::page')
@section('title', 'Cadastrar Novo Serviço')

@section('content_header')
    <h1>Cadastrar Novo Serviço</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.services._partials.form')
            </form>
        </div>
    </div>
@stop
