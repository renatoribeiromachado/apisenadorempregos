@extends('adminlte::page')

@section('title', 'Serviços')

@section('content')

    <div class="card">
        <div class="card-header">
            
            <h1>Serviços <a href="{{ route('services.create') }}" class="btn btn-dark">ADD</a></h1>
            
            <form action="{{ route('services.search') }}" method="POST" class="form form-inline">
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
                            <th>Descrição</th>
                            <th>Editar</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                @if( !$service->image )         
                                    <td><img src="{{ url("images/sem-imagem.png") }}" class="img-fluid" alt="SEm Imagem definida" style="max-width: 90px;"></td>         
                                @else
                                    <td><img src="{{ url("storage/{$service->image}") }}" class="img-thumbnail img-fluid shadow" alt="{{ $service->title }}" style="max-width: 90px;"></td>      
                                @endif 
                                <td>{{ $service->title }}</td>
                                <td>{{ Str::limit($service->description, 60, '...') }}</td>
                                <td><a href="{{ route('services.edit', $service->url) }}" class="btn btn-info shadow"><i class="fa fa-edit"></i></a></td>
                                <td><a href="{{ route('services.show', $service->url) }}" class="btn btn-warning shadow"><i class="fa fa-lock"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                @if (isset($filters))
                    {!! $services->appends($filters)->links() !!}
                @else
                    {!! $services->links() !!}
                @endif
            </div>
            
        </div>

    </div>
@stop

