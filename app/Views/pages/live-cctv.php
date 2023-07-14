<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .embed-responsive-16by9 {
            padding-bottom: 12.45%;
            position: relative;
        }

        .embed-responsive-16by9 iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .col-md-4 {
            margin: 0;
            padding: 0;

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="video-frame" class="embed-responsive-item" src="https://www.youtube.com/embed/IpKXHZ67P6M?autoplay=1" frameborder="0" allow="autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="510" height="352" src="https://www.youtube.com/embed/1JiFsVQ7B2A?&autoplay=1" title="🔴 Air Putih - Sei Selari 02" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen autoplay></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="510" height="352" src="https://www.youtube.com/embed/WvUBdhrAoAs?&autoplay=1" title="🔴 Sei Selari - Air Putih 01" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen autoplay></iframe>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://www.youtube.com/embed/geR-4refGB4?&autoplay=1" title="🔴 Sei Selari - Air Putih 02" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen autoplay></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://www.youtube.com/embed/uwdtiuigyUU?&autoplay=1" title="🔴 Sei Selari - Air Putih 03" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen autoplay></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center" style="height:350px;">
                    <div class="card-header">
                        <?= date('l, d F Y'); ?>
                    </div>
                    <div class="card-body">
                        <p class="card-title">
                            Total penumpang hari ini:
                        </p>
                        <h5 class="card-text"> <?= count($count) ?></h5>

                    </div>
                    <div class="card-footer text-muted">
                        <a href="tiket" class="btn btn-warning"><i class="bi bi-arrow-bar-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>


</html>