<?php
require_once("../lib/Items.php");
$id = $_GET['id'];

Items::increment($id);
?>