<?
require_once "directories_config.php";
require_once "language_config.php";
require_once "template_utils.php";
require_once "dictionary_utils.php";

class AbstractFiller {
	protected $content;
	protected $dictionary;
	
	protected function __construct($page) {
		global $TEMPLATES_DIRECTORY, $DICTIONARIES_DIRECTORY;
		global $DEFAULT_LANGUAGE;
		
		$templateFile = $TEMPLATES_DIRECTORY . $page . ".tpl";
		$this -> content = readTemplate($templateFile);
		
		$dictionaryFile = $DICTIONARIES_DIRECTORY . $page . ".dic";
		$this -> dictionary = readDictionary($dictionaryFile);
	}
	
	public function getContent() {
		return $this -> content;
	}
}
?>