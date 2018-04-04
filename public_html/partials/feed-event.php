<?php
/**
 * Homepage Event Feed List
 */
?>
<ul>
<?php foreach($events as $event): ?>
    <li><?php print_r($event); ?></li>
<?php endforeach; ?>
</ul>
