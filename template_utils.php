<?
require_once "language_config.php";

$MESSAGE_TAG_BEGIN = "{{";
$MESSAGE_TAG_END = "}}";
$PLACEHOLDER_BEGIN = "%";
$PLACEHOLDER_END = "%";

function readTemplate($templateFile) {
	if (file_exists($templateFile)) {
		$content = file_get_contents($templateFile);
		return $content;
	}
	else {
		throw new Exception("Template file doesn't exist");
		return false;
	}
}
	
function substMessages($content, $dictionary, $language) {
	global $MESSAGE_TAG_BEGIN, $MESSAGE_TAG_END, $PLACEHOLDER_BEGIN, $PLACEHOLDER_END;
	global $DEFAULT_LANGUAGE;

	$result = "";
	
	$initPos = 0;
	while (($messageTagBeginPos = strpos($content, $MESSAGE_TAG_BEGIN, $initPos)) !== false) {
		$messageNamePos = $messageTagBeginPos + strlen($MESSAGE_TAG_BEGIN);
		$messageTagEndPos = strpos($content, $MESSAGE_TAG_END, $messageNamePos);
		$messageName = substr($content, $messageNamePos, ($messageTagEndPos - $messageNamePos));
		$result .= substr($content, $initPos, ($messageTagBeginPos - $initPos));
		
		if (!empty($dictionary[$messageName])) {
			$record = $dictionary[$messageName];
			$translation = "";
			if (!empty($record[$language])) {
				$translation = $record[$language];
			}
			elseif (!empty($record[$DEFAULT_LANGUAGE])) {
				$translation = $record[$DEFAULT_LANGUAGE];
			}			
			$result .= $translation;
		}		
		
		$initPos = $messageTagEndPos + strlen($MESSAGE_TAG_END);
	}
	
	$result .= substr($content, $initPos, (strlen($content) - $initPos));
	
	return $result;
}

?>