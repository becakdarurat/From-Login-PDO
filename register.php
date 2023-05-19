<?php 

    require_once 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- link font cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- khusus file css -->
    <link rel="stylesheet" href="css/home.css">

</head>
<body>
    
    <!-- register section start -->

    <section class="form-container">

        <form action="" method="post">
            <h3>Daftar sekarang</h3>
            <input type="text" required maxlength="20" placeholder="Masukkan nama anda" class="box" name="name">
            <input type="email" required maxlength="50" placeholder="Masukkan email anda" class="box" name="email">
            <input type="password" required maxlength="50" placeholder="Masukkan password anda" class="box" name="password">
            <input type="password" required maxlength="50" placeholder="Confirmasi password anda" class="box" name="cpassword">
            <input type="submit" value="Daftar Sekarang" name="submit" class="btn">
            <p>Sudah memiliki akun? <a href="login.php">Login sekarang</a></p>
        </form>

    </section>

    <!-- register section end -->

</body>
</html>