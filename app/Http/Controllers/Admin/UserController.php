<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\newUserMail;
use Illuminate\Http\Request;
use App\Http\Requests\FormUserCreateRequest;
use App\Http\Requests\FormUserUpdateRequest;

use App\User;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
        $usersSystem = User::where('level', '<', 1)->get();

        /** Usuários e Empresas do sistema */
        $users = User::where('level', '=', 0)->get();
        // $companiesActive = Company::where('status', 'Ativa')->get();
        $companiesActive = Company::where('status', 'Pendente')
                                    ->orWhere('status', 'Ativa')
                                    ->orderBy('status','DESC')->get();

        $companiesPending = Company::where('status', 'Pendente')->get();

        return view('admin.users.index', compact('users', 'companiesActive', 'usersSystem', 'usersSuperAdmins', 'companiesPending'));
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
        dd($request->all());

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

        Mail::to('robertocnovos@gmail.com')->send(new newUserMail($user));

        return redirect()->route('company.index')->withInput()->with('success', 'usuário cadastro realizado com sucesso!');
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
    public function update(FormUserUpdateRequest $request, $uuid)
    {
        try{

            $updateUser = User::where('uuid', $uuid)->first();
            $updateUser->name = filter_var($request->name, FILTER_SANITIZE_STRING);
            $updateUser->email = filter_var($request->email, FILTER_SANITIZE_STRING);
            $updateUser->status = filter_var($request->status, FILTER_SANITIZE_STRING);

            if($request->password != null){
                $updateUser->password = bcrypt($request->password);
            }

            $updateUser->save();

            return redirect()->route('usuario.index')->withInput()->with('success', 'Usuário atualizado realizado com sucesso!');

        }catch(\Exception $e){
            Log::error('Erro ao tentar atualizar usuário. Menagem: ' . $e->getMessage());
            return redirect()->route('usuario.index')->withInput()->with('error', 'Opsss! Algo aconteceu de errado! Entre em contato com o administrador do sistema.');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {

        // $user = User::find($uuid);

        // $company = Company::find($user->company->id);

        // if(file_exists(url('storage/' . $company->docs))){
        //     unlink('storage/' . $company->docs);

        // }

        // $user->delete();


        // return redirect()->route('usuario.index')->withInput()->with('success', 'Usuário deletado com sucesso!');
    }
}
