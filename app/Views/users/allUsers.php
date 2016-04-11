<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Imię</th>
				<th>Nazwisko</th>
				<th>Login</th>
				<th>Rola</th>
				<th>Email</th>
				<th>Edycja</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data['table'] as $row) 
			{
				echo "<tr><td>$row->imie</td><td>$row->nazwisko</td><td>$row->login</td><td>$row->rola</td><td>$row->email</td>";
				echo "<td><a class='glyphicon glyphicon-pencil' href='/user/edit/$row->id'/></td></tr>";
			}?>
		</tbody>
	</table>
</div>