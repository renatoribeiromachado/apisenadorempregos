
@extends('adminlte::page')
@section('title', 'Cadastrar Novo Banner')

@section('content_header')
    <h1>Cadastrar Novo Banner</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('banners.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.banners._partials.form')
            </form>
        </div>
    </div>
@stop
