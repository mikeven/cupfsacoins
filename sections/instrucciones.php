<?php 
	$inicio_atributos = obtenerAtributosRegistrados( $dbh );
?>
<div id="instrucciones">

	<p>Esta es una plataforma diseñada para que puedas realizar reconocimientos espontáneos a todo aquel compañero o compañera que consideres ha demostrado alguno de los Atributos CUPFSA en sus acciones diarias.
Cada Atributo le da al ganador de la nominación una cantidad de CUPFSA Coins que luego podrá canjear por premios instantáneos, sin tómbolas ni sorteos, de la siguiente manera:</p>

	<ul style="margin: 15px 0">
		<?php foreach ( $inicio_atributos as $a ) { ?>
			<li><?php echo $a["nombre"]." - ".$a["valor"]." coins"; ?></li>
		<?php } ?>
	</ul>

	<p>Es importante que, al hacer una nominación, detalles muy bien las razones por las cuales la estás realizando, y porqué ese compañero o compañera merece ser reconocido por ese atributo.
Recuerda que antes de adjudicar el monto de CUPFSA Coins, debes retirar en Recursos Humanos la postal que le entregarás a tu compañero o compañera nominado.</p>

	</p>Gracias por incentivar el reconocimiento en la empresa y por utilizar CUPFSA Coins.</p>

	<p style="text-align: right;">Dirección de Recursos Humanos</p>

</div>