<!-- Php area is referred from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php -->

<?php 
// Include config file
require "functions/header.php";
require_once "functions/config.php";

$username = $email = $passwd = "";
$username_err = $email_err = $passwd_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if(empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and undercross.";
    } else {
        //Prepare a statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)) {
            //Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            // Set parameters
            $param_username = trim($_POST["username"]);
            // Attempt to execute the prepared statement
            if($stmt->execute()){ 
                if($stmt->rowCount() == 1) {
                    $username_err = "This username is already taken...";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later...";
            }
            // Clsoe statement
            unset($stmt);
        }
    }
    
    // Manage email format
    if(empty(trim($_POST['email']))) {
        $email_err = "Please enter a Email address";
    } else {
        $email = trim($_POST['email']);
    }
    
    // Validate password
    if(empty(trim($_POST['passwd']))) {
        $passwd_err = "Please enter a password";
    } elseif(strlen(trim($_POST['passwd'])) < 6 ) {
        $passwd_err = "Password must have at least 6 characters.";
    } else {
        $passwd = trim($_POST['passwd']);
    }
    // Check input errors before inserting in DB
    if(empty($username_err) && empty($email_err) && empty($passwd_err)) {
        $sql = "INSERT INTO users (username, email, passwd) VALUES (:username, :email, :passwd)";
        if($stmt = $pdo->prepare($sql)) {
            //Bind variables -> statement
            $stmt->bindParam(":username", $param_username);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":passwd", $param_passwd);
            $param_username = $username;
            $param_email = $email;
            $param_passwd = password_hash($passwd, PASSWORD_DEFAULT); // create a password hash
            
            // Execute trhe statement
            if($stmt->execute()) {
                //Redirect to login page
                header("location: login.php");
            } else {
                echo "Ouch! Something went wrong. Please try again later...";
            }
            //close statement
            unset($stmt);
        }
    }
    //close connection
    unset($pdo);
}

?>
        <form class="container" name="insert" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <div class="mb-3 row justify-content-center">
                <div class="col-sm-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control <?php echo(!empty($username_err)) ? 'is-invalid' : '';?>" value="<?php echo $username; ?>" id="floatingInputGrid" placeholder="Username" >
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        <label for="floatingInputGrid" >Userame</label>
                    </div>
                </div>
            </div>
            <div class="form-floating mb-3 row justify-content-center">
                <div class="col-sm-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="email" class="form-control <?php echo(!empty($email_err)) ? 'is-invalid' : '';?>" value="<?php echo $email; ?>" id="floatingInputGrid" placeholder="E-mail address">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        <label for="floatingInputGrid">Email Address</label>
                    </div>
                </div>
            </div>
            <div class="mb-3 row justify-content-center">
                <div class="col-sm-3">
                    <div class="form-floating mb-3">
                        <input type="password" name="passwd" class="form-control <?php echo(!empty($passwd_err)) ? 'is-invalid' : '';?>" value="<?php echo $passwd; ?>"  id="floatingInputGrid" placeholder="Password" required>
                        <span class="invalid-feedback"><?php echo $passwd_err; ?></span>
                        <label for="floatingInputGrid">Password</label>
                    </div>
                </div>
            </div>
            <div calss="mb-3">
                <button type="submit" class="btn btn-primary mb-3" value="Submit">Submit</button>
                <button type="Reset" class="btn btn-secondary mb-3" value="Reset">Reset</button>
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
        
        <?php
        // for debug
        //  echo "<h3>The input --</h3>";
        //  echo $username, "<br/>";
        //  echo $email, "<br/>";
        //  echo $passwd, "<br/>";
        ?>
    </body>
</html>
