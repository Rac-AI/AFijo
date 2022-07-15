 	
<?php
	require ('validarnum.php');

	$fecha2=date("d/m/Y");  	
	$nombre="";
	$correo="";
	$celular="";
	$id=0;
	$c_tusuario="";
	$c_empresa="";
	$c_ubicacion="";
	$c_depto="";
	$c_instalacion="";
	$c_cargo="";
	$c_cenco="";
?>

<?php
	if (isset($_GET['nuevo'])) { 
		if (isset($_POST['lugarguardar'])) {
			$nombre=strtoupper($_POST["nombre"]);
			$correo=$_POST["correo"];
			$celular=$_POST["celular"];
			$c_tusuario=$_POST['st_usuario'];
			$c_empresa=$_POST["s_empresa"];
			$c_ubicacion=$_POST["s_ubicacion"];
			$c_depto=$_POST["s_depto"];
			$c_instalacion=$_POST["s_instalacion"];
			$c_cargo=$_POST["s_cargo"];
			$c_cenco=$_POST["s_cenco"];
			
			$sql="select * from `usuarios` where id_usuarios='$id'";
			$cs=$bd->consulta($sql);

			if($bd->numeroFilas($cs)!=0)
			{
				//CONSULTAR SI EL CAMPO YA EXISTE
				echo '<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-check"></i>
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<b>Alerta no se registro este usuario </b> Ya Existe... ';
				echo '   </div>';
			} else 
			{
				$sql = "INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `c_tusuario`, `c_empresa`, `c_ubicacion`, `c_depto`, `mail`, `celular`, `c_instalacion`, `c_cargo`, `c_cenco`) VALUES (NULL, '$nombre', '$c_tusuario', '$c_empresa', '$c_ubicacion', '$c_depto', '$correo', '$celular', '$c_instalacion', '$c_cargo', '$c_cenco')";
				$cs=$bd->consulta($sql);  

				//echo "Datos Guardados Correctamente";
				echo '<div class="alert alert-success alert-dismissable">
											<i class="fa fa-check"></i>
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<b>Bien!</b> Datos Guardados Correctamente... ';

				echo "Nombre: $nombre";
				echo '   </div>';
			}
		}
?>
	<div class="col-md-10">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Usuarios</h3>
			</div>
								
			<!-- form start -->
			<form role="form"  name="fe" action="?mod=registro&nuevo=nuevo" method="post">
				<div class="box-body">
					<div class="form-group">
						<label for="exampleInputFile">Nombre</label>
						<input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" 
								required type="tex" 
								name="nombre" 
								class="form-control" 
								value="<?php echo $nombre ?>"
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

						<label for="exampleInputFile">Instalacion</label>
						<select  class="form-control" name='s_instalacion'>
							<option value="0">Seleccione...</option>
							<?php
								$consulta2="SELECT codigo AS c_instalacion, descripcion AS d_instalacion FROM instalaciones ORDER BY descripcion ASC;";
								$sql2 = $bd->consulta($consulta2);
								while ($fila=$bd->mostrar_registros($sql2)) {
									$cod_ins=$fila ['c_instalacion'];
									$nom_ins=$fila ['d_instalacion'];
									if ($c_instalacion == $cod_ins) {
							?>
										<option value="<?php echo $cod_ins ?>" selected><?php echo $nom_ins ?></option>
									<?php } else { ?>
										<option value="<?php echo $cod_ins ?>"><?php echo $nom_ins ?></option>
							<?php						
									}}
							?>
						</select>	

						<label for="exampleInputFile">Cargo</label>
						<select  class="form-control" name='s_cargo'>
							<option value="0">Seleccione...</option>
							<?php
								$consulta2="SELECT codigo AS c_cargo, descripcion AS d_cargo FROM cargos ORDER BY descripcion ASC;";
								$sql2 = $bd->consulta($consulta2);
								while ($fila=$bd->mostrar_registros($sql2)) {
									$cod_crg=$fila ['c_cargo'];
									$nom_crg=$fila ['d_cargo'];
									if ($c_cargo == $cod_crg) {
							?>
										<option value="<?php echo $cod_crg ?>" selected><?php echo $nom_crg ?></option>
									<?php } else { ?>
										<option value="<?php echo $cod_crg ?>"><?php echo $nom_crg ?></option>
							<?php						
									}}
							?>
						</select>

						<label for="exampleInputFile">CENCO</label>
						<select  class="form-control" name='s_cenco'>
							<option value="0">Seleccione...</option>
							<?php
								$consulta2="SELECT codigo AS c_cenco, descripcion AS d_cenco FROM cencos ORDER BY descripcion ASC;";
								$sql2 = $bd->consulta($consulta2);
								while ($fila=$bd->mostrar_registros($sql2)) {
									$cod_cec=$fila ['c_cenco'];
									$nom_cec=$fila ['d_cenco'];
									if ($c_cenco == $cod_cec) {
							?>
										<option value="<?php echo $cod_cec ?>" selected><?php echo $nom_cec ?></option>
									<?php } else { ?>
										<option value="<?php echo $cod_cec ?>"><?php echo $nom_cec ?></option>
							<?php						
									}}
							?>
						</select>

						<label for="exampleInputFile">Correo</label>
						<input required type="email" name="correo" class="form-control" value="<?php echo $correo ?>"  placeholder="Correo">
						
						<label for="exampleInputFile">Celular</label>
						<input required type="text" name="celular" class="form-control" value="<?php echo $celular ?>"  placeholder="Celular">        
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
                    <h3 class="box-title">Lista Usuarios:</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Empresa</th>
                                <th>Ubicacion</th>
                                <th>Departamento</th>
                                <th></th>
							</tr>
                        </thead>
                        <tbody>
                            <?php
								$consulta="SELECT usuarios.id_usuarios AS id_usuarios, usuarios.NOMBRE AS nombre, usuarios.C_TUSUARIO, tusuarios.descripcion AS d_tusuario, usuarios.C_EMPRESA, empresa.descripcion AS d_empresa, 
													usuarios.C_UBICACION, oficinas.descripcion AS d_ubicacion,
													usuarios.C_DEPTO, areas.descripcion AS d_depto,
													usuarios.MAIL, usuarios.CELULAR, usuarios.c_instalacion, usuarios.c_cargo, usuarios.c_cenco
											FROM usuarios, tusuarios, empresa, oficinas, areas
											WHERE usuarios.C_TUSUARIO = tusuarios.codigo AND
													usuarios.C_EMPRESA = empresa.codigo AND
													usuarios.C_UBICACION = oficinas.codigo AND
													usuarios.C_DEPTO = areas.codigo
											ORDER BY usuarios.NOMBRE ASC;";
                                $bd->consulta($consulta);
                                while ($fila=$bd->mostrar_registros())
								{

                                    echo "<tr><td>$fila[nombre]</td>
                                              <td>$fila[d_empresa]</td>
                                              <td>$fila[d_ubicacion]</td>
                                              <td>$fila[d_depto]</td>
                                              <td><center><a  href=?mod=registro&equipos&codigo=".$fila["id_usuarios"]."&asigna=0><img src='./img/consul.png' width='25' alt='Edicion' title=' CONSULTAR EQUIPOS ".$fila["nombre"]."'></a>";
									echo "
										<a  href=?mod=registro&editar&codigo=".$fila["id_usuarios"]."><img src='./img/editar.png' width='25' alt='Edicion' title='EDITAR LOS DATOS DE ".$fila["nombre"]."'></a> 
										<a   href=?mod=registro&eliminar&codigo=".$fila["id_usuarios"]."><img src='./img/elimina.png'  width='25' alt='Edicion' title='ELIMINAR A   ".$fila["nombre"]."'></a>";
									if($tipo2==1){
										echo "<a  href=?mod=registro&equipos&codigo=".$fila["id_usuarios"]."&asigna=1><img src='./img/cancel.png' width='25' alt='Cancelar' title=' CANCELAR ASIGNACION ".$fila["nombre"]."'></a>";}
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
									<h3> <center>Agregar Usuarios <a href="#" class="alert-link">Nuevos</a></center></h3>                                    
                                </div>
								<center>        
									<form  name="fe" action="?mod=registro&nuevo" method="post" id="ContactForm">
										<input title="Agregar un nuevo Usuario" name="btn1"  class="btn btn-primary"type="submit" value="Agregar Nuevo">
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
                            <h3> <center>Imprimir Lista de Usuarios</a></center></h3>                                    
                        </div>
                        <a target='_blank'  href=./pdf/listaclientes.php><img src='./img/impresora.png'  width='50' alt='Edicion' title='Imprimir lista de Usuarios'></a>
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
        else
           {
				$sql=" UPDATE usuarios SET 
						nombre='$nombre' ,
						c_tusuario='$c_tusuario' ,
						c_empresa='$c_empresa' ,
						c_ubicacion='$c_ubicacion' ,
						c_depto='$c_depto' ,
						mail='$correo' ,
						celular='$celular'  ,
						c_instalacion='$c_instalacion' ,
						c_cargo='$c_cargo' ,
						c_cenco='$c_cenco'
						where id_usuarios='$x1'";
				$bd->consulta($sql);
                //echo "Datos Guardados Correctamente";
                echo '<div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <b>Bien!</b> Datos Editados Correctamente... ';

				echo "Nombre: '$nombre', id='$x1'";
                echo '   </div>';
			}
	}
								
    $consulta="SELECT usuarios.NOMBRE AS nombre, 
						usuarios.C_TUSUARIO, tusuarios.descripcion AS d_tusuario, 
						usuarios.C_EMPRESA, empresa.descripcion AS d_empresa, 
						usuarios.C_UBICACION, oficinas.descripcion AS d_ubicacion,
						usuarios.C_DEPTO, areas.descripcion AS d_depto,
						usuarios.MAIL, usuarios.CELULAR, usuarios.c_instalacion, usuarios.c_cargo, usuarios.c_cenco
				FROM usuarios, tusuarios, empresa, oficinas, areas
				WHERE usuarios.id_usuarios='$x1' AND
						usuarios.C_TUSUARIO = tusuarios.codigo AND
						usuarios.C_EMPRESA = empresa.codigo AND
						usuarios.C_UBICACION = oficinas.codigo AND
						usuarios.C_DEPTO = areas.codigo
				ORDER BY usuarios.NOMBRE ASC;";
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
	
		$nombre=$fila ['nombre'];
		$c_tusuario=$fila ['C_TUSUARIO'];
		$c_empresa=$fila ['C_EMPRESA'];
		$c_ubicacion=$fila ['C_UBICACION'];
		$c_depto=$fila ['C_DEPTO'];
		$correo=$fila ['MAIL'];
		$celular=$fila ['CELULAR'];
		$c_instalacion=$fila ['c_instalacion'];
		$c_cargo=$fila ['c_cargo'];
		$c_cenco=$fila ['c_cenco'];		
		
?>
    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Editar Usuarios</h3>
            </div>
                                
            <?php  echo '  <form role="form"  name="fe" action="?mod=registro&editar=editar&codigo='.$x1.'" method="post">';?>
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

					<label for="exampleInputFile">Instalacion</label>
					<select  class="form-control" name='s_instalacion'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_instalacion, descripcion AS d_instalacion FROM instalaciones ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_ins=$fila ['c_instalacion'];
								$nom_ins=$fila ['d_instalacion'];
								if ($c_instalacion == $cod_ins) {
						?>
									<option value="<?php echo $cod_ins ?>" selected><?php echo $nom_ins ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_ins ?>"><?php echo $nom_ins ?></option>
						<?php						
								}}
						?>
					</select>	

					<label for="exampleInputFile">Cargo</label>
					<select  class="form-control" name='s_cargo'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_cargo, descripcion AS d_cargo FROM cargos ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_crg=$fila ['c_cargo'];
								$nom_crg=$fila ['d_cargo'];
								if ($c_cargo == $cod_crg) {
						?>
									<option value="<?php echo $cod_crg ?>" selected><?php echo $nom_crg ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_crg ?>"><?php echo $nom_crg ?></option>
						<?php						
								}}
						?>
					</select>

					<label for="exampleInputFile">CENCO</label>
					<select  class="form-control" name='s_cenco'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_cenco, descripcion AS d_cenco FROM cencos ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_cec=$fila ['c_cenco'];
								$nom_cec=$fila ['d_cenco'];
								if ($c_cenco == $cod_cec) {
						?>
									<option value="<?php echo $cod_cec ?>" selected><?php echo $nom_cec ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_cec ?>"><?php echo $nom_cec ?></option>
						<?php						
								}}
						?>
					</select>

                    <label for="exampleInputFile">Correo</label>
                    <input required type="email" name="correo" class="form-control" value="<?php echo $correo ?>"  placeholder="Correo">
                    <label for="exampleInputFile">Celular</label>
                    <input required type="text" name="celular" class="form-control" value="<?php echo $celular ?>"  placeholder="Celular">                
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
		$nombre=strtoupper($_POST["nombre"]);
		$correo=$_POST["correo"];
		$celular=$_POST["celular"];
		$c_tusuario=$_POST['st_usuario'];
		$c_empresa=$_POST["s_empresa"];
		$c_ubicacion=$_POST["s_ubicacion"];
		$c_depto=$_POST["s_depto"];	
		$c_instalacion=$_POST["s_instalacion"];	
		$c_cargo=$_POST["s_cargo"];	
		$c_cenco=$_POST["s_cenco"];	
		
		if( $nombre=="" )
        {
			echo "<script> alert('campos vacios')</script>";
            echo "<br>";
        }
        else
        {
			// Validar que tenga NO TENGA asignado equipo 
			// para poder eliminar
			$sql2="SELECT * FROM `asignaciones` WHERE id_usuario = '$x1' AND situacion = 'A'";
			$cs=$bd->consulta($sql2);
			if($bd->numeroFilas($cs)==0){
				$sql="DELETE FROM usuarios WHERE id_usuarios='$x1' ";
				$bd->consulta($sql);

				//echo "Datos Guardados Correctamente";
				echo '<div class="alert alert-success alert-dismissable">
						<i class="fa fa-check"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Bien!</b> Se Elimino Correctamente... ';
				echo "Nombre: '$nombre', correo='$correo', id_usuarios='$x1'";
				echo '   </div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-check"></i>
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<b>Alerta este usuario tiene computador asignado </b> Debe dar de baja asignación para proceder a eliminar a usuario... ';
				echo '   </div>';					
			}
        }
	}

    $consulta="SELECT usuarios.NOMBRE AS nombre, 
						usuarios.C_TUSUARIO, tusuarios.descripcion AS d_tusuario, 
						usuarios.C_EMPRESA, empresa.descripcion AS d_empresa, 
						usuarios.C_UBICACION, oficinas.descripcion AS d_ubicacion,
						usuarios.C_DEPTO, areas.descripcion AS d_depto,
						usuarios.MAIL, usuarios.CELULAR, usuarios.c_instalacion, usuarios.c_cargo, usuarios.c_cenco
				FROM usuarios, tusuarios, empresa, oficinas, areas
				WHERE usuarios.id_usuarios='$x1' AND
						usuarios.C_TUSUARIO = tusuarios.codigo AND
						usuarios.C_EMPRESA = empresa.codigo AND
						usuarios.C_UBICACION = oficinas.codigo AND
						usuarios.C_DEPTO = areas.codigo
				ORDER BY usuarios.NOMBRE ASC;";
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
	
		$nombre=$fila ['nombre'];
		$c_tusuario=$fila ['C_TUSUARIO'];
		$c_empresa=$fila ['C_EMPRESA'];
		$c_ubicacion=$fila ['C_UBICACION'];
		$c_depto=$fila ['C_DEPTO'];
		$correo=$fila ['MAIL'];
		$celular=$fila ['CELULAR'];
		$c_instalacion=$fila ['c_instalacion'];
		$c_cargo=$fila ['c_cargo'];
		$c_cenco=$fila ['c_cenco'];
?>

		<div class="col-md-10">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Eliminar Usuarios</h3>
                </div>
                <?php  echo '  <form role="form"  name="fe" action="?mod=registro&eliminar=eliminar&codigo='.$x1.'" method="post">';?>
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

					<label for="exampleInputFile">Instalacion</label>
					<select  class="form-control" name='s_instalacion'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_instalacion, descripcion AS d_instalacion FROM instalaciones ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_ins=$fila ['c_instalacion'];
								$nom_ins=$fila ['d_instalacion'];
								if ($c_instalacion == $cod_ins) {
						?>
									<option value="<?php echo $cod_ins ?>" selected><?php echo $nom_ins ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_ins ?>"><?php echo $nom_ins ?></option>
						<?php						
								}}
						?>
					</select>	

					<label for="exampleInputFile">Cargo</label>
					<select  class="form-control" name='s_cargo'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_cargo, descripcion AS d_cargo FROM cargos ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_crg=$fila ['c_cargo'];
								$nom_crg=$fila ['d_cargo'];
								if ($c_cargo == $cod_crg) {
						?>
									<option value="<?php echo $cod_crg ?>" selected><?php echo $nom_crg ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_crg ?>"><?php echo $nom_crg ?></option>
						<?php						
								}}
						?>
					</select>

					<label for="exampleInputFile">CENCO</label>
					<select  class="form-control" name='s_cenco'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_cenco, descripcion AS d_cenco FROM cencos ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_cec=$fila ['c_cenco'];
								$nom_cec=$fila ['d_cenco'];
								if ($c_cenco == $cod_cec) {
						?>
									<option value="<?php echo $cod_cec ?>" selected><?php echo $nom_cec ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_cec ?>"><?php echo $nom_cec ?></option>
						<?php						
								}}
						?>
					</select>

                    <label for="exampleInputFile">Correo</label>
                    <input required type="email" name="correo" class="form-control" value="<?php echo $correo ?>"  placeholder="Correo">
                    <label for="exampleInputFile">Celular</label>
                    <input required type="text" name="celular" class="form-control" value="<?php echo $celular ?>"  placeholder="Celular">                
				
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
	if (isset($_GET['equipos'])) 
	{ 
		//codigo que viene de la lista
		$x1=$_GET['codigo'];
		$x2=$_GET['asigna'];
        if (isset($_POST['equipos'])) {

			$nombre=strtoupper($_POST["nombre"]);
			$correo=$_POST["correo"];
			$celular=$_POST["celular"];
			$c_tusuario=$_POST['st_usuario'];
			$c_empresa=$_POST["s_empresa"];
			$c_ubicacion=$_POST["s_ubicacion"];
			$c_depto=$_POST["s_depto"];
			$c_instalacion=$_POST["s_instalacion"];
			$c_cargo=$_POST["s_cargo"];
			$c_cenco=$_POST["s_cenco"];
						
			if( $nombre=="" )
            {
				echo "<script> alert('campos vacios')</script>";
                echo "<br>";
            }
	}
								
    $consulta="SELECT usuarios.* ,tusuarios.descripcion AS d_tusuario, 
						empresa.descripcion AS d_empresa, oficinas.descripcion AS d_ubicacion,
						areas.descripcion AS d_depto, asignaciones.id_equipo,
						computadores.*, usuarios.c_cenco, usuarios.c_cargo, usuarios.c_instalacion
				FROM usuarios, tusuarios, empresa, oficinas, areas, asignaciones, computadores
				WHERE usuarios.id_usuarios= '$x1' AND
						usuarios.C_TUSUARIO = tusuarios.codigo AND
						usuarios.C_EMPRESA = empresa.codigo AND
						usuarios.C_UBICACION = oficinas.codigo AND
						usuarios.C_DEPTO = areas.codigo AND
						usuarios.id_usuarios = asignaciones.id_usuario AND
						asignaciones.SITUACION = 'A' AND
						asignaciones.id_equipo = computadores.id_equipo
				ORDER BY usuarios.NOMBRE ASC;";
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
	
		$nombre=$fila ['NOMBRE'];
		$c_tusuario=$fila ['C_TUSUARIO'];
		$c_empresa=$fila ['C_EMPRESA'];
		$c_ubicacion=$fila ['C_UBICACION'];
		$c_depto=$fila ['C_DEPTO'];
		$correo=$fila ['MAIL'];
		$celular=$fila ['CELULAR'];
		$c_instalacion=$fila ['c_instalacion'];
		$c_cargo=$fila ['c_cargo'];
		$c_cenco=$fila ['c_cenco'];		

?>
    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Usuario y sus Equipos</h3>
            </div>
                                
            <?php  echo '<form role="form"  name="fe" action="?mod=registro&asignacion=elimina&codigo='.$x1.'" method="post">';?>
			
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

					<label for="exampleInputFile">Instalacion</label>
					<select  class="form-control" name='s_instalacion'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_instalacion, descripcion AS d_instalacion FROM instalaciones ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_ins=$fila ['c_instalacion'];
								$nom_ins=$fila ['d_instalacion'];
								if ($c_instalacion == $cod_ins) {
						?>
									<option value="<?php echo $cod_ins ?>" selected><?php echo $nom_ins ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_ins ?>"><?php echo $nom_ins ?></option>
						<?php						
								}}
						?>
					</select>	

					<label for="exampleInputFile">Cargo</label>
					<select  class="form-control" name='s_cargo'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_cargo, descripcion AS d_cargo FROM cargos ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_crg=$fila ['c_cargo'];
								$nom_crg=$fila ['d_cargo'];
								if ($c_cargo == $cod_crg) {
						?>
									<option value="<?php echo $cod_crg ?>" selected><?php echo $nom_crg ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_crg ?>"><?php echo $nom_crg ?></option>
						<?php						
								}}
						?>
					</select>

					<label for="exampleInputFile">CENCO</label>
					<select  class="form-control" name='s_cenco'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_cenco, descripcion AS d_cenco FROM cencos ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_cec=$fila ['c_cenco'];
								$nom_cec=$fila ['d_cenco'];
								if ($c_cenco == $cod_cec) {
						?>
									<option value="<?php echo $cod_cec ?>" selected><?php echo $nom_cec ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_cec ?>"><?php echo $nom_cec ?></option>
						<?php						
								}}
						?>
					</select>

                    <label for="exampleInputFile">Correo</label>
                    <input required type="email" name="correo" class="form-control" value="<?php echo $correo ?>"  placeholder="Correo">
                    <label for="exampleInputFile">Celular</label>
                    <input required type="text" name="celular" class="form-control" value="<?php echo $celular ?>"  placeholder="Celular">   
					<br></br>

					<!-- Muestra una lista de equipos asignados --> 

						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Lista Equipos Asignados:</h3>                                    
							</div><!-- /.box-header -->
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Tipo</th>
											<th>Marca</th>
											<th>Modelo</th>
											<th>Serie/Numero</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$consulta="SELECT asignaciones.id_equipo, asignaciones.t_equipo, marcas.descripcion, computadores.modelo, computadores.serial, asignaciones.T_EQUIPO
															FROM asignaciones, computadores, marcas
															WHERE asignaciones.id_usuario = '$x1' AND 
																	asignaciones.T_EQUIPO = 'PC' AND
																	computadores.id_equipo = asignaciones.id_equipo AND
																	computadores.c_marca = marcas.codigo AND
																	asignaciones.SITUACION = 'A'
															UNION
															SELECT asignaciones.id_equipo, asignaciones.t_equipo, marcas.descripcion, celulares.modelo, celulares.NUMERO, asignaciones.T_EQUIPO
															FROM asignaciones, celulares, marcas
															WHERE asignaciones.id_usuario = '$x1' AND 
																	asignaciones.T_EQUIPO = 'CL' AND
																	celulares.id_equipo = asignaciones.id_equipo AND
																	celulares.c_marca = marcas.codigo AND
																	asignaciones.SITUACION = 'A'";
											$bd->consulta($consulta);
											while ($fila=$bd->mostrar_registros())
											{

												echo "<tr><td>$fila[t_equipo]</td>
														  <td>$fila[descripcion]</td>
														  <td>$fila[modelo]</td>
														  <td>$fila[serial]</td>
														  <td><center><a  href=?mod=registro&detalle&codigo=".$fila["id_equipo"]."&tipo=".$fila["T_EQUIPO"]."><img src='./img/consul.png' width='25' alt='Edicion' title=' CONSULTAR EQUIPO ".$fila["descripcion"]."'></a>";
												if ($x2 == '1') {
														echo "<input type='checkbox' name='cb_asigna[]' value=".$fila["id_equipo"].$fila["t_equipo"].">";
												}
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
					
						<?php if ($x2 == '1') { ?>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary btn-lg" name="eliminar" id="eliminar" value="Eliminar">Eliminar Asignacion</button>
							</div>
						<?php } ?>
					</div>
				</div>
			</form>
		</div>			
	</div>		
<?php
}
}

	if (isset($_GET['detalle'])) 
	{ 
		//codigo que viene de la lista
		$x1=$_GET['codigo'];
		$x2=$_GET['tipo'];
        if (isset($_POST['detalle'])) {
			$nombre=strtoupper($_POST["nombre"]);

		}

	if ($x2 == 'PC') {
		$consulta="SELECT computadores.*, marcas.descripcion AS d_marca, usuarios.NOMBRE
					FROM computadores, marcas, asignaciones, usuarios
					WHERE computadores.id_equipo = '$x1' AND 
							computadores.c_marca = marcas.codigo AND
							asignaciones.id_equipo = computadores.id_equipo AND
							asignaciones.T_EQUIPO = '$x2' AND
							asignaciones.id_usuario = usuarios.id_usuarios AND
							asignaciones.SITUACION = 'A'
					ORDER BY computadores.t_computador, computadores.c_marca, computadores.modelo;";
	} else {
		$consulta="SELECT celulares.*, marcas.descripcion AS d_marca, compania.descripcion AS d_compania, usuarios.NOMBRE
					FROM celulares, marcas, compania, asignaciones, usuarios
					WHERE celulares.ID_EQUIPO = '$x1' AND	
							celulares.C_MARCA = marcas.codigo AND
							celulares.C_COMPANIA = compania.codigo AND
							asignaciones.id_equipo = celulares.ID_EQUIPO AND
							asignaciones.T_EQUIPO = '$x2' AND
							asignaciones.SITUACION = 'A' AND
							usuarios.id_usuarios = asignaciones.id_usuario;";
	}
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
		
		$nombre=$fila ['NOMBRE'];
		if ($x2 == 'PC') {
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
		} else {
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
		}
		
?>				
        <!-- general form elements -->
        <div class="box box-primary">
                                
            <?php  echo '  <form role="form"  name="fe" action="?mod=registrocomputadores&editar=editar&codigo='.$x1.'" method="post">';
			if ($x2 == 'PC') {
			?>
				<div class="box-body">	
					<fieldset>
						<legend>Computador Asignado a <?php echo $nombre ?></legend>
						
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
			<?php } else { ?>
				<div class="box-body">	
					<fieldset>
						<legend>Celular Asignado a <?php echo $nombre ?></legend>		
						<div class="pull-left">
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
						</div>

						<div class="pull-left">
							<label for="exampleInputFile">Numero</label>
							<input required type="text" name="numero" class="form-control" value="<?php echo $numero ?>"  placeholder="Numero"> 
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

					</fieldset>
					<br></br>
					<label for="exampleInputFile">Modelo</label>
					<input required type="text" name="modelo" class="form-control" value="<?php echo $modelo ?>"  placeholder="Modelo"> 
					<br></br>
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
					<br></br>
					<label >Plan</label>
					<input required type="text" name="plan" class="form-control" value="<?php echo $plan ?>"  placeholder="Plan"> 
					<br></br>
					<fieldset>
						<div class="pull-left">
							<label for="exampleInputFile">Tipo Plan</label>
							<input required type="text" name="t_plan" class="form-control" value="<?php echo $t_plan ?>"  placeholder="Tipo Plan"> 
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Telefonia Ip</label>
							<input required type="text" name="ip" class="form-control" value="<?php echo $telefonia_ip ?>"  placeholder="Ip"> 
						</div>
						<div class="pull-left">
							<label for="exampleInputFile">Estado Linea</label>
							<input required type="text" name="e_linea" class="form-control" value="<?php echo $estado_linea ?>"  placeholder="Estado Linea"> 
						</div>	
						<div class="pull-left">
							<label for="exampleInputFile">Estado Equipo</label>
							<input required type="text" name="e_equipo" class="form-control" value="<?php echo $estado_equipo ?>"  placeholder="Estado Equipo"> 
						</div>						
					</fieldset>	
					<br></br>
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
				</div>			
			<?php } ?>			
        </div><!-- /.box-body -->

        </form>

<?php
	}}
?>

<?php
	if (isset($_GET['asignacion'])) 
	{ 
		//codigo que viene de la lista
		$x1=$_GET['codigo'];
		$x2='0';
		$cb_asigna=$_POST["cb_asigna"];
	
		// Cambia la situacion en la tabla Asignaciones
		$sql="UPDATE asignaciones 
				SET SITUACION = 'I'
				WHERE id_usuario = '$x1' AND (";
		
		foreach($_POST['cb_asigna'] AS $selected){
			$sql.="(id_equipo = SUBSTRING('$selected', 1,char_length('$selected')-2) AND T_EQUIPO = SUBSTRING('$selected', -2)) OR ";
		}
		if (substr(rtrim($sql),-2) == "OR") {$sql=substr(rtrim($sql), 0, -2);}
		$sql.=")";
		$cs=$bd->consulta($sql);
//echo $sql;

		// Actualiza la tabla de computadores
		$sql="UPDATE computadores
				SET id_usuarios = NULL
				WHERE id_usuarios = '$x1' AND (";
		foreach($_POST['cb_asigna'] AS $selected){
			if (substr($selected,-2) == "PC") {
				$sql.="(id_equipo = SUBSTRING('$selected', 1,char_length('$selected')-2)) OR ";}
		}
		if (substr(rtrim($sql),-2) == "OR") {$sql=substr(rtrim($sql), 0, -2);}
		$sql.=")";
		$cs=$bd->consulta($sql);
//echo $sql;	
	
		//echo "Datos Actualizados Correctamente";
		echo '<div class="alert alert-success alert-dismissable">
							<i class="fa fa-check"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<b>Bien!</b> Datos actualizados Correctamente... ';				
		echo '   </div>';			
			
    $consulta="SELECT usuarios.* ,tusuarios.descripcion AS d_tusuario, 
						empresa.descripcion AS d_empresa, oficinas.descripcion AS d_ubicacion,
						areas.descripcion AS d_depto, asignaciones.id_equipo,
						computadores.*, usuarios.c_cenco, usuarios.c_cargo, usuarios.c_instalacion
				FROM usuarios, tusuarios, empresa, oficinas, areas, asignaciones, computadores
				WHERE usuarios.id_usuarios= '$x1' AND
						usuarios.C_TUSUARIO = tusuarios.codigo AND
						usuarios.C_EMPRESA = empresa.codigo AND
						usuarios.C_UBICACION = oficinas.codigo AND
						usuarios.C_DEPTO = areas.codigo AND
						usuarios.id_usuarios = asignaciones.id_usuario AND
						asignaciones.SITUACION = 'A' AND
						asignaciones.id_equipo = computadores.id_equipo
				ORDER BY usuarios.NOMBRE ASC;";
	
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
	
		$nombre=$fila ['NOMBRE'];
		$c_tusuario=$fila ['C_TUSUARIO'];
		$c_empresa=$fila ['C_EMPRESA'];
		$c_ubicacion=$fila ['C_UBICACION'];
		$c_depto=$fila ['C_DEPTO'];
		$correo=$fila ['MAIL'];
		$celular=$fila ['CELULAR'];
		$c_instalacion=$fila ['c_instalacion'];
		$c_cargo=$fila ['c_cargo'];
		$c_cenco=$fila ['c_cenco'];		

?>
    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Usuario y sus Equipos</h3>
            </div>
                                
            <form role="form"  name="fe" action="?mod=registro&asignacion=elimina" method="post">
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

					<label for="exampleInputFile">Instalacion</label>
					<select  class="form-control" name='s_instalacion'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_instalacion, descripcion AS d_instalacion FROM instalaciones ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_ins=$fila ['c_instalacion'];
								$nom_ins=$fila ['d_instalacion'];
								if ($c_instalacion == $cod_ins) {
						?>
									<option value="<?php echo $cod_ins ?>" selected><?php echo $nom_ins ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_ins ?>"><?php echo $nom_ins ?></option>
						<?php						
								}}
						?>
					</select>	

					<label for="exampleInputFile">Cargo</label>
					<select  class="form-control" name='s_cargo'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_cargo, descripcion AS d_cargo FROM cargos ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_crg=$fila ['c_cargo'];
								$nom_crg=$fila ['d_cargo'];
								if ($c_cargo == $cod_crg) {
						?>
									<option value="<?php echo $cod_crg ?>" selected><?php echo $nom_crg ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_crg ?>"><?php echo $nom_crg ?></option>
						<?php						
								}}
						?>
					</select>

					<label for="exampleInputFile">CENCO</label>
					<select  class="form-control" name='s_cenco'>
						<option value="0">Seleccione...</option>
						<?php
							$consulta2="SELECT codigo AS c_cenco, descripcion AS d_cenco FROM cencos ORDER BY descripcion ASC;";
							$sql2 = $bd->consulta($consulta2);
							while ($fila=$bd->mostrar_registros($sql2)) {
								$cod_cec=$fila ['c_cenco'];
								$nom_cec=$fila ['d_cenco'];
								if ($c_cenco == $cod_cec) {
						?>
									<option value="<?php echo $cod_cec ?>" selected><?php echo $nom_cec ?></option>
								<?php } else { ?>
									<option value="<?php echo $cod_cec ?>"><?php echo $nom_cec ?></option>
						<?php						
								}}
						?>
					</select>

                    <label for="exampleInputFile">Correo</label>
                    <input required type="email" name="correo" class="form-control" value="<?php echo $correo ?>"  placeholder="Correo">
                    <label for="exampleInputFile">Celular</label>
                    <input required type="text" name="celular" class="form-control" value="<?php echo $celular ?>"  placeholder="Celular">   
					<br></br>

					<!-- Muestra una lista de equipos asignados --> 

						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Lista Equipos Asignados:</h3>                                    
							</div><!-- /.box-header -->
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Tipo</th>
											<th>Marca</th>
											<th>Modelo</th>
											<th>Serie/Numero</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$consulta="SELECT asignaciones.id_equipo, asignaciones.t_equipo, marcas.descripcion, computadores.modelo, computadores.serial, asignaciones.T_EQUIPO
															FROM asignaciones, computadores, marcas
															WHERE asignaciones.id_usuario = '$x1' AND 
																	asignaciones.T_EQUIPO = 'PC' AND
																	computadores.id_equipo = asignaciones.id_equipo AND
																	computadores.c_marca = marcas.codigo AND 
																	asignaciones.SITUACION = 'A'
															UNION
															SELECT asignaciones.id_equipo, asignaciones.t_equipo, marcas.descripcion, celulares.modelo, celulares.NUMERO, asignaciones.T_EQUIPO
															FROM asignaciones, celulares, marcas
															WHERE asignaciones.id_usuario = '$x1' AND 
																	asignaciones.T_EQUIPO = 'CL' AND
																	celulares.id_equipo = asignaciones.id_equipo AND
																	celulares.c_marca = marcas.codigo AND
																	asignaciones.SITUACION = 'A'";
											$bd->consulta($consulta);
											while ($fila=$bd->mostrar_registros())
											{

												echo "<tr><td>$fila[t_equipo]</td>
														  <td>$fila[descripcion]</td>
														  <td>$fila[modelo]</td>
														  <td>$fila[serial]</td>
														  <td><center><a  href=?mod=registro&detalle&codigo=".$fila["id_equipo"]."&tipo=".$fila["T_EQUIPO"]."><img src='./img/consul.png' width='25' alt='Edicion' title=' CONSULTAR EQUIPO ".$fila["descripcion"]."'></a>";
												if ($x2 == '1') {
														echo "<input type='checkbox' name='cb-asigna' value='asigna'>";
												}
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
					
						<?php if ($x2 == '1') { ?>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary btn-lg" name="eliminar" id="eliminar" value="Eliminar">Eliminar Asignacion</button>
							</div>
						<?php } ?>
					</div>
				</div>
			</form>
		</div>			
	</div>		
<?php
	}} ?>
