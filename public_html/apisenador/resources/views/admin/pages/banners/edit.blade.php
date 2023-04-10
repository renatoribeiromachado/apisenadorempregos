@extends('adminlte::page')

@section('title', "Editar o Banner {$banner->title}")

@section('content_header')
    <h1>Editar o banner {{ $banner->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('banners.update', $banner->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.banners._partials.form')
            </form>
        </div>
    </div>
@endsection
