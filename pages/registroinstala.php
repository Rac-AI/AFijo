 	
<?php

require ('validarnum.php');

$codigo="";
$descripcion="";

if (isset($_GET['nuevo'])) { 
	if (isset($_POST['lugarguardar'])) {
		$codigo=strtoupper($_POST["codigo"]);
		$descripcion=strtoupper($_POST["descripcion"]);

		$sql="select * from `instalaciones` WHERE codigo = '$codigo'";
		$cs=$bd->consulta($sql);

		if($bd->numeroFilas($cs)!=0){

			//CONSULTAR SI EL CAMPO YA EXISTE
			echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Alerta no se registro esta Instalacion </b> Ya Existe... ';
            echo '   </div>';
		}else{
			$sql = "INSERT INTO `instalaciones` (`codigo`, `descripcion`) VALUES ('$codigo', '$descripcion')";
            $cs=$bd->consulta($sql);  

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Bien!</b> Datos Guardados Correctamente... ';



			echo "Instalacion: $descripcion";
            echo '   </div>';
        }
	}
?>

 <div class="col-md-10">
	<!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header">
			<h3 class="box-title">Instalaciones</h3>
        </div>
                            
        <!-- form start -->
        <form role="form"  name="fe" action="?mod=registroinstala&nuevo=nuevo" method="post">
            <div class="box-body">
                <div class="form-group">
					<label for="exampleInputFile">Código</label>
                    <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" 
							required type="tex" 
							name="codigo" 
							class="form-control" 
							value="<?php echo $codigo ?>"
							id="exampleInputEmail1" 
							placeholder="Introducir el Código">
																								
                    <label for="exampleInputFile">Descripción</label>
                    <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" 
							required type="tex" 
							name="descripcion" 
							class="form-control" 
							value="<?php echo $descripcion ?>" id="exampleInputEmail1" placeholder="Descripcion">
                                            
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
        <div class="col-xs-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Instalaciones:</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $consulta="SELECT codigo, descripcion FROM instalaciones ORDER BY descripcion ";
                                $bd->consulta($consulta);
                                while ($fila=$bd->mostrar_registros()) {
                                    //echo '<li data-icon="delete"><a href="?mod=lugares?edit='.$fila['id_tipo'].'"><img src="images/lugares/'.$fila['imagen'].'" height="350" >'.$fila['nombre'].'</a><a href="?mod=lugares?borrar='.$fila['id_tipo'].'" data-position-to="window" >Borrar</a></li>';
                                    echo "<tr>
                                          <td>$fila[codigo]</td>
                                          <td>$fila[descripcion]</td>
                                          <td><center>";
      
									echo "
										<a  href=?mod=registroinstala&editar&codigo=".$fila["codigo"]."><img src='./img/editar.png' width='25' alt='Edicion' title='EDITAR LOS DATOS DE ".$fila["descripcion"]."'></a> 
										<a   href=?mod=registroinstala&eliminar&codigo=".$fila["codigo"]."><img src='./img/elimina.png'  width='25' alt='Edicion' title='ELIMINAR A   ".$fila["descripcion"]."'></a>";}
									echo "</center></td></tr>";
                            ?>                                            
                        </tbody>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        </br>       
		<div class="col-md-3">
			<div class="box">
                <div class="box-header">
					<center>
						<div class="box-header">
                            <h3> <center>Imprimir Lista de Instalaciones</a></center></h3>                                    
                        </div>
                        <a target='_blank'  href=./pdf/listainstala.php><img src='./img/impresora.png'  width='50' alt='Edicion' title='Imprimir lista de Instalaciones'></a>
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
			$descripcion=strtoupper($_POST["descripcion"]);
                       
			if( $descripcion=="" )
            {
				echo "<script> alert('campos vacios')</script>";
                echo "<br>";
            }
        else
           {
				$sql=" UPDATE instalaciones SET 
						descripcion='$descripcion' 
						where codigo='$x1'";
				$bd->consulta($sql);
                //echo "Datos Guardados Correctamente";
                echo '<div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <b>Bien!</b> Datos Editados Correctamente... ';

				echo "Instalacion: '$descripcion', codigo='$x1'";
                echo '   </div>';
			}
   
	}
                                
    $consulta="SELECT codigo, descripcion FROM instalaciones where codigo='$x1'";
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
	
		$codigo = $fila ['codigo'];
		$descripcion = $fila ['descripcion'];
	
?>
    <div class="col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Editar Instalacion</h3>
            </div>
                                
            <?php  echo '  <form role="form"  name="fe" action="?mod=registroinstala&editar=editar&codigo='.$x1.'" method="post">';?>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputFile">Descripcion</label>
                    <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="tex" name="descripcion" class="form-control" value="<?php echo  $descripcion ?>" id="exampleInputEmail1" placeholder="Descripcion">
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
        $descripcion=strtoupper($_POST["descripcion"]);
		if( $descripcion=="" )
        {
			echo "<script> alert('campos vacios')</script>";
            echo "<br>";
        }
        else
        {
			
			// Validar que tenga NO TENGA asignado un usuario
			// para poder eliminar
			$sql2="SELECT * FROM `usuarios` WHERE c_instalacion = '$x1'";
			$cs=$bd->consulta($sql2);
			if($bd->numeroFilas($cs)==0){

				$sql="delete from instalaciones where codigo='$x1' ";
				$bd->consulta($sql);

				//echo "Datos Guardados Correctamente";
				echo '<div class="alert alert-success alert-dismissable">
						<i class="fa fa-check"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Bien!</b> Se Elimino Correctamente... ';
				echo "Instalacion: '$descripcion', codigo='$x1'";
				echo '   </div>';

			} else {
				echo '<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-check"></i>
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<b>Alerta esta instalacion no se puede eliminar </b> hay un usuario asignado a esta instalacion... ';
				echo '   </div>';					
			}				
        }
	}
                                      
	$consulta="SELECT codigo, descripcion FROM instalaciones where codigo='$x1'";
    $sql2 = $bd->consulta($consulta);
    while ($fila=$bd->mostrar_registros($sql2)) {
	
		$codigo = $fila ['codigo'];
		$descripcion= $fila ['descripcion'];
		
?>
		<div class="col-md-10">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Eliminar Instalacion</h3>
                </div>
                <?php  echo '  <form role="form"  name="fe" action="?mod=registroinstala&eliminar=eliminar&codigo='.$x1.'" method="post">';?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputFile">Descripcion</label>
                        <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="descripcion" class="form-control" value="<?php echo  $descripcion ?>" id="exampleInputEmail1" placeholder="Introducir la descripcion">
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

