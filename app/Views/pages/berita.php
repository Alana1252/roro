<!-- file: app/Views/pages/berita.php -->

<!-- Tampilkan daftar berita -->
<?php foreach ($news as $item): ?>
    <div class="card">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="/img/<?= $item['photo']; ?>" alt="Berita" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="ml-2">
                    <h3 class="card-title"><?= $item['title']; ?></h3>
                    <p class="card-text"><?= $item['description']; ?></p>
                    <!-- Tambahkan tombol detail -->
                    <a href="<?= site_url('berita/' . $item['id']); ?>" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
