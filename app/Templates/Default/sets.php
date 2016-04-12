<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<?php foreach ($data['nazwykolumn'] as $value) {?>
					<th><?=$value->COLUMN_NAME?></th>
					<?php }?>
				<th>Edycja</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data['zestawy'] as $value){  ?>
			<tr>
				<td><?=$value->id;?></td>
				<td><?=$value->id_konto;?></td>
				<td><?=$value->id_jezyk1;?></td>
				<td><?=$value->id_jezyk2;?></td>
				<td><?=$value->id_podkategoria;?></td>
				<td><?=$value->nazwa;?></td>
				<td><?=$value->zestaw;?></td>
				<td><?=$value->ilosc_slowek;?></td>
				<td><?=$value->data_edycji;?></td>
				<td><a class="glyphicon glyphicon-pencil" href="/zestaw/edit/<?=$value->id?>"></a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>


