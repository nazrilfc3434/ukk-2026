<h2>Edit Lokasi</h2>

<form action="<?= route('admin.lokasi.update', $lokasi->id_lokasi) ?>"
      method="POST">

    <?= csrf_field() ?>
    <?= method_field('PUT') ?>

    <div>
        <label>Nama Lokasi</label>
        <br>

        <input type="text"
               name="nama_lokasi"
               value="<?= $lokasi->nama_lokasi ?>"
               required>
    </div>

    <br>

    <button type="submit">Update</button>

    <a href="<?= route('admin.lokasi.index') ?>">
        Kembali
    </a>

</form>