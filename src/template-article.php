<?php /* Template Name: Article Wordpress Template */

require_once('lib/ExtDCR.php');

$ext = new ExtDCR();

$article = $ext->getArticlePage(8779);

?>

<?php var_dump($article); ?>
