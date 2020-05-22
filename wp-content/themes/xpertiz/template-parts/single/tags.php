<?php
/**
 * Blog single tags
 *
 * @package Xpertiz
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="uf-single-post__tags">

	<?php if ( has_tag() ) : ?>

		<?php
		$xpertiz_tags = get_the_tags( get_the_ID() );
		foreach ( $xpertiz_tags as $xpertiz_tag ) {
			echo wp_kses( '<a href="' . esc_url( get_tag_link( $xpertiz_tag->term_id ) ) . '" rel="tag" class="pills pills-default">' . $xpertiz_tag->name . '</a>', 'post' );
		}
		?>

	<?php endif; ?>

</div>
