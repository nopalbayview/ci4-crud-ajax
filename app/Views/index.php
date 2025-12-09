<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>


<a href="/siswa/create" class="btn btn-success mb-3">+ Tambah Siswa</a>


<table class="table table-bordered table-striped">
<tr class="table-primary">
<th>ID</th>
<th>Nama</th>
<th>Alamat</th>
<th>Kelas</th>
<th>Aksi</th>
</tr>
<?php foreach($siswa as $s): ?>
<tr>
<td><?= $s['id']; ?></td>
<td><?= $s['nama']; ?></td>
<td><?= $s['alamat']; ?></td>
<td><?= $s['kelas']; ?></td>
<td>
<a href="/siswa/edit/<?= $s['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="/siswa/delete/<?= $s['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus siswa?')">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</table>


<?= $this->endSection(); ?>