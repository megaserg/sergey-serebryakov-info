<?php
require_once "language_config.php";
require_once "fillers/IndexFiller.php";

$page = "main";
if (!empty($_GET['page'])) $page = $_GET['page'];

$lang = $DEFAULT_LANGUAGE;
if (!empty($_GET['lang'])) $lang = $_GET['lang'];

$index = new IndexFiller($page, $lang);
echo $index -> getContent();
?>