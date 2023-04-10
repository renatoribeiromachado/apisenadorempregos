@extends('adminlte::page')

@section('content_header')
    <h1>Detalhes do serviço <b>{{ $service->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if( !$service->image )         
                <img src="{{ url("images/sem-imagem.png") }}" class="img-fluid" alt="SEm Imagem definida" style="max-width: 90px;">        
            @else
               <img src="{{ url("storage/{$service->image}") }}" class="img-thumbnail img-fluid shadow" alt="{{ $service->title }}" style="max-width: 90px;">     
            @endif 
            
            <ul class="navbar-nav mt-3 mb-3">
                <li>
                    <strong>Título: </strong> {{ $service->title }}
                </li>
        
                <li>
                    <strong>Descrição: </strong> {{ $service->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR {{ $service->title }}</button>
            </form>
        </div>
    </div>
@endsection
