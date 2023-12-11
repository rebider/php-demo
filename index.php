<?php 
require 'functions/header.php'; 

class getAllPosts {
	public function fetch_all_data() {
		require "functions/config.php";
		$all_data = $pdo->query("SELECT title, date, content FROM posts")->fetchAll();
		return $all_data;
	}
}

?>

        
        <div class="container mt-3" >
            <div class="row g-2">
                <div class="col-md-8 gv-3 px-4">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="height:600px; overflow:hidden;">
                        <h2 class="alert alert-info text-center">Top Rated Places</h2>
                        <p>   Sed sit amet augue congue, tincidunt ligula pretium, acumin dolor ligula dolor condimentum leo.
                        Proin vel diam sit amet orci tincidunt commodo. Nulla acumin ligula, dolor sit buncha elementum ligula.</p>
                        <div class="carousel-inner">
                            <!-- image slide from folder w/ php -->
                            <?php
                                $dir = "images/";
                                $images = glob($dir . "*.{JPG,jpg,gif,png,bmp}" , GLOB_BRACE);
                                $length = count($images);
                                $flag = 0; # The flag is used to identify if it's the 1st image or not
                                foreach ($images as $image) {
                                    #echo $image;
                                    $class='';
                                    if ($flag == 0) { $class='active'; }
                                    #echo '<div class="carousel-item' .($flag?' active':''). '">';
                                    echo '<div class="carousel-item ' .$class. '">';
                                    echo '<img src="' .$image. '" class="d-block w-100"></div>';
                                    $flag++; 
                                }
                            ?>
                                    
                        </div>

                          
                        <!-- next/prev control -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
		    <div class="accordion accordion-flush" id="accordionFlush">
			    <?php
			    $all_posts = new getAllPosts;
			    $post_data = $all_posts->fetch_all_data();
			    foreach($post_data as $post) {
				    print "<div class='accordion-item'>";
			            print "<h2 class='accordion-header'>";
				    print "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse' aria-expanded='false' aria-controls='flush-collapse'>Title: $post[0]</button></h2>";
				    print "<div id='flush-collapse' class='accordion-collapse collapse' data-bs-parent='accordion-flush'><div class='accordion-body'>";
		        	    print "<figcaption class='blockquote-footer'>Date: $post[1]</figcaption>";
			            print "<p>$post[2]</p></div></div></div>";
			    }
			    ?>
		    </div>
                </div>
                <!-- Sidebar section-->
                <div class="col-md-4 gv-3 px-4">
                    <h4 class="alert alert-primary text-center">News Feed</h4>
                    <?php require 'functions/rss.php';
                    $rss = 'data/rr.rss';
                    show_title($rss);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
