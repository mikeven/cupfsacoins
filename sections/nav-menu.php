<nav id="menu" class="nav-main" role="navigation">
	<ul class="nav nav-main">
		<li class="nav-active">
			<a href="inicio.php">
				<i class="fa fa-home" aria-hidden="true"></i>
				<span>Inicio</span>
			</a>
		</li>
		<?php if( isV( 'mp_titm_us' ) ) { ?>
		<li class="nav-parent ">
			<a>
				<i class="fa fa-users" aria-hidden="true"></i>
				<span>Usuarios</span>
			</a>
			<ul class="nav nav-children">
				<li><a href="usuarios.php">Ver usuarios</a></li>
				<li><a href="nuevo_usuario.php">Nuevo usuario</a></li>
				<li><a href="#!">Permisologías</a></li>
			</ul>
		</li>
		<?php } ?>
		<li class="nav-parent">
			<a>
				<i class="fa fa-bookmark" aria-hidden="true"></i>
				<span>Nominaciones</span>
			</a>
			<ul class="nav nav-children">
				<?php if( isV( 'mp_ver_nom' ) ) { ?>
				<li> <a href="nominaciones.php"> Ver nominaciones </a> </li>
				<?php } ?>
				<?php if( isV( 'mp_nom_pers' ) ) { ?>
				<li> <a href="nuevo_nominacion.php"> Nueva nominación </a> </li>
				<li> <a href="nominaciones.php?param=hechas">Nominaciones hechas</a> </li>
				<li> <a href="nominaciones.php?param=recibidas">Nominaciones recibidas</a> </li>
				<?php } ?>
				<?php if( isV( 'mp_ver_atrib' ) ) { ?>
					<li> <a href="atributos.php"> Atributos </a> </li>
				<?php } ?>
			</ul>
		</li>
		<?php if( isV( 'mp_titm_pro' ) ) { ?>
		<li class="nav-parent">
			<a>
				<i class="fa fa-cubes" aria-hidden="true"></i>
				<span>Productos</span>
			</a>
			<ul class="nav nav-children">
				<?php if( isV( 'mp_ver_pro' ) ) { ?>
					<li> <a href="productos.php">Ver productos</a> </li>
				<?php } ?>
				<?php if( isV( 'mp_ag_pro' ) ) { ?>
					<li><a href="nuevo_producto.php">Nuevo producto</a> </li>
				<?php } ?>	
				<?php if( isV( 'mp_ver_canj' ) ) { ?>
					<li> <a href="canjes.php"> Canjes </a> </li>
				<?php } ?>
				<?php if( isV( 'mp_ver_miscanj' ) ) { ?>
					<li> <a href="mis-canjes.php"> Mis Canjes </a> </li>
				<?php } ?>	
			</ul>
		</li>
		<?php } ?>
	</ul>
</nav>