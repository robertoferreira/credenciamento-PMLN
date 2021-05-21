<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\newUserMail;
use App\Mail\newUserRegistered;
use Illuminate\Http\Request;
use App\Models\Company;
use App\User;
use App\Http\Requests\FormHomeRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormHomeRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->uuid = Str::uuid();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone_person = $request->phone_person;
        $user->document_person_owner = $request->document_person_owner;
        $user->birthday = $request->birthday;
        $user->level = 0;
        $user->status = 'ativo';
        $user->save();

        $company = new Company();
        $company->type = 'physical_business';
        $company->user_id = $user->id;
        $company->provider = $request->provider;
        $company->document = $request->document;
        $company->name_business = $request->name_business;
        $company->share_capital = $request->share_capital;
        $company->zipcode = $request->zipcode;
        $company->address = $request->address;
        $company->number_address = $request->number_address;
        $company->complement = $request->complement;
        $company->neighborhood = $request->neighborhood;
        $company->city = $request->city;
        $company->state = $request->state;
        $company->phone_business = $request->phone_business;
        $company->status = 'Pendente';

        if($request->file('docs')){
            $cnai = $request->file('docs')->store('docs');
        }

        $company->docs = $cnai;

        $company->save();

        //Mail::to(env('MAIL_FROM_ADDRESS'))->send(new newUserMail($user));
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new newUserRegistered($user));


        return redirect()->route('site.home')->withInput()->with('success', 'Cadastro realizado com sucesso!');
        //dd($request->all());
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
