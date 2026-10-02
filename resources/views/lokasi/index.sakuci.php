<h2>Data Lokasi</h2>

<a href="<?= route('admin.lokasi.create') ?>">
    Tambah Lokasi
</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lokasi</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($lokasi as $key => $item): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $item->nama_lokasi ?></td>
                <td>
                    <a href="<?= route('admin.lokasi.edit', $item->id_lokasi) ?>">
                        Edit
                    </a>

                    <form action="<?= route('admin.lokasi.delete', $item->id_lokasi) ?>"
                          method="POST"
                          style="display:inline;">
                        <?= csrf_field() ?>
                        <?= method_field('DELETE') ?>

                        <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus lokasi ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>