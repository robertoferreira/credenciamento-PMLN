<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Admin\OutletPrice;
use App\User;
use App\Models\Certificate;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLoginCompany = null;


        /** PEGA USUÁRIOS */
        $userLoginCompany = Auth::user()->company['status'];
        $userLoginlevel = Auth::user()->level;

        if($userLoginCompany != 'Ativa'){
            $userLoginCompany = false;
        }

        if($userLoginlevel == 1 || $userLoginlevel == 3){
            $userLoginCompany = true;
        }



        //** PEGA TODAS AS TOMADAS DE PREÇOS */
        $outletPrices = OutletPrice::where('status', 'ativo')->orderBy('created_at', 'desc')->get();

        return view('admin.index', compact('outletPrices', 'userLoginCompany'));
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
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $company = Company::where('id', $id)->first();

        $certificates = Certificate::orderBy('created_at', 'desc')->where('company_id', $id)->get();

        /** PEGA O ÚLTIMO CERTIFICADO */
        $lastCertificate = Certificate::latest()->first();

        return view('admin.company.show', compact('company', 'certificates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        /* BUSCA INFORMAÇÕES DA EMPRESA PARA EDIÇÃO */
        $company = Company::where('id', $id)->first();

        if($id != Auth::user()->company->id){
            return redirect()->back()->with('warning', 'Você não tem acesso para editar este usuário.');
        }
        return view('admin.company.index', compact('company'));

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
        if($id != Auth::user()->company->id){
            return redirect()->back()->with('warning', 'Você não tem acesso para editar este usuário.');
        }

        //$cnaiExists = Company::find($id);

        $company = Company::find($id);
        $company->type = 'physical_business';
        $company->provider = $request->provider;
        $company->document = $request->document;
        $company->name_business = $request->name_business;
        $company->zipcode = $request->zipcode;
        $company->address = $request->address;
        $company->number_address = $request->number_address;
        $company->complement = $request->complement;
        $company->neighborhood = $request->neighborhood;
        $company->city = $request->city;
        $company->state = $request->state;
        $company->phone_business = $request->phone_business;
        $company->status = $request->status;


        if($request->file('docs') != null){
            if(file_exists(url('storage/' . $company->docs))){
                unlink('storage/' . $company->docs);
                $docs = $request->file('docs')->store('docs');
            }else{
                $docs = $request->file('docs')->store('docs');
            }


            //$docs = $request->file('docs')->store('docs');
        }


        //dd($request->docs_old);

//        if($request->file('docs') == null){
//            $docs = $request->docs_old;
//        }


        $company->docs = $docs;

        $company->save();


        return redirect()->route('company.index')->withInput()->with('success', 'Cadastro Atualizado com sucesso!');
    }

    public function observationUpdate(Request $request, $id)
    {
        $company = Company::find($id);

        $company->observation = $request->observation;
        $company->status = $request->status;
        $company->save();

        return redirect()->route('company.index')->withInput()->with('success', 'Informação enviada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();

        return redirect()->route('company.index')->withInput()->with('success', 'Empresa deletada com sucesso!');
    }
}
