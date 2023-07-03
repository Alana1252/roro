<!DOCTYPE html>
<html>

<head>
    <title>Barcode Generator</title>
</head>

<body>
    <div>
        <h1>Barcode Generator</h1>
        <img src="data:image/png;base64,<?= base64_encode($barcode); ?>" alt="Barcode">
    </div>
</body>

</html>