<?php
/** Begin Bootstrap */

//require the application functions file
require_once('../app/functions.php');

//set the homepath URL variable
$homepath = 'extension.purdue.edu/';

//kick off the bootstrap
bootstrap();

/** End Bootstrap */
?>
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<div id="header">
    <h2>Menu Example</h2>
    <?php get_menu(); ?>
</div>

<div class="content">

    <div id="banner">
        <h2>Banner Example</h2>
        <?php get_banner(); ?>
    </div>

    <div id="articles">
        <h2>Articles Example</h2>
        <?php get_article_list(7, 0); ?>
    </div>

    <div id="navigation">
        <h2>Navigation Example</h2>
        <?php get_navigation(); ?>
    </div>

    <div id="events">
        <h2>Events</h2>
        <?php get_event_list(5, 0); ?>
    </div>

</div>

<div id="footer">
    <?php get_footer(); ?>
</div>
</body>
</html>
