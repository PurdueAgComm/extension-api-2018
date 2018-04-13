<?php
    preg_match('~^(.*)/category/(?P<cat_id>(\d+))(.*)$~',$_SERVER['REQUEST_URI'],$matches);
    if(isset($matches['cat_id'])){
        $cat_id = (int) $matches['cat_id'];
    }
    $page_size = 7;
    $page_count = 0;
    if(isset($_GET['ps'])){
        $page_size = (int) $_GET['ps'];
    }
    if(isset($_GET['pc'])){
        $page_count = (int) $_GET['pc'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<h1>Category Page</h1>

<?php get_category_list($cat_id, $page_size, $page_count); ?>

</body>
</html>