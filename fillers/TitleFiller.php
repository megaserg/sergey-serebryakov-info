<?
require_once "template_utils.php";
require_once "fillers/AbstractFiller.php";

class TitleFiller extends AbstractFiller {
	public function __construct($page, $lang) {
		parent::__construct("title");
		$content = $this -> content;
		
		switch ($page) {
			case "main":
				$content = $content . ". {{TITLE_HOMEPAGE}}";
				break;
			case "bio":
				$content = "{{TITLE_BIO}} / " . $content;
				break;
			case "projects":
				$content = "{{TITLE_PROJECTS}} / " . $content;
				break;
			case "contacts":
				$content = "{{TITLE_CONTACTS}} / " . $content;
				break;
			default:
				$content = "{{TITLE_ERROR404}}";
		}
		
		$content = substMessages($content, $this -> dictionary, $lang);
		$this -> content = $content;
	}
}
?>