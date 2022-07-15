<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hola, <?php echo $_SESSION['dondequeda_nombre']; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
                        </div>
                    </div>
                    <!-- search form 
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="?mod=index" data-ajax="false">
                                <i class="fa fa-home"></i> <span>Principal</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-group"></i>
                                <span>Tablas </span>
                                <i class="  fa fa-unsorted"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="?mod=registroempresa&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar Empresa</a> </li>
                                <li><a href="?mod=registroempresa&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de Empresas </a> </li>
								<li> -- </li>
								<li><a href="?mod=registroubicacion&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar Ubicaciones</a> </li>
                                <li><a href="?mod=registroubicacion&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de Ubicaciones </a> </li>
								<li> -- </li>
								<li><a href="?mod=registroareas&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar Departamentos</a> </li>
                                <li><a href="?mod=registroareas&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de Departamentos </a> </li>
								<li> -- </li>
								<li><a href="?mod=registromarcas&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar Marcas</a> </li>
                                <li><a href="?mod=registromarcas&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de Marcas </a> </li>
								<li> -- </li>
								<li><a href="?mod=registrocompania&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar Compania</a> </li>
                                <li><a href="?mod=registrocompania&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de Compania </a> </li>
								<li> -- </li>
								<li><a href="?mod=registroinstala&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar Instalaciones</a> </li>
                                <li><a href="?mod=registroinstala&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de Instalaciones </a> </li>
							</ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-group"></i>
                                <span>Usuarios </span>
                                <i class="  fa fa-unsorted"></i>
                            </a>
                            <ul class="treeview-menu">
                                <?php 
									if($tipo2==1){ 
								?>
										<li><a href="?mod=registro&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar Usuarios</a> </li>
								<?php } 
								?>
                                <li><a href="?mod=registro&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista De Usuarios </a> </li>
								<li> -- </li>
								<li><a href="?mod=registrotipous&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar Tipo Usuarios</a> </li>
                                <li><a href="?mod=registrotipous&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de Tipo Usuarios </a> </li>
								<li> -- </li>
								<li><a href="?mod=registrocenco&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar CENCO</a> </li>
                                <li><a href="?mod=registrocenco&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de CENCOs </a> </li>
								<li> -- </li>
								<li><a href="?mod=registrocargo&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar Cargos</a> </li>
                                <li><a href="?mod=registrocargo&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de Cargos </a> </li>
                            </ul>
                        </li>							
                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon glyphicon-phone"></i>
                                <span>Computadores y Celulares </span>
                                <i class="fa  fa fa-unsorted "></i>
                            </a>
                            <ul class="treeview-menu">
                                <?php 
									if($tipo2==1){ ?>
										<li><a href="?mod=registrocomputadores&nuevo"><i class=" glyphicon glyphicon-floppy-open"></i>Registrar Computador</a> </li>
									<?php } ?>
                                <li><a href="?mod=registrocomputadores&lista"><i class=" glyphicon glyphicon-list"></i>Lista de Computadores </a> </li>
								<li> -- </li>
								<?php
									if($tipo2==1){ ?>
										<li><a href="?mod=registrocelulares&nuevo"><i class=" glyphicon glyphicon-floppy-open"></i>Registrar Celulares</a> </li>
									<?php } ?>
                                <li><a href="?mod=registrocelulares&lista"><i class=" glyphicon glyphicon-list"></i>Lista de Celulares </a> </li>	
					
                            </ul>
						</li>

							 <li class="treeview">
                                <a href="#">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                    <span>Reportes</span>
                                    <i class="fa  fa fa-unsorted "></i>
                                </a>
                                <ul class="treeview-menu">
									<li><a href="?mod=reportecomputadores&reporte"><i class=" fa fa-sort-amount-desc"></i>Reporte Computadores</a> </li>
                                    <li><a href="?mod=reportecelulares&reporte"><i class="  fa fa-sort-amount-desc"></i>Reporte Celulares</a> </li>
									</br>
                                    <li><a href="?mod=historicoequipos&reporte"><i class="  fa fa-sort-amount-desc"></i>Historico de Equipos x Usuario</a> </li>
                                </ul>
                            </li>

						<?php 
						if($tipo2==1){ ?>

                           
                           
<?php
                           if($tipo2==1){

                            ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-gears"></i>
                                    <span>Administracion </span>
                                    <i class="fa  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="?mod=registroadmin&nuevo"><i class="glyphicon glyphicon-user"></i>Registrar Administrador</a> </li>
                                    <li><a href="?mod=registroadmin&lista=lista"><i class="glyphicon glyphicon-list-alt"></i>Lista De Administradores</a> </li>
                                    
                                    <!-- <li><a href="?mod=registroadmin&lista=lista"><i class=" glyphicon glyphicon-wrench"></i>Opciones</a> </li> -->
                                    <li><a href="?mod=/respaldo/respaldo&respaldo=respaldo"><i class=" glyphicon glyphicon-hdd"></i>Respaldar Bd</a> </li>
                                  
                                </ul>
                            </li>




						<?php 

                        }
                        } ?>
						
                </section>
                <!-- /.sidebar -->
            </aside>
