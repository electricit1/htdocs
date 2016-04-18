<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>id</th>
				<th>Login</th>
				<th>Jezyk 1</th>
				<th>Jezyk 2</th>
				<th>Nazwa podkategorii</th>
				<th>Nazwa zestawu</th>
				<th>Zawartosc zestawu</th>
				<th>Ilosc slowek</th>
				<th>Data edycji</th>	
				<th><?php foreach ($data['zestawy'] as $value){  
					if ($data['userrole']==4 or
						Session::get('userID')==$value->id_konto or 
						in_array((object) array(id_podkategoria => $value->id_podkategoria), $data['uprawnienia']))
					{echo "Edycja";break;} } 
					// break bo tu sie wywoluje tylko naglowek, a zestawow moze byc kilka i wtedy napis edytuj sie duplikuje
					?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data['zestawy'] as $value){  ?>
			<tr>
				<td><?=$value->{'id'};?></td>
				<td><?=$value->{'Login'};?></td>
				<td><?=$value->{'Jezyk 1'};?></td>
				<td><?=$value->{'Jezyk 2'};?></td>
				<td><?=$value->{'Nazwa podkategorii'};?></td>
				<td><?=$value->{'Nazwa zestawu'};?></td>
				<td><?=$value->{'Zawartosc zestawu'};?></td>
				<td><?=$value->{'Ilosc slowek'};?></td>
				<td><?=$value->{'Data edycji'};?></td>
				<td><?php
				if ($data['userrole']==4 or
					Session::get('userID')==$value->id_konto or 
					in_array((object) array(id_podkategoria => $value->id_podkategoria), $data['uprawnienia']))
				 {echo "<a class=\"glyphicon glyphicon-pencil\" href=\"/zestaw/edit/$value->id\"></a>";}
				?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<?php
		if ($data['userrole']==4 or	in_array((object) array(id_podkategoria => $value->id_podkategoria), $data['uprawnienia'])){ ?>
	<div class="text-center">
		<a href="/zestaw/add" class="btn btn-primary active">Dodaj Zestaw</a>
	</div>
	<?php } ?>
</div>
