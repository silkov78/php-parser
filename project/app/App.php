<?php

declare(strict_types=1);

// Code
function getTransactionFiles(): array {
  
  $files = [];

  foreach(scandir(FILES_PATH) as $file){
    if (is_dir($file)) {
      continue;
    }

    $files[] = $file;
  }

  return $files;
}

