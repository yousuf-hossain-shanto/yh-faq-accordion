<?php

	function yf_load_textdomain(){
		load_plugin_textdomain( 'yf_textdomain', false, YF_PLUGIN_PATH . '/languages' );
	}

	function yf_register_post(){
		$slug = 'yf_accordion';
		$text_domain = 'yf_textdomain';
		$labels = array(
			'name'                => __( 'FAQ Accordions', $text_domain ),
			'singular_name'       => __( 'Accordion', $text_domain ),
			'add_new'             => _x( 'Add New Accordion', $text_domain, $text_domain ),
			'add_new_item'        => __( 'Add New Accordion', $text_domain ),
			'edit_item'           => __( 'Edit FAQ Accordion', $text_domain ),
			'new_item'            => __( 'New Accordion', $text_domain ),
			'view_item'           => __( 'View Accordion', $text_domain ),
			'search_items'        => __( 'Search FAQ Accordions', $text_domain ),
			'not_found'           => __( 'No FAQ Accordions found', $text_domain ),
			'not_found_in_trash'  => __( 'No FAQ Accordions found in Trash', $text_domain ),
			'parent_item_colon'   => __( 'Parent Accordion:', $text_domain ),
			'menu_name'           => __( 'FAQ Accordions', $text_domain ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'menu_icon'           => 'dashicons-info',
			'rewrite'       	=> array( 'slug' => 'yf_accordion' ),
			'supports'            => array('title', 'editor')
		);
		register_post_type( $slug, $args );
	}

	function yf_register_category(){
		$post_slug = 'yf_accordion';
		$text_domain = 'yf_textdomain';
		$slug   = 'faq_group';
		$labels = array(
			'name'					=> _x( 'Groups', 'Groups', $text_domain ),
			'singular_name'			=> _x( 'Group', 'Group', $text_domain ),
			'search_items'			=> __( 'Search Groups', $text_domain ),
			'popular_items'			=> __( 'Popular Groups', $text_domain ),
			'all_items'				=> __( 'All Groups', $text_domain ),
			'parent_item'			=> __( 'Parent Group', $text_domain ),
			'parent_item_colon'		=> __( 'Parent Group', $text_domain ),
			'edit_item'				=> __( 'Edit Group', $text_domain ),
			'update_item'			=> __( 'Update Group', $text_domain ),
			'add_new_item'			=> __( 'Add New Group', $text_domain ),
			'new_item_name'			=> __( 'New Group Name', $text_domain ),
			'add_or_remove_items'	=> __( 'Add or remove Groups', $text_domain ),
			'choose_from_most_used'	=> __( 'Choose from most used text-domain', $text_domain ),
			'menu_name'				=> __( 'Group', $text_domain ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'hierarchical'      => true,
			'rewrite'       	=> array( 'slug' => 'faq_group' )
		);
		register_taxonomy( $slug, $post_slug, $args );
	}
	
	function yf_meta_box(){
		add_meta_box( 'yf-details', 'FAQ Details (Optional)', 'yf_meta_input', 'yf_accordion', 'side', 'high', null );
	}

	function yf_meta_input($post){ ?>
		<label for="yf-details">Type Accordion Details</label>
		<input type="text" id="yf-details" placeholder="Accordion Details Here" class="widefat" name="yf-details" value="<?php echo get_post_meta( $post->ID, 'yf-details', true ); ?>">
	<?php }

	function yf_update_meta($post_id){
		$meta_value = $_POST['yf-details'];
		update_post_meta( $post_id, 'yf-details', $meta_value );
	}

?>