<?php

function load_theme_scripts()
{
  wp_register_style('main', get_template_directory_uri() . '/assets/styles/build/main.min.css', array(), 1, 'all');
  wp_enqueue_style('main');
}
add_action('wp_enqueue_scripts', 'load_theme_scripts');

function init_nav()
{
    register_nav_menu('main-menu', __('Main Menu'));
    register_nav_menu('main-footer', __('Main Footer'));
}
add_action('init', 'init_nav');



function add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'add_woocommerce_support' );

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'General Options ACF',
        'menu_title' => 'General Options',
        'menu_slug' => 'general-options-acf',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

function register_widget_areas()
{
    register_sidebar(array(
        'id' => 'footer-menu-obrabiarka',
        'name' => 'Footer - Menu Obrabiarka',
        'description' => 'HTML',
        'before_widget' => '<div class="footer-menu-obrabiarka">',
        'after_widget' => "</div>",
    ));
    register_sidebar(array(
        'id' => 'footer-contact',
        'name' => 'Footer - Kontakt',
        'description' => 'HTML',
        'before_widget' => '<div class="footer-contact">',
        'after_widget' => "</div>",
    ));
}
add_action('widgets_init', 'register_widget_areas');


// Remove the description product tab
function remove_descrip_product_tab( $tabs ) {
    // Remove the description tab
    unset( $tabs['description'] );
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'remove_descrip_product_tab', 98 );

// Remove related products output
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Move Description to Under Title WooCommerce
function woocommerce_template_product_description() {
    wc_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 5 );

function add_product_fields_html() {
?>
    <ul class="info-content">
    <?php $labels = get_field('product_filter'); ?>
        <?php if ($labels) : ?>
            <?php foreach ($labels as $label) : ?>
                <li class="info">
                    <span class="key">
                        <strong><?php echo $label['key']; ?></strong>
                    </span>
                    <span><?php echo $label['value']; ?></span>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
<?php
}
add_action( 'woocommerce_single_product_summary', 'add_product_fields_html', 5 );








?>