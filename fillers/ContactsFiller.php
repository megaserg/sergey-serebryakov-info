<?
require_once "template_utils.php";
require_once "fillers/AbstractFiller.php";

class ContactsFiller extends AbstractFiller {
    public function __construct($lang) {
        parent::__construct("contacts");
        $content = $this -> content;
        $content = substMessages($content, $this -> dictionary, $lang);
        $this -> content = $content;
    }
}
?>
