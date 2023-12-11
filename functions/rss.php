<?php
function show_title($rssURL) {
    // refer below code from : https://phppot.com/php/php-rss-feed-read-and-list/ 
    $rss_feed = simplexml_load_file($rssURL);
    if (!empty($rss_feed)) {
        $i = 0;
        foreach ($rss_feed->channel->item as $feed_item) {
            if ($i >= 5)
            break;
            echo "<div>";
	              echo '<p><strong><a class="feed_title text-decoration-none" href="'. $feed_item->link.'" target="_blank">'.$feed_item->title.'</a></strong></p>';
            echo "</div>";
            //echo "<br/>";
            $i ++;
        }
    }
    
}
?>
