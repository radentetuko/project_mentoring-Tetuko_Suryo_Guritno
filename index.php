<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Project Mentoring</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style/index.css">
</head>

<body>
    <main>
        <form id="form_login" action="" method="POST">
            <h3 class="mb-3"><b>Login to Aplication</b></h3>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="kata_kunci" class="form-label">Password</label>
                <input type="password" class="form-control" id="kata_kunci" name="kata_kunci">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>

        <?php
        if (isset($_POST['login'])) {
            session_start();
            include 'db.php';
            $user = $_POST['username'];
            $kata_kunci = $_POST['kata_kunci'];

            $cek = mysqli_query($con, "SELECT * FROM tb_admin WHERE username = '" . $user . "' AND kata_kunci = '" . $kata_kunci . "'");
            if (mysqli_num_rows($cek) > 0) {
                $d = mysqli_fetch_object($cek);
                $_SESSION['status_login'] = true;
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d->admin_id;
                echo '<script>window.location="progress.php"</script>';
            } else {
                echo '<script>alert("Username atau password yang anda masukkan salah!")</script>';
            }
        }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>