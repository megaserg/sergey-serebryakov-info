<?
require_once "template_utils.php";
require_once "fillers/AbstractFiller.php";

class MainFiller extends AbstractFiller {
    public function __construct($lang) {
        parent::__construct("main");
        $content = $this -> content;
        $content = substMessages($content, $this -> dictionary, $lang);

        $town_link = "http://sfgov.org/";
        //$spbu_link = "http://www.spbu.ru";
        $company_link = "http://www.getcruise.com";

        $content = str_replace("%TOWN_LINK%", $town_link, $content);
        //$content = str_replace("%SPBU_LINK%", $spbu_link, $content);
        $content = str_replace("%COMPANY_LINK%", $company_link, $content);

        $this -> content = $content;
    }
}
?>
