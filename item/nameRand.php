<?php
require_once("../lib/Items.php");
foreach($randomItems as $i=>$v)
	$randomItems[$i]['name'] = Items::proceedName($randomItems[$i]['name']);

?>