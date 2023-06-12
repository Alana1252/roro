<?= $this->extend('layout/layout'); ?>

<?= $this->section('content') ?>
<?= view('layout/news_view', ['news' => $news]); ?>
    <?= isset($userContent) ? $userContent : '' ?>
<?= $this->endSection(); ?>
