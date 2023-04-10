@extends('adminlte::page')

@section('content_header')
    <h1>Detalhes da noticia <b>{{ $noticie->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if( !$noticie->image )         
                <img src="{{ url("images/sem-imagem.png") }}" class="img-fluid" alt="SEm Imagem definida" style="max-width: 90px;">        
            @else
               <img src="{{ url("storage/{$noticie->image}") }}" class="img-thumbnail img-fluid shadow" alt="{{ $noticie->title }}" style="max-width: 90px;">     
            @endif 
            
            <ul class="navbar-nav mt-3 mb-3">
                <li>
                    <strong>Título: </strong> {{ $noticie->title }}
                </li>
        
                <li>
                    <strong>Descrição: </strong> {{ $noticie->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('noticies.destroy', $noticie->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR {{ $noticie->title }}</button>
            </form>
        </div>
    </div>
@endsection
