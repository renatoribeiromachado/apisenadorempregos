<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Http\Requests\StoreUpdateProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    private $banner; 
    private $totalPage = 10;
    private $path = 'banners';
    /**
     * 
     * @param Banners para visualizar a imagem no navegador
     * https://senador.acessohost.com.br/storage/banners/testes-2.jpg
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
    public function index(Request $request)
    {
        $banners = $this->banner->getResults($request->all(),$this->totalPage);
        //$banners = $this->banner->get();

        return response()->json($banners);
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
         
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = Str::slug($request->name);
            $extension = $request->image->extension();

            $nameFile = "{$name}.{$extension}";
            $data['image'] = $nameFile;

            $upload = $request->image->storeAs($this->path, $nameFile);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $banner = $this->banner->create($data);

        return response()->json($banner, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$banner = $this->banner->with('id')->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        return response()->json($banner);
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
        if (!$banner = $this->banner->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($banner->image) {
                if (Storage::exists("{$this->path}/{$banner->image}"))
                    Storage::delete("{$this->path}/{$banner->image}");
            }

            $name = Str::slug($request->name);
            $extension = $request->image->extension();

            $nameFile = "{$name}.{$extension}";
            $data['image'] = $nameFile;

            $upload = $request->image->storeAs($this->path, $nameFile);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $banner->update($data);

        return response()->json($banner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$banner = $this->banner->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        if ($banner->image) {
            if (Storage::exists("{$this->path}/{$banner->image}"))
                Storage::delete("{$this->path}/{$banner->image}");
        }

        $banner->delete();

        return response()->json(['success' => true], 204);
    }
}
