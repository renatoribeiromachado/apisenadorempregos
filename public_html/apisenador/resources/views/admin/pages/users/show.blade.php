@extends('adminlte::page')

@section('content_header')
    <h1>Detalhes do usuario <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if( !$user->image )         
                <img src="{{ url("images/sem-imagem.png") }}" class="img-fluid" alt="Sem Imagem definida" style="max-width: 90px;">        
            @else
               <img src="{{ url("storage/{$user->image}") }}" class="img-thumbnail img-fluid shadow" alt="{{ $user->name }}" style="max-width: 90px;">     
            @endif 
            
            <ul class="navbar-nav mt-3 mb-3">
                <li>
                    <strong>Nome: </strong> {{ $user->name }}
                </li>
        
                <li>
                    <strong>Email: </strong> {{ $user->email }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR {{ $user->name }}</button>
            </form>
        </div>
    </div>
@endsection
