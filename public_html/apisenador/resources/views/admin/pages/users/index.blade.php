@extends('adminlte::page')

@section('title', 'Usuários')

@section('content')

    <div class="card">
        <div class="card-header">
            
            <h1>Usuários <a href="{{ route('users.create') }}" class="btn btn-dark">ADD</a></h1>
            
            <form action="{{ route('users.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        
        @if(session('msg'))
            <div class="card-header">
                <div class="alert alert-success">
                    <p class="text-center">
                        {{ session('msg') }}
                    </p>
                </div>
            </div>
        @endif
        
        <div class="table table-responsive">
            <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th width="100" class="text-center"><i class="fa fa-camera fa-3x"></i></th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Editar</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                @if( !$user->image )         
                                    <td><img src="{{ url("images/sem-imagem.png") }}" class="img-fluid" alt="SEm Imagem definida" style="max-width: 90px;"></td>         
                                @else
                                    <td><img src="{{ url("storage/{$user->image}") }}" class="img-thumbnail img-fluid shadow" alt="{{ $user->name }}" style="max-width: 90px;"></td>      
                                @endif 
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{ route('users.edit', $user->url) }}" class="btn btn-info shadow"><i class="fa fa-edit"></i></a></td>
                                <td><a href="{{ route('users.show', $user->url) }}" class="btn btn-warning shadow"><i class="fa fa-lock"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                @if (isset($filters))
                    {!! $users->appends($filters)->links() !!}
                @else
                    {!! $users->links() !!}
                @endif
            </div>
            
        </div>

    </div>
@stop

