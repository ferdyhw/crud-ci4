<?= $this->extend('layout/auth-template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <h1 class="mt-3 mb-3">Login User</h1>
    <?php if (session()->getFlashData('flash')) : ?>
        <div class="row">
            <div class="col-6">
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashData('flash'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-6">
            <form action="/auth/login" method="post">
                <?= csrf_field(); ?>
                <div class="form-control p-3">
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autofocus value="<?= old('username'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" autofocus value="<?= old('password'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>