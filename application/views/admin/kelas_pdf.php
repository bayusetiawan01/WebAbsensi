<!DOCTYPE html>
<html><head>

</head><body>

<h2>Manajemen Kelas</h2>
<br><br>

<table>
	<tr>
		<th>No</th>
		<th>Judul</th>
		<th>Mata Kuliah</th>
		<th>Aktif</th>
	</tr>

	<?php 
	$no=1;
	foreach($kelas as $k):?>

	<tr>
		<td><?php echo $no++ ?></td>
		<td><?php echo $k->title ?></td>
		<td><?php echo $k->matkul_id ?></td>
		<td><?php echo $k->is_active ?></td>

	</tr>

	<?php endforeach;?>
</table>

</body></html>