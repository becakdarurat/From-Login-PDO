<?php 

    require_once 'connect.php';
    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
        
        $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_users->execute([$email]);
        if ($select_users->rowCount() > 0){
            $message[] = 'email sudah di ambil!';
        } else {
            if($pass != $cpass){
                $message[] = 'konfirmasi kata sandi tidak cocok!';
            } else {
                $insert_user = $conn->prepare("INSERT INTO `users`(name,email,password) VALUES (?,?,?)");
                $insert_user->execute([$name,$email,$cpass]);
                if($insert_user){
                    $fetch_user = $conn->prepare("SELECT * FROM `users` WHERE email 
                    = ? AND password = ?");
                    $fetch_user->execute([$email,$cpass]);
                    $row = $fetch_user->fetch(PDO::FETCH_ASSOC);
                    if($fetch_user->rowCount() > 0){
                        setcookie('user_id', $row['id'], time() + 60*60*24, '/');
                        header('location: home.php');
                    }
                }
            }
        }
    }

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
            <h3>Daftar sekarang</h3>
            <input type="text" required maxlength="20" placeholder="Masukkan nama anda" class="box" name="name">
            <input type="email" required maxlength="50" placeholder="Masukkan email anda" class="box" name="email">
            <input type="password" required maxlength="50" placeholder="Masukkan password anda" class="box" name="pass">
            <input type="password" required maxlength="50" placeholder="Confirmasi password anda" class="box" name="cpass">
            <input type="submit" value="Daftar Sekarang" name="submit" class="btn">
            <p>Sudah memiliki akun? <a href="login.php">Login sekarang</a></p>
        </form>

    </section>

    <!-- register section end -->

</body>
</html>