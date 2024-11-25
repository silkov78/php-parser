<?php

function getCsvPathes(string $sourceDir): array {
  $resultArray = [];
  $sourceList = scandir($sourceDir);

  foreach ($sourceList as $file) {
    if (str_ends_with($file, '.csv')) {
      array_push($resultArray, $sourceDir . '/' . $file);
    }
  }

  return $resultArray;
}

function getTransactionsFromFile(string $filePath): array {
  $file = fopen($filePath, 'r');
  $headers = fgetcsv($file);
 
  $resultArray = [];
  while(($row = fgetcsv($file)) !== false) {
      $tempRow = array_combine(keys: $headers, values: $row);
      $tempRow['Amount_ed'] = str_replace('$', '', $tempRow['Amount']);
      $tempRow['Amount_ed'] = str_replace(',', '', $tempRow['Amount_ed']);
      $tempRow['Amount_ed'] = (float) $tempRow['Amount_ed'];
      $resultArray[] = $tempRow; 
  }

  fclose($file);
  return $resultArray;
}

// Execution

define("TRANSACTIONS_PATH", "../transactions");
$csvTransactionsFiles = getCsvPathes(TRANSACTIONS_PATH);

$transactionsArray = [];
foreach ($csvTransactionsFiles as $filePath) {
  $tempArray = getTransactionsFromFile($filePath);
  $transactionsArray = array_merge($transactionsArray, $tempArray);
}

$transationsIncome = 0;
$transactionsExpense = 0;

foreach($transactionsArray as $value) {
   $amount = $value['Amount_ed'];
   if ($amount >= 0) {
        $transactionsIncome += $amount;
   } else {
        $transactionsExpense += $amount;
   }
}
