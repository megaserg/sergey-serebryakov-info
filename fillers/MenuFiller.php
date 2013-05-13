<?
require_once "template_utils.php";
require_once "fillers/AbstractFiller.php";

class MenuFiller extends AbstractFiller {
	public function __construct($page, $lang) {
		parent::__construct("menu");
		$content = $this -> content;
		$content = substMessages($content, $this -> dictionary, $lang);
		
		// Unlink current menu element.
		$pagelinks = array("main" => "", "bio" => "bio", "projects" => "projects", "contacts" => "contacts");
		$pageupper = array("main" => "MAIN", "bio" => "BIO", "projects" => "PROJECTS", "contacts" => "CONTACTS");
		
		foreach ($pagelinks as $pagename => $pagelink) {
			$menu_begin[$pagename] = "<a class=\"menulink\" href=\"/$lang/$pagelink\">";
			$menu_end[$pagename] = "</a>";
		}
		
		$menu_begin[$page] = "<span class=\"currentmenulink\">";
		$menu_end[$page] = "</span>";
		
		foreach ($pageupper as $pagename => $upperpage) {
			$content = str_replace("%MENU_" . $upperpage . "_BEGIN%", $menu_begin[$pagename], $content);
			$content = str_replace("%MENU_" . $upperpage . "_END%", $menu_end[$pagename], $content);
		}
		
		$this -> content = $content;
	}
}
?>