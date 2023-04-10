@extends('adminlte::page')

@section('title', "Editar a noticia {$noticie->title}")

@section('content_header')
    <h1>Editar o serviço {{ $noticie->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('noticies.update', $noticie->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.noticies._partials.form')
            </form>
        </div>
    </div>
@endsection
