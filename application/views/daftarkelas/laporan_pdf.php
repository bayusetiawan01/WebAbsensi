<!DOCTYPE html>
<html><head>
	<title>
		Kehadiran Mahasiswa
	</title>
</head><body>

<table>
	<tr>
		<th>No</th>
		<th>Nama Mahasiswa</th>
		<th>NPM</th>
		<th>Kehadiran</th>
		<th>Lokasi</th>
	</tr>

	
	<?php 
	$no=1;
	foreach($mahasiswa as $m):?>

	<tr>
		<td><?php echo $no++ ?></td>
		<td><?php echo $m->nama ?></td>
		<td><?php echo $m->npm ?></td>
		<td><?php echo $m->kehadiran ?></td>
		<td><?php echo $m->lokasi ?></td>
	</tr>

	<?php endforeach;?>
</table>

</body></html>