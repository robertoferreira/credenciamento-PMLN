<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormUserCreateRequest;
use App\Http\Requests\FormUserUpdateRequest;

use App\User;
use App\Models\Company;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** Usuários administrativos do sistema */
        $usersSuperAdmins = User::where('level', '>', 1)->get();

        /** Usuários administrativos do sistema */
        $usersSystem = User::where('level', '=', 1)->get();

        /** Usuários e Empresas do sistema */
        $users = User::where('level', '=', 0)->get();
        $companies = Company::all();
        return view('admin.users.index', compact('users', 'companies', 'usersSystem', 'usersSuperAdmins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormUserCreateRequest $request)
    {

        $user = new User();
        $user->uuid = Str::uuid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone_person = null;
        $user->document_person_owner = null;
        $user->birthday = null;
        $user->level = 1;
        $user->status = 'ativo';

        $user->save();

        return redirect()->route('usuario.index')->withInput()->with('success', 'usuário cadastro realizado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $userEdit = User::where('uuid', $uuid)->first();
        return view('admin.users.edit', compact('userEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $updateUser = User::where('uuid', $uuid);

        if($request->password == null){
            $updateUser->update($request->except(['password', '_token', '_method']));
        }else{
            $updateUser->update($request->all()->except(['_token', '_method']));
        }

        return redirect()->route('usuario.index')->withInput()->with('success', 'Usuário atualizado realizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {

        $user = User::find($uuid);

        $company = Company::find($user->company->id);
        unlink('storage/' . $company->docs);

        $user->delete();



        return redirect()->route('usuario.index')->withInput()->with('success', 'Usuário deletado com sucesso!');
    }
}
