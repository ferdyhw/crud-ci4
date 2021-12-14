<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>Daftar Orang</h1>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukan keyword pencarian..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + (5 * ($currentPage - 1)); ?>
            <?php foreach ($orang as $o) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $o['nama']; ?></td>
                    <td><?= $o['alamat']; ?></td>
                    <td>
                        <a href="/orang/detail/<?= $o['id']; ?>" class="btn btn-success">Detail</a>
                    </td>
                </tr>
        </tbody>
    <?php endforeach; ?>
    </table>
    <?= $pager->links('orang', 'orang_pagination'); ?>
</div>

<?= $this->endSection(); ?>