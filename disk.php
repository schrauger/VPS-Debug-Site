<?php include('head.php'); ?>

<span class="output running"><i class="material-icons">done</i><?php

echo "disk: ";

$free = disk_free_space('/');
$total = disk_total_space('/');
$percent = ($free/$total)*100;

echo $free . " / " . $total . " = " . $percent . "% used";
?></span>

<?php include('links.php'); ?>

<?php include('footer.php'); ?>
