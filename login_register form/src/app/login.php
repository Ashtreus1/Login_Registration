<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../style/form.css">
    <title>Login Account</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container">
            <h2>Login Account</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" id="username" name="username" placeholder="Username" required><br><br>
                <input type="password" id="password" name="password" placeholder="Password" required><br><br>
                <button type="submit">Login</button>
				<a href="forgotPassword.php" class="forgot-password">Forgot Password?</a>
            </form>
        </div>
        <div class="comment-container">
            <div class="comment">
                <h1>Register your account!</h1>
                <p>Join us today by signing up your credentials!</p>
                <button class="hidden" id="login" onclick="window.location.href='register.php';">Sign Up</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";
        });
    </script>

</body>
</html>

<?php
session_start();

function displayAlert($message) {
    ob_start(); 
    ?>
    <div class="alert" id="alert">
        <h4><?php echo $message; ?></h4>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.getElementById('alert');
            alert.classList.add('show-alert');
            setTimeout(function(){
                alert.classList.remove('show-alert');
            }, 3000);
        });
    </script>
    <?php
    $output = ob_get_clean(); 
    echo $output;
}

function authenticateUser($username, $password) {
    $file = 'forms.txt';
    $lines = file($file, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        $data = explode(",", $line);
        if (count($data) >= 3) {
            $stored_username = substr($data[0], 11); 
            $stored_password = substr($data[2], 11, -1); 
            if(trim($username) === trim($stored_username) && password_verify($password, trim($stored_password))) {
                return true;
            }
        }
    }

    return false;
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(authenticateUser($username, $password)) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        displayAlert("Invalid username or password");
    }
}
?>
