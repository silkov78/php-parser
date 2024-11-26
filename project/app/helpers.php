<?php

declare(strict_types = 1);

function formatDollarAmount(float $value): string {
    
    $isNegative = $value < 0;

    return ($isNegative? '-' : '') . '$' . number_format(abs($value), 2);
}

function formatDate(string $date): string {
    return date('M j, Y', strtotime($date));
}
