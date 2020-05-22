<!DOCTYPE html>
<html><head>

</head><body>

<h2>Manajemen User</h2>
<br><br>

<table>
	<tr>
		<th>No</th>
		<th>Nama User</th>
		<th>NPM</th>
		<th>Email</th>
		<th>Role</th>
		<th>Aktif</th>
		<th>Tanggal dibuat</th>
	</tr>

	<?php 
	$no=1;
	foreach($mahasiswa as $m):?>

	<tr>
		<td><?php echo $no++ ?></td>
		<td><?php echo $m->name ?></td>
		<td><?php echo $m->npm ?></td>
		<td><?php echo $m->email ?></td>
		<td><?php echo $m->role_id ?></td>
		<td><?php echo $m->is_active ?></td>
		<td><?php echo $m->date_created?></td>

	</tr>

	<?php endforeach;?>
</table>

</body></html>