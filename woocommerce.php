<?php get_header(); ?>
    <div class="woocommerce-content-wrapper woocommerce-new <?php if (is_singular('product')) : echo 'default-content-wrapper single-product-new'; endif; ?>">
        <div class="container">
            <?php $page_id = wc_get_page_id('shop'); ?>

            <?php if (is_singular('product')) : ?>
                <div class="page-wrapper" id="product-page">

                    <?php while (have_posts()) : ?>
                        <?php the_post(); ?>


                        <?php wc_get_template_part('content', 'single-product'); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>


            <?php elseif (woocommerce_product_loop()) : ?>
                <div class="page-wrapper" id="products-page">
                    <h1 class="title-border"><?php the_field('shop_title', 'option'); ?></h1>
                    <p class="description">
                        <?php the_field('shop_description', 'option'); ?>
                    </p>
                    <section class="section section-1">
                        <div class="two-columns">
                            <div class="col col-1">
                                <div id="sidebar-filter">
                                    <h4>Kategorie</h4>
                                    <?php echo do_shortcode('[woof is_ajax=1] '); ?>
                                </div>
                            </div>
                            <div class="col col-2">
                                <div id="main-content-products">
                                    <?php
                                    echo do_shortcode('[woof_products per_page=9 columns=3 is_ajax=1] ');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php get_footer(); ?>

