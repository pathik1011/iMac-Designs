<?php
/**
 * Displays post entry footer
 *
 * @package Xpertiz
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="entry__footer-wrapper">
  <div class="entry__meta-tags">
<?php
if ( has_tag() ) :
?>
<svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.0046 6.35459L8.04541 0.395409C7.79224 0.142235 7.44886 1.87221e-06 7.09082 0H1.35C0.604406 0 0 0.604406 0 1.35V7.09082C1.87221e-06 7.44886 0.142235 7.79224 0.395409 8.04541L6.35459 14.0046C6.88177 14.5318 7.73654 14.5318 8.26377 14.0046L14.0046 8.26377C14.5318 7.73657 14.5318 6.88179 14.0046 6.35459ZM3.15 4.5C2.40441 4.5 1.8 3.89559 1.8 3.15C1.8 2.40441 2.40441 1.8 3.15 1.8C3.89559 1.8 4.5 2.40441 4.5 3.15C4.5 3.89559 3.89559 4.5 3.15 4.5ZM17.6046 8.26377L11.8638 14.0046C11.3366 14.5318 10.4818 14.5318 9.95459 14.0046L9.94447 13.9945L14.8399 9.09906C15.318 8.62096 15.5813 7.98531 15.5813 7.30918C15.5813 6.63306 15.3179 5.9974 14.8399 5.51931L9.32054 0H10.6908C11.0489 1.87221e-06 11.3922 0.142235 11.6454 0.395409L17.6046 6.35459C18.1318 6.88179 18.1318 7.73657 17.6046 8.26377Z" fill="#AAAAAA"/>
</svg>
<?php
$xpertiz_tags = get_the_tags( get_the_ID() );
if ( $xpertiz_tags ) {
	$i = 0;
	foreach ( $xpertiz_tags as $xpertiz_tag ) {
		$comma = ( 0 === $i ) ? '' : ', ';
		echo wp_kses( $comma . '<a href="' . esc_url( get_tag_link( $xpertiz_tag->term_id ) ) . '" rel="tag">' . $xpertiz_tag->name . '</a>' , 'post' );
		$i++;
	}
}
	  endif;
?>
  </div>

  <div class="entry__edit_post_link">
	<?php edit_post_link(); ?>
  </div>
</div><!-- .entry__footer-wrapper-->

<?php
	$after_post = apply_filters( 'xpertiz_after_post', '' );

if ( ! empty( $after_post ) ) {
	echo wp_kses(
		$after_post , array(
			'a' => array(
				'class' => array(),
				'href' => array(),
				'title' => array(),
				'onclick' => array(),
			),
			'div' => array(
				'class' => array(),
			),
			'svg' => array(
				'width' => array(),
				'height' => array(),
				'viewbox' => array(),
				'fill' => array(),
				'xmlns' => array(),
			),
			'path' => array(
				'd' => array(),
				'fill' => array(),
			),
		)
	);
}
?>
