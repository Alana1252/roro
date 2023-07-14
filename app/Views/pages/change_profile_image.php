<!-- views/change_profile_image.php -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>

<body>
    <h1><?= $title ?></h1>

    <form action="<?= route_to('user.update_profile_image') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="profile_image">Profile Image</label>
        <input type="file" id="profile_image" name="profile_image">

        <button type="submit">Change Profile Image</button>
    </form>
</body>

</html>