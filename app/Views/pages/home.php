<?php if (!logged_in() || in_groups('user')) : ?>
    <?= $this->extend('layout/layout'); ?>
    <?= $this->section('content') ?>
    <?= $this->endSection(); ?>

<?php elseif (in_groups('admin')) : ?>
    <?= $this->extend('admin/index'); ?>
    <?= $this->section('admin') ?>
    <?= view('admin/card_dashboard', ['transaksi' => $transaksi]); ?>
    <?= $this->endSection(); ?>

<?php elseif (in_groups('operator')) : ?>
    <?= $this->extend('operator/index'); ?>
    <?= $this->section('operator') ?>
    <?= view('admin/card_dashboard', ['transaksi' => $transaksi]); ?>
    <?= $this->endSection(); ?>
<?php endif; ?>