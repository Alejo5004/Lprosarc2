@extends('layouts.app')

@section('htmlheader_title','Requerimientos')

@section('contentheader_title', 'Lista Requerimientos')

@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Requerimientos de los residuos</h3>
            <a href="cargos/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="RequerimientosTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                	<th>FotoCargue</th>
                	<th>FotoDescargue</th>
                  <th>FotoPesaje</th>
            	    <th>FotoAlmacenado</th>
                  <th>FotoMezclado</th>
          	      <th>FotoDestruccion</th>
                  <th>VideoCargue</th>
                  <th>VideoDescargue</th>
                  <th>VideoPesaje</th>
                  <th>VideoAlmacenado</th>
                  <th>VideoMezclado</th>
                  <th>VideoDestruccion</th>
                  <th>Auditoria</th>
                  <th>AuditoriaTip</th>
                  <th>Devolucion</th>
                  <th>DevolucionTipo</th>
                  <th>DatosPersonal</th>
                  <th>Planillas</th>
                  <th>Alistamiento</th>
                  <th>Capacitacion</th>
                  <th>Bascula</th>
                  <th>MasPerson</th>
                  <th>Platform</th>
                  <th>CertiEspecial</th>
                  <th>Residuo</th>
                </tr>
              </thead>
              <tbody  hidden onload="renderTable()" id="readyTable">
                {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                <div class="fingerprint-spinner" id="loadingTable">
                  <div class="spinner-ring"><b style="font-size: 1.8rem;">L</b></div>
                  <div class="spinner-ring"><b style="font-size: 1.8rem;">o</b></div>
                  <div class="spinner-ring"><b style="font-size: 1.8rem;">a</b></div>
                  <div class="spinner-ring"><b style="font-size: 1.8rem;">d</b></div>
                  <div class="spinner-ring"><b style="font-size: 1.8rem;">i</b></div>
                  <div class="spinner-ring"><b style="font-size: 1.8rem;">n</b></div>
                  <div class="spinner-ring"><b style="font-size: 1.8rem;">g</b></div>
                  <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                  <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                </div>
                {{-- @foreach($Cargos as $Cargo)
                <tr>
                  <td>{{$Cargo->CargName}}</td>
                  <td>{{$Cargo->CargGrade}}</td>
                  <td>{{$Cargo->AreaName}}</td>
                  <td>{{$Cargo->CargSalary}}</td>
                </tr>
                @endforeach --}}
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
@endsection
