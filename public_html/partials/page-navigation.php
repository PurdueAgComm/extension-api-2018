<?php
/**
 * local variable $navigation must be set by the function including this partial
 *
 * home and about links are implied to be always present.  the rest are dynamic.
 *
 * we are using the listMenuCategories intCategoryID and strCategoryText instead of the strCategoryURL since those are hardset to the current application.
 *
 * we are honoring the sub-category list menu links node URL as-is.
 *
 * SFP Note: This is merely a suggestion on how to go about the menu, rewrite however you prefer to build megamenu navigation.
 */

$root = $navigation->currentHome->strPublicURLRoot;
$hid = $navigation->currentHome->intHomeID;

?>
<ul>
    <?php foreach($navigation->listMenuCategories as $cat):?>
        <li>
            <a href="//<?php echo $root;?>pages/category.php?hid=<?php echo $hid;?>&cat=<?php echo $cat->intCategoryID;?>"><?php echo $cat->strCategoryText;?></a>
            <ul>
                <?php foreach($cat->listMenuSubCategories as $subcat):?>
                    <li>
                        <a href="//<?php echo $root;?>pages/subcategory.php?hid=<?php echo $hid;?>&subcat=<?php echo $subcat->intSubCatID;?>"><?php echo $subcat->strSubCatText;?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>