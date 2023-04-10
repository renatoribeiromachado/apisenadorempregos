@extends('adminlte::page')

@section('content_header')
    <h1>Detalhes da legislação <b>{{ $legislation->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            
            <ul class="navbar-nav mt-3 mb-3">
                <li>
                    <strong>Título: </strong> {{ $legislation->title }}
                </li>
        
                <li>
                    <strong>Link: </strong> {{ $legislation->link }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('legislations.destroy', $legislation->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR {{ $legislation->title }}</button>
            </form>
        </div>
    </div>
@endsection
