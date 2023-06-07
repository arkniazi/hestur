<?php
/**
 * Header / Info
 *
 * @package sublime
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get defaults from Customizer
$cls = '';

$email_prefix = sublime_get_mod( 'header_info_email_prefix', 'Email:' );
$phone_prefix = sublime_get_mod( 'header_info_phone_prefix', 'Phone:' );
$address_prefix = sublime_get_mod( 'header_info_address_prefix', 'Address:' );

$email = sublime_get_mod( 'header_info_email' );
$phone = sublime_get_mod( 'header_info_phone' );
$address = sublime_get_mod( 'header_info_address' );

?>

<div class="header-info <?php echo esc_attr( $cls ); ?>">
    <?php
    if ( $phone ) : ?>
        <span class="phone content">
            <?php if ( $phone_prefix ) echo '<span class="content-prefix">' . do_shortcode ( $phone_prefix ) . '</span>'; ?>
            <?php echo do_shortcode( $phone ); ?>
        </span>
    <?php endif; 

    if ( $email ) : ?>
        <span class="email content">
            <?php if ( $email_prefix ) echo '<span class="content-prefix">' . do_shortcode ( $email_prefix ) . '</span>'; ?>
            <?php echo do_shortcode( $email ); ?>
        </span>
    <?php endif;

    if ( $address ) : ?>
        <span class="address content">
            <?php if ( $address_prefix ) echo '<span class="content-prefix">' . do_shortcode ( $address_prefix ) . '</span>'; ?>
            <?php echo do_shortcode( $address ); ?>
        </span>
    <?php endif; ?>
</div><!-- /.header-info -->