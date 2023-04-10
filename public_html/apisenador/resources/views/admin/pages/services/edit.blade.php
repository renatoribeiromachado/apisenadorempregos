@extends('adminlte::page')

@section('title', "Editar o serviço {$service->title}")

@section('content_header')
    <h1>Editar o serviço {{ $service->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.update', $service->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.services._partials.form')
            </form>
        </div>
    </div>
@endsection
