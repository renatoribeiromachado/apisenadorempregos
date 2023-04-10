@extends('adminlte::page')

@section('title', 'Banners')

@section('content')

    <div class="card">
        <div class="card-header">
            
            <h1>Banner <a href="{{ route('banners.create') }}" class="btn btn-dark">ADD</a></h1>
            
            <form action="{{ route('banners.search') }}" method="POST" class="form form-inline">
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
                            <th>Título</th>
                            <th>Editar</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                @if( !$banner->image )         
                                    <td><img src="{{ url("images/sem-imagem.png") }}" class="img-fluid" alt="SEm Imagem definida" style="max-width: 250px;"></td>         
                                @else
                                    <td><img src="{{ url("storage/{$banner->image}") }}" class="img-thumbnail img-fluid shadow" alt="{{ $banner->title }}" style="max-width: 250px;"></td>      
                                @endif 
                                <td>{{ $banner->title }}</td>
                                <td><a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-info shadow"><i class="fa fa-edit"></i></a></td>
                                <td><a href="{{ route('banners.show', $banner->id) }}" class="btn btn-warning shadow"><i class="fa fa-lock"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@stop

