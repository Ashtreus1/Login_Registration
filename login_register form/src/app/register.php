<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../style/form.css">
    <title>Register Account</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <h1>Create Account</h1>
                <input type="text" name="username" placeholder="Username">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="submit">Register Account</button>
            </form>
        </div>
        <div class="comment-container">
            <div class="comment">
                <h1>Welcome Back!</h1>
                <p>Enter your personal details to use all site features</p>
                <button class="hidden" id="login" onclick="window.location.href='login.php';">Sign In</button>
            </div>
        </div>
    </div>

    <?php 
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

        function isDuplicate($username, $email){
            $file = 'forms.txt';

            if(file_exists($file)){
                $lines = file($file, FILE_IGNORE_NEW_LINES);

                foreach ($lines as $line) {
                    $data = explode(",", $line);

                    // Check if $data has at least 2 elements
                    if (count($data) >= 2) {
                        if($data[1] === " Email: {$email}" or $data[0] === " Username: {$username}"){
                            return true;
                        }
                    }
                }
            }
            return false;
        }

        function isPasswordValid($password){
            $minLength = 8;

            if(strlen($password) > $minLength){
                return true;
            }

            if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $password)){
                return true;
            }

            return false;
        }

        if(isset($_POST["submit"])){
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            $hash = password_hash($password, PASSWORD_DEFAULT);

            if ($email === false) {
                displayAlert("Invalid email address. Please enter a valid email.");
            } elseif (empty($username) || empty($email) || empty($password)) {
                displayAlert("Please fill in all fields.");
            } elseif(isDuplicate($username, $email)){
                displayAlert("Email or username is already taken.");
            } elseif(!isPasswordValid($password)) {
                displayAlert('Password must be 8+ characters with at least 1 uppercase, 1 lowercase, 1 digit, and 1 special character.');
            } else {
                $fhandler = fopen('forms.txt', 'a');
                $forms = "[Username: {$username}, Email: {$email}, Password: {$hash}]\n";
                fwrite($fhandler, $forms);
                fclose($fhandler);
                displayAlert("Registration successful!");
            }
            
        }
    ?>
</body>
</html>
