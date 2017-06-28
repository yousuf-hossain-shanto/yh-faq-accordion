<?php
	function yf_shortcode($atts, $content) {
		$accordion_atts = shortcode_atts(array(
			'title' => 'Sample Title',
			'group' => '',
			'count' => '4',
		), $atts);
		ob_start(); ?>		
		<div class="yf-accordion">
			<h2><?php echo $accordion_atts['title']; ?></h2>
			<?php
				$args = array(
					'post_type'      => 'yf_accordion',
					'tax_query'      => array(
						array(
							'taxonomy'  => 'faq_group',
							'field'     => 'name',
							'terms'     => $accordion_atts['group'],
						)
					),
					'post_status'    => 'publish',
					'posts_per_page' => $accordion_atts['count']
				);
				$accordion = new WP_Query( $args );
			?>
			<?php while($accordion->have_posts()):$accordion->the_post() ?>
				<div class="yf-accordion-section">
					<div class="yf-accordion-title plus-minus-style" rel="#id-<?php echo get_the_ID(); ?>">
						<h3>
							<span class="icon-style">
								<i class="fa yf-fa-up" style="background: #E50000;color: #fff;border-radius: 0px;"></i>
							</span>
							<?php the_title(); ?>
							<?php
								if(get_post_meta( get_the_ID(), 'yf-details', true ) !== NULL){ ?>
									<span class="yf-details"><?php echo get_post_meta( get_the_ID(), 'yf-details', true ); ?></span>
								<?php } 
							?>
						</h3>
					</div>
					<div class="yf-accordion-content" id="id-<?php echo get_the_ID(); ?>">
						<?php the_content(); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php 
		$accordion_content = ob_get_clean();
		return $accordion_content;
	}
?>