@extends('adminlte::page')

@section('title', "Editar o usuario {$user->name}")

@section('content_header')
    <h1>Editar o usuarios {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="label" for="selecao-arquivo"><i class="fa fa-camera"></i> Anexar Imagem</label>
                    <input type="file" name="image" id="selecao-arquivo" class="form-control">
                </div>

                <div class="form-group">
                    <label>* Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
                </div>

                <div class="form-group">
                    <label>* Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email:" value="{{ $user->email ?? old('email') }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-dark btnSubmit">Enviar</button>
                </div>

            </form>
        </div>
    </div>
    <style>
        /* Esconde o input */
        input[type='file'] {
            display: none
        }

        /* Aparência que terá o seletor de arquivo */
        .label {
            background-color: green;
            border-radius: 30px;
            color: #fff;
            font-weight: 700 !important;
            cursor: pointer;
            margin: 10px;
            padding: 6px 20px
        }
    </style>

    <script>
        let btnSubmit = document.querySelector('.btnSubmit');

        btnSubmit.addEventListener('submit', function(){
           btnSubmit.InnerHTML = "Aguarde inserindo";
        });

    </script>
@endsection
