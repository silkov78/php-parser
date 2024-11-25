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
      $resultArray[] = array_combine(keys: $headers, values: $row);
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

echo '<pre>';
print_r($transactionsArray);
echo '</pre>';
