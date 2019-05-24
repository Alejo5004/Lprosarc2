<div id="Respels">
	<div id="Residuo">
		{{-- <div id="form-step-0" role="form" data-toggle="validator"> --}}
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-6 form-group">
				<label>{{ trans('adminlte_lang::message.name') }}</label>
				<input maxlength="128" name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required value="{{ old('RespelName.0') }}">
			</div>
			<div class="col-md-6 form-group">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="{{ trans('adminlte_lang::LangRespel.respeldescriptittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.respeldescriptinfo') }}">{{ trans('adminlte_lang::LangRespel.descripcion') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
				<input maxlength="512" name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{ old('RespelDescrip.0') }}">
			</div>
			<div class="col-md-6 form-group">
				<label>{{ trans('adminlte_lang::LangRespel.danger') }}</label>
				<select id="selectDanger0" name="RespelIgrosidad[]" class="form-control" required>
					<option value="">{{ trans('adminlte_lang::LangRespel.select')}}</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger1')}}" {{ (old('RespelIgrosidad.0') === 'No peligroso' ? 'selected' : '' )}} onclick="setNoDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger1') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger2')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger2') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger2') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger3')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger3') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger3') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger4')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger4') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger4') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger5')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger5') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger5') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger5')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger5') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger6') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger7')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger7') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger7') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger8')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger8') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger8') }}
					</option>

				</select>
			</div>
			<div class="col-md-6 form-group">
				<label>{{ trans('adminlte_lang::LangRespel.estadofisico') }}</label>
				<select name="RespelEstado[]" class="form-control" required>
					<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
					<option {{ (old('RespelEstado.0') === trans('adminlte_lang::LangRespel.estadofisico1') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico1') }}">{{ trans('adminlte_lang::LangRespel.estadofisico1') }}</option>
					<option {{ (old('RespelEstado.0') === trans('adminlte_lang::LangRespel.estadofisico2') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico2') }}">{{ trans('adminlte_lang::LangRespel.estadofisico2') }}</option>
					<option {{ (old('RespelEstado.0') === trans('adminlte_lang::LangRespel.estadofisico3') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico3') }}">{{ trans('adminlte_lang::LangRespel.estadofisico3') }}</option>
					<option {{ (old('RespelEstado.0') === trans('adminlte_lang::LangRespel.estadofisico4') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico4') }}">{{ trans('adminlte_lang::LangRespel.estadofisico4') }}</option>
				</select>
			</div>
			<div id="danger0">
			</div>
			<div class="col-md-6 form-group">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.hojapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
				<input required id="hoja0" name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".pdf">
			</div>
			<div class="col-md-6 form-group">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
				<input name="RespelTarj[]" type="file" class="form-control" accept=".pdf">
			</div>
			<div id="SustanciaControlada0">
			</div>
			<div class="col-md-6 form-group">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="{{ trans('adminlte_lang::LangRespel.resolucion1tittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.resolucion1descrip') }}">{{ trans('adminlte_lang::LangRespel.controlx') }}
					<a href="{{route('ClasificacionA')}}" target="_blank">{{ trans('adminlte_lang::LangRespel.resolucion1') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></a>
				</label>
				<select id="selectDanger0" name="SustanciaControlada[]" class="form-control" required>
					<option onclick="setNoControlada(0)">{{ trans('adminlte_lang::LangRespel.no') }}</option>
					<option onclick="setControlada(0)">{{ trans('adminlte_lang::LangRespel.yes') }}</option>
				</select>
			</div>
			<div class="col-md-6 form-group">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::LangRespel.foto') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.fotopopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.fotolabel') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
				<input id="foto0" name="RespelFoto[]" type="file" class="form-control" accept=".jpg,.png" data-max-size="2048" value="{{ old('RespelFoto.0') }}">
			</div>
				
			{{--
		</div> --}}
	</div>
</div>
<script>
var contador = 1;

function attachPopover() {
	$('[data-toggle="popover"]').popover({
		html: true,
		trigger: 'hover',
		placement: 'auto'
	});
}

function setDanger(id) {
	var ifDangerRespel = `@include('layouts.RespelPartials.layoutsRes.ifDangerRespel')`;
	$("#danger" + id).empty();
	$("#danger" + id).append(ifDangerRespel);
	$("#hoja" + id).prop('required', true);
	attachPopover();
}

function setNoDanger(id) {
	$("#danger" + id).empty();
	$("#hoja" + id).prop('required', false)
}

function setControlada(id) {
	var ifControladaRespel = `@include('layouts.RespelPartials.layoutsRes.ifControladaRespel')`;
	$("#SustanciaControlada" + id).empty();
	$("#SustanciaControlada" + id).append(ifControladaRespel);
	attachPopover();
}

function setNoControlada(id) {
	$("#SustanciaControlada" + id).empty();
}

var ControladaName = `@include('layouts.RespelPartials.layoutsRes.ControladaCreateName')`;
var MasivoName = `@include('layouts.RespelPartials.layoutsRes.MasivoCreateName')`;
var ControladaDoc = `@include('layouts.RespelPartials.layoutsRes.ControladaCreateDoc')`;
var MasivoDoc = `@include('layouts.RespelPartials.layoutsRes.MasivoCreateDoc')`;
var ClasifY = `@include('layouts.RespelPartials.layoutsRes.ClasificacionYCreate')`;
var ClasifA = `@include('layouts.RespelPartials.layoutsRes.ClasificacionACreate')`;

function AgregarRes() {
	var Residuo = `@include('layouts.RespelPartials.layoutsRes.CreateResiduos')`;
	$("#Respels").append(Residuo);
	$("#myform").validator('update');
	$("#Clasif" + contador).append(ClasifY);
	contador = parseInt(contador) + 1;
	attachPopover();
}

function AgregarY(id) {
	$("#ClasifY" + id).removeClass("btn-default");
	$("#ClasifY" + id).addClass("btn-success");
	$("#ClasifA" + id).removeClass("btn-success");
	$("#ClasifA" + id).addClass("btn-default");
	$("#Clasif" + id).empty();
	$("#Clasif" + id).append(ClasifY);
	$("#myform").validator('update');
	attachPopover();
}

function AgregarA(id) {
	$("#ClasifA" + id).removeClass("btn-default");
	$("#ClasifA" + id).addClass("btn-success");
	$("#ClasifY" + id).removeClass("btn-success");
	$("#ClasifY" + id).addClass("btn-default");
	$("#Clasif" + id).empty();
	$("#Clasif" + id).append(ClasifA);
	$("#myform").validator('update');
	attachPopover();
}

function AgregarControlada(id) {
	$("#Controlada" + id).removeClass("btn-default");
	$("#Controlada" + id).addClass("btn-success");
	$("#Masivo" + id).removeClass("btn-success");
	$("#Masivo" + id).addClass("btn-default");
	$("#sustanciaFormDoc" + id).empty();
	$("#sustanciaFormDoc" + id).append(ControladaDoc);
	$("#sustanciaFormName" + id).empty();
	$("#sustanciaFormName" + id).append(ControladaName);
	$("#myform").validator('update');
	attachPopover();
}

function AgregarMasivo(id) {
	$("#Masivo" + id).removeClass("btn-default");
	$("#Masivo" + id).addClass("btn-success");
	$("#Controlada" + id).removeClass("btn-success");
	$("#Controlada" + id).addClass("btn-default");
	$("#sustanciaFormDoc" + id).empty();
	$("#sustanciaFormDoc" + id).append(MasivoDoc);
	$("#sustanciaFormName" + id).empty();
	$("#sustanciaFormName" + id).append(MasivoName);
	$("#myform").validator('update');
	attachPopover();
}

function EliminarRes(id) {
	$("#Residuo" + id).remove();
	$("#myform").validator('update');
}

</script>
<script>
  $(document).ready(function() {
    const genderOldValue = '{{ old('gender') }}';
    
    if(genderOldValue !== '') {
      $('#gender').val(genderOldValue);
    }
  });
</script>
