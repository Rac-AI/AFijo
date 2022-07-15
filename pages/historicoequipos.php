 	
<?php

require ('validarnum.php');

$id=0;
$id_usuario=0;
$numero="";
$c_compania="";
$simcard="";
$imei="";
$c_marca="";
$modelo="";
$plan="";
$t_plan="";		
$telefonia_ip="";
$estado_linea="";
$estado_equipo="";
$f_recambio=date("Y-m-d");  	

?>

	 <div class="col-md-9">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Historico de Equipos por Usuario</h3>
			</div>
								
			<!-- form start -->
			<form target=_blank  role="form"  name="fe" action="./pdf/listaequipos2.php" method="post">
				<div class="box-body">

					<div class="form-group">
						<label for="exampleInputFile">Usuario</label>
						<select  class="form-control" name='s_usuario' >
							<option value="0">Seleccione...</option>
								<?php
								$consulta2="SELECT id_usuarios, nombre FROM usuarios ORDER BY nombre ASC;";
								$sql2 = $bd->consulta($consulta2);
								while ($fila=$bd->mostrar_registros($sql2)) {
									$cod_usuario=$fila ['id_usuarios'];
									$nom_usuario=$fila ['nombre'];
									if ($id_usuario == $cod_usuario) {
								?>
										<option value="<?php echo $cod_usuario ?>" selected><?php echo $nom_usuario ?></option>
									<?php } else { ?>
										<option value="<?php echo $cod_usuario ?>"><?php echo $nom_usuario ?></option>
								<?php						
									}}
								?>	
						</select>							
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary btn-lg" name="imprimir" id="imprimir" value="Imprimir">Imprimir</button>
				</div>
			</form>
		</div><!-- /.box -->
	</div>

   




