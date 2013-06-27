<?
require_once "template_utils.php";
require_once "fillers/AbstractFiller.php";

class MainFiller extends AbstractFiller {
	public function __construct($lang) {
		parent::__construct("main");
		$content = $this -> content;
		$content = substMessages($content, $this -> dictionary, $lang);
		
		$peterhof_link = "http://www.peterhof.ru";
		$spbu_link = "http://www.spbu.ru";
		$jetbrains_link = "http://www.jetbrains.com";
		$content = str_replace("%PETERHOF_LINK%", $peterhof_link, $content);
		$content = str_replace("%SPBU_LINK%", $spbu_link, $content);
		$content = str_replace("%JETBRAINS_LINK%", $jetbrains_link, $content);
		
		$this -> content = $content;
	}
}
?>