<h1>Data Siswa</h1>
<h3>_______________________________________________________________________________________</h3>
<table border="1" width="100%">
	<thead>
	<tr>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Logo</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($sekolah2 as $list):?>
		<tr>
			<td><?php echo $list->nama ?></td>
			<td><?php echo $list->alamat ?></td>
			<td><img src="<?php echo base_url('upload/product/'.$list->image) ?>" width="64" /></td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>