<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Http\Requests\StoreUpdateBanner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    private $banner; 
    private $totalPage = 10;
    private $path = 'banners';
    /**
     * 
     * @param Service para visualizar a imagem no navegador
     * https://senador.acessohost.com.br/storage/services/testes-2.jpg
    **/


    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->banner->get();
        //$services = $this->service->get();
        
        return view('admin.pages.banners.index',[
            'title' => "Listagem de Banners",
            'banners' => $banners
        ]);

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateBanner $request)
    {
        $data = $request->all();
        //dd($request->all());
        $data['url'] = Str::slug($request->title);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("/banners");
        }

        $this->banner->create($data);

        return redirect()->route('banners.index')->with('msg', 'Cadastrado com sucesso!!');
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        if (!$banner = $this->banner->where('id', $id)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.banners.edit', compact('banner'));
    }
    
    
    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $url
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateBanner $request, $url)
    {
        if (!$banner = $this->banner->find($url)) {
            return redirect()->back();
        }

        $data = $request->all();
        $data['url'] = Str::slug($request->title);

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($banner->image)) {
                Storage::delete($banner->image);
            }

            $data['image'] = $request->image->store("/banners");
        }

        $banner->update($data);

        return redirect()->route('banners.index')->with('msg', 'Editado com sucesso');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$banner = $this->banner->where('id', $id)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.banners.show', compact('banner'));
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
        if (!$banner = $this->banner->find($id)) {
            return redirect()->back();
        }

        if (Storage::exists($banner->image)) {
            Storage::delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('banners.index')->with('msg', 'Deletado com sucesso');
    }
    
    
    /**
     * Serach the specified resource from storage.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $banners = $this->banner->search($request->filter);

        return view('admin.pages.banners.index', compact('banners'));
    }


}
