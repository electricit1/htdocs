<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Nazwa</th>
				<?php if ($data['rola']==4) {echo "<th>Login</th>";}?>
				<th>Data wyniku</th>
				<th>Wynik</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data['wyniki'] as $value){  ?>
			<tr>
				<td><?=$value->{'nazwa'};?></td>
				<?php if ($data['rola']==4){echo "<td>".$value->login."</td>";}?>
				<td><?=$value->{'data_wyniku'};?></td>
				<td><?=$value->{'wynik'}."%";?></td>
			<?php }?>
		</tbody>
	</table>
</div>
