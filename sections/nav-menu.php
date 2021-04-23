<nav id="menu" class="nav-main" role="navigation">
	<ul class="nav nav-main">
		<li class="nav-active">
			<a href="inicio.php">
				<i class="fa fa-home" aria-hidden="true"></i>
				<span>Inicio</span>
			</a>
		</li>
		
		<li class="nav-parent">
			<a>
				<i class="fa fa-bookmark" aria-hidden="true"></i>
				<span>Nominaciones</span>
			</a>
			<ul class="nav nav-children">
				<?php if( isV( 'mp_ver_nom' ) ) { ?>
				<li> <a href="nominaciones.php"> Ver nominaciones </a> </li>
				<?php } ?>
				<?php if( isV( 'mp_nva_nom' ) ) { ?>
				<li> <a href="nuevo_nominacion.php"> Nueva nominación </a> </li>
				<?php } ?>
				<?php if( isV( 'mp_nom_pers' ) ) { ?>
				<li> <a href="nominaciones.php?param=hechas">Realizadas</a> </li>
				<li> <a href="nominaciones.php?param=recibidas">Recibidas</a> </li>
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
					<?php if( isV( 'mp_ver_canj' ) ) { ?>
						<li> <a href="canjes.php"> Canjes </a> </li>
					<?php } ?>
					<?php if( isV( 'mp_ver_miscanj' ) ) { ?>
						<li> <a href="mis-canjes.php"> Mis Canjes </a> </li>
					<?php } ?>	
				</ul>
			</li>
		<?php } ?>
		<?php if( isV( 'mp_manten' ) ) { ?>
			<li class="nav-parent">
				<a>
					<i class="fa fa-database" aria-hidden="true"></i>
					<span>Mantenimiento</span>
				</a>
				<ul class="nav nav-children">
					<li> <a href="atributos.php"> Atributos </a> </li>
					<li> <a href="departamentos.php"> Departamentos </a> </li>
					<li> <a href="usuarios.php"> Usuarios </a> </li>
				</ul>
			</li>
		<?php } ?>
	</ul>
</nav>