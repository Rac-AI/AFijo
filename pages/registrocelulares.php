 	
<?php

require ('validarnum.php');

$id=0;
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
$f_alta=date("Y-m-d");
$f_recambio=date("Y-m-d");

if (isset($_GET['nuevo'])) { 
	if (isset($_POST['lugarguardar'])) {
		
		$id=$_POST['id_equipo'];
		$numero=$_POST['numero'];
		$c_compania=$_POST['c_compania'];
		$simcard=$_POST['simcard'];
		$imei=$_POST['imei'];
		$c_marca=$_POST['c_marca'];
		$modelo=$_POST['modelo'];
		$plan=$_POST['plan'];
		$t_plan=$_POST['t_plan'];		
		$telefonia_ip=$_POST['telefonia_ip'];
		$estado_linea=$_POST['estado_linea'];
		$estado_equipo=$_POST['estado_equipo'];
		$f_alta=$_POST['f_alta'];
		$f_recambio=$_POST['f_recambio'];	
		
		//echo 'Nombre '.$nombre.' Codigo '.$id.' Correo '.$correo.' Celular '.$celular.' Tipo de Usuario '.$c_tusuario.' Empresa '.$c_empresa.' Ubicacion '.$c_ubicacion.' Departamento '.$c_depto;

		$sql="select * from `celulares` where id_equipo='$id'";
		$cs=$bd->consulta($sql);

		if($bd->numeroFilas($cs)!=0){

			//CONSULTAR SI EL CAMPO YA EXISTE
			echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alerta no se registro este celular </b> Ya Existe... ';
            echo '   </div>';
		}else{
			$sql = "INSERT INTO `celulares` (`ID_EQUIPO`, `NUMERO`, `C_COMPANIA`, `SIMCARD`, `IMEI`, `C_MARCA`, `MODELO`, `PLAN`, `T_PLAN`, `TELEFONIA_IP`, `ESTADO_LINEA`, `ESTADO_EQUIPO`, `F_ALTA`, `F_RECAMBIO`) 
							VALUES (NULL, '$numero', '$c_compania','$simcard','$imei','$c_marca', '$modelo','$plan','$t_plan','$telefonia_ip','$estado_linea','$estado_equipo','$f_alta','$f_recambio')";
            $cs=$bd->consulta($sql);  
			$situacion = "A";
			$id=$bd->ultimo_agregado();
			$sql_asigna = "INSERT INTO `asignaciones` (`id_equipo`, `id_usuario`, `f_asignacion`, `situacion`) VALUES ('$id','$id_usuario','$f_compra', '$situacion')";
			$ds=$bd->consulta($sql_asigna); 

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Bien!</b> Datos Guardados Correctamente... ';
			echo "Computador: '$t_computador', marca='$c_marca', id_equipo='$id'";
            echo '   </div>';
        }
	}

?>

 <div class="col-md-10">
	<!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header">
			<h3 class="box-title">Registro de Celulares</h3>
        </div>
                            
        <!-- form start -->
        <form role="form"  name="fe" action="?mod=registrocelulares&nuevo=nuevo" method="post">
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
					<input required type="text" name="numero" class="form-control" value="<?php echo $numero ?>"  placeholder="Numero"> 
								
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
					<input required type="text" name="modelo" class="form-control" value="<?php echo $modelo ?>"  placeholder="Modelo">  

					<fieldset>	
						<div class="pull-left">
							<label for="exampleInputFile">Simcard</label>
							<input required type="text" name="simcard" class="form-control" value="<?php echo $simcard ?>"  placeholder="Simcard"> 
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">IMEI</label>
							<input required type="text" name="imei" class="form-control" value="<?php echo $imei ?>"  placeholder="IMEI"> 
						</div>
					</fieldset>	
					
					<label >Plan</label>
					<input required type="text" name="plan" class="form-control" value="<?php echo $plan ?>"  placeholder="Plan"> 

					<label for="exampleInputFile">Tipo Plan</label>
					<select  class="form-control" name='t_plan' >
						<option value="0">Seleccione...</option>
						<?php if ($t_plan == 'VOZ') {?> <option value="VOZ" selected>VOZ</option> <?php } else { ?> <option value="VOZ">VOZ</option> <?php } ?>
						<?php if ($t_plan == 'DATOS') {?> <option value="DATOS" selected>DATOS</option> <?php } else { ?> <option value="DATOS">DATOS</option> <?php } ?>							
						<?php if ($t_plan == 'VOZ/DATOS') {?> <option value="VOZ/DATOS" selected>VOZ/DATOS</option> <?php } else { ?> <option value="VOZ/DATOS">VOZ/DATOS</option> <?php } ?>							
					</select>					

					<label for="exampleInputFile">Telefonia Ip</label>
					<input required type="text" name="ip" class="form-control" value="<?php echo $telefonia_ip ?>"  placeholder="Ip"> 					

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
					
					<fieldset>	
						<div class="pull-left">
							<label for="exampleInputFile">Fecha Alta</label>
							<input required type="text" name="f_alta" class="form-control" value="<?php echo $f_alta ?>"  placeholder="Fecha de Alta"> 
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Fecha Recambio</label>
							<input required type="text" name="f_recambio" class="form-control" value="<?php echo $f_recambio ?>"  placeholder="Fecha de Recambio"> 
						</div>
					</fieldset>	
					
					<br></br>
					<fieldset>
						<legend>Asignar Usuario</legend>
						<label for="exampleInputFile">Usuario</label>
						<select  class="form-control" name='s_usuario' >
							<option value="0">Seleccione...</option>
							<?php
								$consulta2="SELECT id_usuarios, nombre FROM usuarios ORDER BY nombre ASC;";
								$sql2 = $bd->consulta($consulta2);
								while ($fila=$bd->mostrar_registros($sql2)) {
									$cod_usu=$fila ['id_usuarios'];
									$nom_usu=$fila ['nombre'];
									if ($cod_usu == $x2) {
							?>
										<option value="<?php echo $cod_usu ?>" selected><?php echo $nom_usu ?></option>
									<?php } else { ?>
										<option value="<?php echo $cod_usu ?>"><?php echo $nom_usu ?></option>
							<?php						
									}}
							?>	
						</select>							
					</fieldset>
				</div>
            </div><!-- /.box-body -->

            <div class="box-footer">
				<button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" id="lugarguardar" value="Guardar">Agregar</button>
            </div>
        </form>
    </div><!-- /.box -->
	<?php
	}
		if (isset($_GET['lista'])) { 
			$x1="";
            if (isset($_POST['lista'])) {
	}?>
  
    <div class="row">
        <div class="col-xs-10">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista Celulares:</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Numero</th>
                                <th>Usuario</th>
                                <th></th>
							</tr>
                        </thead>
                        <tbody>
                            <?php
								$consulta="SELECT celulares.*, marcas.descripcion AS d_marca, compania.descripcion AS d_compania, usuarios.NOMBRE, usuarios.id_usuarios
											FROM celulares, marcas, compania, asignaciones LEFT JOIN usuarios
											ON usuarios.id_usuarios = asignaciones.id_usuario AND asignaciones.SITUACION = 'A'
											WHERE celulares.C_MARCA = marcas.codigo AND
													celulares.C_COMPANIA = compania.codigo AND
													asignaciones.id_equipo = celulares.ID_EQUIPO AND
													asignaciones.T_EQUIPO = 'CL'";
                                $bd->consulta($consulta);
                                while ($fila=$bd->mostrar_registros())
								{

                                    echo "<tr><td>$fila[d_marca]</td>
                                              <td>$fila[MODELO]</td>
                                              <td>$fila[NUMERO]</td>
                                              <td>$fila[NOMBRE]</td>
                                              <td><center>";
									echo "
										<a  href=?mod=registrocelulares&editar&codigo=".$fila["ID_EQUIPO"]."&usuario=".$fila["id_usuarios"]."><img src='./img/editar.png' width='25' alt='Edicion' title='EDITAR LOS DATOS DE ".$fila["MODELO"]."'></a> 
										<a   href=?mod=registrocelulares&eliminar&codigo=".$fila["ID_EQUIPO"]."&usuario=".$fila["id_usuarios"]."><img src='./img/elimina.png'  width='25' alt='Edicion' title='ELIMINAR A   ".$fila["MODELO"]."'></a>";
									echo "</center></td></tr>";
                                }
                            ?>                                            
                        </tbody>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <?php
			if($tipo2==1)
			{
				echo '<div class="col-md-2">
						<div class="box">
							<div class="box-header">
								<div class="box-header">
									<h3> <center>Agregar Celular <a href="#" class="alert-link">Nuevo</a></center></h3>                                    
                                </div>
								<center>        
									<form  name="fe" action="?mod=registrocelulares&nuevo" method="post" id="ContactForm">
										<input title="Agregar un nuevo Celular" name="btn1"  class="btn btn-primary"type="submit" value="Agregar Nuevo">
									</form>
								</center>
                            </div>
                        </div>
                      </div>  '; 
			} 
		?>
        </br>       
		<div class="col-md-2">
			<div class="box">
                <div class="box-header">
					<center>
						<div class="box-header">
                            <h3> <center>Imprimir Lista de Celulares</a></center></h3>                                    
                        </div>
                        <a target='_blank'  href=./pdf/listacelulares.php><img src='./img/impresora.png'  width='50' alt='Edicion' title='Imprimir lista de Celulares'></a>
                    </center>
                </div>
            </div>
        </div>

		<?php
}

	if (isset($_GET['editar'])) 
	{ 
		//codigo que viene de la lista
		$x1=$_GET['codigo'];
		$x2=$_GET['usuario'];
		
        if (isset($_POST['editar'])) {
			$id_usuario=$_POST['s_usuario'];
			$numero=$_POST['numero'];
			$c_compania=$_POST['s_compania'];
			$simcard=$_POST['simcard'];
			$imei=$_POST['imei'];
			$c_marca=$_POST['s_marca'];
			$modelo=$_POST['modelo'];
			$plan=$_POST['plan'];
			$t_plan=$_POST['t_plan'];		
			$telefonia_ip=$_POST['ip'];
			$estado_linea=$_POST['estado_linea'];
			$estado_equipo=$_POST['estado_equipo'];
			$f_alta=$_POST['f_alta'];
			$f_recambio=$_POST['f_recambio'];				
                      
			if( $x1=="" )
            {
				echo "<script> alert('campos vacios')</script>";
                echo "<br>";
            } else {
				// Validar que tenga asignado otro equipo en caso
				// se modifique el usuario
				$sql2="SELECT * FROM `asignaciones` WHERE id_usuario = '$id_usuario' AND id_equipo = '$x1' AND SITUACION <> 'I' AND T_EQUIPO = 'CL'";
				$cs=$bd->consulta($sql2);

				if($bd->numeroFilas($cs)==0){
					$sql="UPDATE celulares SET
							NUMERO='$numero' ,
							C_COMPANIA='$c_compania' ,
							MODELO='$modelo' ,
							SIMCARD='$simcard' ,
							IMEI='$imei' ,
							C_MARCA='$c_marca' ,
							PLAN='$plan' ,
							T_PLAN='$t_plan' ,
							TELEFONIA_IP='$telefonia_ip' ,
							ESTADO_LINEA='$estado_linea' ,
							ESTADO_EQUIPO='$estado_equipo' ,
							F_ALTA='$f_alta' ,
							F_RECAMBIO='$f_recambio' 
							WHERE id_equipo='$x1'";
					$bd->consulta($sql);
					
					$sql="UPDATE asignaciones SET SITUACION = 'A' WHERE id_usuario = '$id_usuario' AND id_equipo = '$x1' AND t_equipo = 'CL'";
					$bd->consulta($sql);					
					//echo "Datos Guardados Correctamente";
					echo '<div class="alert alert-success alert-dismissable">
							<i class="fa fa-check"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<b>Bien!</b> Datos Editados Correctamente... ';

					echo "Celular: '$modelo', id='$x1'";
					echo '   </div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
												<i class="fa fa-check"></i>
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<b>Este celular ya ha sido asignado a otro usuario </b> Debe dar de baja asignación para proceder... ';
					echo '   </div>';						
				}
			}
   
	}
							
    $consulta="SELECT celulares.*, marcas.descripcion AS d_marca, compania.descripcion AS d_compania, usuarios.NOMBRE, asignaciones.id_usuario
					FROM celulares, marcas, compania, asignaciones, usuarios
					WHERE celulares.C_MARCA = marcas.codigo AND
							celulares.C_COMPANIA = compania.codigo AND
							asignaciones.id_equipo = celulares.ID_EQUIPO AND
							asignaciones.T_EQUIPO = 'CL' AND
							usuarios.id_usuarios = asignaciones.id_usuario AND
                            celulares.ID_EQUIPO = '$x1'";
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
		$numero=$fila ['NUMERO'];
		$c_compania=$fila ['C_COMPANIA'];
		$modelo=$fila ['MODELO'];
		$simcard=$fila ['SIMCARD'];
		$imei=$fila ['IMEI'];
		$c_marca=$fila ['C_MARCA'];
		$plan=$fila ['PLAN'];
		$t_plan=$fila ['T_PLAN'];		
		$telefonia_ip=$fila ['TELEFONIA_IP'];
		$estado_linea=$fila ['ESTADO_LINEA'];
		$estado_equipo=$fila ['ESTADO_EQUIPO'];
		$f_alta=$fila ['F_ALTA'];
		$f_recambio=$fila ['F_RECAMBIO'];
		
?>
    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Editar Celular</h3>
            </div>
                                
            <?php  echo '  <form role="form"  name="fe" action="?mod=registrocelulares&editar=editar&codigo='.$x1.'&usuario='.$x2.'" method="post">';?>
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
					<input required type="text" name="numero" class="form-control" value="<?php echo $numero ?>"  placeholder="Numero"> 
								
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
					<input required type="text" name="modelo" class="form-control" value="<?php echo $modelo ?>"  placeholder="Modelo">  

					<fieldset>	
						<div class="pull-left">
							<label for="exampleInputFile">Simcard</label>
							<input required type="text" name="simcard" class="form-control" value="<?php echo $simcard ?>"  placeholder="Simcard"> 
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">IMEI</label>
							<input required type="text" name="imei" class="form-control" value="<?php echo $imei ?>"  placeholder="IMEI"> 
						</div>
					</fieldset>	
					
					<label >Plan</label>
					<input required type="text" name="plan" class="form-control" value="<?php echo $plan ?>"  placeholder="Plan"> 

					<label for="exampleInputFile">Tipo Plan</label>
					<select  class="form-control" name='t_plan' >
						<option value="0">Seleccione...</option>
						<?php if ($t_plan == 'VOZ') {?> <option value="VOZ" selected>VOZ</option> <?php } else { ?> <option value="VOZ">VOZ</option> <?php } ?>
						<?php if ($t_plan == 'DATOS') {?> <option value="DATOS" selected>DATOS</option> <?php } else { ?> <option value="DATOS">DATOS</option> <?php } ?>							
						<?php if ($t_plan == 'VOZ/DATOS') {?> <option value="VOZ/DATOS" selected>VOZ/DATOS</option> <?php } else { ?> <option value="VOZ/DATOS">VOZ/DATOS</option> <?php } ?>							
					</select>					

					<label for="exampleInputFile">Telefonia Ip</label>
					<input required type="text" name="ip" class="form-control" value="<?php echo $telefonia_ip ?>"  placeholder="Ip"> 					

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
					
					<fieldset>	
						<div class="pull-left">
							<label for="exampleInputFile">Fecha Alta</label>
							<input required type="text" name="f_alta" class="form-control" value="<?php echo $f_alta ?>"  placeholder="Fecha de Alta"> 
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Fecha Recambio</label>
							<input required type="text" name="f_recambio" class="form-control" value="<?php echo $f_recambio ?>"  placeholder="Fecha de Recambio"> 
						</div>
					</fieldset>	
					
					<br></br>
					<fieldset>
						<legend>Asignar Usuario</legend>
						<label for="exampleInputFile">Usuario</label>
						<select  class="form-control" name='s_usuario' >
							<option value="0">Seleccione...</option>
							<?php
								$consulta2="SELECT id_usuarios, nombre FROM usuarios ORDER BY nombre ASC;";
								$sql2 = $bd->consulta($consulta2);
								while ($fila=$bd->mostrar_registros($sql2)) {
									$cod_usu=$fila ['id_usuarios'];
									$nom_usu=$fila ['nombre'];
									if ($cod_usu == $x2) {
							?>
										<option value="<?php echo $cod_usu ?>" selected><?php echo $nom_usu ?></option>
									<?php } else { ?>
										<option value="<?php echo $cod_usu ?>"><?php echo $nom_usu ?></option>
							<?php						
									}}
							?>	
						</select>							
					</fieldset>
				</div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" name="editar" id="editar" value="Editar">Editar</button>
            </div>
            </form>
        </div><!-- /.box -->
<?php

}
}
//eliminar
if (isset($_GET['eliminar'])) 
{ 
	//codigo que viene de la lista
	$x1=$_GET['codigo'];
	$x2=$_GET['usuario'];
		
    if (isset($_POST['eliminar'])) 
	{
		$numero=$fila ['NUMERO'];
		$c_compania=$fila ['C_COMPANIA'];
		$modelo=$fila ['MODELO'];
		$simcard=$fila ['SIMCARD'];
		$imei=$fila ['IMEI'];
		$c_marca=$fila ['C_MARCA'];
		$plan=$fila ['PLAN'];
		$t_plan=$fila ['T_PLAN'];		
		$telefonia_ip=$fila ['TELEFONIA_IP'];
		$estado_linea=$fila ['ESTADO_LINEA'];
		$estado_equipo=$fila ['ESTADO_EQUIPO'];
		$f_alta=$fila ['F_ALTA'];
		$f_recambio=$fila ['F_RECAMBIO'];
		
		if( $numero=="" )
        {
			echo "<script> alert('campos vacios')</script>";
            echo "<br>";
        }
        else
        {
			// Validar que tenga NO TENGA asignado usuario 
			// para poder eliminar
			$sql2="SELECT * FROM `asignaciones` WHERE id_usuario = '$x2' AND id_equipo <> '$x1' AND SITUACION = 'A'";
			$cs=$bd->consulta($sql2);

			if($bd->numeroFilas($cs)==0){
				$sql="DELETE FROM celulares WHERE id_equipo='$x1' ";
				$bd->consulta($sql);

				//echo "Datos Guardados Correctamente";
				echo '<div class="alert alert-success alert-dismissable">
						<i class="fa fa-check"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Bien!</b> Se Elimino Correctamente... ';
				echo "Celular: '$modelo', marca='$c_marca', id_equipo='$x1'";
				echo '   </div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-check"></i>
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<b>Alerta este celular tiene usuario asignado </b> Debe dar de baja asignación para proceder a eliminar a celular... ';
				echo '   </div>';					
			}			
        }
	}

    $consulta="SELECT celulares.*, marcas.descripcion AS d_marca, compania.descripcion AS d_compania, usuarios.NOMBRE, asignaciones.id_usuario
					FROM celulares, marcas, compania, asignaciones, usuarios
					WHERE celulares.C_MARCA = marcas.codigo AND
							celulares.C_COMPANIA = compania.codigo AND
							asignaciones.id_equipo = celulares.ID_EQUIPO AND
							asignaciones.T_EQUIPO = 'CL' AND
							usuarios.id_usuarios = asignaciones.id_usuario AND
                            celulares.ID_EQUIPO = '$x1'";
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
		$numero=$fila ['NUMERO'];
		$c_compania=$fila ['C_COMPANIA'];
		$modelo=$fila ['MODELO'];
		$simcard=$fila ['SIMCARD'];
		$imei=$fila ['IMEI'];
		$c_marca=$fila ['C_MARCA'];
		$plan=$fila ['PLAN'];
		$t_plan=$fila ['T_PLAN'];		
		$telefonia_ip=$fila ['TELEFONIA_IP'];
		$estado_linea=$fila ['ESTADO_LINEA'];
		$estado_equipo=$fila ['ESTADO_EQUIPO'];
		$f_alta=$fila ['F_ALTA'];
		$f_recambio=$fila ['F_RECAMBIO'];

?>
    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Editar Celular</h3>
            </div>
                                
            <?php  echo '  <form role="form"  name="fe" action="?mod=registrocelulares&eliminar=eliminar&codigo='.$x1.'&usuario='.$x2.'" method="post">';?>
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
					<input required type="text" name="numero" class="form-control" value="<?php echo $numero ?>"  placeholder="Numero"> 
								
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
					<input required type="text" name="modelo" class="form-control" value="<?php echo $modelo ?>"  placeholder="Modelo">  

					<fieldset>	
						<div class="pull-left">
							<label for="exampleInputFile">Simcard</label>
							<input required type="text" name="simcard" class="form-control" value="<?php echo $simcard ?>"  placeholder="Simcard"> 
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">IMEI</label>
							<input required type="text" name="imei" class="form-control" value="<?php echo $imei ?>"  placeholder="IMEI"> 
						</div>
					</fieldset>	
					
					<label >Plan</label>
					<input required type="text" name="plan" class="form-control" value="<?php echo $plan ?>"  placeholder="Plan"> 

					<label for="exampleInputFile">Tipo Plan</label>
					<select  class="form-control" name='t_plan' >
						<option value="0">Seleccione...</option>
						<?php if ($t_plan == 'VOZ') {?> <option value="VOZ" selected>VOZ</option> <?php } else { ?> <option value="VOZ">VOZ</option> <?php } ?>
						<?php if ($t_plan == 'DATOS') {?> <option value="DATOS" selected>DATOS</option> <?php } else { ?> <option value="DATOS">DATOS</option> <?php } ?>							
						<?php if ($t_plan == 'VOZ/DATOS') {?> <option value="VOZ/DATOS" selected>VOZ/DATOS</option> <?php } else { ?> <option value="VOZ/DATOS">VOZ/DATOS</option> <?php } ?>							
					</select>					

					<label for="exampleInputFile">Telefonia Ip</label>
					<input required type="text" name="ip" class="form-control" value="<?php echo $telefonia_ip ?>"  placeholder="Ip"> 					

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
					
					<fieldset>	
						<div class="pull-left">
							<label for="exampleInputFile">Fecha Alta</label>
							<input required type="text" name="f_alta" class="form-control" value="<?php echo $f_alta ?>"  placeholder="Fecha de Alta"> 
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Fecha Recambio</label>
							<input required type="text" name="f_recambio" class="form-control" value="<?php echo $f_recambio ?>"  placeholder="Fecha de Recambio"> 
						</div>
					</fieldset>	
					
					<br></br>
					<fieldset>
						<legend>Asignar Usuario</legend>
						<label for="exampleInputFile">Usuario</label>
						<select  class="form-control" name='s_usuario' >
							<option value="0">Seleccione...</option>
							<?php
								$consulta2="SELECT id_usuarios, nombre FROM usuarios ORDER BY nombre ASC;";
								$sql2 = $bd->consulta($consulta2);
								while ($fila=$bd->mostrar_registros($sql2)) {
									$cod_usu=$fila ['id_usuarios'];
									$nom_usu=$fila ['nombre'];
									if ($cod_usu == $x2) {
							?>
										<option value="<?php echo $cod_usu ?>" selected><?php echo $nom_usu ?></option>
									<?php } else { ?>
										<option value="<?php echo $cod_usu ?>"><?php echo $nom_usu ?></option>
							<?php						
									}}
							?>	
						</select>							
					</fieldset>
				</div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" name="editar" id="eliminar" value="Eliminar">Eliminar</button>
            </div>
            </form>
        </div><!-- /.box -->
			
<?php
}
}
?>

