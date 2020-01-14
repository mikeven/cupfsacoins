<?php 
	$inicio_atributos = obtenerAtributosRegistrados( $dbh );
?>
<div id="instrucciones">

	<p>Esta es una plataforma diseñada para que puedas realizar reconocimientos espontáneos a todo aquel compañero o compañera que consideres ha demostrado alguno de los Atributos CUPFSA en sus acciones diarias.
Cada Atributo le da al ganador de la nominación una cantidad de CUPFSA Coins que luego podrá canjear por premios instantáneos, sin tómbolas ni sorteos, de la siguiente manera:</p>
	
	<table class="table table-bordered table-striped tableatrib" border="0" style="" align="center">
		<thead>
			<tr>
				<th colspan="2">Atributo</th>
				<th align="center">Valor</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $inicio_atributos as $a ) { ?>
				<tr class="gradeX">
					<td width="30%" align="center"><img width="25%" src="<?php echo $a["imagen"]; ?>"></td>
					<td width="50%"><?php echo $a["nombre"]; ?></td>
					<td width="20%" align="center"><?php echo $a["valor"]; ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<p>Es importante que, al hacer una nominación, detalles muy bien las razones por las cuales la estás realizando, y porqué ese compañero o compañera merece ser reconocido por ese atributo.
Recuerda que antes de adjudicar el monto de CUPFSA Coins, debes retirar en Recursos Humanos la postal que le entregarás a tu compañero o compañera nominado.</p>

	</p>Gracias por incentivar el reconocimiento en la empresa y por utilizar CUPFSA Coins.</p>

	<p style="text-align: right;">Dirección de Recursos Humanos</p>

</div>