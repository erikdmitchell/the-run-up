<?php
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

if ( 1 === $paged ) :
    get_template_part( 'template-parts/content-blog', 'landing' );
else :
    get_template_part( 'template-parts/content-blog', 'archive' );
endif;
