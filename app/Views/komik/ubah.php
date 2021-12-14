<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Edit Data</h1>
    <div class="row">
        <div class="col-6">
            <form action="/komik/prosesUbah/<?= $komik['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-control p-3">
                    <h5 class="mb-3">Masukan Data Komik Baru</h5>
                    <div class="row mb-3">
                        <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
                        <input type="hidden" name="sampulLama" value="<?= $komik['sampul']; ?>">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $komik['judul']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('judul'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('penulis'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('penerbit'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="sampul" class="col-sm-2 col-form-label">Cover</label>
                        <div class="col-sm-2">
                            <img src="/img/<?= $komik['sampul']; ?>" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="previewImg()" value="<?= $komik['sampul']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('sampul'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                    <a href="/komik/detail/<?= $komik['slug']; ?>" style="float: right;">
                        <- Kembali ke detail komik</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>