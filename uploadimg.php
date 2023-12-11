<!-- Php area is referred from https://www.allphptricks.com/upload-file-using-php-save-directory/ -->
<?php
// Initialize a session
session_start();

// Include config file
require_once("functions/config.php");
require("functions/manage_header.php");


// Check if the user is logged in, if not -> login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: http://site1.guosi.site/login.php");
    exit;
} 

?>

        <div class="container-xl mt-4">
            <h3 class="my-3">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to manage page</h3>
            <div class="row">
                <div class="col-md-8">
                <p>Please upload image for the slide show</p>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <input type="file" name="image" accept="images/*">
                    <input type="submit" name="submit" value="Upload">
                </form>
                <?php
                    //******** Upload image function *********
                    // Set where the images is stored
                    if(!empty($_FILES["image"]["name"])) {
                        $errors = "";
                        $target_dir = "images/";
                        $maxsize    = 2097152;
                        $img_file = $_FILES["image"]["name"];
                        $img_size = $_FILES["image"]["size"];
                        $path = pathinfo($img_file);
                        $filename = $path["filename"];
                        $ext = $path["extension"];
                        $temp_name = $_FILES["image"]["tmp_name"];
                        $path_filename_ext = $target_dir.$filename.".".$ext;
                     
                         // Check if file already exists
                        if(file_exists($path_filename_ext)) {
                            echo "Sorry, file already exists...";
                        } 
                        if(($img_size >= $maxsize) || ($img_size == 0))  {
                            $errors = 'File too large. File must be less than 2 megabytes.';
                        } 
                        if ($errors == null) {
                            move_uploaded_file($temp_name, $path_filename_ext);
                            printf("<br> Great! File uploaded successfully.<br> ");
                        } else {
                            foreach ($errors as $error) {
                                echo '<script>alert("'.$error.'")</script>';
                            }
                        }
                        //printf("Here is some more debugging info:<br> ");
                        //print_r($_FILES);
                    }
                    ?>
                </div>
            <div class="col gy-3">
                <a href="functions/reset-passwd.php" class="btn btn-warning"> Reset Your password</a>
                <a href="logout.php" class="btn btn-danger ml-3"> Sign Out of your account</a>
            </div>
        </div>
        </div>
    </body>
</html>