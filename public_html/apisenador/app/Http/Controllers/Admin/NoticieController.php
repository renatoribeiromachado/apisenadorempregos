<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Noticie;
use App\Http\Requests\StoreUpdateNoticie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
 
class NoticieController extends Controller
{
    private $noticie; 
    private $totalPage = 10;
    private $path = 'noticies';
    /**
     * 
     * @param noticies para visualizar a imagem no navegador
     * https://senador.acessohost.com.br/storage/noticies/testes-2.jpg
    **/


    public function __construct(Noticie $noticie)
    {
        $this->noticie = $noticie;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $noticies = $this->noticie->getResults($request->all(),$this->totalPage);
        //$noticies = $this->noticie->get();
        
        return view('admin.pages.noticies.index',[
            'title' => "Listagem de Noticias",
            'noticies' => $noticies
        ]);

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.noticies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateNoticie $request)
    {
        $data = $request->all();
        //dd($request->all());
        $data['url'] = Str::slug($request->title);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("/noticies");
        }

        $this->noticie->create($data);

        return redirect()->route('noticies.index')->with('msg', 'Cadastrado com sucesso!!');
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $url
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
       
        if (!$noticie = $this->noticie->where('url', $url)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.noticies.edit', compact('noticie'));
    }
    
    
    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $url
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateNoticie $request, $url)
    {
        if (!$noticie = $this->noticie->find($url)) {
            return redirect()->back();
        }

        $data = $request->all();
        $data['url'] = Str::slug($request->title);

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($noticie->image)) {
                Storage::delete($noticie->image);
            }

            $data['image'] = $request->image->store("/noticies");
        }

        $noticie->update($data);

        return redirect()->route('noticies.index')->with('msg', 'Editado com sucesso');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        if (!$noticie = $this->noticie->where('url', $url)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.noticies.show', compact('noticie'));
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
        if (!$noticie = $this->noticie->find($id)) {
            return redirect()->back();
        }

        if (Storage::exists($noticie->image)) {
            Storage::delete($noticie->image);
        }

        $noticie->delete();

        return redirect()->route('noticies.index')->with('msg', 'Deletado com sucesso');
    }
    
    
    /**
     * Serach the specified resource from storage.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $noticies = $this->noticie->search($request->filter);

        return view('admin.pages.noticiees.index', compact('noticies'));
    }


}
