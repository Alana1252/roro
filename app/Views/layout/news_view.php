<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="card  card-besar"></div>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-kiri">
        <div class="card-body">
          <h2 class="card-title">Berita</h2>
          <?php foreach ($news as $item): ?>
    <div class="card">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="/img/<?= $item['photo']; ?>" alt="Berita" class="card-img"><?= $item['date']; ?>
            </div>
            <div class="col-md-8">
                <div class="ml-2">
                    <h3 class="card-title"><?= $item['title']; ?></h3>
                    <p class="card-text"><?= $item['deskripsi']; ?></p>
                    <a href="<?= site_url('pages/berita/' . $item['id']); ?>" class="text-secondary" style="position: absolute; bottom: 10px; right: 10px;">Selengkapnya ></a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

        </div>
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="card card-kanan">
        <div class="card-body">
          <h2 class="card-title">Live CCTV</h2>
          <div class="video-list">
            <div class="card">
              <div class="row no-gutters">
                <div class="col-md-4">
                <iframe class="card-img"
src="https://www.youtube.com/embed/IpKXHZ67P6M">
</iframe> 
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h3 class="card-title">Video Title 1</h3>
                    <p class="card-text">Video Description 1</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="/img/banner1.png" alt="Video Thumbnail" class="card-img">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h3 class="card-title">Video Title 2</h3>
                    <p class="card-text">Video Description 2</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="/img/banner1.png" alt="Video Thumbnail" class="card-img">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h3 class="card-title">Video Title 3</h3>
                    <p class="card-text">Video Description 3</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="/img/banner1.png" alt="Video Thumbnail" class="card-img">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h3 class="card-title">Video Title 4</h3>
                    <p class="card-text">Video Description 4</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="/img/banner1.png" alt="Video Thumbnail" class="card-img">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h3 class="card-title">Video Title 5</h3>
                    <p class="card-text">Video Description 5</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
