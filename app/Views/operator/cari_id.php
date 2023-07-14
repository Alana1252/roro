<!DOCTYPE html>
<html>

<head>
    <title>Search Order ID</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            background-color: #f1f1f1;
        }

        .card {
            width: 420px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 97%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            float: right;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Cari Tiket Anda</h1>


        <form action="/operator/search" method="post">
            <div class="form-group">
                <input type="text" id="order_id" placeholder="BKS-XXXXXXXXXX" name="order_id" required>
            </div>
            <?php if (session()->has('error')) : ?>
                <p style="color: red; position:absolute;" id="error-message"><?php echo session('error'); ?></p>
            <?php endif; ?>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>
<script>
    setTimeout(function() {
        var errorElement = document.getElementById('error-message');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }, 5000);
</script>