<?php

/**
 * Format price with smart decimal display
 * - $1.00 → $1
 * - $1.10 → $1.10
 * - $1.12 → $1.12
 * - $0.00 → $0.00
 */
if (!function_exists('formatPrice')) {
    function formatPrice($price, $currency = '$') {
        $price = (float) $price;
        
        // If price is zero, always show decimals
        if ($price == 0) {
            return $currency . number_format($price, 2);
        }
        
        // Check if price has cents
        $cents = ($price * 100) % 100;
        
        if ($cents == 0) {
            // No cents, show as whole number
            return $currency . number_format($price, 0);
        } else {
            // Has cents, show with 2 decimals
            return $currency . number_format($price, 2);
        }
    }
}
