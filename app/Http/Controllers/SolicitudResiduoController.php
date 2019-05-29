<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\SolicitudResiduo;
use App\audit;
use App\Respel;
use App\Recurso;
use App\ResiduosGener;
use App\SolicitudServicio;


class SolicitudResiduoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Residuos = DB::table('solicitud_residuos')
            ->join('respels', 'respels.ID_Respel', '=', 'solicitud_residuos.FK_SolResRespel')
            ->join('solicitud_servicios', 'solicitud_servicios.ID_SolSer', '=', 'solicitud_residuos.FK_SolResSolSer')
            ->join('sedes', 'solicitud_servicios.Fk_SolSerTransportador', '=', 'sedes.ID_Sede')
            ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
            ->select('clientes.CliShortname', 'clientes.CliSlug','respels.RespelName', 'solicitud_residuos.*', 'solicitud_servicios.ID_SolSer')
            ->get();

        return view('solicitud-resid.index', compact('Residuos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Se ejecuta en el controlador de solicitud de servicio
        $SolRes = DB::table('solicitud_residuos')
            ->join('respels', 'solicitud_residuos.FK_SolResRespel', '=', 'respels.ID_Respel')
            ->select('respels.RespelName', 'respels.ID_Respel')
            ->get();
        $SolSers = SolicitudServicio::all();
        return view('solicitud-resid.create', compact('SolRes', 'SolSers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = $request->input('SolResKgEnviado');
        $Residuo->SolResKgRecibido = $request->input('SolResKgRecibido');
        $Residuo->SolResKgConciliado = $request->input('SolResKgConciliado');
        $Residuo->SolResKgTratado = $request->input('SolResKgTratado');
        $Residuo->FK_SolResRespel = $request->input('FK_SolResRespel');
        $Residuo->FK_SolResSolSer = $request->input('FK_SolResSolSer');
        $Residuo->SolResSlug = 'Slug'.date('YmdHis');
        $Residuo->SolResDelete = 0;
        $Residuo->save();

        return redirect()->route('solicitud-residuo.index'); 
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
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
        
            $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
            $RespelSgener = ResiduosGener::where('ID_SGenerRes', $SolRes->FK_SolResRg)->first();

            if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
                $Respel = DB::table('respels')
                    ->join('residuos_geners', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
                    ->join('solicitud_residuos', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
                    ->select('respels.ID_Respel', 'respels.RespelName')
                    ->where('residuos_geners.ID_SGenerRes', $SolRes->FK_SolResRg)
                    ->first();
            }else{

                $Respels = DB::table('solicitud_residuos')
                    ->join('solicitud_servicios', 'solicitud_servicios.ID_SolSer', '=', 'solicitud_residuos.FK_SolResSolSer')
                    ->join('clientes', 'clientes.ID_Cli', '=', 'solicitud_servicios.FK_SolSerCliente')
                    ->join('residuos_geners', 'residuos_geners.ID_SGenerRes', '=', 'solicitud_residuos.FK_SolResRg')
                    ->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
                    ->select('respels.ID_Respel', 'respels.RespelName', 'clientes.ID_Cli', 'residuos_geners.FK_SGener')
                    ->where('solicitud_residuos.SolResSlug', $id)
                    // ->where('respels.RespelStatus', '=', "Aprobado")
                    ->where('respels.RespelDelete', '=', 0)
                    ->get();
            }
            return view('solicitud-resid.edit', compact('SolRes', 'Respels', 'Respel', 'RespelSgener'));
        }
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
        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
        $SolRes->fill($request->all());
        $SolRes->save();

        $log = new audit();
        $log->AuditTabla="solicitud_residuos";
        $log->AuditType="Modificado";
        $log->AuditRegistro=$SolRes->ID_SolRes;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($request->all());
        $log->save();

        return redirect()->route('solicitud-residuo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SolRes = SolicitudResiduo::where('SolResSlug', $id)->first();
        $Recursos = Recurso::where('FK_RecSolRes', $SolRes->ID_SolRes)->get();
        $SolSer = SolicitudServicio::where('ID_SolSer', $SolRes->FK_SolResSolSer)->first();
        
        $log = new audit();
        $log->AuditTabla="solicitud_residuos";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$SolRes->ID_SolRes;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$SolRes->SolResDelete;
        $log->save();

        foreach($Recursos as $Recurso){
            unlink(public_path("img/Recursos/$Recurso->RecSrc")."/$Recurso->RecRmSrc");
        }
        rmdir(public_path("img/Recursos/").$Recursos[0]->RecSrc);

        SolicitudResiduo::destroy($SolRes->ID_SolRes);
        $id = $SolSer->SolSerSlug;

        return redirect()->route('solicitud-servicio.show', compact('id'));

    }
}
