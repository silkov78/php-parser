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
  $resultArray = [];

  while(($line = fgetcsv($file)) !== false) {
    array_push($resultArray, $line);
  }

  fclose($filePath);
  return resultArray;
}

// Execution

define("TRANSACTIONS_PATH", "../transactions");
$csvTransactionsFiles = getCsvPathes(TRANSACTIONS_PATH);

// $transactionsArray = [];
// foreach($csvTransactionsFiles as $file){
//   $tempTransactionAray = getTransactionsFromFile();
// }

print_r($csvTransactionsFiles);
