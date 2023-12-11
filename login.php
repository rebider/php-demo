<?php
# Refer to : https://stackoverflow.com/questions/44557532/pdo-query-inside-a-php-function
//$user='balajan';

/*function dbConnect() {
	try {
		$sqlite = new PDO('sqlite:dbs/site1.db');
		$sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $sqlite;
	} catch (PDOException $e) {
	    exit("Error: Could not connect. " . $e->getMessage());
	}
}*/

//Initialize the session
session_start();
// Check if the user is already logged in, if yes => redirect to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: manage.php");
    exit;
}

require "functions/header.php";

function getUserCount($user) {
	try {
		//Get how many rows for a specific username
//		$pdo = dbConnect();
		require "functions/config.php";
                $result = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username= ?");
                $result->execute([$user]);
                $rows = $result->fetchColumn();
		return "$rows";
        } catch (Exception $e) {
                print "Query failed: " . $e->getMessage();
                return false;
        }
}


function getUserData($user) {
	try {
		// Retrieve data for a specific user and return an array
//		$pdo = dbConnect();
		require "functions/config.php";
		$user_data = $pdo->query("SELECT id, username, passwd from users where username= '$user'")->fetch();
		$id = $user_data['id'];
		$username = $user_data['username'];
		$hashed_passwd = $user_data['passwd'];
		return array($id, $username, $hashed_passwd);
	} catch (Exception $e) {
		print "SQL query failed: " . $e->getMessage();
		return false;
	}
}

# Inject
/*$num_rows = getUserCount($user);
print "$num_rows";
$account_data = getUserData($user);
print "$account_data[0], $account_data[1], $account_data[2]";*/
//-------------------------------------------------------------------

$user = $passwd = "";
$username_err = $passwd_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //Check if username-password is empty
    if(empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username";
    } else {
        $user = trim($_POST["username"]);
    }
    // Check password
    if(empty(trim($_POST["passwd"]))) {
        $passwd_err = "Please enter a valid password";
    } else {
        $passwd = trim($_POST["passwd"]);
    }
// Validate credentials
    if(empty($username_err) && empty($passwd_err)) {
	$num_rows = getUserCount($user);
	if($num_rows == 1) {
		$account_data = getUserData($user);
		$id = $account_data[0];
                $username = $account_data[1];
                $hashed_passwd = $account_data[2];
		if(password_verify($passwd, $hashed_passwd)) {
			// password correct -> start a new session
                        // If the session is not set...
                        if(!isset($_SESSION)) {
				session_start();
                        }
                            // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;

                        //Rediredct the user to manage page
                        header("Location: manage.php");
                } else {
               		// password invalid -> error msg
			$login_err = "Invalid password";
                }
	} else {
                    // Username non-exists, display Err Msg
                    $login_err = "Invalid username";
        } 
    } else {
	echo "Ouch! Something went wrong, please try latter...";
    }
}

?>
    <main class="form-signin ">
        <div class="text-center">
        <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
            <?php
            if(!empty($login_err)) {
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                // debug use
                print " user= $user ,  count= $num_rows";
            }
            ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row justify-content-center">
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-3 ">
                    <div class="form-floating mb-3">
                        <input type="password" name="passwd" class="form-control <?php echo (!empty($passwd_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $passwd; ?>" >
                        <span class="invalid-feedback"><?php echo $passwd_err; ?></span>
                        <label for="floatingInputGrid">Password</label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <input type="submit" class="btn btn-primary mb-3" value="Login">
                    <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
                </div>
            </div>
        </form>
        </div>
    </main>
    </body>
</html>

