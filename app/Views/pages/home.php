<?php if (!logged_in() || in_groups('user')) : ?>
    <?= $this->extend('layout/layout'); ?>
    <?= $this->section('content') ?>
    <?= view('layout/news_view', ['news' => $news]); ?>
    <?= $this->endSection(); ?>

<?php elseif (in_groups('admin')) : ?>
    <?= $this->extend('admin/index'); ?>
    <?= $this->section('admin') ?>
    <?= view('admin/card_dashboard', ['transaksi' => $transaksi]); ?>
    <?= $this->endSection(); ?>

<?php elseif (in_groups('operator')) : ?>
    <?= $this->extend('operator/index'); ?>
    <?= $this->section('content') ?>
    <h1>Welcome, Operator!</h1>
    <!-- Tampilkan konten khusus operator di sini -->
    <?= $this->endSection(); ?>
<?php endif; ?>