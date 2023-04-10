<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Http\Requests\StoreUpdateProduct;

class ConfigController extends Controller
{
    private $config; 
    private $totalPage = 10;
    private $path = 'api_config_senador';

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = $this->config->get();
        //$configs = $this->config->get();

        return response()->json($configs);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateBanner $request)
    {
        
        $data = $request->all();

        $config = $this->config->create($data);

        return response()->json($config, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$config = $this->config->with('id')->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        return response()->json($config);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
        if (!$config = $this->config->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $data = $request->all();

        $config->update($data);

        return response()->json($config);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$config = $this->config->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $config->delete();

        return response()->json(['success' => true], 204);
    }
}
