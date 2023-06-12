<!-- CSS -->

<!-- Carousel -->
<div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="10000">
    <ol class="carousel-indicators">
        <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExample" data-slide-to="1"></li>
        <li data-target="#carouselExample" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('/img/banner1.png'); ?>" class="d-block w-100 img-fluid" alt="Banner 1">
        
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('/img/banner2.png'); ?>" class="d-block w-100 img-fluid" alt="Banner 2">

        </div>
        <div class="carousel-item">
            <img src="<?= base_url('/img/banner3.png'); ?>" class="d-block w-100 img-fluid" alt="Banner 3">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


