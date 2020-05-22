<!DOCTYPE html>
<html><head>

</head><body>

<h2>Kehadiran Mahasiswa Pertemuan</h2>
<br><br>

<table>
	<tr>
		<th>No</th>
		<th>Nama Mahasiswa</th>
		<th>NPM</th>
		<th>Kehadiran</th>
		<th>	Lokasi Mahasiswa</th>
	</tr>

	<?php 
	$no=1;
	foreach($hadir as $h):?>

	<tr>
		<td><?php echo $no++ ?></td>
		<td><?php echo $h['name']; ?></td>
		<td><?php echo $h['npm']; ?></td>
		<?php if ($h['status_per'] == 0) { ?>
                                <td>Tidak Hadir</td>
                            <?php } else { ?>
                                <td>Hadir</td>
                            <?php } ?>
		<td><?php echo $h['latitude'] . "/" . $h['longitude']?></td>

	</tr>

	<?php endforeach;?>
</table>

</body></html>