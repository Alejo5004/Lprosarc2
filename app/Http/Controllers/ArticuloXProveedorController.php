<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ArticuloPorProveedor;
use App\Activo;
use App\Quotation;

class ArticuloXProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ArtProvs = DB::table('articulo_por_proveedors')
            ->join('activos', 'activos.ID_Act', '=', 'articulo_por_proveedors.ID_ArtiProve')
            ->select('articulo_por_proveedors.*', 'activos.ActName')
            ->get();

        return view('articulos.index', compact('ArtProvs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Activos = Activo::all();
        $Quotations = Quotation::all();

        return view('articulos.create', compact('Activos', 'Quotations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ArtProv = new ArticuloPorProveedor();
        $ArtProv->ArtiUnidad = $request->input("ArtiUnidad");
        $ArtProv->ArtiCant = $request->input("ArtiCant");
        $ArtProv->ArtiPrecio = $request->input("ArtiPrecio");
        $ArtProv->ArtiCostoUnid = $request->input("ArtiCostoUnid");
        $ArtProv->ArtiMinimo = $request->input("ArtiMinimo");

        $ArtProv->FK_ArtCotiz = $request->input("FK_ArtCotiz");
        $ArtProv->FK_ArtiActiv = $request->input("FK_ArtiActiv");
        // $ArtProv->FK_AutorizedBy = $request->input("FK_AutorizedBy");
        $ArtProv->FK_AutorizedBy = 1;

        $ArtProv->save();

        return redirect()->route('articulos-proveedor.index');
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
