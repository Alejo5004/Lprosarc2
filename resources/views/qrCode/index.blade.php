@extends('layouts.app')
@section('htmlheader_title')
Activos
@endsection
@section('contentheader_title')
Activos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos de los activos</h3>
          <a href="/code/create" class="btn btn-primary" style="float: right;">Crear</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="QrCodesTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                    <th>Numero de estibas </th>
                    <th>Direccion del codigo qr</th>
                    <th>Fecha Creado</th>
                    <th>Fecha Modificado</th>
                    {{-- <th>Solicitud servicio</th> --}}
                    <th>Editar</th>
                </tr>
              
            {{-- </thead> --}}
          {{-- </tbody> --}}
            <tbody id="readyTable">
              @foreach ($QrCodes as $QrCode)
                  <tr>
                    <td>{{$QrCode->QrCodeEstiba}}</td>
                    <td>{{$QrCode->QrCodeSrc}}</td>
                    <td>{{$QrCode->created_at}}</td>
                    <td>{{$QrCode->updated_at}}</td>
                    {{-- <td>{{$QrCode->FK_QrCodeSolSer}}</td> --}}
                    <td><a href='#" + data + "/edit' class='btn btn-warning'>Edit</a></td>
                  </tr>
                
              @endforeach
              {{-- @foreach ($Activos as $Activo)
                  
              @endforeach --}}
            {{-- <tfoot>
                <tr>
                    <th>Categoria</th>
                    <th>SubCategoria</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Unidades</th>
                    <th>Modelo</th>
                </tr>
            </tfoot> --}}
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
@endsection