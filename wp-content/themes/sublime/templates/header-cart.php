<?php
/**
 * Header / Cart
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Cart Icon
if ( sublime_get_mod( 'header_cart_icon', false ) && class_exists( 'woocommerce' ) ) { ?>
    <div class="nav-top-cart-wrapper">
        <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
        	<?php echo sublime_svg( 'cart' ); ?>
            <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                <span class="shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
            <?php else: ?>
                <span class="shopping-cart-items-count">0</span>
            <?php endif ?>
        </a>

        <div class="nav-shop-cart">
            <div class="widget_shopping_cart_content">      	
                <?php woocommerce_mini_cart() ?>
            </div>
        </div>
    </div>

<?php  } ?>
