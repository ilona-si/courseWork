<?php

require_once("../lib/Items.php");
if ($_POST['id']!="") {
	Items::addToOrder($_POST['id'],$_POST['amount']);
}

header("Location:$_SERVER[HTTP_REFERER]")


?>