<?php get_header(); ?>

<div class="container">
    <div class="<?php if(is_page( 'koszyk' )) : echo 'cart-new'; elseif(is_page( 'zamowienie' )) : echo 'order-new'; else : echo 'default-content-wrapper'; endif?>">
        <?php

        while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php
        endwhile;
        wp_reset_query();
        ?>
    </div>
</div>

<?php get_footer(); ?>