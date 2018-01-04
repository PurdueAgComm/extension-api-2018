<?php
/**
 * Feed item/article markup
 */
?><?php if(isset($article->thumb)): ?>
    <a href="article.aspx?intItemID=<?php echo $article->intItemID; ?>">
        <img src="<?php echo $article->thumb->url; ?>" alt="<?php echo $article->thumb->alt; ?>" />
    </a>
<?php endif; ?>
<?php if($article->bln4H === true): ?>
    <?php //todo: move this 4H Logo into WP media library ?>
    <img alt="4-H Logo" src="https://extension.purdue.edu/Style%20Library/Extension/images/4HLogo.gif" width="50" height="50">
<?php endif; ?>
<a href="article.aspx?intItemID=<?php echo $article->intItemID; ?>"><?php echo $article->strTitle; ?></a>
<div>
    <p>
        <?php echo $article->strShortBody; ?>
    </p>
</div>
<div>
    <a href="article.aspx?intItemID=<?php echo $article->intItemID; ?>">read more...</a>
</div>