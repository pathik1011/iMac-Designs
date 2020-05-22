<?php
/**
 * Template part for displaying meta in single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Xpertiz
 * @since 1.0
 * @version 1.0
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
$queried_object = get_query_var( 'ob' );
?>

<div class="single__meta">
  <div class="meta-author">
	
	<img src="
	<?php
	echo wp_kses_post(
		get_avatar_url(
			$queried_object->post_author, [
				'size' => '40',
			]
		)
	);
?>
" />
	<?php echo esc_html__( 'By ', 'xpertiz' ); ?>
		<?php
		while ( have_posts() ) :
			the_post();
			echo wp_kses( the_author_posts_link(), 'post' );
	  endwhile;
	?>
  </div>

  <div class="meta-date">
	<?php
	  $xpertiz_title = get_the_title();
	if ( empty( $xpertiz_title ) ) :
	?>
	<a href="<?php echo esc_url( get_permalink() ); ?>"> <span class="dashicons dashicons-calendar-alt"></span><?php echo wp_kses_data( get_the_date() ); ?> </a>
	<?php
	  else :
			echo wp_kses( '<span class="dashicons dashicons-calendar-alt"></span>' , 'post' ) . wp_kses_data( get_the_date() );
	  endif;
	?>
  </div>

	<?php
	if ( is_sticky() ) :
	?>
	<div class="meta-sticky">
	<?php
	echo wp_kses( '<span class="xpertizicons icon-bookmark"></span>' , 'post' ) . esc_html__( 'Sticky post', 'xpertiz' );
	?>
	</div>
	<?php
  endif;
?>

  <div class="meta-comments ricos">
<?php
if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
?>
<svg width="20" height="20" viewBox="0 -2 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3.93751 5.6875C3.45353 5.6875 3.06251 6.07852 3.06251 6.5625C3.06251 7.04648 3.45353 7.4375 3.93751 7.4375C4.4215 7.4375 4.81251 7.04648 4.81251 6.5625C4.81251 6.07852 4.4215 5.6875 3.93751 5.6875ZM7.00001 5.6875C6.51603 5.6875 6.12501 6.07852 6.12501 6.5625C6.12501 7.04648 6.51603 7.4375 7.00001 7.4375C7.484 7.4375 7.87501 7.04648 7.87501 6.5625C7.87501 6.07852 7.484 5.6875 7.00001 5.6875ZM10.0625 5.6875C9.57853 5.6875 9.18751 6.07852 9.18751 6.5625C9.18751 7.04648 9.57853 7.4375 10.0625 7.4375C10.5465 7.4375 10.9375 7.04648 10.9375 6.5625C10.9375 6.07852 10.5465 5.6875 10.0625 5.6875ZM7.00001 0.875C3.13361 0.875 1.42184e-05 3.4207 1.42184e-05 6.5625C1.42184e-05 7.86406 0.544155 9.05625 1.4465 10.016C1.03908 11.0934 0.19142 12.0066 0.177749 12.0176C-0.00272016 12.209 -0.0519389 12.4879 0.0519673 12.7285C0.155874 12.9691 0.393764 13.125 0.656264 13.125C2.3379 13.125 3.66408 12.4223 4.45978 11.859C5.25001 12.1078 6.10314 12.25 7.00001 12.25C10.8664 12.25 14 9.7043 14 6.5625C14 3.4207 10.8664 0.875 7.00001 0.875ZM7.00001 10.9375C6.26994 10.9375 5.54806 10.8254 4.85626 10.6066L4.23556 10.4098L3.70236 10.7871C3.31134 11.0633 2.7754 11.3723 2.13009 11.5801C2.3297 11.2492 2.52384 10.8773 2.67423 10.4809L2.96408 9.7125L2.4008 9.11641C1.90587 8.58867 1.31251 7.71641 1.31251 6.5625C1.31251 4.15078 3.86369 2.1875 7.00001 2.1875C10.1363 2.1875 12.6875 4.15078 12.6875 6.5625C12.6875 8.97422 10.1363 10.9375 7.00001 10.9375Z" fill="#ffffff"/>
</svg>
<?php
if ( ! ( function_exists( 'is_product' ) && is_product() ) ) {
	comments_popup_link();
} else {
	comments_popup_link( 'No Review','There is 1 Review' );
}
endif;
?>
  </div>
</div>
