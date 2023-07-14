<!-- views/change_password.php -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>

<body>
    <h1><?= $title ?></h1>

    <form action="<?= route_to('user.update_password') ?>" method="post">
        <?= csrf_field() ?>

        <label for="current_password">Current Password</label>
        <input type="password" id="current_password" name="current_password">

        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password">

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password">

        <button type="submit">Change Password</button>
    </form>
</body>

</html>