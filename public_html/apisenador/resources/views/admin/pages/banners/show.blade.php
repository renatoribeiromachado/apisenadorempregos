@extends('adminlte::page')

@section('content_header')
    <h1>Detalhes do banner <b>{{ $banner->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if( !$banner->image )         
                <img src="{{ url("images/sem-imagem.png") }}" class="img-fluid" alt="SEm Imagem definida" style="max-width: 250px;">        
            @else
               <img src="{{ url("storage/{$banner->image}") }}" class="img-thumbnail img-fluid shadow" alt="{{ $banner->title }}" style="max-width: 250px;">     
            @endif 
            
            <ul class="navbar-nav mt-3 mb-3">
                <li>
                    <strong>Título: </strong> {{ $banner->title }}
                </li>
             </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR {{ $banner->title }}</button>
            </form>
        </div>
    </div>
@endsection
