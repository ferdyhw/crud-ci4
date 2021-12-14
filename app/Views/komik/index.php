<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="flash-data" data-flashdata="<?= session()->getFlashData('flash'); ?>"></div>
    <a href="/komik/tambah" class="btn btn-primary mb-3 mt-3">Tambah Data Komik</a>
    <h1>Daftar Komik</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cover</th>
                <th scope="col">Judul</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <?php $i = 1 ?>
        <?php foreach ($komik as $k) : ?>
            <tbody>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><img src="/img/<?= $k['sampul']; ?>" class="cover"></td>
                    <td><?= $k['judul']; ?></td>
                    <td>
                        <a href="/komik/detail/<?= $k['slug']; ?>" class="btn btn-success">Detail</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>

<?= $this->endSection(); ?>