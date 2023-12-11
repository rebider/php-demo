<!-- Php area is referred from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php -->
<!doctype html>
<?php
//Initialize the session
session_start();
// Check if the user is already logged in, if yes => redirect to welcome page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
}

require "header.php";
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate new password
    if(empty(trim($_POST['new_password']))) {
        $new_password_err = "Please enter a password";
    } elseif(strlen(trim($_POST['new_password'])) < 6 ) {
        $new_password_err = "Password must have at least 6 characters.";
    } else {
        $new_password = trim($_POST['new_password']);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    // Check input error before inserting
    if(empty($new_password_err) && empty($confirm_password_err)) {
        $sql = "UPDATE users SET passwd = :passwd WHERE id = :id";
        if($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":passwd", $param_passwd, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            $param_passwd = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION['id'];
            
            //Execute it
            if($stmt->execute()) {
                // UPdate password successfully and destroy the session
                session_destroy();
                header("location: ../login.php");
                exit();
            } else {
                echo "Ouch! Something went wrong, please try later....";
            }
            //Close statement
            unset($stmt);
        }
    }
    // close connection
    unset($pdo);
}
?>
        <div class="text-center">
            <h2>Reset Password</h2>
            <p>Please fill out below form to reset your password</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3 row justify-content-center">
                    <label for="inputPassword" class="form-label" >New Password</label>
                    <div class="col-3">
                        <input type="password" name="new_password" class="form-control <?php echo(!empty($new_password_err)) ? 'is-invalid' : '';?>" value="<?php echo $new_password; ?>" >
                        <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <label for="inputPassword" class="form-label">Confirm Password</label>
                     <div class="col-3">
                        <input type="password" name="confirm_password" class="form-control <?php echo(!empty($cpmfirm_password_err)) ? 'is-invalid' : '';?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                </div>
                <div calss="mb-3">
                    <button type="submit" class="btn btn-primary mb-3" value="Submit" onclick="alert('If password modified successfully, will back to Login page..')" >Submit</button>
                    <a class="btn btn-secondary mb-3" href="manage.php">Cancel</a></button>
                </div>
            </form>
        </div>
    </body>
</html>
