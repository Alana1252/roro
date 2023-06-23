<h1>Welcome, <?= $user->email ?></h1>
<p>Your User ID: <?= $user->username ?></p>
<img src="<?= base_url('img/' . $user->user_image) ?>" alt="User Image">