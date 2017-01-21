<?
require_once "template_utils.php";
require_once "fillers/AbstractFiller.php";

class BioFiller extends AbstractFiller {
    public function __construct($lang) {
        parent::__construct("bio");
        $content = $this -> content;
        $content = substMessages($content, $this -> dictionary, $lang);
        $this -> content = $content;
    }
}
?>
