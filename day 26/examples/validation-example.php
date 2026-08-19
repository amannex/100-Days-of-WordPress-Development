<?php

/**
 * Validation Examples
 */


$age = absint(
    $_POST['age']
);


if (
    $age < 18 ||
    $age > 100
) {

    return;
}


$price = absint(
    $_POST['price']
);


if (
    $price <= 0
) {

    return;
}