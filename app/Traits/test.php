<?php
    if(isset($_GET['deleteID'])) {
       dd(true);
        if($result)
            echo "succces";

    } else {
        echo 'GET NOT SET';
    }
?>