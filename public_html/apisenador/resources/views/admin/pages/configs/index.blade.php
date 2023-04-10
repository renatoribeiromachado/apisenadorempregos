@extends('adminlte::page')

@section('title', 'Configuração')

@section('content')

    <div class="card">
 
        
        @if(session('msg'))
            <div class="card-header">
                <div class="alert alert-success">
                    <p class="text-center">
                        {{ session('msg') }}
                    </p>
                </div>
            </div>
        @endif
        <div class="card-header">
            <h1>Configuração do site</h1>
        </div>

        <div class="card-body">
            @foreach ($configs as $config)
                <form action="{{ route('configs.update', $config->id) }}" method="POST">
                    
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label><strong><i class="fas fa-building"></i> Empresa:</strong></label>
                        <input type="text" name="fantasy" class="form-control" value="{{ $config->fantasy }}"/>
                    </div>

                    <div class="form-group">
                        <label><strong><i class="fas fa-home"></i> Site:</strong></label>
                        <input type="text" name="site" class="form-control" value="{{ $config->site }}"/>
                    </div>

                    <div class="form-group">
                        <label><strong><i class="fas fa-envelope"></i> E-mail:</strong></label>
                        <input type="text" name="email" class="form-control" value="{{ $config->email }}"/>
                    </div>

                    <div class="form-group">
                        <label><strong><i class="fas fa-check"></i> Descrição:</strong></label>
                        <input type="text" name="description" class="form-control" value="{{ $config->description }}"/>
                    </div>

                    <div class="form-group">
                        <label><strong><i class="fas fa-phone"></i> Telefone:</strong></label>
                        <input type="text" name="phone" class="form-control" value="{{ $config->phone }}"/>
                    </div>

                    <div class="form-group">
                        <label><strong><i class="fas fa-map-marker"></i> Endereço:</strong></label>
                        <input type="text" name="adress" class="form-control" value="{{ $config->adress }}"/>
                    </div>

                    <div class="form-group">
                        <label><strong><i class="fas fa-check"></i> Visão:</strong></label>
                        <input type="text" name="vision" class="form-control" value="{{ $config->vision }}"/>
                    </div>

                    <div class="form-group">
                        <label><strong><i class="fas fa-check"></i> Atendimento:</strong></label>
                        <input type="text" name="service" class="form-control" value="{{ $config->service }}"/>
                    </div>


                    <div class="alert alert-warning">
                        <p><strong>REDE SOCIAL</strong></p>
                    </div>


                    <div class="form-group">
                        <label><strong><i class="fab fa-facebook-f"></i> Facebook: </strong></label>
                        <input type="text" name="facebook" class="form-control" value="{{ $config->facebook }}"/>
                    </div>

                     <div class="form-group">
                        <label><strong><i class="fab fa-instagram"></i> Instagram: </strong></label>
                        <input type="text" name="instagram" class="form-control" value="{{ $config->instagram }}"/>
                    </div>

                     <div class="form-group">
                        <label><strong><i class="fab fa-linkedin"></i> Linkedin:</strong></label>
                        <input type="text" name="linkedin" class="form-control" value="{{ $config->linkedin }}"/>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-success btnSubmit">Atualizar</button>
                    </div>

                </form>
            @endforeach
        </div>

    </div>

@stop

