<?php if (!logged_in() || in_groups('user')) : ?>
    <?= $this->extend('layout/layout'); ?>

    <?= $this->section('content') ?>
    <?= view('layout/news_view', ['news' => $news]); ?>
    <?= $this->endSection(); ?>
<?php endif; ?>

<?php if (in_groups('admin')) : ?>
    <?= $this->include('admin/index'); ?>
<?php elseif (in_groups('operator')) : ?>
    Test
<?php endif; ?>