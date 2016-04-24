<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Nazwa uzytkownika</th>
				<th>Nazwa Podkategorii</th>
				<th>Edycja</th>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data['uprawnienia'] as $value){  ?>
			<tr>
				<td><?=$value->{'Login'};?></td>
				<td><?=$value->{'Nazwa Podkategorii'};?></td>
				<td><?php echo "<a class=\"glyphicon glyphicon-pencil\" href=\"/uprawnienia/$value->id/edit\"></a>";	?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<div class="text-center">
		<a href="/uprawnienia/add" class="btn btn-primary active">Nadaj Uprawnienia</a>
	</div>
</div>
