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
    $namedTransaction = [
      'Date' => $line[0],
      'Check #' => $line[1],
      'Description' => $line[2],
      'Amount' => $line[3],
    ];

    if ($namedTransaction['Date'] === 'Date'){
      continue;
    }

    array_push($resultArray, $namedTransaction);
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
