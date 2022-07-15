 	
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
				<h3 class="box-title">Reporte de Celulares (Seleccione el Filtro)</h3>
			</div>
								
			<!-- form start -->
			<form target=_blank  role="form"  name="fe" action="./pdf/listacelulares2.php" method="post">
				<div class="box-body">

                <div class="form-group">
					<label for="exampleInputFile">Compania</label>
					<select  class="form-control" name='s_compania' >
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_compania, descripcion AS d_compania FROM compania ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_cia=$fila ['c_compania'];
								$nom_cia=$fila ['d_compania'];
								if ($c_compania == $cod_cia) {
								?>
									<option value="<?php echo $cod_cia ?>" selected><?php echo $nom_cia ?></option>
										<?php } else { ?>
											<option value="<?php echo $cod_cia ?>"><?php echo $nom_cia ?></option>
								<?php						
										}}
								?>
					</select> 
								
					<label for="exampleInputFile">Numero</label>
					<input name="numero" class="form-control" value="<?php echo $numero ?>"  placeholder="Numero"> 
								
					<label for="exampleInputFile">Marca</label>
					<select  class="form-control" name='s_marca' >
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_marca, descripcion AS d_marca FROM marcas ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_mc=$fila ['c_marca'];
								$nom_mc=$fila ['d_marca'];
								if ($c_marca == $cod_mc) {
						?>
									<option value="<?php echo $cod_mc ?>" selected><?php echo $nom_mc ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_mc ?>"><?php echo $nom_mc ?></option>
						<?php						
								}}
						?>
					</select>

					<label for="exampleInputFile">Modelo</label>
					<input name="modelo" class="form-control" value="<?php echo $modelo ?>"  placeholder="Modelo">  

					<label for="exampleInputFile">Tipo Plan</label>
					<select  class="form-control" name='t_plan' >
						<option value="0">Seleccione...</option>
						<?php if ($t_plan == 'VOZ') {?> <option value="VOZ" selected>VOZ</option> <?php } else { ?> <option value="VOZ">VOZ</option> <?php } ?>
						<?php if ($t_plan == 'DATOS') {?> <option value="DATOS" selected>DATOS</option> <?php } else { ?> <option value="DATOS">DATOS</option> <?php } ?>							
						<?php if ($t_plan == 'VOZ/DATOS') {?> <option value="VOZ/DATOS" selected>VOZ/DATOS</option> <?php } else { ?> <option value="VOZ/DATOS">VOZ/DATOS</option> <?php } ?>							
					</select>					

					<fieldset>	
						<div class="pull-left">
							<label for="exampleInputFile">Estado Linea</label>
							<select  class="form-control" name='estado_linea' >
								<option value="0">Seleccione...</option>
								<?php if ($estado_linea == 'ACTIVA') {?> <option value="ACTIVA" selected>ACTIVA</option> <?php } else { ?> <option value="ACTIVA">ACTIVA</option> <?php } ?>
								<?php if ($estado_linea == 'INACTIVA') {?> <option value="INACTIVA" selected>INACTIVA</option> <?php } else { ?> <option value="INACTIVA">INACTIVA</option> <?php } ?>							
							</select>
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Estado Equipo</label>
							<select  class="form-control" name='estado_equipo' >
								<option value="0">Seleccione...</option>
								<?php if ($estado_equipo == 'OPERATIVO') {?> <option value="OPERATIVO" selected>OPERATIVO</option> <?php } else { ?> <option value="OPERATIVO">OPERATIVO</option> <?php } ?>
								<?php if ($estado_equipo == 'INOPERATIVO') {?> <option value="INOPERATIVO" selected>INOPERATIVO</option> <?php } else { ?> <option value="INOPERATIVO">INOPERATIVO</option> <?php } ?>							
							</select>
						</div>
					</fieldset>	

						<br></br>
						<fieldset>
							<legend>Por Usuario</legend>
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
						</fieldset>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary btn-lg" name="imprimir" id="imprimir" value="Imprimir">Imprimir</button>
				</div>
			</form>
		</div><!-- /.box -->
	</div>

   




