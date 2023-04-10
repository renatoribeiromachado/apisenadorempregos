<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Http\Requests\StoreUpdateConfig;


class ConfigController extends Controller
{
    private $config; 

    /**
     * 
     * @param Service para visualizar a imagem no navegador
     * https://senador.acessohost.com.br/storage/services/testes-2.jpg
    **/


    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $configs = $this->config->get();
        
        return view('admin.pages.configs.index',[
            'title' => "Listagem de Configuração",
            'configs' => $configs
        ]);

    }
    
    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateConfig $request, $id)
    {
        if (!$config = $this->config->find($id)) {
            return redirect()->back();
        }

        $config->update($request->all());

        return redirect()->route('configs.index')->with('msg', 'Editado com sucesso');
    }
   
}
