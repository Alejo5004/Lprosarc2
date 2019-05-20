<div id="Respels">
	<div id="Residuo">
		{{-- <div id="form-step-0" role="form" data-toggle="validator"> --}}
			<div class="col-md-12"> <hr> </div>
			<div class="col-md-6 form-group">
				<label>Nombre</label>
				<input maxlength="128" name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required>
			</div> 
			<div class="col-md-6 form-group">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Descripción del residuo</b>" data-content="<p style='width: 50%'> brinde una descripcion del residuo según sus caracteristicas, con el fin de facilitar la evaluacion del mismo y la asignación de tratamientos viables adecuados</p>">Descripción <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
				<input maxlength="512" name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo">
			</div> 
			<div class="col-md-6 form-group">
				<label>Peligrosidad</label>
				<select id="selectDanger0" name="RespelIgrosidad[]" class="form-control" required>
					<option value="">Selecione...</option>
					<option onclick="setDanger(0)">Corrosivo</option>
					<option onclick="setDanger(0)">Reactivo</option>
					<option onclick="setDanger(0)">Explosivo</option>
					<option onclick="setDanger(0)">Toxico</option>
					<option onclick="setDanger(0)">Inflamable</option>
					<option onclick="setDanger(0)">Patogeno - Infeccioso</option>
					<option onclick="setDanger(0)">Radiactivo</option> 
					<option onclick="setNoDanger(0)">No peligroso</option>
				</select>
			</div> 
			<div class="col-md-6 form-group">
				<label>Estado fisico</label>
				<select name="RespelEstado[]" class="form-control" required>
					<option value="">Selecione...</option>
					<option value="Liquido">Liquido</option>
					<option value="Solido">Solido</option>
					<option value="Gaseoso">Gaseoso</option>
					<option value="Mezcla">Mezcla</option> 
				</select>
			</div>
			<div id="danger0">
				
			</div>
			<div class="col-md-6 form-group">
			    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Hoja de seguridad</b>" data-content="<p style='width: 50%'> Si el campo <b><i>Peligrosidad del residuo</i></b> es diferente a: <i>No peligroso</i>, entonces, este campo es Obligatorio</p>">Hoja de seguridad <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
			    <input required id="hoja0" name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".pdf">
			    
			</div> 
			<div class="col-md-6 form-group">
			    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Hoja de seguridad</b>" data-content="<p style='width: 50%'> Si el campo <b><i>Peligrosidad del residuo</i></b> es diferente a: <i>No peligroso</i>, entonces, este campo es Obligatorio... sin embargo, podra postponer la carga de la <b>Tarjeta de Emergencia</b> hasta el momento en el que vaya a realizar un solicitud de servicio</p>">Tarjeta De Emergencia <i  style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
			    <input name="RespelTarj[]" type="file" class="form-control" accept=".pdf">
			</div> 
			<div class="col-md-6 form-group">
				<label>¿Sustancia controlada?</label>
				<select id="selectDanger0" name="SustanciaControlada[]" class="form-control" required>
					<option onclick="setNoControlada(0)">No</option>
					<option onclick="setControlada(0)">Si</option> 
				</select>
			</div>

			<div id="SustanciaControlada0">
				
			</div>
		{{-- </div> --}}
	</div>
</div>

<script>
	var contador = 1;
	function attachPopover(){
	    $('[data-toggle="popover"]').popover({
	        html: true,
	        trigger: 'hover',
	        placement: 'auto'
	    });
	}
	function setDanger(id){
		var ifDangerRespel = `@include('layouts.RespelPartials.layoutsRes.ifDangerRespel')`;
	    $("#danger"+id).empty();
	    $("#danger"+id).append(ifDangerRespel);
	    $("#hoja"+id).prop('required', true);
	    attachPopover();
	}
	function setNoDanger(id){
	    $("#danger"+id).empty();
	    $("#hoja"+id).prop('required', false)
	}

	function setControlada(id){
		var ifDangerRespel = `@include('layouts.RespelPartials.layoutsRes.ifControladaRespel')`;
	    $("#SustanciaControlada"+id).empty();
	    $("#SustanciaControlada"+id).append(ifDangerRespel);
	    $("#hoja"+id).prop('required', true);
	    attachPopover();
	}
	function setNoControlada(id){
	    $("#SustanciaControlada"+id).empty();
	    $("#hoja"+id).prop('required', false)
	}
	var Controlada = `@include('layouts.RespelPartials.layoutsRes.ControladaCreate')`;
	var Masivo = `@include('layouts.RespelPartials.layoutsRes.MasivoCreate')`;
	var ClasifY = `@include('layouts.RespelPartials.layoutsRes.ClasificacionYCreate')`;
	var ClasifA = `@include('layouts.RespelPartials.layoutsRes.ClasificacionACreate')`;
	function AgregarRes(){
		var Residuo = `@include('layouts.RespelPartials.layoutsRes.CreateResiduos')`;
		$("#Respels").append(Residuo);
		$("#myform").validator('update');
		$("#Clasif"+contador).append(ClasifY);
		contador= parseInt(contador)+1;
		attachPopover();
	}
	function AgregarY(id){
		$("#ClasifY"+id).removeClass("btn-default");
		$("#ClasifY"+id).addClass("btn-success");
		$("#ClasifA"+id).removeClass("btn-success");
		$("#ClasifA"+id).addClass("btn-default");
		$("#Clasif"+id).empty();
		$("#Clasif"+id).append(ClasifY);
		$("#myform").validator('update');
		attachPopover();
	}
	function AgregarA(id){
		$("#ClasifA"+id).removeClass("btn-default");
		$("#ClasifA"+id).addClass("btn-success");
		$("#ClasifY"+id).removeClass("btn-success");
		$("#ClasifY"+id).addClass("btn-default");
		$("#Clasif"+id).empty();
		$("#Clasif"+id).append(ClasifA);
		$("#myform").validator('update');
		attachPopover();
	}
	function AgregarControlada(id){
		$("#ClasifY"+id).removeClass("btn-default");
		$("#ClasifY"+id).addClass("btn-success");
		$("#ClasifA"+id).removeClass("btn-success");
		$("#ClasifA"+id).addClass("btn-default");
		$("#Clasif"+id).empty();
		$("#Clasif"+id).append(Controlada);
		$("#myform").validator('update');
		attachPopover();
	}
	function AgregarMasivo(id){
		$("#ClasifA"+id).removeClass("btn-default");
		$("#ClasifA"+id).addClass("btn-success");
		$("#ClasifY"+id).removeClass("btn-success");
		$("#ClasifY"+id).addClass("btn-default");
		$("#Clasif"+id).empty();
		$("#Clasif"+id).append(ClasifA);
		$("#myform").validator('Masivo');
		attachPopover();
	}
	function EliminarRes(id){
		$("#Residuo"+id).remove();
		$("#myform").validator('update');
	}

</script>