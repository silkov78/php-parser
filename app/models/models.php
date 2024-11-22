<?php

$transactions = [];
$transactionsIndex = 0;

// $transactionsDirlist = scandir('../transactions');
$csvFiles = array_filter(
  $array = scandir('../transactions'),
  $callback = fn($el) => str_ends_with($el, '.csv')
);

// $openExample = fopen('../transactions/sample1.csv', 'r');
//
// while(($line = fgetcsv($openExample)) !== false){
//   $transactions[$transactionsIndex] = $line;
//   $transactionsIndex++;
// }
//
// fclose($openExample);
//
// echo '<pre>';
// print_r($transactions);
// echo '</pre>';


print_r($csvFiles);
