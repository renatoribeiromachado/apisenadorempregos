@extends('adminlte::page')

@section('title', 'Noticias')

@section('content')

    <div class="card">
        <div class="card-header">
            
            <h1>Noticias <a href="{{ route('noticies.create') }}" class="btn btn-dark">ADD</a></h1>
            
            <form action="{{ route('noticies.search') }}" method="POST" class="form form-inline">
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
                        @foreach ($noticies as $noticie)
                            <tr>
                                @if( !$noticie->image )         
                                    <td><img src="{{ url("images/sem-imagem.png") }}" class="img-fluid" alt="SEm Imagem definida" style="max-width: 90px;"></td>         
                                @else
                                    <td><img src="{{ url("storage/{$noticie->image}") }}" class="img-thumbnail img-fluid shadow" alt="{{ $noticie->title }}" style="max-width: 90px;"></td>      
                                @endif 
                                <td>{{ $noticie->title }}</td>
                                <td>{{ Str::limit($noticie->description, 60, '...') }}</td>
                                <td><a href="{{ route('noticies.edit', $noticie->url) }}" class="btn btn-info shadow"><i class="fa fa-edit"></i></a></td>
                                <td><a href="{{ route('noticies.show', $noticie->url) }}" class="btn btn-warning shadow"><i class="fa fa-lock"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                @if (isset($filters))
                    {!! $noticies->appends($filters)->links() !!}
                @else
                    {!! $noticies->links() !!}
                @endif
            </div>
            
        </div>

    </div>
@stop

