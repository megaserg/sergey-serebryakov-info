<?
require_once "template_utils.php";
require_once "fillers/AbstractFiller.php";

class HeaderFiller extends AbstractFiller {
	public function __construct($page, $lang) {
		parent::__construct("header");
		$content = $this -> content;
		
		// Define the greeting.
		if ($page == "404") {
			$greetings = array("{{HEADER404_UHOH}}", "{{HEADER404_OOPS}}");
		}
		else {
			$greetings = array("{{HEADER_WELCOME}}", "{{HEADER_HELLO}}");
		}
		$content = str_replace("%HEADER_MESSAGE%", $greetings[rand(0, count($greetings)-1)], $content);
		
		$languages = array("ru" => "RU", "en" => "EN");
		// German isn't supported yet.
		//$languages = array("ru" => "RU", "en" => "EN", "de" => "DE");
		
		// Link every language.
		foreach ($languages as $language => $upperlang) {
			$lang_begin[$language] = "<a class=\"langlink\" href=\"/$language/$page/\">";
			$lang_end[$language] = "</a>";
		}
		
		// Unlink current language.
		$lang_begin[$lang] = "<span class=\"currentlanglink\">";
		$lang_end[$lang] = "</span>";
		
		// Construct the language block.
		$language_block = "";
		foreach ($languages as $language => $upperlang) {
			$language_block .= $lang_begin[$language] . $language . $lang_end[$language] . "\n";
		}
		
		$content = str_replace("%HEADER_LANGUAGE_BLOCK%", $language_block, $content);
		
		$content = substMessages($content, $this -> dictionary, $lang);
		$this -> content = $content;
	}
}
?>