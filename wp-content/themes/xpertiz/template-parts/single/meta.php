<?php
/**
 * Single Post Meta
 *
 * @package Xpertiz
 * @since   1.0.0
 */

$queried_object = get_query_var( 'ob' );
?>

<div class="post-meta">
	<span class="post-meta-author"><a href="<?php echo esc_url( get_author_posts_url( isset( $queried_object->post_author ) ? $queried_object->post_author : 'ID' ) ); ?>" title="<?php esc_attr_e( 'Visit Author Posts', 'xpertiz' ); ?>"><?php echo wp_kses( the_author_meta( 'display_name', isset( $queried_object->post_author ) ? $queried_object->post_author : '' ), 'post' ); ?></a></span> <?php echo esc_html__( 'on', 'xpertiz' ); ?> <span class="post-meta-date"><?php echo wp_kses_data( get_the_date() ); ?></span>
</div>
