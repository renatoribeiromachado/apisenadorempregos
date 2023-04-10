<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\SendMail;


class EmailController extends Controller
{
    public function index(Request $request)
    {
        //$data = $request->all();
      
        $data = [
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'assunto' => $request->assunto,
            'mensagem' => $request->mensagem,
        ];
       // dd($data);
        if(!$data = $request->all()){
           return response('Dados não informados!', 401); 
        }else{
               
            Mail::to('renato@acessohost.com.br')->send(new SendMail($data));

            //return response()->json($data, 201);
            return response('Obrigado, sua mensagem foi enviada com sucesso, logo entraremos em contato!', 201);
        }
    }
}