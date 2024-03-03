<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

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

function updatePassword($username, $newPassword) {
    $file = 'forms.txt';
    $lines = file($file, FILE_IGNORE_NEW_LINES);

    $updatedLines = array();
    $updated = false;

    foreach ($lines as $line) {
        $data = explode(",", $line);
        if (count($data) >= 3) {
            $stored_username = explode(": ", $data[0])[1];
            if (trim($username) === trim($stored_username)) {
                $data[2] = " Password: " . password_hash(trim($newPassword), PASSWORD_DEFAULT)."]";
                $updated = true;
            }
        }
        $updatedLines[] = implode(",", $data);
    }

    if ($updated) {
        file_put_contents($file, implode("\n", $updatedLines));
        return true;
    } else {
        return false;
    }
}

if(isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        if (updatePassword($_SESSION['username'], $newPassword)) {
            displayAlert("Password updated successfully");

            // Redirect to login.php after 5 seconds with countdown message
            echo '<script>
                    var countdown = 5;
                    var countdownInterval = setInterval(function() {
                        countdown--;
                        if (countdown >= 0) {
                            document.getElementById("countdown").innerText = "Redirecting in " + countdown + " seconds";
                        } else {
                            clearInterval(countdownInterval);
                            window.location.href = "login.php";
                        }
                    }, 1000);
                </script>';
        } else {
            displayAlert("Failed to update password");
        }
    } else {
        displayAlert("Passwords do not match");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../style/form.css">
    <title>Update Password</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Update Password</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="password" name="new_password" placeholder="New Password" required><br><br>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required><br><br>
                <button type="submit">Update Password</button>
            </form>
            <p id="countdown"></p>
        </div>
    </div>
</body>
</html>
