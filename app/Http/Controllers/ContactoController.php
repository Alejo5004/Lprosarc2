<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactosStoreRequest;
use App\Http\Requests\ContactosUpdateRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Sede;
use App\Departamento;
use App\Municipio;
use App\Vehiculo;
use App\audit;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
        $Clientes = Cliente::where('CliCategoria', '<>', 'Cliente')->get();
        return view('contactos.index', compact('Clientes'));
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Departamentos = Departamento::all();
            if (old('FK_SedeMun') !== null){
                $Municipios = Municipio::select()->where('FK_MunCity', old('departamento'))->get();
            }
            return view('contactos.create', compact('Departamentos', 'Municipios'));
        }else{
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactosStoreRequest $request)
    {
        $Cliente = new Cliente();
            $Cliente->CliNit = $request->input('CliNit');
            $Cliente->CliName = $request->input('CliName');
            $Cliente->CliShortname = $request->input('CliShortname');
            $Cliente->CliCategoria = $request->input('CliCategoria');
            $Cliente->CliSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32).$request->input('CliShortname').substr(md5(rand()), 0,32);
            $Cliente->CliDelete = 0;
            $Cliente->save();

            $Sede = new Sede();
            $Sede->SedeName = $request->input('SedeName');
            $Sede->SedeAddress = $request->input('SedeAddress');
            $Sede->SedePhone1 = $request->input('SedePhone1');
            if($request->input('SedePhone1') === null && $request->input('SedePhone2') !== null){
                $Sede->SedePhone1 = $request->input('SedePhone2');
                $Sede->SedeExt1 = $request->input('SedeExt2');
            }else{
                if($request->input('SedePhone1') === null){
                    $Sede->SedeExt1 = null;
                }else{
                    $Sede->SedePhone1 = $request->input('SedePhone1');
                    $Sede->SedeExt1 = $request->input('SedeExt1');
                }
                if($request->input('SedePhone2') === null){
                    $Sede->SedeExt2 = null;
                }else{
                    $Sede->SedePhone2 = $request->input('SedePhone2');
                    $Sede->SedeExt2 = $request->input('SedeExt2');
                }
            }
            $Sede->SedeEmail = $request->input('SedeEmail');
            $Sede->SedeCelular = $request->input('SedeCelular');
            $Sede->SedeSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32).$request->input('SedeName').substr(md5(rand()), 0,32);
            $Sede->FK_SedeCli = $Cliente->ID_Cli;
            $Sede->FK_SedeMun = $request->input('FK_SedeMun');
            $Sede->SedeDelete = 0;
            $Sede->save();

            if($request->input('CliCategoria') === 'Transportador'){
                $Validate = $request->validate([
                    'VehicPlaca' => 'required|max:9|min:9|unique:vehiculos,VehicPlaca',
                    'VehicTipo' => 'required|max:64',
                    'VehicCapacidad' => 'required|max:64',
                ]);

                $Vehiculo = new Vehiculo();
                $Vehiculo->VehicPlaca = $request->input('VehicPlaca');
                $Vehiculo->VehicTipo = $request->input('VehicTipo');
                $Vehiculo->VehicCapacidad = $request->input('VehicCapacidad');
                $Vehiculo->VehicInternExtern = 1;
                $Vehiculo->VehicDelete = 0;
                $Vehiculo->FK_VehiSede = $Sede->ID_Sede;
                $Vehiculo->save();
            }
            
            return redirect()->route('contactos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
            $Cliente = Cliente::where('CliSlug', $id)->first();
            $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();
            $Municipio = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
            $Departamento = Departamento::where('ID_Depart', $Municipio->FK_MunCity)->first();
            
            if($Cliente->CliCategoria === 'Transportador'){
                if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
                    $Vehiculos = Vehiculo::where('FK_VehiSede', $Sede->ID_Sede)->get();
                }elseif(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')){
                    $Vehiculos = Vehiculo::where('FK_VehiSede', $Sede->ID_Sede)->where('VehicDelete', 0)->get();
                }
                return view('contactos.show', compact('Cliente', 'Sede', 'Vehiculos', 'Municipio', 'Departamento'));
            }else{
                return view('contactos.showProveedor', compact('Cliente', 'Sede', 'Municipio', 'Departamento'));
            }
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Departamentos = Departamento::all();
        $Cliente = Cliente::where('CliSlug', $id)->first();
        $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();

        $Municipality = Municipio::where('ID_Mun', $Sede->FK_SedeMun)->first();
        $Departament = Departamento::where('ID_Depart', $Municipality->FK_MunCity)->first();
        $Municipios = Municipio::where('FK_MunCity', $Municipality->FK_MunCity)->get();

        return view('contactos.edit', compact('Cliente', 'Sede', 'Municipios', 'Departamentos', 'Municipality', 'Departament'));
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
        $validate = $request->validate([

            'CliNit' => ['required','min:13','max:13',Rule::unique('clientes')->where(function ($query) use ($request, $id){

                $Cliente = DB::table('clientes')
                    ->select('clientes.CliNit')
                    ->where('CliNit', $request->input('CliNit'))
                    ->where('CliCategoria', $request->input('CliCategoria'))
                    ->where('CliDelete', 0)
                    ->where('CliSlug', '<>', $id)
                    ->first();

                if(isset($Cliente->CliNit)){
                    $query->where('clientes.CliNit','=', $Cliente->CliNit);
                }else{
                    $query->where('clientes.CliNit','=', null);
                }
            })],
            
            'CliName'       => 'required|max:255|min:1',
            'CliShortname'  => 'required|max:255|min:1',
            'CliCategoria'  => 'required|max:32',

            'SedeName'      => 'required|max:128|min:1',
            'SedeAddress'   => 'required|max:255|min:1',
            'SedePhone1'    => 'max:11|min:11|nullable',
            'SedeExt1'      => 'min:2|max:5|nullable',
            'SedePhone2'    => 'max:11|min:11|nullable',
            'SedeExt2'      => 'min:2|max:5|nullable',
            'SedeEmail'     => 'required|email|max:128',
            'SedeCelular'   => 'required|min:12|max:12',
            'FK_SedeMun'    => 'required',

        ]);


        $Cliente = Cliente::where('CliSlug', $id)->first();
        $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();

        $Cliente->fill($request->all());
        $Cliente->save();

        $Sede->fill($request->all());
        $Sede->save();

        $Vehiculos = Vehiculo::where('FK_VehiSede', $Sede->ID_Sede)->where('VehicDelete', 0)->get();

        if($Cliente->CliCategoria === 'Proveedor' && isset($Vehiculos)){
            foreach($Vehiculos as $Vehiculo){
                $Vehiculo->VehicDelete = 1;
                $Vehiculo->save();
            }
            
        }elseif($Cliente->CliCategoria === 'Transportador' && !empty($Vehiculos)){
            $Validate = $request->validate([
                'VehicPlaca' => 'required|unique:vehiculos,VehicPlaca|max:9|min:9',
                'VehicTipo' => 'required|max:64',
                'VehicCapacidad' => 'required|max:64',
            ]);

            $Vehiculo = new Vehiculo();
            $Vehiculo->VehicPlaca = $request->input('VehicPlaca');
            $Vehiculo->VehicTipo = $request->input('VehicTipo');
            $Vehiculo->VehicCapacidad = $request->input('VehicCapacidad');
            $Vehiculo->VehicInternExtern = 1;
            $Vehiculo->VehicDelete = 0;
            $Vehiculo->FK_VehiSede = $Sede->ID_Sede;
            $Vehiculo->save();
        }

        $log = new audit();
        $log->AuditTabla="clientes-contacto";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$Cliente->ID_Cli;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        $id = $Cliente->CliSlug;

        return redirect()->route('contactos.show', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Cliente = Cliente::where('CliSlug', $id)->first();
        $Sede = Sede::where('FK_SedeCli', $Cliente->ID_Cli)->first();
        $Vehiculos = Vehiculo::where('FK_VehiSede', $Sede->ID_Sede)->get();

        if ($Cliente->CliDelete == 0){
            if(isset($Vehiculos)){
                foreach($Vehiculos as $Vehiculo){
                    $Vehiculo->VehicDelete = 1;
                    $Vehiculo->save();
                }
            }
            $Cliente->CliDelete = 1;
            $Cliente->save();

            $Sede->SedeDelete = 1;
            $Sede->save();

            return redirect()->route('contactos.index');
        }
        else{
            if(isset($Vehiculos)){
                foreach($Vehiculos as $Vehiculo){
                    $Vehiculo->VehicDelete = 0;
                    $Vehiculo->save();
                }
            }
            $Cliente->CliDelete = 0;
            $Cliente->save();

            $Sede->SedeDelete = 0;
            $Sede->save();

            $id = $Cliente->CliSlug;
            return redirect()->route('contactos.show', compact('id'));
        }
    }
}
