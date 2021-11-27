<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Admin\OutletPrice;
use App\User;
use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //** PEGA TODAS AS TOMADAS DE PREÇOS RECEBENDO ENVELOPE */
        $outletPrices = OutletPrice::where('status', 'Recebimento de Envelope')->orderBy('created_at', 'desc')->get();

        //** PEGA TODAS AS TOMADAS DE PREÇOS EM ANDAMENTO */
        $outletPricesOpen = OutletPrice::where('status', 'Em Andamento')->orderBy('created_at', 'desc')->get();

        //** PEGA TODAS AS TOMADAS DE PREÇOS ENCERRADO */
        $outletPricesClosed = OutletPrice::where('status', 'Encerrado')->orderBy('created_at', 'desc')->get();

        if(Auth::user()->level == 0){
            $company = Company::where('id', Auth::user()->company->id)->first();
            return view('admin.index', compact('outletPrices', 'company', 'outletPricesOpen', 'outletPricesClosed'));
        }

        if(Auth::user()->level == 3){
            $company = Company::all();
            return view('admin.index-admin', compact('outletPrices', 'company', 'outletPricesOpen', 'outletPricesClosed'));
        }


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


        if($request->file('docs')){
            if($company->docs != null){
                Storage::disk('s3')->delete($company->docs);
                $docs = $request->file('docs')->store('docs');
            }else{
                $docs = $request->file('docs')->store('docs');
            }
        }


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
