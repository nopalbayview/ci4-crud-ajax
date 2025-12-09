<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>


<h3>Tambah Siswa</h3>
<form action="/siswa/store" method="post" class="mt-3">
<input class="form-control mb-3" name="nama" placeholder="Nama" required>
<input class="form-control mb-3" name="alamat" placeholder="Alamat" required>
<input class="form-control mb-3" name="kelas" placeholder="Kelas" required>
<button class="btn btn-primary">Simpan</button>
</form>


<?= $this->endSection(); ?>