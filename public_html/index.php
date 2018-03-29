<?php
    require_once(dirname(__FILE__).'/../src/lib/ExtDCR.php');
    $ext = new SFP\PurdueAg\ExtDCR('extension.purdue.edu/');
    $header = $ext->getHeaderElements('extension.purdue.edu/');
    $menu = $ext->getMenu('extension.purdue.edu/');
    $page = $ext->getCountyPage('extension.purdue.edu/');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Page Test</title>
</head>
<body>
    <div id="header">
        <h2>Social Media</h2>
        <pre>
            <?php var_dump($header['social']); ?>
        </pre>
        <h2>Menu</h2>
        <pre>
            <?php var_dump($menu); ?>
        </pre>
    </div>
    <div id="cta">
        <h2>Call to Action</h2>
        <pre>
            <?php var_dump($page['cta']); ?>
        </pre>
    </div>
    <h2>Articles</h2>
    <div id="articles">
    <pre>
        <?php var_dump($page['articles']); ?>
    </pre>
    </div>
    <div id="events">
        <h2>Events</h2>
        <pre>
            <?php var_dump($page['events']); ?>
        </pre>
    </div>
</body>
</html>