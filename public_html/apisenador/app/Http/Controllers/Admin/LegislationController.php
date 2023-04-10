<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Legislation;
use App\Http\Requests\StoreCreateLegislation;
use App\Http\Requests\StoreUpdateLegislation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
 
class LegislationController extends Controller
{
    private $noticie; 
    private $totalPage = 10;
    private $path = 'legislations';
    /**
     * 
     * @param noticies para visualizar a imagem no navegador
     * https://senador.acessohost.com.br/storage/legislations/testes-2.jpg
    **/


    public function __construct(Legislation $legislation)
    {
        $this->legislation = $legislation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $legislations = $this->legislation->getResults($request->all(),$this->totalPage);
        //$legislations = $this->legislation->get();
        
        return view('admin.pages.legislations.index',[
            'title' => "Listagem de legislação",
            'legislations' => $legislations
        ]);

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.legislations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreateLegislation $request)
    {
        $data = $request->all();
        //dd($request->all());
        $data['url'] = Str::slug($request->title);
        $data['link'] = $request->link->store("/legislations");
     
        $this->legislation->create($data);

        return redirect()->route('legislations.index')->with('msg', 'Cadastrado com sucesso!!');
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $url
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
       
        if (!$legislation = $this->legislation->where('url', $url)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.legislations.edit', compact('legislation'));
    }
    
    
    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $url
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLegislation $request, $url)
    {
        if (!$legislation = $this->legislation->find($url)) {
            return redirect()->back();
        }

        $data = $request->all();
        $data['url'] = Str::slug($request->title);
        
        if ($request->hasFile('link') && $request->link->isValid()) {
    
            if (Storage::exists($legislation->link)) {
                Storage::delete($legislation->link);
            }

            $data['link'] = $request->link->store("/legislations");
        }

        $legislation->update($data);

        return redirect()->route('legislations.index')->with('msg', 'Editado com sucesso');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        if (!$legislation = $this->legislation->where('url', $url)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.legislations.show', compact('legislation'));
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
        if (!$legislation = $this->legislation->find($id)) {
            return redirect()->back();
        }

        $legislation->delete();

        return redirect()->route('legislations.index')->with('msg', 'Deletado com sucesso');
    }
    
    
    /**
     * Serach the specified resource from storage.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $legislations = $this->legislation->search($request->filter);

        return view('admin.pages.legislations.index', compact('legislations'));
    }


}
