<?
function readDictionary($filename) {
	if (file_exists($filename)) {
		$content = file_get_contents($filename);
		return parseRecords($content);
	}
	else {
		return parseRecords("");
	}
}

$START_TAG_BEGIN = "{";
$START_TAG_END = "}";
$FINISH_TAG_BEGIN = "{/";
$FINISH_TAG_END = "}";
$RECORD_TAG_NAME = "record";

function writeDictionary($filename, $dictionary) {
	global $START_TAG_BEGIN, $START_TAG_END, $FINISH_TAG_BEGIN, $FINISH_TAG_END, $RECORD_TAG_NAME;
	
	if ($handle = fopen($filename, "w")) {
		if (flock($handle, LOCK_EX)) {
			foreach ($dictionary as $name => $record) {
				fwrite($handle, $START_TAG_BEGIN . $RECORD_TAG_NAME . $START_TAG_END . "\n");
				foreach ($record as $lang => $trans) {
					$translationString =
						"\t" . $START_TAG_BEGIN . $lang . $START_TAG_END.
						htmlspecialchars_decode($trans) .
						$FINISH_TAG_BEGIN . $lang . $FINISH_TAG_END . "\n";
					fwrite($handle, $translationString);
				}
				fwrite($handle, $FINISH_TAG_BEGIN . $RECORD_TAG_NAME . $FINISH_TAG_END . "\n");
			}
			flock($handle, LOCK_UN);
		}
		else {
			echo "Error: flock() fail\n";
		}			
		fclose($handle);
	}
	else {
		echo "Error: fopen() fail\n";
	}
}

function parseRecords($content) {
	global $START_TAG_BEGIN, $START_TAG_END, $FINISH_TAG_BEGIN, $FINISH_TAG_END, $RECORD_TAG_NAME;
	
	$records = array();
	$startRecord = $START_TAG_BEGIN . $RECORD_TAG_NAME . $START_TAG_END;
	$finishRecord = $FINISH_TAG_BEGIN . $RECORD_TAG_NAME . $FINISH_TAG_END;
	
	$initPos = 0;
	$startPos = strpos($content, $startRecord, $initPos);
	while (($startPos = strpos($content, $startRecord, $initPos)) !== false) {
		$recordPos = $startPos + strlen($startRecord);
		$finishPos = strpos($content, $finishRecord, $recordPos);
		$record = substr($content, $recordPos, ($finishPos - $recordPos));
		$parsed = parseRecord($record);
		$records[$parsed["name"]] = $parsed;
		$initPos = $finishPos + strlen($finishRecord);
	}
	
	return $records;
}

function parseRecord($record) {
	global $START_TAG_BEGIN, $START_TAG_END, $FINISH_TAG_BEGIN, $FINISH_TAG_END;
	
	$langs = array();
	
	$initPos = 0;
	while (($startTagBeginPos = strpos($record, $START_TAG_BEGIN, $initPos)) !== false) {
		$startTagNamePos = $startTagBeginPos + strlen($START_TAG_BEGIN);
		$startTagEndPos = strpos($record, $START_TAG_END, $startTagNamePos);
		$startTagName = substr($record, $startTagNamePos, ($startTagEndPos - $startTagNamePos));
		
		$valuePos = $startTagEndPos + strlen($START_TAG_END);
		$finishTagBeginPos = strpos($record, $FINISH_TAG_BEGIN, $valuePos);
		$value = substr($record, $valuePos, ($finishTagBeginPos - $valuePos));
		
		$finishTagNamePos = $finishTagBeginPos + strlen($FINISH_TAG_BEGIN);
		$finishTagEndPos = strpos($record, $FINISH_TAG_END, $finishTagNamePos);
		$finishTagName = substr($record, $finishTagNamePos, ($finishTagEndPos - $finishTagNamePos));
		
		if ($startTagName == $finishTagName) {
			$langs[$startTagName] = $value;
		}
		else {
			echo "Start/finish tag mismatch!";
		}
		$initPos = $finishTagEndPos + strlen($FINISH_TAG_END);
	}
	
	return $langs;
}

function testDictionary() {
	$dict = readDictionary("test.dic");
	foreach ($dict as $name => $record) {
		echo "$name<br />\n";
		foreach ($record as $lang => $trans) {
			echo "<b>$lang:</b> $trans<br />\n";
		}
		echo "<br />\n";
	}
}

//test();
?>