
    <!-- Tampilkan informasi pengguna -->
    <!-- <h1>Welcome, <?= $user->email ?></h1>
    <p>Your User ID: <?= $user->username ?></p>
    <img src="<?= base_url('img/' . $user->user_image) ?>" alt="User Image"> -->
    <!-- ... -->
    </head>
<body>

<!DOCTYPE html>
<html lang="en">
    <head>
    
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>

<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 20px; font-family: 'Roboto', sans-serif; border-radius: 10px 10px 0 0; background-color: #1c1c1ced;">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEj8VKuGxSanyefjjiSn2ZdPQAjH5llk2t_brsNWXKItnSCK8JNlVxZiaKyo6J9YsnFq_C2eZerpSp6OHyDh9YJYU0fkFrwP0l9zUzdMWcYNVFsadOHnlO_jI2G2bY3loSWgmLLqpNrS5HB5KecjuE1deoGLN0TH4DLLjWsWCu3mz9mYreZ6igFhRMky/s472/logo2.png" alt="Airputih" style="height: 200px; width: 200px;">
            <div style="font-size: 12px; color: rgba(255, 255, 255, 0.696); margin-bottom: 10px;">
                <p style="font-size: 30px; font-weight: bold;">Halo <?= $username ?>,</p>
                <div>Ini adalah email aktivasi untuk akun anda pada <div style="color: azure;"><?= site_url() ?></div>.</div>
                <div>Untuk mengaktifkan akunmu pada website, silahkan klik tombol di bawah ini:</div>     
            </div>
        </td>
    </tr>
    <tr>
        <td  style="padding: 10px 20px ; background-color: rgb(29, 28, 28);">
            <table cellpadding="0" cellspacing="0"  width="100%">
                <tr>
                    <td align="center">
                        <a href="<?= url_to('activate-account') . '?token=' . $hash ?>" class="button-link" style="text-decoration: none;">
                            <div style="font-size: 20px; font-family: 'Roboto', sans-serif; font-weight: bold; color: rgb(100, 67, 234); display: inline-block; padding: 10px 20px;">Aktifkan Akun</div>
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px; font-family:  'Roboto', sans-serif; border-radius: 0 0 10px 10px; background-color: #1c1c1ced; font-size: 12px; color: rgba(255, 255, 255, 0.696);">
            <div>
                Jika Anda tidak mendaftar di situs web ini, Anda dapat mengabaikan email ini dengan aman.</div>
                <div>
                Jika button tidak bekerja silahkan copy link ini dan paste dibrowser anda:
                </div>
                <div style="color:azure"> <?= url_to('activate-account') . '?token=' . $hash ?></div>
                <div style="margin-top: 20px;"> Jika Anda memiliki pertanyaan, cukup balas email ini, kami selalu senang membantu.</div>
                <div style="margin-top: 20px; font-size: 16px;">Hormat kami,</div>
                <div style="color: azure; font-weight: bold; font-size: 16px;">Go-RoRo</div>
            </div>
        </td>
    </tr>
</table>

</body>
</html>