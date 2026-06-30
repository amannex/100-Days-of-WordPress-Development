<?php

$price = get_field('price');
$duration = get_field('duration');
$location = get_field('location');

?>

<p>Price: <?php echo esc_html($price); ?></p>

<p>Duration: <?php echo esc_html($duration); ?></p>

<p>Location: <?php echo esc_html($location); ?></p>