<?php
/**
 * Displays post entry tags
 *
 * @package Xpertiz
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( has_tag() ) : ?>
<div class="entry__meta-tags">
	<?php
		$xpertiz_tags = get_the_tags( get_the_ID() );
	if ( $xpertiz_tags ) {
		foreach ( $xpertiz_tags as $xpertiz_tag ) {
			echo wp_kses( '<a href="' . esc_url( get_tag_link( $xpertiz_tag->term_id ) ) . '" rel="tag" class="pills pills-default">' . $xpertiz_tag->name . '</a>' , 'post' );
		}
	}
	?>
</div>
<?php endif; ?>
