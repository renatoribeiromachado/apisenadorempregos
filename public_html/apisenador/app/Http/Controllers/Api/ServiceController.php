<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Requests\StoreUpdateService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    private $service; 
    private $totalPage = 10;
    private $path = 'services';
    /**
     * 
     * @param Service para visualizar a imagem no navegador
     * https://senador.acessohost.com.br/storage/services/testes-2.jpg
    **/


    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = $this->service->getResults($request->all(),$this->totalPage);
        //$services = $this->product->get();

        return response()->json($services);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateService $request)
    {
        
        $data = $request->all();
         
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = Str::slug($request->name);
            $extension = $request->image->extension();

            $nameFile = "{$name}.{$extension}";
            $data['image'] = $nameFile;

            $upload = $request->image->storeAs($this->path, $nameFile);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $service = $this->service->create($data);

        return response()->json($service, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (!$service = $this->service->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        return response()->json($service);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateService $request, $id)
    {
        if (!$service = $this->service->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($service->image) {
                if (Storage::exists("{$this->path}/{$service->image}"))
                    Storage::delete("{$this->path}/{$service->image}");
            }

            $name = Str::slug($request->name);
            $extension = $request->image->extension();

            $nameFile = "{$name}.{$extension}";
            $data['image'] = $nameFile;

            $upload = $request->image->storeAs($this->path, $nameFile);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $service->update($data);

        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$service = $this->product->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        if ($service->image) {
            if (Storage::exists("{$this->path}/{$service->image}"))
                Storage::delete("{$this->path}/{$service->image}");
        }

        $service->delete();

        return response()->json(['success' => true], 204);
    }
}
