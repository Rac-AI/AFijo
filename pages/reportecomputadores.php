 	
<?php

require ('validarnum.php');

$id=0;
$id_usuario=0;
$t_computador="";
$c_marca="";
$modelo="";
$t_hdd="";
$office="";
$s_o="";
$ver_s_o="";
$procesador="";
$lic_windows="";
$lic_office="";
$f_compra=date("Y-m-d");  	

?>

	 <div class="col-md-9">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Reporte de Computadores (Seleccione el Filtro)</h3>
			</div>
								
			<!-- form start -->
			<form target=_blank  role="form"  name="fe" action="./pdf/listacomputadores2.php" method="post">
				<div class="box-body">
					<div class="form-group">
						<label for="exampleInputFile">Tipo de Computador</label>
						<select  class="form-control" name='s_computador' >
							<option value="0">Seleccione...</option>
							<?php if ($t_computador == 'DESKTOP') {?> <option value="DESKTOP" selected>DESKTOP</option> <?php } else { ?> <option value="DESKTOP">DESKTOP</option> <?php } ?>
							<?php if ($t_computador == 'NOTEBOOK') {?> <option value="NOTEBOOK" selected>NOTEBOOK</option> <?php } else { ?> <option value="NOTEBOOK">NOTEBOOK</option> <?php } ?>							
						</select>
																				
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
						<br></br>
						<fieldset>
							<legend>Hardware</legend>
							<div class="pull-left">
								<label for="exampleInputFile">Procesador</label>
								<input name="procesador" class="form-control" value="<?php echo $procesador ?>"  placeholder="Procesador">     
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">Tipo Disco</label>
								<select  class="form-control" name='s_tipodisco' >
									<option value="0">Seleccione...</option>
									<?php if ($t_hdd == 'MECANICO') {?> <option value="MECANICO" selected>MECANICO</option> <?php } else { ?> <option value="MECANICO">MECANICO</option> <?php } ?>
									<?php if ($t_hdd == 'SOLIDO') {?> <option value="SOLIDO" selected>SOLIDO</option> <?php } else { ?> <option value="SOLIDO">SOLIDO</option> <?php } ?>	
								</select>    
							</div>
						</fieldset>
						<br></br>
						<fieldset>
							<legend>Software</legend>
							<div class="pull-left">
								<label for="exampleInputFile">Office</label>
								<input name="office" class="form-control" value="<?php echo $office ?>"  placeholder="Office">     
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">Licencia</label>
								<select  class="form-control" name='s_lic_office' >
									<option value="0">Seleccione...</option>
									<?php if ($lic_office == 'SI') {?> <option value="SI" selected>SI</option> <?php } else { ?> <option value="SI">SI</option> <?php } ?>
									<?php if ($lic_office == 'NO') {?> <option value="NO" selected>NO</option> <?php } else { ?> <option value="NO">NO</option> <?php } ?>
								</select> 
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">Windows</label>
								<input name="s_o" class="form-control" value="<?php echo $s_o ?>"  placeholder="windows">     
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">Ver. SO</label>
								<input name="ver_s_o" class="form-control" value="<?php echo $ver_s_o ?>"  placeholder="Version">     
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">Licencia</label>
								<select  class="form-control" name='s_lic_windows' >
									<option value="0">Seleccione...</option>
									<?php if ($lic_windows == 'SI') {?> <option value="SI" selected>SI</option> <?php } else { ?> <option value="SI">SI</option> <?php } ?>
									<?php if ($lic_windows == 'NO') {?> <option value="NO" selected>NO</option> <?php } else { ?> <option value="NO">NO</option> <?php } ?>
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

   




