<?php include('head.php'); ?>

<span class="output running"><i class="material-icons">done</i><?php

echo "disk: ";

$free = disk_free_space('/');
$total = disk_total_space('/');
$used = $total - $free;
$percent = ($used/$total)*100;

echo round(($used/(1024*1024)),2) . "MB / " . round(($total/(1024*1024)),2) . "MB = " . round($percent,2) . "% used";
?></span>

<?php include('links.php'); ?>

<?php include('footer.php'); ?>
