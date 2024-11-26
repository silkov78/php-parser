<?php

declare(strict_types=1);

// Code
function getTransactionFiles(string $dirPath): array {
  
  $files = [];

  foreach(scandir($dirPath) as $file){
    if (is_dir($file)) {
      continue;
    }

    $files[] = $dirPath . $file;
  }

  return $files;
}


function getTransactions(string $filePath, ?callable $transactionsHandler = null): array {

  if (! file_exists($filePath)) {
    trigger_error('File "' . $filePath . '"does not exist.', E_USER_ERROR);
  }

  $file = fopen($filePath, 'r');

  $transactions = [];

  fgetcsv($file);

  while (($transaction = fgetcsv($file)) !== false) {

    if ($transactionsHandler !== null) {
      $transaction = $transactionsHandler($transaction);
    }

    $transactions[] = $transaction;

  }

  return $transactions;

}

function parseTransaction(array $transactionRow): array {

  [$date, $checkNumber, $description, $amount] = $transactionRow;

  $amount = (float) str_replace(['$', ','], '', $amount);

  return [
    'date' => $date,
    'checkNumber' => $checkNumber,
    'description' => $description,
    'amount' => $amount
  ];
}

function calculateTotals(array $transactions): array {

  $totals = [
    'netTotal' => 0,
    'totalIncome' => 0,
    'totalExpense' => 0
  ];

  foreach($transactions as $transaction) {
    $totals['netTotal'] += $transaction['amount'];

    if ($transaction['amount'] >= 0) {
      $totals['totalIncome'] += $transaction['amount'];
    } else {
      $totals['totalExpense'] += $transaction['amount'];
    }
  }

  return $totals;
}
