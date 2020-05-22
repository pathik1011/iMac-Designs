<?php
/**
 * Displays post entry category
 *
 * @package Xpertiz
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="entry__meta-category">
	<?php the_category( '', get_the_ID() ); ?>
</div>
