@extends('layouts.app')
{{-- vista de edición para el cliente --}}
@if(Auth::user()->UsRol == "Cliente")
@section('htmlheader_title')
{{ trans('adminlte_lang::LangRespel.Respeledittag') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangRespel.Respeleditmenu') }}
@endsection
@section('main-content')
@component('layouts.partials.modal')
	@slot('slug')
		{{$Respels->ID_Respel}}
	@endslot
	@slot('textModal')
		la solicitud <b>N° {{$Respels->ID_Respel}}</b>
	@endslot
@endcomponent
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respeleditmenu') }}</h3>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/respels/{{$Respels->RespelSlug}}" method="POST" id="myform" enctype="multipart/form-data" data-toggle="validator" >
								@method('PUT')
								@csrf
								@if ($errors->any())
								    <div class="alert alert-danger" role="alert">
								        <ul>
								            @foreach ($errors->all() as $error)
								                <li>{{$error}}</li>
								            @endforeach
								        </ul>
								    </div>
								@endif
								<input type="text" name="Sede" style="display: none;" value="{{$Sede}}">
								@include('layouts.RespelPartials.Respelform1Edit')
								<!-- /.box-body -->
								<div class="col-md-12">	
									<div class="box-footer">
										<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Actualizar</button>
										<a class="btn btn-default btn-close pull-right" style="margin-right: 2rem;" href="{{ route('respels.index') }}"><i class="fas fa-backspace" color="red"></i> {{ trans('adminlte_lang::LangTratamiento.cancel') }}</a>
									</div>
								</div>
							</form>
						</div>
						<!-- /.box -->
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection
@else
{{-- VISTA PARA PROSARC --}}
@section('htmlheader_title')
Respel-Evaluar
@endsection
@section('contentheader_title')
Evaluación de Residuo
@endsection
@section('main-content')
@component('layouts.partials.modal')
	@slot('slug')
		{{$Respels->ID_Respel}}
	@endslot
	@slot('textModal')
		la solicitud <b>N° {{$Respels->ID_Respel}}</b>
	@endslot
@endcomponent
<div class="container-fluid spark-screen">
	<!-- form start -->
	<form id="evaluacioncomercial" role="form" action="/Requerimientos/{{$Respels->ID_Respel}}" method="POST" enctype="multipart/form-data">
		@method('POST')
		@csrf
		<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
		<!-- row -->
		<div class="row">
			<!-- col md3 -->
			<div class="col-md-3">
				<!-- box -->
				<div class="box box-primary">
					<!-- box body -->
					<div class="box-body box-profile">
						{{-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> --}}
						<h3 class="profile-username text-center">{{$Respels->RespelName}}</h3>
						<p class="text-muted text-center">{{$Respels->RespelDescrip}}</p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Clasificación</b> <a class="pull-right">{{$Respels->YRespelClasf4741 <> null ? $Respels->YRespelClasf4741 : $Respels->ARespelClasf4741 }}</a>
							</li>
							<li class="list-group-item">
								<b>Peligrosidad</b> <a class="pull-right">{{$Respels->RespelIgrosidad}}</a>
							</li>
							<li class="list-group-item">
								<b>Estado Físico</b> <a class="pull-right">{{$Respels->RespelEstado}}</a>
							</li>
							<li class="list-group-item">
								<b>Estado de aprobación</b>
								<select name="RespelStatus" class="form-control">
									<option {{$Respels->RespelStatus == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
									<option {{$Respels->RespelStatus == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
									<option {{$Respels->RespelStatus == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
									<option {{$Respels->RespelStatus == 'Incompleto' ? 'selected' : '' }}>Incompleto</option>
									<option {{$Respels->RespelStatus == 'Vencido' ? 'selected' : '' }}>Vencido</option>
								</select>
							</li>
							<li class="list-group-item">
								<label>Observaciones</label>
								<div class="input-group">
									<textarea maxlength="250" name="RespelStatusDescription" id="taid" rows ="5" cols="24" wrap="soft">{{$Respels->RespelStatusDescription}}</textarea>
								</div>	
							</li>
							<li class="list-group-item" style="display: block; overflow: auto";>
								{{-- hoja de seguridad --}}
								@if($Respels->RespelHojaSeguridad!=='RespelHojaDefault.pdf')
									<div class="col-md-12 form-group">
										<label>Hoja de Seguridad</label>
										<div class="input-group">
											<input type="text" class="form-control" value="Ver Documento" disabled>
											<div class="input-group-btn">
												<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@else
									<div class="col-md-12 form-group">
										<label>Hoja de Seguridad</label>
										<div class="input-group">
											<input type="text" class="form-control" value="No Adjuntado" disabled>
											<div class="input-group-btn">
												<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@endif
								{{-- tarjeta de emergencia --}}
								@if($Respels->RespelTarj!=='RespelTarjetaDefault.pdf')
									<div class="col-md-12 form-group">
										<label>Tarjeta De Emergencia</label>
										<div class="input-group">
											<input type="text" class="form-control" value="Ver Documento" disabled>
											<div class="input-group-btn">
												<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@else
									<div class="col-md-12 form-group">
										<label>Tarjeta De Emergencia</label>
										<div class="input-group">
											<input type="text" class="form-control" value="No Adjuntado" disabled>
											<div class="input-group-btn">
												<a target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@endif
								{{-- fotografia del residuo --}}
								@if($Respels->RespelFoto!=='RespelFotoDefault.png')
									<div class="col-md-12 form-group">
										<label>Fotografía del Residuo</label>
										<div class="input-group">
											<input type="text" class="form-control" value="Ver Documento" disabled>
											<div class="input-group-btn">
												<a method='get' href='/img/fotoRespelCreate/{{$Respels->RespelFoto}}' target='_blank' class='btn btn-success'><i class='fas fa-image fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@else
									<div class="col-md-12 form-group">
										<label>Fotografía del Residuo</label>
										<div class="input-group">
											<input type="text" class="form-control" value="No Adjuntado" disabled>
											<div class="input-group-btn">
												<a target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
											</div>
										</div>	
									</div>
								@endif
							</li>
						</ul>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box body -->
			</div>
			<!-- /.col md3 -->
			<!-- col md9 -->
			<div class="col-md-9">
				<!-- box -->
				<div class="box">
					<!-- box header -->
					<div class="box-header with-border">
						<h3 class="box-title">Evaluación de Residuo</h3>
					</div>
					<!-- /.box header -->
					<!-- box body -->
					<div class="box-body">
						<!-- nav-tabs-custom -->
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="nav-item active">
									<a class="nav-link" href="#Residuopane" data-toggle="tab">Residuo</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Tratamientospane" data-toggle="tab">Tratamientos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Requerimientospane" data-toggle="tab">Requerimientos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Tarifaspane" data-toggle="tab">Tarifas</a>
								</li>
							</ul>
							<!-- nav-content -->
							<div class="tab-content" style="display: block; overflow: auto;">
								<!-- tab-pane fade -->
								<div class="tab-pane fade in active" id="Residuopane">
									@include('layouts.respel-cliente.respel-residuo')
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade " id="Tratamientospane">
									@include('layouts.respel-comercial.respel-tratamiento')
								</div>
								<!-- tab-pane fade -->
								<!-- /.tab-pane fade -->
								<div class="tab-pane fade" id="Requerimientospane">
									@include('layouts.respel-comercial.respel-requerimiento')
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="tarifaspane">
									<div class="form-horizontal">
										@include('layouts.respel-comercial.respel-tarifas')
									</div>
								</div>
								<!-- /.tab-pane fade -->
							</div>
							<!-- /.tab-content -->
						</div>
						<div class="row">
							 <input class="btn btn-primary pull-right" type="submit" value="Actualizar" style="margin-right:5em" />
						</div>
						<!-- /.nav-tabs-custom -->
					</div>
					<!-- /.box body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col md9 -->
		</div>
		<!-- /.row -->
	</form>
	<!-- /.form  -->
</div>
@endsection
@endif
