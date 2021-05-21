<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Str;

use Auth;

class CertificateController extends Controller
{
    /**
     * Teste de git php
     *
     */
    public function certificate($uuid)
    {
        $certificate = Certificate::where('uuid', $uuid)->first();

        //$finaDate = Carbon::parse($certificate->expired_at)->format('d/m/Y');

        $mainActivity = json_decode($certificate->main_activity);
        $secondaryActivity = json_decode($certificate->secondary_activity);
        return view('admin.certificate.certificate', compact('certificate', 'mainActivity', 'secondaryActivity'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idCompany = Auth::user()->company->id;

        $certificates = Certificate::orderBy('created_at', 'desc')->where('company_id', $idCompany)->get();

        /** PEGA O ÚLTIMO CERTIFICADO */
        $lastCertificate = Certificate::latest()->first();

        return view('admin.certificate.index', compact('certificates', 'lastCertificate'));
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
        //dd($request->company_id);
        $certificate = new Certificate();
        $certificate->uuid = Str::uuid();
        $certificate->company_id = $request->company_id;
        $certificate->expired_at =  date('Y-m-d H:i:s', strtotime('+12 months'));

        /** pega dos da empresa */
        $cnpj = str_replace('.', '', str_replace('/', '', str_replace('-', '', Auth::user()->company->document)));


        /** inica dados da receita */
        $starCurl = curl_init();

        //create curl resource
        curl_setopt($starCurl, CURLOPT_URL, "https://www.receitaws.com.br/v1/cnpj/{$cnpj}");

        //return the transfer as a string
        curl_setopt($starCurl, CURLOPT_RETURNTRANSFER, 1);

        // $getData contains the output string
        $getData = curl_exec($starCurl);

        // close curl resource to free up system resources
        curl_close($starCurl);

        $dataRF = json_decode($getData, true);

        //var_dump(array($dataRF['atividade_principal']));
        //die;

        $certificate->main_activity = json_encode($dataRF['atividade_principal']);
        $certificate->secondary_activity = json_encode($dataRF['atividades_secundarias']);


        /** finaliza dados da receita */

        $certificate->save();

        return redirect()->route('company.certificate.index')->with('success', 'Certificado emitido com sucesso!');

        //dd($certificate->uuid);
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
