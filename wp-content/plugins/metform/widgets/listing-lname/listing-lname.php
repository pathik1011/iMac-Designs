<?php
namespace Elementor;
defined( 'ABSPATH' ) || exit;

Class MetForm_Input_Listing_Lname extends Widget_Base{

	use \MetForm\Traits\Common_Controls;
	use \MetForm\Traits\Conditional_Controls;
	use \MetForm\Widgets\Widget_Notice;

    public function get_name() {
		return 'mf-listing-lname';
    }
    
	public function get_title() {
		return esc_html__( 'Last Name (Listing)', 'metform' );
	}
	
	public function show_in_panel() {
        return 'metform-form' == get_post_type();
	}

	public function get_categories() {
		return [ 'metform' ];
	}
	
	public function get_keywords() {
        return ['metform', 'input', 'last name', 'name', 'mailchimp', 'zapier', 'slack'];
    }

    protected function _register_controls() {
        
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'metform' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->input_content_controls(['NO_NAME']);

        $this->end_controls_section();

        $this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'metform' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->input_setting_controls(['VALIDATION']);

		$this->end_controls_section();
		
		if(class_exists('\MetForm_Pro\Base\Package')){
			$this->input_conditional_control();
		}
		
        $this->start_controls_section(
			'label_section',
			[
				'label' => esc_html__( 'Label', 'metform' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'    => [
                    'mf_input_label_status' => 'yes',
                ],
			]
        );

		$this->input_label_controls();

        $this->end_controls_section();

        $this->start_controls_section(
			'input_section',
			[
				'label' => esc_html__( 'Input', 'metform' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

        $this->input_controls();

        $this->end_controls_section();

        $this->start_controls_section(
			'placeholder_section',
			[
				'label' => esc_html__( 'Place Holder', 'metform' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->input_place_holder_controls();

		$this->end_controls_section();
		
        $this->start_controls_section(
			'help_text_section',
			[
				'label' => esc_html__( 'Help Text', 'metform' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'mf_input_help_text!' => ''
				]
			]
		);
		
		$this->input_help_text_controls();

        $this->end_controls_section();

        $this->insert_pro_message();
	}

    protected function render($instance = []){
		$settings = $this->get_settings_for_display();
		extract($settings);

		$render_on_editor = false;
		$is_edit_mode = 'metform-form' === get_post_type() && \Elementor\Plugin::$instance->editor->is_edit_mode();

		$class = (isset($settings['mf_conditional_logic_form_list']) ? 'mf-conditional-input' : '');
        ?>

		<div class="mf-input-wrapper">
			<?php if ( 'yes' == $mf_input_label_status ): ?>
				<label class="mf-input-label" for="mf-input-text-<?php echo esc_attr( $this->get_id() ); ?>"><?php echo apply_filters( 'metform_label_text', esc_html($mf_input_label), $render_on_editor ); ?>
					<span class="mf-input-required-indicator"><?php echo esc_html( ($mf_input_required === 'yes') ? '*' : '' );?></span>
				</label>
			<?php endif; ?>

			<input type="text" class="mf-input <?php echo $class; ?>" id="mf-input-text-<?php echo esc_attr($this->get_id()); ?>" 
				name="<?php echo esc_attr( $mf_input_name ); ?>" 
				placeholder="<?php echo apply_filters( 'metform_placeholder', esc_attr($mf_input_placeholder), $render_on_editor ); ?>"
				onInput=${ parent.handleChange }	

				<?php if ( !$is_edit_mode ) :
					$configData = [
						'message' 		=> $errorMessage 	= isset($mf_input_validation_warning_message) ? !empty($mf_input_validation_warning_message) ? $mf_input_validation_warning_message : esc_html__('This field is required.', 'metform') : esc_html__('This field is required.', 'metform'),
						'minLength'		=> isset($mf_input_min_length) ? $mf_input_min_length : 1,
						'maxLength'		=> isset($mf_input_max_length) ? $mf_input_max_length : '',
						'type'			=> isset($mf_input_validation_type) ? $mf_input_validation_type : '',
						'required'		=> isset($mf_input_required) && $mf_input_required == 'yes' ? true : false,
						'expression'	=> isset($mf_input_validation_expression) && !empty(trim($mf_input_validation_expression)) ? trim($mf_input_validation_expression) : 'null'
					];
				?>
					aria-invalid=${validation.errors['<?php echo esc_attr($mf_input_name); ?>'] ? 'true' : 'false'}
					ref=${ el => parent.activateValidation(<?php echo json_encode($configData); ?>, el) }
				<?php endif; ?>
				
			/>

			<?php if ( !$is_edit_mode ) : ?>
				<${validation.ErrorMessage}
					errors=${validation.errors}
					name="<?php echo esc_attr( $mf_input_name ); ?>"
					as=${html`<span className="mf-error-message"></span>`}
					/>
			<?php endif; ?>

			<?php echo '' != $mf_input_help_text ? '<span class="mf-input-help">'. apply_filters( 'metform_help_text', esc_html($mf_input_help_text), $render_on_editor ) .'</span>' : ''; ?>
		</div>

		<?php
    }
    
}
