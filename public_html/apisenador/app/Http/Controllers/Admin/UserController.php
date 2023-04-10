<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreCreateUser;
use App\Http\Requests\StoreUpdateUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user; 
    private $totalPage = 10;
    private $path = 'users';
    /**
     * 
     * @param Service para visualizar a imagem no navegador
     * https://senador.acessohost.com.br/storage/users/testes-2.jpg
    **/


    public function __construct(User $users)
    {
        $this->user = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->user->getResults($request->all(),$this->totalPage);
        //$users = $this->user->get();
        
        return view('admin.pages.users.index',[
            'title' => "Listagem de usuarios",
            'users' => $users
        ]);

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreateUser $request)
    {
        $data = $request->all();
        //dd($request->all());
        $data['url'] = Str::slug($request->name);

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("/users");
        }
        
        $data['url'] = Str::slug($request->name);
        $data['password'] = Hash::make($request->password);

        $this->user->create($data);

        return redirect()->route('users.index')->with('msg', 'Cadastrado com sucesso!!');
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $url
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
       
        if (!$user = $this->user->where('url', $url)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', compact('user'));
    }
    
    
    /**
     * Update register by id
     *
     * @param  \App\Http\Requests\StoreUpdateProduct  $request
     * @param  int  $url
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $url)
    {
        if (!$user = $this->user->find($url)) {
            return redirect()->back();
        }

        $data = $request->all();
        $data['url'] = Str::slug($request->name);

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            $data['image'] = $request->image->store("/users");
        }

        $user->update($data);

        return redirect()->route('users.index')->with('msg', 'Editado com sucesso');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        if (!$user = $this->user->where('url', $url)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', compact('user'));
    }
    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!$user = $this->user->find($id)) {
            return redirect()->back();
        }

        if (Storage::exists($user->image)) {
            Storage::delete($user->image);
        }

        $user->delete();

        return redirect()->route('users.index')->with('msg', 'Deletado com sucesso');
    }
    
    
    /**
     * Serach the specified resource from storage.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $users = $this->user->search($request->filter);

        return view('admin.pages.users.index', compact('users'));
    }


}
