<?php
require_once("../lib/Items.php");
$arrPictures = Items::getGalleryImages($_GET['id']);
