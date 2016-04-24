<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Nazwa zestawu</th>
				<th>Login</th>
				<th>Jezyk 1</th>
				<th>Jezyk 2</th>
				<th>Nazwa podkategorii</th>
				<th>Zawartosc zestawu</th>
				<th>Ilosc slowek</th>
				<th>Data edycji</th>
				<th><?php if ($data['userrole']==4){echo "Widocznosc";}?></th>
				<th>Nauka</th>
				<th>Sprawdzian</th>	
				<th><?php foreach ($data['zestawy'] as $value){  
					if ($data['userrole']==4 or 
					($data['userrole']==3 and in_array((object) array(id_podkategoria => $value->id_podkategoria), $data['uprawnienia'])) or 
					Session::get('userID')==$value->id_konto)
					{echo "Edycja";break;} } 
					// break bo tu sie wywoluje tylko naglowek, a zestawow moze byc kilka i wtedy napis edytuj sie duplikuje
					?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data['zestawy'] as $value){  
				if($data['userrole']==4 or $value->widocznosc==1){?>
			<tr>
				<td><?=$value->{'Nazwa zestawu'};?></td>
				<td><?=$value->{'Login'};?></td>
				<td><?=$value->{'Jezyk 1'};?></td>
				<td><?=$value->{'Jezyk 2'};?></td>
				<td><?=$value->{'Nazwa podkategorii'};?></td>
				<td><?php  	$z = (explode(PHP_EOL, $value->{'Zawartosc zestawu'}));
							foreach ($z as $key ) {echo $key.'</br>';}?>
				</td>
				<td><?=$value->{'Ilosc slowek'};?></td>
				<td><?=$value->{'Data edycji'};?></td>
				<td><?php if ($data['userrole']==4){	
					if ($value->widocznosc==1) {$jak='tak';}else{ $jak='nie';}
					echo $jak;}?></td>
				<td><?php echo "<a class=\"glyphicon glyphicon-th-list\" href=\"/wiedza/nauka/$value->id\"></a>";?></td>
				<td><?php echo "<a class=\"glyphicon glyphicon-th-list\" href=\"/wiedza/spr/$value->id\"></a>";?></td>
				<td><?php
				if (
					($data['userrole']==4 or 
					($data['userrole']==3 and in_array((object) array(id_podkategoria => $value->id_podkategoria), $data['uprawnienia'])) or 
					Session::get('userID')==$value->id_konto)
				 )
				 {echo "<a class=\"glyphicon glyphicon-pencil\" href=\"/zestaw/$value->id/edit\"></a>";}
				?></td>
			</tr>
			<?php }}?>
		</tbody>
	</table>
	<?php
		if ($data['userrole']==4 or	in_array((object) array(id_podkategoria => $value->id_podkategoria), $data['uprawnienia'])){ ?>
	<div class="text-center">
		<a href="/zestaw/add" class="btn btn-primary active">Dodaj Zestaw</a>
	</div>
	<?php } ?>
</div>
