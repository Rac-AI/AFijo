<?php 
	
    //$nena = $fila[1]; // */
		
?>
  <h4 class="page-header">
                        OPCIONES PRINCIPALES PARA REGISTRO Y MANTENIMIENTO"<small>seleccione la opción que desea editar o agregar dependiendo de la categoría <code>!seleccione correctamente¡</code><code></code></small>
                   </h4>
                    
					
                    <!-- Small boxes (Stat box) -->
                    <!-- Small boxes (Stat box) -->
                  
					<div class="row">
					
					  
					<?php 
					if($tipo2==1){
					echo '
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                         Usuarios
                                    </h3>
                                    <p>
                                        Agregar o editar Usuarios
                                    </p>
                                </div>
                                
                                <div class="icon"><a href="?mod=registro&nuevo"  id="alimen" data-icon="custom" data-transition="slide" data-prefetch="true" data-id="alimen" class="small-box-footer"> 
                                    
                                </div>
                                
                                    MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                      Computadores<sup style="font-size: 20px"></sup>
                                    </h3>
                                    <p>
                                       Equipos
                                    </p>
                                </div>
                                <div class="icon">
                                	<a href="?mod=registrocomputadores&nuevo" class="small-box-footer"></a>
                                </div>
                                <a href="?mod=registrocomputadores&nuevo" class="small-box-footer">
                                    MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>Reportes</h3>
                                    <p>
                                       Reportes computadores y celulares
                                    </p>
                                </div>
                                <div class="icon">
                                	<a href="?mod=reportecomputadores&reporte" class="small-box-footer"></a>
                                </div>
                                <a href="?mod=reportecomputadores&reporte" class="small-box-footer">
                                    MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                   

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>Administracion</h3>
                                    <p>
                                        Administradores.                                   </p>
                                </div>
                                <div class="icon">
                                    <i class="ion "></i>
                                </div>
                                <a href="?mod=registroadmin&lista=lista" class="small-box-footer">
                                    MAS INFORMACION <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                    
                    </div><!-- /.row -->
					
					';
					}
					
					?>

                    <!-- top row -->
                  
                    <!-- /.row -->

                    <!-- START ACCORDION & CAROUSEL-->
                   
                  
                      <div class="col-md-7">
                       
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista de Usuarios:</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Empresa</th>
                                                <th>Ubicacion</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if($tipo2==1){
                                        
                                        $consulta="SELECT usuarios.id_usuarios, usuarios.NOMBRE, empresa.descripcion AS d_empresa, oficinas.descripcion AS d_ubicacion
														FROM usuarios, empresa, oficinas
														WHERE usuarios.C_EMPRESA = empresa.codigo AND
																usuarios.C_UBICACION = oficinas.codigo
														ORDER BY usuarios.NOMBRE ASC ";
                                        $bd->consulta($consulta);
                                        while ($fila=$bd->mostrar_registros()) 
										{
											echo "<tr><td>$fila[NOMBRE]</td>
													  <td>$fila[d_empresa]</td>
													  <td>$fila[d_ubicacion]</td>
													  <td><center><a href=?mod=registro&equipos&codigo=".$fila["id_usuarios"]."><img src='./img/consul.png' width='25' alt='Edicion' title=' CONSULTAR EQUIPOS ".$fila["NOMBRE"]."'></a>";
											echo "
												<a  href=?mod=registro&editar&codigo=".$fila["id_usuarios"]."><img src='./img/editar.png' width='25' alt='Edicion' title='EDITAR LOS DATOS DE ".$fila["NOMBRE"]."'></a> 
												<a   href=?mod=registro&eliminar&codigo=".$fila["id_usuarios"]."><img src='./img/elimina.png'  width='25' alt='Edicion' title='ELIMINAR A   ".$fila["NOMBRE"]."'></a>";
											echo "</center></td></tr>";
										}
                                        } ?>                                            
                                        </tbody>

                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                    
                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <div class="box box-solid">
                                <div class="box-header">
                                   
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="item">
                                                <img src="img/slider2.jpg" alt="First slide">
                                                <div class="carousel-caption">
                                                    
                                                </div>
                                            </div>
                                            <div class="item active">
                                                <img src="img/slider2.jpg" alt="Second slide">
                                                <div class="carousel-caption">
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    
                    </div><!-- /.row -->
                    <!-- END ACCORDION & CAROUSEL-->

