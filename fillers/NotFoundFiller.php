<?
require_once "template_utils.php";
require_once "fillers/AbstractFiller.php";

class NotFoundFiller extends AbstractFiller {
	public function __construct($lang) {
		parent::__construct("404");
		$content = $this -> content;
		$content = substMessages($content, $this -> dictionary, $lang);
		$this -> content = $content;
	}
}
?>