<?php
/* Template Name: Test API Page */

require_once('lib/ExtDCR.php');
$ext = new ExtDCR();
$info = $ext->getCountyPage('extension.purdue.edu/benton');

?>

<?php //begin article news feed ?>
<?php foreach($info['articles'] as $article): ?>
    <?php include('includes/feed-article.php'); ?>
<?php endforeach; ?>
<?php //end article news feed ?>
