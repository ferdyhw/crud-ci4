<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Detail Orang</h1>
    <div class="row">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h6 class="card-title">Nama : <?= $orang['nama']; ?></h6>
                            <p class="card-text">Alamat : <?= $orang['alamat']; ?></p>
                            <p class="card-text"><small class="text-muted">Dibuat : <?= $orang['created_at']; ?></small></p>
                            <p class="card-text"><small class="text-muted">Diubah : <?= $orang['updated_at']; ?></small></p>
                            <br><br>
                            <a href="/orang">
                                <- Kembali ke daftar orang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>