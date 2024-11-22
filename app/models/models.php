<?php

$transactions = [];
$transactionsIndex = 0;

$openExample = fopen('../transactions/sample1.csv', 'r');

while(($line = fgetcsv($openExample)) !== false){
  $transactions[$transactionsIndex] = $line;
  $transactionsIndex++;
}

fclose($openExample);

echo '<pre>';
print_r($transactions);
echo '</pre>';
