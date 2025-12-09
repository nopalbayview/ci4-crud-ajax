<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>


<h3>Edit Siswa</h3>
<form action="/siswa/update/<?= $siswa['id']; ?>" method="post" class="mt-3">
<input class="form-control mb-3" name="nama" value="<?= $siswa['nama']; ?>" required>
<input class="form-control mb-3" name="alamat" value="<?= $siswa['alamat']; ?>" required>
<input class="form-control mb-3" name="kelas" value="<?= $siswa['kelas']; ?>" required>
<button class="btn btn-primary">Update</button>
</form>


<?= $this->endSection(); ?>