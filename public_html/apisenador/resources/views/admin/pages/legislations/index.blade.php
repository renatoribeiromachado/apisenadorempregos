@extends('adminlte::page')

@section('title', 'Legislação')

@section('content')

    <div class="card">
        <div class="card-header">
            
            <h1>Legislação <a href="{{ route('legislations.create') }}" class="btn btn-dark">ADD</a></h1>
            
            <form action="{{ route('legislations.search') }}" method="POST" class="form form-inline">
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
                            <th>Título</th>
                            <th>Link</th>
                            <th>Editar</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($legislations as $legislation)
                            <tr>
                                <td>{{ $legislation->title }}</td>
                                <td>{{ $legislation->link }}</td>
                                <td><a href="{{ route('legislations.edit', $legislation->url) }}" class="btn btn-info shadow"><i class="fa fa-edit"></i></a></td>
                                <td><a href="{{ route('legislations.show', $legislation->url) }}" class="btn btn-warning shadow"><i class="fa fa-lock"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                @if (isset($filters))
                    {!! $legislations->appends($filters)->links() !!}
                @else
                    {!! $legislations->links() !!}
                @endif
            </div>
            
        </div>

    </div>
@stop

