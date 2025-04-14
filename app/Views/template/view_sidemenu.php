<!-- Start Sidemenu Area -->
<div class="sidemenu-area">
	<div class="sidemenu-header">
		<a href="<?php echo base_url('Administrator') ?>" class="navbar-brand d-flex align-items-center">
			<img src="<?php echo base_url('assets/img/small-logo.png') ?>" alt="image">
			<span>ZUÑIGA</span>
		</a>

		<div class="burger-menu d-none d-lg-block">
			<span class="top-bar"></span>
			<span class="middle-bar"></span>
			<span class="bottom-bar"></span>
		</div>

		<div class="responsive-burger-menu d-block d-lg-none">
			<span class="top-bar"></span>
			<span class="middle-bar"></span>
			<span class="bottom-bar"></span>
		</div>
	</div>

	<div class="sidemenu-body">
		<ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar="">
			<li class="nav-item-title">
				Main
			</li>

			<li class="nav-item">
				<a href="<?php echo base_url('Administrator') ?>" class="nav-link">
					<span class="icon"><i class='bx bx-home-circle'></i></span>
					<span class="menu-title">Dashboard</span>
				</a>
			</li>

			<!-- <li class="nav-item">
				<a href="<?php echo base_url('Administrator/Existencia') ?>" class="nav-link">
					<span class="icon"><i class='bx bxs-book-reader'></i></span>
					<span class="menu-title">Consulta Existencia</span>
				</a>

			</li> -->

			<li class="nav-item-title">
				Clientes
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url('Administrator/clientes'); ?>" class="nav-link">
					<span class="icon"><i class='bx bx-message'></i></span>
					<span class="menu-title">Clientes</span>
				</a>
			</li>

			<li class="nav-item-title">
				Inventario
			</li>

			<li class="nav-item">
				<a href="#" class="collapsed-nav-link nav-link" aria-expanded="false">
					<span class="icon"><i class='bx bx-brightness'></i></span>
					<span class="menu-title">Productos</span>
				</a>

				<ul class="sidemenu-nav-second-level">

					<li class="nav-item">
						<a href="<?php echo base_url('Administrator/Lineas'); ?>" class="nav-link">
							<span class="icon"><i class='bx bx-badge-check'></i></span>
							<span class="menu-title">Lineas</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url('Administrator/Marcas'); ?>" class="nav-link">
							<span class="icon"><i class='bx bx-badge-check'></i></span>
							<span class="menu-title">Marcas</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url('Administrator/Productos'); ?>" class="nav-link">
							<span class="icon"><i class='bx bx-right-arrow-alt'></i></span>
							<span class="menu-title">Catalogo Gral.</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url('Administrator/productoRegistro'); ?>" class="nav-link">
							<span class="icon"><i class='bx bx-right-arrow-alt'></i></span>
							<span class="menu-title">Alta Producto</span>
						</a>
					</li>

					<!-- <li class="nav-item">
                        <a href="<?php echo base_url('producto/act_masiva'); ?>" class="nav-link">
                            <span class="icon"><i class='bx bx-right-arrow-alt'></i></span>
                            <span class="menu-title">Act. Masiva Precios</span>
                        </a>
                    </li> -->

					<!-- <li class="nav-item">
                        <a href="<?php echo base_url('producto/eliminar'); ?>" class="nav-link">
                            <span class="icon"><i class='bx bx-right-arrow-alt'></i></span>
                            <span class="menu-title">Eliminar</span>
                        </a>
                    </li> -->

				</ul>
			</li>

			<li class="nav-item-title">
				Configuración
			</li>

			<li class="nav-item">
				<a href="#" class="collapsed-nav-link nav-link" aria-expanded="false">
					<span class="icon"><i class='bx bx-brightness'></i></span>
					<span class="menu-title">Configuraciones</span>
				</a>
				<ul class="sidemenu-nav-second-level">
					<li class="nav-item">
						<a href="<?php echo base_url('Administrator/promocionesApp'); ?>" class="nav-link">
							<span class="icon"><i class='bx bx-right-arrow-alt'></i></span>
							<span class="menu-title">Promoción</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url('Administrator/sucTareas'); ?>" class="nav-link">
							<span class="icon"><i class='bx bx-right-arrow-alt'></i></span>
							<span class="menu-title">Suc.Tareas</span>
						</a>
					</li>

				</ul>
			</li>


		</ul>
	</div>
</div>
<!-- End Sidemenu Area -->
