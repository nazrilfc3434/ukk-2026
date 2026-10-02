<h2>Tambah Lokasi</h2>

<form action="<?= route('admin.lokasi.store') ?>" method="POST">

    <?= csrf_field() ?>

    <div>
        <label>Nama Lokasi</label>
        <br>
        <input type="text"
               name="nama_lokasi"
               placeholder="Masukkan nama lokasi"
               required>
    </div>

    <br>

    <button type="submit">Simpan</button>

    <a href="<?= route('admin.lokasi.index') ?>">
        Kembali
    </a>

</form>