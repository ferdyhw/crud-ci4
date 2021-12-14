<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Detail Komik</h1>
    <div class="row">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $komik['sampul']; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h6 class="card-title">Judul : <?= $komik['judul']; ?></h6>
                            <p class="card-text">Penulis : <?= $komik['penulis']; ?></p>
                            <p class="card-text"><small class="text-muted">Penerbit : <?= $komik['penerbit']; ?></small></p>
                            <a href="/komik/ubah/<?= $komik['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/komik/hapus/<?= $komik['id']; ?>" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" onclick="return confirm('Apakah yakin akan menghapus komik ?');">Delete</button>
                            </form>
                            <br><br>
                            <a href="/komik">
                                <- Kembali ke daftar komik</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>