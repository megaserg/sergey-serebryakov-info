<?
require_once "template_utils.php";
require_once "fillers/AbstractFiller.php";

class FooterFiller extends AbstractFiller {
    public function __construct($lang) {
        parent::__construct("footer");
        $content = $this -> content;
        $content = substMessages($content, $this -> dictionary, $lang);

        // set current year
        $year = date("Y");
        $content = str_replace("%CURRENT_YEAR%", $year, $content);

        $this -> content = $content;
    }
}
?>
