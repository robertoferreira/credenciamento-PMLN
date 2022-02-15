<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificate;
use App\Http\Controllers\Controller;
use App\Models\Company;
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
        $share_capital = json_decode($certificate->share_capital);
        return view('admin.certificate.certificate', compact('certificate', 'mainActivity', 'secondaryActivity', 'share_capital'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idCompany = auth()->user()->company->id;

        $certificates = Certificate::orderBy('created_at', 'desc')->where('company_id', $idCompany)->get();

        /** PEGA O ÚLTIMO CERTIFICADO */
        $lastCertificate = Certificate::latest()->first();

        return view('admin.certificate.index', compact('certificates', 'lastCertificate'));
    }

    public function create(int $id)
    {
        $company = Company::where('id', $id)->first();

        return view('admin.certificate.create', compact('company'));
    }

    public function storeCertificate(Request $request, $id)
    {
        $company = Company::where('id', $id)->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $certificate = new Certificate();
        $certificate->uuid = Str::uuid();
        $certificate->company_id = $request->company_id;
        $certificate->expired_at =  date('Y-m-d H:i:s', strtotime($request->end_date));
        $certificate->start_date =  date('Y-m-d H:i:s', strtotime($request->start_date));

        /** pega dos da empresa */

        $cnpj = str_replace('.', '', str_replace('/', '', str_replace('-', '', $request->document)));
        //dd($cnpj);

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

        $certificate->main_activity = json_encode($dataRF['atividade_principal']);
        $certificate->secondary_activity = json_encode($dataRF['atividades_secundarias']);
        $certificate->share_capital = json_encode($dataRF['capital_social']);


        /** finaliza dados da receita */

        //dd($certificate);

        $certificate->save();

        return redirect()->route('company.index')->with('success', 'Certificado emitido com sucesso!');

        //dd($certificate->uuid);
    }


}
