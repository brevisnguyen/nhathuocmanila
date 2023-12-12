<?php

if (! function_exists('my_money')) {
    function my_money(int|float $amount) {
        return money($amount, forceDecimals: true);
    }
}
