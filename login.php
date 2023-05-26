<?php 

    require_once 'connect.php';
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        
        $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
        $select_users->execute([$email, $pass]);
        $row = $select_users->fetch(PDO::FETCH_ASSOC);


        if($select_users->rowCount() > 0){
             setcookie('user_id', $row['id'], time() + 60*60*24, '/');
             header('location: home.php');
            } else {
                $mesage[] = 'Email atau sandi Salah!';
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- link font cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- khusus file css -->
    <link rel="stylesheet" href="css/home.css">

</head>
<body>
<?php 
        if(isset($message)){
            foreach($message as $message){
                echo '
                <div class="message">
                    <span>'. $message .'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove"></i>
                </div>
                ';
            }
        }
    ?>
    <!-- register section start -->

    <section class="form-container">

        <form action="" method="post">
            <h3>Login sekarang</h3>
            <input type="email" required maxlength="50" placeholder="Masukkan email anda" class="box" name="email">
            <input type="password" required maxlength="50" placeholder="Masukkan password anda" class="box" name="pass">
            <input type="submit" value="Login Sekarang" name="submit" class="btn">
            <p>Tidak memiliki akun? <a href="register.php">Login sekarang</a></p>
        </form>

    </section>

    <!-- register section end -->

</body>
</html>