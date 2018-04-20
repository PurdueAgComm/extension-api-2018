<?php
preg_match('~^(.*)/article/(?P<article_id>(\d+))(.*)$~',$_SERVER['REQUEST_URI'],$matches);
if(isset($matches['article_id'])){
    $article_id = (int) $matches['article_id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<h1>Article Page</h1>

<?php get_article($article_id); ?>

</body>
</html>