 	
<?php

require ('validarnum.php');

$id=0;
$id_usuario=0;
$t_computador="";
$c_marca="";
$modelo="";
$serie="";
$size_hdd="";
$t_hdd="";
$ram="";
$office="";
$s_o="";
$ver_s_o="";
$procesador="";
$lic_windows="";
$lic_office="";
$f_compra=date("Y-m-d");  	
$t_equipo="PC";

if (isset($_GET['nuevo'])) { 
	if (isset($_POST['lugarguardar'])) {
		$id_usuario=$_POST['s_usuario'];
		$t_computador=$_POST['s_computador'];
		$c_marca=$_POST['s_marca'];
		$modelo=$_POST['modelo'];
		$serie=$_POST['serie'];
		$size_hdd=$_POST['size_hdd'];
		$t_hdd=$_POST['s_tipodisco'];
		$ram=$_POST['ram'];
		$office=$_POST['office'];
		$s_o=$_POST['s_o'];
		$ver_s_o=$_POST['ver_s_o'];
		$procesador=$_POST['procesador'];
		$lic_windows=$_POST['s_lic_windows'];
		$lic_office=$_POST['s_lic_office'];
		
		//echo 'Nombre '.$nombre.' Codigo '.$id.' Correo '.$correo.' Celular '.$celular.' Tipo de Usuario '.$c_tusuario.' Empresa '.$c_empresa.' Ubicacion '.$c_ubicacion.' Departamento '.$c_depto;

		$sql="select * from `computadores` where id_equipo='$id'";
		$cs=$bd->consulta($sql);

		if($bd->numeroFilas($cs)!=0){

			//CONSULTAR SI EL CAMPO YA EXISTE
			echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alerta no se registro este computador </b> Ya Existe... ';
            echo '   </div>';
		}else{
			$sql = "INSERT INTO `computadores` (`id_equipo`, `id_usuarios`, `t_computador`, `c_marca`, `modelo`, `serial`, `size_hdd`, `t_hdd`, `ram`, `office`, `s_o`, `ver_s_o`, `procesador`, `lic_windows`, `lic_office`, `f_compra`) 
							VALUES (NULL, '$id_usuario', '$t_computador','$c_marca','$modelo','$serie', '$size_hdd','$t_hdd','$ram','$office','$s_o','$ver_s_o','$procesador','$lic_windows','$lic_office','$f_compra')";
            $cs=$bd->consulta($sql);  
			$situacion = "A";
			$id=$bd->ultimo_agregado();
			$sql_asigna = "INSERT INTO `asignaciones` (`id_equipo`, `id_usuario`, `t_equipo`, `f_asignacion`, `situacion`) VALUES ('$id','$id_usuario','$t_equipo', '$f_compra', '$situacion')";
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
			<h3 class="box-title">Registro de Computadores</h3>
        </div>
                            
        <!-- form start -->
        <form role="form"  name="fe" action="?mod=registrocomputadores&nuevo=nuevo" method="post">
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
                    <input required type="text" name="modelo" class="form-control" value="<?php echo $modelo ?>"  placeholder="Modelo">        
					<br></br>
					<fieldset>
						<legend>Hardware</legend>
						<div class="pull-left">
							<label for="exampleInputFile">Serie</label>
							<input required type="text" name="serie" class="form-control" value="<?php echo $serie ?>"  placeholder="Serie">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Procesador</label>
							<input required type="text" name="procesador" class="form-control" value="<?php echo $procesador ?>"  placeholder="Procesador">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Disco Duro</label>
							<input required type="text" name="size_hdd" class="form-control" value="<?php echo $size_hdd ?>"  placeholder="HDD">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Tipo Disco</label>
							<select  class="form-control" name='s_tipodisco' >
								<option value="0">Seleccione...</option>
								<?php if ($t_hdd == 'MECANICO') {?> <option value="MECANICO" selected>MECANICO</option> <?php } else { ?> <option value="MECANICO">MECANICO</option> <?php } ?>
								<?php if ($t_hdd == 'SOLIDO') {?> <option value="SOLIDO" selected>SOLIDO</option> <?php } else { ?> <option value="SOLIDO">SOLIDO</option> <?php } ?>	
							</select>    
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">RAM</label>
							<input required type="text" name="ram" class="form-control" value="<?php echo $ram ?>"  placeholder="RAM">     
						</div>
					</fieldset>
					<br></br>
					<fieldset>
						<legend>Software</legend>
						<div class="pull-left">
							<label for="exampleInputFile">Office</label>
							<input required type="text" name="office" class="form-control" value="<?php echo $office ?>"  placeholder="Office">     
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
							<input required type="text" name="s_o" class="form-control" value="<?php echo $s_o ?>"  placeholder="windows">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Ver. SO</label>
							<input required type="text" name="ver_s_o" class="form-control" value="<?php echo $ver_s_o ?>"  placeholder="Version">     
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
						<legend>Asignar Usuario</legend>
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
                    <h3 class="box-title">Lista Computadores:</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Serie</th>
                                <th>Usuario</th>
                                <th></th>
							</tr>
                        </thead>
                        <tbody>
                            <?php
								$consulta="SELECT computadores.*, marcas.descripcion AS d_marca, usuarios.NOMBRE AS n_usuario
											FROM marcas, computadores LEFT JOIN usuarios ON computadores.id_usuarios = usuarios.id_usuarios
											WHERE computadores.c_marca = marcas.codigo
											ORDER BY computadores.t_computador, computadores.c_marca, computadores.modelo";
                                $bd->consulta($consulta);
                                while ($fila=$bd->mostrar_registros())
								{

                                    echo "<tr><td>$fila[t_computador]</td>
                                              <td>$fila[d_marca]</td>
                                              <td>$fila[serial]</td>
                                              <td>$fila[n_usuario]</td>
                                              <td><center><a href=?mod=registrocomputadores&usuario&codigo=".$fila["id_usuarios"]."><img src='./img/consul.png' width='25' alt='Edicion' title=' CONSULTAR ".$fila["t_computador"]." ".$fila["d_marca"]." ".$fila["modelo"]."'></a>";
									echo "
										<a  href=?mod=registrocomputadores&editar&codigo=".$fila["id_equipo"]."><img src='./img/editar.png' width='25' alt='Edicion' title='EDITAR LOS DATOS DE ".$fila["t_computador"]." ".$fila["d_marca"]." ".$fila["modelo"]."'></a> 
										<a   href=?mod=registrocomputadores&eliminar&codigo=".$fila["id_equipo"]."><img src='./img/elimina.png'  width='25' alt='Edicion' title='ELIMINAR A   ".$fila["t_computador"]." ".$fila["d_marca"]." ".$fila["modelo"]."'></a>";
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
									<h3> <center>Agregar Computador <a href="#" class="alert-link">Nuevo</a></center></h3>                                    
                                </div>
								<center>        
									<form  name="fe" action="?mod=registrocomputadores&nuevo" method="post" id="ContactForm">
										<input title="Agregar un nuevo Computador" name="btn1"  class="btn btn-primary"type="submit" value="Agregar Nuevo">
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
                            <h3> <center>Imprimir Lista Computadores</a></center></h3>                                    
                        </div>
                        <a target='_blank'  href=./pdf/listacomputadores.php><img src='./img/impresora.png'  width='50' alt='Edicion' title='Imprimir lista de Computadores'></a>
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
        if (isset($_POST['editar'])) {
			$id_usuario=$_POST['s_usuario'];
			$t_computador=$_POST['s_computador'];
			$c_marca=$_POST['s_marca'];
			$modelo=$_POST['modelo'];
			$serie=$_POST['serie'];
			$size_hdd=$_POST['size_hdd'];
			$t_hdd=$_POST['s_tipodisco'];
			$ram=$_POST['ram'];
			$office=$_POST['office'];
			$s_o=$_POST['s_o'];
			$ver_s_o=$_POST['ver_s_o'];
			$procesador=$_POST['procesador'];
			$lic_windows=$_POST['s_lic_windows'];
			$lic_office=$_POST['s_lic_office'];
                      
			if( $t_computador=="" )
            {
				echo "<script> alert('campos vacios')</script>";
                echo "<br>";
            } else {
				// Validar que tenga asignado otro equipo en caso
				// se modifique el usuario
				$sql2="SELECT * FROM `asignaciones` WHERE id_usuario = '$id_usuario' AND id_equipo = '$x1' AND SITUACION <> 'I' AND T_EQUIPO = 'PC'";
				$cs=$bd->consulta($sql2);		

				if($bd->numeroFilas($cs)==0){
					$sql=" UPDATE computadores SET
							id_usuarios='$id_usuario' ,
							t_computador='$t_computador' ,
							c_marca='$c_marca' ,
							modelo='$modelo' ,
							serial='$serie' ,
							size_hdd='$size_hdd' ,
							t_hdd='$t_hdd' ,
							ram='$ram' ,
							office='$office' ,
							s_o='$s_o' ,
							ver_s_o='$ver_s_o' ,
							procesador='$procesador' ,
							lic_windows='$lic_windows' ,
							lic_office='$lic_office' 
							where id_equipo='$x1'";
					$bd->consulta($sql);
					
					$sql="UPDATE asignaciones SET SITUACION = 'A' WHERE id_usuario = '$id_usuario' AND id_equipo = '$x1' AND t_equipo = 'PC'";
					$bd->consulta($sql);		
					//echo "Datos Guardados Correctamente";
					echo '<div class="alert alert-success alert-dismissable">
							<i class="fa fa-check"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<b>Bien!</b> Datos Editados Correctamente... ';

					echo "Computador: '$t_computador', id='$x1'";
					echo '   </div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissable">
												<i class="fa fa-check"></i>
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<b>Alerta este usuario ya tiene computador asignado </b> Debe dar de baja asignación para proceder... ';
					echo '   </div>';						
				}
			}
   
	}
								
    $consulta="SELECT computadores.*, marcas.descripcion AS d_marca
					FROM computadores, marcas
					WHERE computadores.id_equipo = '$x1' AND computadores.c_marca = marcas.codigo
					ORDER BY computadores.t_computador, computadores.c_marca, computadores.modelo;";
	
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
		$id_usuario=$fila ['id_usuarios'];	
		$t_computador=$fila ['t_computador'];
		$c_marca=$fila ['c_marca'];
		$modelo=$fila ['modelo'];
		$serie=$fila ['serial'];
		$size_hdd=$fila ['size_hdd'];
		$t_hdd=$fila['t_hdd'];
		$ram=$fila ['ram'];
		$office=$fila ['office'];
		$s_o=$fila ['s_o'];
		$ver_s_o=$fila ['ver_s_o'];
		$procesador=$fila ['procesador'];
		$lic_windows=$fila ['lic_windows'];
		$lic_office=$fila ['lic_office'];
		
?>
    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Editar Computador</h3>
            </div>
                                
            <?php  echo '  <form role="form"  name="fe" action="?mod=registrocomputadores&editar=editar&codigo='.$x1.'" method="post">';?>
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
					<input required type="text" name="modelo" class="form-control" value="<?php echo $modelo ?>"  placeholder="Modelo">        
					<br></br>
					<fieldset>
						<legend>Hardware</legend>
						<div class="pull-left">
							<label for="exampleInputFile">Serie</label>
							<input required type="text" name="serie" class="form-control" value="<?php echo $serie ?>"  placeholder="Serie">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Procesador</label>
							<input required type="text" name="procesador" class="form-control" value="<?php echo $procesador ?>"  placeholder="Procesador">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Disco Duro</label>
							<input required type="text" name="size_hdd" class="form-control" value="<?php echo $size_hdd ?>"  placeholder="HDD">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Tipo Disco</label>
							<select  class="form-control" name='s_tipodisco' >
								<option value="0">Seleccione...</option>
								<?php if ($t_hdd == 'MECANICO') {?> <option value="MECANICO" selected>MECANICO</option> <?php } else { ?> <option value="MECANICO">MECANICO</option> <?php } ?>
								<?php if ($t_hdd == 'SOLIDO') {?> <option value="SOLIDO" selected>SOLIDO</option> <?php } else { ?> <option value="SOLIDO">SOLIDO</option> <?php } ?>	
							</select>    
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">RAM</label>
							<input required type="text" name="ram" class="form-control" value="<?php echo $ram ?>"  placeholder="RAM">     
						</div>
					</fieldset>
					<br></br>						
					<fieldset>
						<legend>Software</legend>
						<div class="pull-left">
							<label for="exampleInputFile">Office</label>
							<input required type="text" name="office" class="form-control" value="<?php echo $office ?>"  placeholder="Office">     
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
							<input required type="text" name="s_o" class="form-control" value="<?php echo $s_o ?>"  placeholder="windows">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Ver. SO</label>
							<input required type="text" name="ver_s_o" class="form-control" value="<?php echo $ver_s_o ?>"  placeholder="Version">     
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
						<legend>Asignar Usuario</legend>
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

    if (isset($_POST['eliminar'])) 
	{
		$t_computador=$_POST['s_computador'];
		$c_marca=$_POST['s_marca'];
		$modelo=$_POST['modelo'];
		$serie=$_POST['serie'];
		$size_hdd=$_POST['size_hdd'];
		$t_hdd=$_POST['s_tipodisco'];
		$ram=$_POST['ram'];
		$office=$_POST['office'];
		$s_o=$_POST['s_o'];
		$ver_s_o=$_POST['ver_s_o'];
		$procesador=$_POST['procesador'];
		$lic_windows=$_POST['s_lic_windows'];
		$lic_office=$_POST['s_lic_office'];
		
		if( $t_computador=="" )
        {
			echo "<script> alert('campos vacios')</script>";
            echo "<br>";
        }
        else
        {
			// Validar que tenga NO TENGA asignado usuario 
			// para poder eliminar
			$sql2="SELECT * FROM `asignaciones` WHERE id_equipo = '$x1' AND t_equipo = '$t_equipo' AND situacion = 'A'";
			$cs=$bd->consulta($sql2);
			if($bd->numeroFilas($cs)==0){
				$sql="DELETE FROM computadores WHERE id_equipo='$x1' ";
				$bd->consulta($sql);

				//echo "Datos Guardados Correctamente";
				echo '<div class="alert alert-success alert-dismissable">
						<i class="fa fa-check"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Bien!</b> Se Elimino Correctamente... ';
				echo "Computador: '$t_computador', marca='$c_marca', id_equipo='$x1'";
				echo '   </div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-check"></i>
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<b>Alerta este computador tiene usuario asignado </b> Debe dar de baja asignación para proceder a eliminar a computador... ';
				echo '   </div>';					
			}			
        }
	}

    $consulta="SELECT computadores.*, marcas.descripcion AS d_marca
					FROM computadores, marcas
					WHERE computadores.id_equipo = '$x1' AND computadores.c_marca = marcas.codigo
					ORDER BY computadores.t_computador, computadores.c_marca, computadores.modelo;";
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
		$id_usuario=$fila ['id_usuarios'];
		$t_computador=$fila ['t_computador'];
		$c_marca=$fila ['c_marca'];
		$modelo=$fila ['modelo'];
		$serie=$fila ['serial'];
		$size_hdd=$fila ['size_hdd'];
		$t_hdd=$fila['t_hdd'];
		$ram=$fila ['ram'];
		$office=$fila ['office'];
		$s_o=$fila ['s_o'];
		$ver_s_o=$fila ['ver_s_o'];
		$procesador=$fila ['procesador'];
		$lic_windows=$fila ['lic_windows'];
		$lic_office=$fila ['lic_office'];

?>
		<div class="col-md-10">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Eliminar Computador</h3>
                </div>
                <?php  echo '  <form role="form"  name="fe" action="?mod=registrocomputadores&eliminar=eliminar&codigo='.$x1.'" method="post">';?>
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
						<input required type="text" name="modelo" class="form-control" value="<?php echo $modelo ?>"  placeholder="Modelo">        

						<fieldset>
							<legend>Hardware</legend>
							<div class="pull-left">
								<label for="exampleInputFile">Serie</label>
								<input required type="text" name="serie" class="form-control" value="<?php echo $serie ?>"  placeholder="Serie">     
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">Procesador</label>
								<input required type="text" name="procesador" class="form-control" value="<?php echo $procesador ?>"  placeholder="Procesador">     
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">Disco Duro</label>
								<input required type="text" name="size_hdd" class="form-control" value="<?php echo $size_hdd ?>"  placeholder="HDD">     
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">Tipo Disco</label>
								<select  class="form-control" name='s_tipodisco' >
									<option value="0">Seleccione...</option>
									<?php if ($t_hdd == 'MECANICO') {?> <option value="MECANICO" selected>MECANICO</option> <?php } else { ?> <option value="MECANICO">MECANICO</option> <?php } ?>
									<?php if ($t_hdd == 'SOLIDO') {?> <option value="SOLIDO" selected>SOLIDO</option> <?php } else { ?> <option value="SOLIDO">SOLIDO</option> <?php } ?>	
								</select>    
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">RAM</label>
								<input required type="text" name="ram" class="form-control" value="<?php echo $ram ?>"  placeholder="RAM">     
							</div>
						</fieldset>
						
						<fieldset>
							<legend>Software</legend>
							<div class="pull-left">
								<label for="exampleInputFile">Office</label>
								<input required type="text" name="office" class="form-control" value="<?php echo $office ?>"  placeholder="Office">     
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
								<input required type="text" name="s_o" class="form-control" value="<?php echo $s_o ?>"  placeholder="windows">     
							</div>
							<div class="pull-left">
								<label for="exampleInputFile">Ver. SO</label>
								<input required type="text" name="ver_s_o" class="form-control" value="<?php echo $ver_s_o ?>"  placeholder="Version">     
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
							<legend>Usuario Asignado</legend>
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
                    <input type=submit  class="btn btn-primary btn-lg" name="eliminar" id="eliminar" value="ELIMINAR">
                </div>
                </form>
            </div><!-- /.box -->
<?php
}
}
?>

<?php
	if (isset($_GET['usuario'])) 
	{ 
		//codigo que viene de la lista
		$x1=$_GET['codigo'];
        if (isset($_POST['usuario'])) {

			$nombre=strtoupper($_POST["nombre"]);
			$correo=$_POST["correo"];
			$celular=$_POST["celular"];
			$c_tusuario=$_POST['st_usuario'];
			$c_empresa=$_POST["s_empresa"];
			$c_ubicacion=$_POST["s_ubicacion"];
			$c_depto=$_POST["s_depto"];
                       
			if( $nombre=="" )
            {
				echo "<script> alert('campos vacios')</script>";
                echo "<br>";
            }
	}
							
    $consulta="SELECT computadores.*, usuarios.*
				FROM computadores, asignaciones, usuarios
				WHERE computadores.id_usuarios = '$x1' AND
						computadores.id_equipo = asignaciones.id_equipo AND
						asignaciones.SITUACION = 'A' AND
						asignaciones.t_equipo = 'PC' AND
						computadores.id_usuarios = usuarios.id_usuarios;";
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
	
		$nombre=$fila ['NOMBRE'];
		$c_tusuario=$fila ['C_TUSUARIO'];
		$c_empresa=$fila ['C_EMPRESA'];
		$c_ubicacion=$fila ['C_UBICACION'];
		$c_depto=$fila ['C_DEPTO'];
		$correo=$fila ['MAIL'];
		$celular=$fila ['CELULAR'];
		
		$t_computador=$fila ['t_computador'];
		$c_marca=$fila ['c_marca'];
		$modelo=$fila ['modelo'];
		$serie=$fila ['serial'];
		$size_hdd=$fila ['size_hdd'];
		$t_hdd=$fila['t_hdd'];
		$ram=$fila ['ram'];
		$office=$fila ['office'];
		$s_o=$fila ['s_o'];
		$ver_s_o=$fila ['ver_s_o'];
		$procesador=$fila ['procesador'];
		$lic_windows=$fila ['lic_windows'];
		$lic_office=$fila ['lic_office'];		

?>
    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Computador Asignado a Usuario</h3>
            </div>
                                
            <?php  echo '  <form role="form"  name="fe" method="post">';?>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputFile">Nombre</label>
                    <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" 
							required type="tex" 
							name="nombre" 
							class="form-control" 
							value="<?php echo  $nombre ?>" 
							id="exampleInputEmail1" 
							placeholder="Introducir el Nombre">
					
                    <label for="exampleInputFile">Tipo de Usuario</label>
                    <select  class="form-control" name='st_usuario' >
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_tusuario, descripcion AS d_tusuario FROM tusuarios ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$tipo_us=$fila ['c_tusuario'];
								$nomb_us=$fila ['d_tusuario'];
								if ($c_tusuario == $tipo_us) {
						?>
									<option value="<?php echo $tipo_us ?>" selected><?php echo $nomb_us ?></option>
								<?php } else { ?>
									<option value="<?php echo $tipo_us ?>"><?php echo $nomb_us ?></option>
						<?php						
								}}
						?>
					</select>

                    <label for="exampleInputFile">Empresa</label>
                    <select  class="form-control" name='s_empresa'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_empresa, descripcion AS d_empresa FROM empresa ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_emp=$fila ['c_empresa'];
								$nomb_em=$fila ['d_empresa'];
								if ($c_empresa == $cod_emp) {
						?>
									<option value="<?php echo $cod_emp ?>" selected><?php echo $nomb_em ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_emp ?>"><?php echo $nomb_em ?></option>
						<?php						
								}}
						?>
					</select>					
					
					<label for="exampleInputFile">Ubicacion</label>
                    <select  class="form-control" name='s_ubicacion'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_oficina, descripcion AS d_oficina FROM oficinas ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_ubi=$fila ['c_oficina'];
								$nom_ubi=$fila ['d_oficina'];
								if ($c_ubicacion == $cod_ubi) {
						?>
									<option value="<?php echo $cod_ubi ?>" selected><?php echo $nom_ubi ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_ubi ?>"><?php echo $nom_ubi ?></option>
						<?php						
								}}
						?>
					</select>	
					
					
                    <label for="exampleInputFile">Departamento</label>
                    <select  class="form-control" name='s_depto'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_depto, descripcion AS d_depto FROM areas ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_dpt=$fila ['c_depto'];
								$nom_dpt=$fila ['d_depto'];
								if ($c_depto == $cod_dpt) {
						?>
									<option value="<?php echo $cod_dpt ?>" selected><?php echo $nom_dpt ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_dpt ?>"><?php echo $nom_dpt ?></option>
						<?php						
								}}
						?>
					</select>	

                    <label for="exampleInputFile">Correo</label>
                    <input required type="email" name="correo" class="form-control" value="<?php echo $correo ?>"  placeholder="Correo">
                    <label for="exampleInputFile">Celular</label>
                    <input required type="text" name="celular" class="form-control" value="<?php echo $celular ?>"  placeholder="Celular">   
					<br></br>
					<fieldset>
						<legend>Computador Asignado</legend>
						<div class="pull-left">
							<label for="exampleInputFile">Tipo Computador</label>
							<select  class="form-control" name='s_computador' >
								<option value="0">Seleccione...</option>
								<?php if ($t_computador == 'DESKTOP') {?> <option value="DESKTOP" selected>DESKTOP</option> <?php } else { ?> <option value="DESKTOP">DESKTOP</option> <?php } ?>
								<?php if ($t_computador == 'NOTEBOOK') {?> <option value="NOTEBOOK" selected>NOTEBOOK</option> <?php } else { ?> <option value="NOTEBOOK">NOTEBOOK</option> <?php } ?>							
							</select>
						</div>
						<div class="pull-left">
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
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Modelo</label>
							<input required type="text" name="modelo" class="form-control" value="<?php echo $modelo ?>"  placeholder="Modelo"> 
						</div>
					</fieldset>
					<br></br>
					<fieldset>
						<legend>Hardware</legend>
						<div class="pull-left">
							<label for="exampleInputFile">Serie</label>
							<input required type="text" name="serie" class="form-control" value="<?php echo $serie ?>"  placeholder="Serie">    
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Procesador</label>
							<input required type="text" name="procesador" class="form-control" value="<?php echo $procesador ?>"  placeholder="Procesador">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Disco Duro</label>
							<input required type="text" name="size_hdd" class="form-control" value="<?php echo $size_hdd ?>"  placeholder="HDD">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Tipo Disco</label>
							<select  class="form-control" name='s_tipodisco' >
								<option value="0">Seleccione...</option>
								<?php if ($t_hdd == 'MECANICO') {?> <option value="MECANICO" selected>MECANICO</option> <?php } else { ?> <option value="MECANICO">MECANICO</option> <?php } ?>
								<?php if ($t_hdd == 'SOLIDO') {?> <option value="SOLIDO" selected>SOLIDO</option> <?php } else { ?> <option value="SOLIDO">SOLIDO</option> <?php } ?>	
							</select>    
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">RAM</label>
							<input required type="text" name="ram" class="form-control" value="<?php echo $ram ?>"  placeholder="RAM">     
						</div>
					</fieldset>
					<br></br>
					<fieldset>
						<legend>Software</legend>
						<div class="pull-left">
							<label for="exampleInputFile">Office</label>
							<input required type="text" name="office" class="form-control" value="<?php echo $office ?>"  placeholder="Office">     
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
							<input required type="text" name="s_o" class="form-control" value="<?php echo $s_o ?>"  placeholder="windows">     
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Ver. SO</label>
							<input required type="text" name="ver_s_o" class="form-control" value="<?php echo $ver_s_o ?>"  placeholder="Version">     
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
				</div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg" name="editar" id="editar" value="Editar">Aceptar</button>
            </div>
            </form>
        </div><!-- /.box -->
<?php
}
}
?>
