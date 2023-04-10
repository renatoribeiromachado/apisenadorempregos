@extends('adminlte::page')

@section('title', "Editar o serviço {$legislation->title}")

@section('content_header')
    <h1>Editar a legislação {{ $legislation->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('legislations.update', $legislation->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.legislations._partials.form')
            </form>
        </div>
    </div>
@endsection
