<?
require_once "template_utils.php";

require_once "fillers/AbstractFiller.php";

require_once "fillers/MainFiller.php";
require_once "fillers/BioFiller.php";
require_once "fillers/ProjectsFiller.php";
require_once "fillers/ContactsFiller.php";
require_once "fillers/NotFoundFiller.php";

require_once "fillers/TitleFiller.php";
require_once "fillers/HeaderFiller.php";
require_once "fillers/MenuFiller.php";
require_once "fillers/FooterFiller.php";

class IndexFiller extends AbstractFiller {
    public function __construct($page, $lang) {
        parent::__construct("index");
        $content = substMessages($this -> content, $this -> dictionary, $lang);

        switch ($page) {
            case "main":
                $body = new MainFiller($lang);
                break;
            case "bio":
                $body = new BioFiller($lang);
                break;
            case "projects":
                $body = new ProjectsFiller($lang);
                break;
            case "contacts":
                $body = new ContactsFiller($lang);
                break;
            default:
                $page = "404";
                $body = new NotFoundFiller($lang);
                break;
        }

        $title = new TitleFiller($page, $lang);
        $header = new HeaderFiller($page, $lang);
        $menu = new MenuFiller($page, $lang);
        $footer = new FooterFiller($lang);

        $content = str_replace("%TITLE%", $title -> getContent(), $content);
        $content = str_replace("%HEADER%", $header -> getContent(), $content);
        $content = str_replace("%MENU%", $menu -> getContent(), $content);
        $content = str_replace("%CONTENT%", $body -> getContent(), $content);
        $content = str_replace("%FOOTER%", $footer -> getContent(), $content);

        $this -> content = $content;
    }
}
?>
