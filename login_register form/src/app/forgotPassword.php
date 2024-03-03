<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../style/form.css">
    <title>Verify Username</title>
</head>
<body>
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

    session_start();

    $file = 'forms.txt';

    if(isset($_POST['username'])) {
        $username = $_POST['username'];

        $lines = file($file, FILE_IGNORE_NEW_LINES);

        $found = false;
        foreach ($lines as $line) {
            $data = explode(",", $line);
            if (count($data) >= 3) {
                $stored_username = substr($data[0], 11);
                if(trim($username) === trim($stored_username)) {
                    $_SESSION['username'] = $username;
                    $found = true;
                    header("Location: updatePassword.php");
                    exit;
                }
            }
        }

        // Username not found, display alert
        if (!$found) {
            displayAlert("Username not found.");
        }
    }
    ?>
    
    <div class="container">
        <div class="form-container">
            <h2>Verify Username</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="username" placeholder="Username" required><br><br>
                <button type="submit">Verify</button>
            </form>
        </div>
    </div>
</body>
</html>
