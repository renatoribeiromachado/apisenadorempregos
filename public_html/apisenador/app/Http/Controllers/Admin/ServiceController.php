<?php

namespace App\Http\Controllers\Admin;

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
        //$services = $this->service->get();
        
        return view('admin.pages.services.index',[
            'title' => "Listagem de Planos",
            'services' => $services
        ]);

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateService $request)
    {
        $data = $request->all();
        //dd($request->all());
        $data['url'] = Str::slug($request->title);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("/services");
        }

        $this->service->create($data);

        return redirect()->route('services.index')->with('msg', 'Cadastrado com sucesso!!');
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $url
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
       
        if (!$service = $this->service->where('url', $url)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.services.edit', compact('service'));
    }
    
    
    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $url
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateService $request, $url)
    {
        if (!$service = $this->service->find($url)) {
            return redirect()->back();
        }

        $data = $request->all();
        $data['url'] = Str::slug($request->title);

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($service->image)) {
                Storage::delete($service->image);
            }

            $data['image'] = $request->image->store("/products");
        }

        $service->update($data);

        return redirect()->route('services.index')->with('msg', 'Editado com sucesso');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        if (!$service = $this->service->where('url', $url)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.services.show', compact('service'));
    }
    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        if (!$service = $this->service->find($id)) {
            return redirect()->back();
        }

        if (Storage::exists($service->image)) {
            Storage::delete($service->image);
        }

        $service->delete();

        return redirect()->route('services.index')->with('msg', 'Deletado com sucesso');
    }
    
    
    /**
     * Serach the specified resource from storage.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $services = $this->service->search($request->filter);

        return view('admin.pages.services.index', compact('services'));
    }


}
