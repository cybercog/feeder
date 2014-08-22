<?php

    header( 'Content-Type: text/html; charset=UTF-8' );

    if (isset($_GET['grab'])) {
        require_once("grab.php");
        $got = new Grab();        
    }
?>

<html>
    <head>
        <title>RSS Reader</title>
            <link rel="alternate" type="application/rss+xml" title="Daily Digest" href="rss/3dnews.xml" />
    </head>
    
    <body>
        <form method="get" action="." />
            <input type="submit" name="grab" value="3d news" />
        </form>
    </body>
</html>