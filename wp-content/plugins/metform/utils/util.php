<?php
namespace MetForm\Utils;

defined( 'ABSPATH' ) || exit;
/**
 * Global helper class.
 *
 * @since 1.0.0
 */

class Util{

    /**
     * Get metform older version if has any.
     *
     * @since 1.0.0
     * @access public
     */
    public static function old_version(){
        $version = get_option('metform_version');
        return null == $version ? -1 : $version;
    }

    /**
     * Set metform installed version as current version.
     *
     * @since 1.0.0
     * @access public
     */
    public static function set_version(){

	}

    /**
     * Auto generate classname from path.
     *
     * @since 1.0.0
     * @access public
     */
    public static function make_classname( $dirname ) {
        $dirname = pathinfo($dirname, PATHINFO_FILENAME);
        $class_name	 = explode( '-', $dirname );
        $class_name	 = array_map( 'ucfirst', $class_name );
        $class_name	 = implode( '_', $class_name );

        return $class_name;
	}

	public static function google_fonts($font_families = []) {
		$fonts_url         = '';
		if ( $font_families ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) )
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}

  	public static function kses( $raw ) {

		$allowed_tags = array(
			'a'								 => array(
				'class'	 => array(),
				'href'	 => array(),
				'rel'	 => array(),
				'title'	 => array(),
				'target' => array(),
			),
			'abbr'							 => array(
				'title' => array(),
			),
			'b'								 => array(),
			'blockquote'					 => array(
				'cite' => array(),
			),
			'cite'							 => array(
				'title' => array(),
			),
			'code'							 => array(),
			'del'							 => array(
				'datetime'	 => array(),
				'title'		 => array(),
			),
			'dd'							 => array(),
			'div'							 => array(
				'class'	 => array(),
				'title'	 => array(),
				'style'	 => array(),
			),
			'dl'							 => array(),
			'dt'							 => array(),
			'em'							 => array(),
			'h1'							 => array(
				'class' => array(),
			),
			'h2'							 => array(
				'class' => array(),
			),
			'h3'							 => array(
				'class' => array(),
			),
			'h4'							 => array(
				'class' => array(),
			),
			'h5'							 => array(
				'class' => array(),
			),
			'h6'							 => array(
				'class' => array(),
			),
			'i'								 => array(
				'class' => array(),
			),
			'img'							 => array(
				'alt'	 => array(),
				'class'	 => array(),
				'height' => array(),
				'src'	 => array(),
				'width'	 => array(),
			),
			'li'							 => array(
				'class' => array(),
			),
			'ol'							 => array(
				'class' => array(),
			),
			'p'								 => array(
				'class' => array(),
			),
			'q'								 => array(
				'cite'	 => array(),
				'title'	 => array(),
			),
			'span'							 => array(
				'class'	 => array(),
				'title'	 => array(),
				'style'	 => array(),
			),
			'iframe'						 => array(
				'width'			 => array(),
				'height'		 => array(),
				'scrolling'		 => array(),
				'frameborder'	 => array(),
				'allow'			 => array(),
				'src'			 => array(),
			),
			'strike'						 => array(),
			'br'							 => array(),
			'strong'						 => array(),
			'data-wow-duration'				 => array(),
			'data-wow-delay'				 => array(),
			'data-wallpaper-options'		 => array(),
			'data-stellar-background-ratio'	 => array(),
			'ul'							 => array(
				'class' => array(),
			),
		);

		if ( function_exists( 'wp_kses' ) ) { // WP is here
			return wp_kses( $raw, $allowed_tags );
		} else {
			return $raw;
		}
	}

	public static function kspan($text){
		return str_replace(['{', '}'], ['<span>', '</span>'], self::kses($text));
	}


	public static function trim_words($text, $num_words){
		return wp_trim_words( $text, $num_words, '' );
	}

	public static function array_push_assoc($array, $key, $value){
		$array[$key] = $value;
		return $array;
	}

	public static function render($content){
		if (stripos($content, "metform-has-lisence") !== false) {
			return null;
		}

		return $content;
	}
	
	public static function render_elementor_content($content_id){
		$elementor_instance = \Elementor\Plugin::instance();
		return $elementor_instance->frontend->get_builder_content_for_display( $content_id );
	}

	public static function img_meta($id){
		$attachment = get_post($id);
		if($attachment == null || $attachment->post_type != 'attachment'){
			return null;
		}
		return [
            'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink( $attachment->ID ),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
		];
	}

	public static function render_inner_content($content, $id){
		return str_replace('.elementor-'.$id.' ', '#elementor .elementor-'.$id.' ', $content);
	}

	public static function mfConvertStyleToReactObj($content){
		preg_match_all(' /style=("|\')(.*?)("|\')/', $content, $match);
		if(isset($match) && !empty($match ) && count($match) <= 0) { return $content; }
		foreach ($match[2] as $i => $item) {    
			$styles = explode(';', $item);
			$styleData = [];

			if(isset($styles) && !empty($styles )){
				foreach($styles as $style){
					$split = explode(':', $style);
					$key = isset($split[0]) ? trim($split[0]) : '';
					$value = isset($split[1]) ? trim($split[1]) : '';
					if(strlen($key) > 0 && strlen($value)){
						$styleData[$key] = $value;
					}
				}
			}

			$replaceStyle = (isset($styleData) && !empty($styleData )) ? ' style=${'. json_encode($styleData, JSON_FORCE_OBJECT) .'} ' : '';
			$content = preg_replace(array(' /style=("|\')('. $item .')("|\')/'), $replaceStyle,$content);
		}

		return $content;
	}

	public static function render_form_content($form, $widget_id){
		$rest_url = get_rest_url();
		$form_unique_name = (is_numeric($form)) ? ($widget_id.'-'.$form) : $widget_id;
		$form_id = (is_numeric($form)) ? $form : $widget_id;
		$form_settings = \MetForm\Core\Forms\Action::instance()->get_all_data($form_id);

		$site_key = !empty($form_settings['mf_recaptcha_site_key']) ?  $form_settings['mf_recaptcha_site_key'] : '';
		if(!empty($form_settings['mf_recaptcha_version'])) {
			if($form_settings['mf_recaptcha_version'] == 'recaptcha-v3') {
				$site_key = $form_settings['mf_recaptcha_site_key_v3'];
			} 
		}
		
		ob_start();
		?>

		<div
			id="metform-wrap-<?php echo esc_attr( $form_unique_name ); ?>"
			class="mf-form-wrapper"
			data-form-id="<?php echo esc_attr( $form_id ); ?>"
			data-action="<?php echo esc_attr($rest_url. "metform/v1/entries/insert/" .$form_id); ?>"
			data-wp-nonce="<?php echo wp_create_nonce( 'wp_rest' ); ?>"
			data-form-nonce="<?php echo wp_create_nonce( 'form_nonce' ); ?>"
			data-stop-vertical-effect="<?php echo isset($form_settings['mf_stop_vertical_scrolling']) ? $form_settings['mf_stop_vertical_scrolling'] : '' ?>"
			></div>

		<script type="text" class="mf-template">
			return html`
				<form
					className="metform-form-content"
					onSubmit=${ validation.handleSubmit( parent.handleFormSubmit ) }
					>

					<${parent.responseMegCom} success=${state.success} errors=${state.errors} form_res=${state.form_res} />

					${!state.formHide ? html`
						<?php
							$replaceStrings = array(
								'from' => array(
									'class=',
									'for=',
									'cellspacing=',
									'cellpadding=',
									'srcset',
									'colspan',
									'<script>',			// Script Start Tag
									'</script>',		// Script End Tag
									'<br>',
									'<BR>'
								),
								'to' => array(
									'className=',
									'htmlFor=',
									'cellSpacing=',
									'cellPadding=',
									'srcSet',
									'colSpan',
									'{new Function(`',	// Script Start Tag
									'`)()}',			// Script End Tag
									'<br/>',
									'<br/>'
								),
							);

							$form_content = is_numeric( $form ) ? \MetForm\Utils\Util::render_elementor_content( $form ) : $form;
							$form_content = \MetForm\Utils\Util::mfConvertStyleToReactObj($form_content);
							$form_content = str_replace( $replaceStrings['from'], $replaceStrings['to'], $form_content );
							$form_content = preg_replace( '/<!--(.|\s)*?-->/', '', $form_content ); // Removes HTML Comments
							echo $form_content;
						?>
					` : ''}
				</form>
			`
		</script>

		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	public static function add_param_url($url, $key, $value) {
	
		$url = preg_replace('/(.*)(?|&)'. $key .'=[^&]+?(&)(.*)/i', '$1$2$4', $url .'&');
		$url = substr($url, 0, -1);
		
		if (strpos($url, '?') === false) {
			return ($url .'?'. $key .'='. $value);
		} else {
			return ($url .'&'. $key .'='. $value);
		}
	}
}
