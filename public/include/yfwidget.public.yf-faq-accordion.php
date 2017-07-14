<?php
	/**
	* YFWidget Class
	*/
	class YF_Widget extends WP_Widget{

		public $defaults;
		
		public function __construct(){
			parent::__construct('Yf_Widget', __( 'YF Accordion', 'yf_textdomain' ), array(
				'description' => __( 'Widget For Accordion', 'yf_textdomain' )
			));
			add_action('in_widget_form', array($this, 'yf_print_script'), PHP_INT_MAX);
			$this->defaults = array(
				'title' => __( 'YF Accordion Group', 'yf_textdomain' ),
				'title_background' => '#fff',
				'title_text' => '#000',
				'group' => '',
				'border' => '0',
				'border_style' => 'solid',
				'border_color' => '#ccc',
				'icon_style' => 'plus-minus-style',
				'icon_bg_color' => '#E50000',
				'icon_color' => '#000',
				'icon_bg_radius' => '0',
				'show_icon_bg' => '1',
				'content_bg_color' => '#fff',
				'content_text_color' => '#000'
			);
		}

		public function yf_print_script(){ ?>
			<script type="text/javascript">
				(function($){
					<?php if(is_customize_preview()){ ?>
						var parent = $('#widgets-right');
					<?php } ?>
					<?php if(!is_customize_preview()){ ?>
						parent = $('#widgets-right, .inactive-sidebar');
					<?php } ?>
					jQuery(document).ready(function($) {
						parent.find('.yf_icon_bg').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-title-background').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-title-text').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-icon-color').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-content-bg').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-content-color').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-border-color').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
					});

					jQuery(document).ajaxComplete(function(event, xhr, settings) {
						parent.find('.yf_icon_bg').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-title-background').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-title-text').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-icon-color').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-content-bg').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-content-color').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
						parent.find('.yf-border-color').wpColorPicker(<?php if(is_customize_preview()){ ?>{change:_.throttle(function(){$(this).trigger('change');}, 1000, {leading: false})}<?php } ?>);
					});

				})(jQuery);
			</script>
		<?php }

		public function widget($args, $instance){
			extract(wp_parse_args( (array) $instance, $this->defaults));
			$title = apply_filters( 'widget_title', $title );
			echo $args['before_widget'];
			if ($title) {
				echo $args['before_title'].$title.$args['after_title'];
			}
		?>
			
			<?php
				$yf_wid_args = array(
					'post_type'      => 'yf_accordion',
					'tax_query'      => array(
						array(
							'taxonomy'  => 'faq_group',
							'field'     => 'slug',
							'terms'     => $group
						)
					),
					'post_status'    => 'publish',
					'posts_per_page' => 4
				);
				$yf_wid_accordion = new WP_Query( $yf_wid_args );
			?>
			<div class="yf-accordion">
				<?php while($yf_wid_accordion->have_posts()):$yf_wid_accordion->the_post() ?>
					<div class="yf-accordion-section" style="border: <?php echo $border; ?>px <?php echo  $border_style; ?> <?php echo $border_color; ?>;">
					<style type="text/css">
						#yf-id-<?php echo $this->number. '-' .get_the_ID(); ?> p{
							color: <?php echo $content_text_color; ?>;
						}
					</style>
						<div class="yf-accordion-title <?php echo $icon_style; ?>" rel="#yf-id-<?php echo get_the_ID(); ?>">
							<h3 style="background: <?php echo $title_background; ?>;color: <?php echo $title_text; ?>">
								<span class="<?php if($show_icon_bg===1){ ?>icon-style<?php } ?> fa yf-fa-up" <?php if($show_icon_bg===1){ ?>style="background: <?php echo $icon_bg_color; ?>;color: <?php echo $icon_color; ?>;border-radius: <?php echo $icon_bg_radius; ?>px;"<?php } ?>>
								</span>
								<?php the_title(); ?>
								<?php
									if(get_post_meta( get_the_ID(), 'yf-details', true ) !== NULL){ ?>
										<span class="yf-details"><?php echo get_post_meta( get_the_ID(), 'yf-details', true ); ?></span>
									<?php } 
								?>
							</h3>
						</div>
						<div class="yf-accordion-content" style="background: <?php echo $content_bg_color; ?>;" id="yf-id-<?php echo $this->number. '-' .get_the_ID(); ?>">
								<?php the_content(); ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

		<?php 
			echo $args['after_widget'];
		}

		public function form($instance){
			extract(wp_parse_args( (array) $instance, $this->defaults));
		?>
			<h3><?php _e('Title Section', 'yf_textdomain'); ?></h3>
			<div style="border-bottom: 1px solid #ccc;">
				<p>
					<label for="<?php echo $this->get_field_id('title') ; ?>"><?php _e( 'Title', 'yf_textdomain' ); ?>:</label>
				</p>
				<p>
					<input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ; ?>" name="<?php echo $this->get_field_name('title') ; ?>" value="<?php echo $title; ?>">
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('title_background'); ?>"><?php _e('Title Background:', 'yf_textdomain'); ?></label>
				</p>
				<p>
					<input type="text" class="yf-title-background" id="<?php echo $this->get_field_id('title_background') ; ?>" name="<?php echo $this->get_field_name('title_background') ; ?>" value="<?php echo $title_background; ?>">
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('title_text'); ?>"><?php _e('Title Text:', 'yf_textdomain'); ?></label>
				</p>
				<p>
					<input type="text" class="yf-title-text" id="<?php echo $this->get_field_id('title_text') ; ?>" name="<?php echo $this->get_field_name('title_text') ; ?>" value="<?php echo $title_text; ?>">
				</p>

			</div>
			<h3><?php _e('Global Section', 'yf_textdomain'); ?></h3>
			<div style="border-bottom: 1px solid #ccc;">
				<p><label for="<?php echo $this->get_field_id('group') ; ?>"><?php _e( 'Group', 'yf_textdomain' ); ?>:</label></p>
				<p>
					<?php wp_dropdown_categories(array(
						'show_option_none' => '',
						'class' => 'widefat',
						'id' => $this->get_field_id('group'),
						'name' => $this->get_field_name('group'),
						'selected' => $group,
						'taxonomy' => 'faq_group',
						'value_field' => 'slug'
					)); ?>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('border') ; ?>"><?php _e( 'Border', 'yf_textdomain' ); ?>:</label>
					<input class="tiny-text" type="number" id="<?php echo $this->get_field_id('border') ; ?>" name="<?php echo $this->get_field_name('border') ; ?>" value="<?php echo $border; ?>">PX
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('border_style'); ?>"><?php _e('Bordesr Style', 'yf_textdomain'); ?></label>
					<select id="<?php echo $this->get_field_id('border_style'); ?>" name="<?php echo $this->get_field_name('border_style'); ?>">
						<option value="solid" <?php selected($border_style, 'solid'); ?>>Solid</option>
						<option value="dashed" <?php selected($border_style, 'dashed'); ?>>Dashed</option>
						<option value="dotted" <?php selected($border_style, 'dotted'); ?>>Dotted</option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('border_color') ; ?>"><?php _e( 'Border Color', 'yf_textdomain' ); ?>:</label>
				</p>
				<p>
					<input type="text" class="yf-border-color" id="<?php echo $this->get_field_id('border_color') ; ?>" name="<?php echo $this->get_field_name('border_color') ; ?>" value="<?php echo $border_color; ?>">
				</p>
			</div>
			<h3><?php _e('Icon Section', 'yf_textdomain'); ?></h3>
			<div style="border-bottom: 1px solid #ccc;">
				<p>
					<label for="<?php echo $this->get_field_id('icon_style'); ?>"><?php _e('Icon Style', 'yf_textdomain'); ?></label>
					<select id="<?php echo $this->get_field_id('icon_style'); ?>" name="<?php echo $this->get_field_name('icon_style'); ?>">
						<option value="arrow-style" <?php selected($icon_style, 'arrow-style'); ?>>Arrow Style</option>
						<option value="plus-minus-style" <?php selected($icon_style, 'plus-minus-style'); ?>>Plus Minus Style</option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('show_icon_bg'); ?>"><?php _e('Show Icon Background', 'yf_textdomain'); ?></label>
					<input type="checkbox" <?php checked($show_icon_bg); ?> class="checkbox" name="<?php echo $this->get_field_name('show_icon_bg'); ?>" value="1" id="<?php echo $this->get_field_id('show_icon_bg'); ?>">
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('icon_bg_color') ; ?>"><?php _e( 'Icon Background', 'yf_textdomain' ); ?>:</label>
				</p>
				<p>
					<input type="text" class="yf_icon_bg" id="<?php echo $this->get_field_id('icon_bg_color') ; ?>" name="<?php echo $this->get_field_name('icon_bg_color') ; ?>" value="<?php echo $icon_bg_color; ?>">
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('icon_color') ; ?>"><?php _e( 'Icon Color', 'yf_textdomain' ); ?>:</label>
				</p>
				<p>
					<input type="text" class="yf-icon-color" id="<?php echo $this->get_field_id('icon_color') ; ?>" name="<?php echo $this->get_field_name('icon_color') ; ?>" value="<?php echo $icon_color; ?>">
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('icon_bg_radius') ; ?>"><?php _e( 'Icon Background Radius', 'yf_textdomain' ); ?>:</label>
					<input class="tiny-text" type="number" id="<?php echo $this->get_field_id('icon_bg_radius') ; ?>" name="<?php echo $this->get_field_name('icon_bg_radius') ; ?>" value="<?php echo $icon_bg_radius; ?>">
				</p>
			</div>
			<h3><?php _e('Content Section', 'yf_textdomain'); ?></h3>
			<div style="border-bottom: 1px solid #ccc;">
				<p>
					<label for="<?php echo $this->get_field_id('content_bg_color') ; ?>"><?php _e( 'Content Background', 'yf_textdomain' ); ?>:</label>
				</p>
				<p>
					<input type="text" class="yf-content-bg" id="<?php echo $this->get_field_id('content_bg_color') ; ?>" name="<?php echo $this->get_field_name('content_bg_color') ; ?>" value="<?php echo $content_bg_color; ?>">
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('content_text_color') ; ?>"><?php _e( 'Content Text Color', 'yf_textdomain' ); ?>:</label>
				</p>
				<p>
					<input type="text" class="yf-content-color" id="<?php echo $this->get_field_id('content_text_color') ; ?>" name="<?php echo $this->get_field_name('content_text_color') ; ?>" value="<?php echo $content_text_color; ?>">
				</p>
			</div>

		<?php
		}

		public function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['title_background'] = $new_instance['title_background'];
			$instance['title_text'] = $new_instance['title_text'];
			$instance['group'] = $new_instance['group'];
			$instance['border'] = $new_instance['border'];
			$instance['border_style'] = $new_instance['border_style'];
			$instance['border_color'] = $new_instance['border_color'];
			$instance['icon_style'] = $new_instance['icon_style'];
			$instance['icon_bg_color'] = $new_instance['icon_bg_color'];
			$instance['icon_color'] = $new_instance['icon_color'];
			$instance['icon_bg_radius'] = $new_instance['icon_bg_radius'];
			$instance['show_icon_bg'] = isset($new_instance['show_icon_bg'])?1:0;
			$instance['content_bg_color'] = $new_instance['content_bg_color'];
			$instance['content_text_color'] = $new_instance['content_text_color'];
			return $instance;
		}

	}

	function reg_yfwidget(){
		register_widget( 'YF_Widget' );
	}

?>