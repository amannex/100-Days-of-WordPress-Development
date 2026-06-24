<?php

$args = array(
    'posts_per_page' => 3
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) :

    while ( $query->have_posts() ) :
        $query->the_post();

        echo '<h2>';
        the_title();
        echo '</h2>';

        the_excerpt();

    endwhile;

endif;

wp_reset_postdata();