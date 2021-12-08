<?php

// Prepare netiCRM po file.
$referenceFile = "civicrm.po";
$context = file_get_contents($referenceFile);
global $formattedSearchPoContext;
$formattedSearchPoContext = str_replace("\"\n\"", '', $context);
$fileLIst = glob('l10n/po/zh_TW/*.po');
print_r($fileLIst);
foreach ($fileLIst as $file) {
  checkAndUpdatePoFile($file);
}

function checkAndUpdatePoFile($file) {
  global $formattedSearchPoContext;
  print("Check and Update file: $file\n");

  // Load a po file.
  $context = file_get_contents($file);
  $msgOriginalArray = explode("\n\n", $context);
  $formattedContext = str_replace("\"\n\"", '', $context);
  $msgFormattedPOArray = explode("\n\n", $formattedContext);
  $aItr = new ArrayIterator($msgFormattedPOArray);
  $regexp = "/^msgid \"(.+)\"\nmsgstr \"(.*)\"$/m";
  
  $rItr = new RegexIterator($aItr, $regexp, RegexIterator::ALL_MATCHES);
  
  // Iterator for all msgid, msgstr patterns.
  foreach ($rItr as $key => $matchPattern) {
    // If it's untranslated yet, search for netiCRM po files.
    if (empty($matchPattern[2][0])) {
      $searchText = $matchPattern[1][0];
      $searchText = preg_quote($searchText, '/');
      $regexp = "/\nmsgid \"{$searchText}\"\nmsgstr \"(.+)\"\n\n/m";
      $match = array();
      $result = preg_match($regexp, $formattedSearchPoContext, $match);
      // Have search out translated text in netiCRM po file.
      if ($result && !empty($match[1])) {
        $originText =& $msgOriginalArray[$key];
        $originText = str_replace("msgstr \"\"", "msgstr \"{$match[1]}\"", $originText);
      }
    }
  }
  
  // Implode writed translated text into origin po file.
  $resultContext = implode("\n\n", $msgOriginalArray);
  $f = fopen($file,'w');
  fwrite($f, $resultContext);
  fclose($f);
}
