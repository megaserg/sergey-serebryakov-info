<?
require_once "directories_config.php";
require_once "dictionary_utils.php";

$page = "main";
if (!empty($_GET['page'])) $page = $_GET['page'];

$inDict = "";
if (!empty($_POST['dict'])) $inDict = $_POST['dict'];

$dictionaryFile = $DICTIONARIES_DIRECTORY . $page . ".dic";
$dictionary = readDictionary($dictionaryFile);

echo "<h2>$dictionaryFile</h2>";

echo "<form method=POST>";

foreach ($dictionary as $name => $record) {
    echo "$name<br />\n";
    foreach ($record as $lang => $trans) {
        echo "<b>$lang:</b> <input name=\"$name\" value=\"" . htmlspecialchars($trans) . "\" />\n";
    }
    echo "<br />\n";
}

echo "</form>";

$dictionaryResultFile = $dictionaryFile . ".test";
writeDictionary($dictionaryResultFile, $dictionary);
?>
