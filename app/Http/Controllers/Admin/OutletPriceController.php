<?php

namespace App\Http\Controllers\Admin;

use App\Admin\OutletPrice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\FormOutletPriceRequest;

use Illuminate\Support\Facades\Auth;

class OutletPriceController extends Controller
{
    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->level >= 1){
            //** PEGA TODAS AS TOMADAS DE PREÇOS */
            $outletPrices = OutletPrice::orderBy('created_at', 'desc')->get();

            return view('admin.outletprice.index', compact('outletPrices'));
        }

        return redirect()->route('company.index')->with('warning', 'Você não tem permissão para acessar esta página.');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level >= 1){
            return view('admin.outletprice.create');
        }

        return redirect()->route('company.index')->with('warning', 'Você não tem permissão para acessar esta página.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormOutletPriceRequest $request)
    {
        if(Auth::user()->level >= 1){

            //dd($request->all());

            $outletPrice = new OutletPrice();
            $outletPrice->uuid = Str::uuid();
            $outletPrice->object = filter_var($request->object, FILTER_SANITIZE_STRING);
            $outletPrice->number = filter_var($request->number, FILTER_SANITIZE_STRING);
            $outletPrice->published = filter_var($request->published, FILTER_SANITIZE_STRING);
            $outletPrice->closing = filter_var($request->closing, FILTER_SANITIZE_STRING);
            $outletPrice->status = filter_var($request->status, FILTER_SANITIZE_STRING);

            if($request->file('docs')){
                $docs = $request->file('docs')->store('docs');
            }

            $outletPrice->docs = $docs;

            $outletPrice->save();

            return redirect()->route('outletprice.index')->withInput()->with('success', 'Cadastro realizado com sucesso!');
        }

        return redirect()->route('company.index')->with('warning', 'Você não tem permissão para acessar esta página.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $outletPrice = OutletPrice::where('uuid' ,$uuid)->first();

        return view('admin.outletprice.show', compact('outletPrice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outletPrice = OutletPrice::where('id', $id)->first();

        return view('admin.outletprice.edit', compact('outletPrice'));
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
        if(Auth::user()->level >= 1){

            $outletPrice = OutletPrice::find($id);

            $outletPrice->object = $request->object;
            $outletPrice->number = $request->number;
            $outletPrice->published = $request->published;
            $outletPrice->closing = $request->closing;
            $outletPrice->status = $request->status;

            if($request->file('docs') == null){
                $docs = $request->docs_old;
            }

            if($request->file('docs') != null){
                unlink('storage/' . $outletPrice->docs);
                $docs = $request->file('docs')->store('docs');
            }

            $outletPrice->docs = $docs;

            $outletPrice->save();

            return redirect()->route('outletprice.index')->withInput()->with('success', 'Tomda de Preço atualizada com sucesso!');

        }

        return redirect()->route('company.index')->with('warning', 'Você não tem permissão para acessar esta página.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->level >= 1){

            $outletPrice = OutletPrice::find($id);
            $outletPrice->delete();

            return redirect()->route('outletprice.index')->withInput()->with('success', 'Tomda de Preço deletada com sucesso!');

        }

        return redirect()->route('company.index')->with('warning', 'Você não tem permissão para acessar esta página.');
    }
}
