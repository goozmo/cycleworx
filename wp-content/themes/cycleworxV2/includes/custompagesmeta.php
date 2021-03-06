<?php
/*
	*
	*	pages post meta custom fields
	*
	*
	*
	*
	*
*/

if ( is_admin() ) {
   $request = new Goo_pages_meta();
}



class Goo_pages_meta{
	

/*
	*
	*
	*
	*
*/
	public function __construct(){
		
		add_action( 'add_meta_boxes', array( $this, 'add_meta' ));
		add_action( 'save_post', array( $this, 'save_meta' ));
		
	}

/*
	*
	*
	*
	*
*/
	public function add_meta( $post_type ){
		
		$post_types = array( 'page' );     // limit to certain post types
		
		// reference array & apply wp add_meta_box
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'goo_pages_meta',
				__( 'Pages Meta' ),
				array( $this, 'render_meta' ),
				$post_type,
				'advanced',
				'high'
			);
		}
	}

/*
	*
	*
	*
	*
*/	
	public function save_meta( $post_id ){
		
		/*
			* We need to verify this came from our screen and with proper authorization,
			* because the save_post action can be triggered at other times.
		*/
		
		// Check if our nonce is set.
		
		if ( ! isset( $_POST['pages_meta_box_nonce'] ) ) {
			return;
		}
		
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['pages_meta_box_nonce'], 'pages_meta_box' ) ) {
			return;
		}
		
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		
		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) { 
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else { 
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
				
		foreach( $_POST as $key=>$value ){
			if( preg_match( '/^(_goo)/', $key )){
				$data = htmlspecialchars( $value );
				update_post_meta( $post_id, $key, $data );
			}
		}
		
	}

/*
	*
	*
	*
	*
*/
	public function render_meta( $post ){
		
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'pages_meta_box', 'pages_meta_box_nonce' );
		
		/*
			*
			*
			*
		*/
		$_pre_feat_icon = get_post_meta( $post->ID, '_goo_home_featured_icon', true );
		
		
		// begin main container
		echo "<div id='_goo-artist-meta-container'>";
		//echo "the category is: ";
		//echo "<pre>";
		//print_r( get_the_category());
		//echo "</pre>";
		
		/*
			* homepage featured icon
			*
		*/
		?>
		<label for="_goo_home_featured_icon"><?php _e( 'Icon to show on Homepage for Featured Pages. Get a complete list at  http://fortawesome.github.io/Font-Awesome/icons/' ); ?></label> <br/><br/>
		<input type="text" id="_goo_home_featured_icon" name="_goo_home_featured_icon" style="width: 100%; resize: none;" value="<?php echo esc_attr( $_pre_feat_icon ); ?>" /><br/><br/>
		
		<?php
			
		echo '<div style="clear:both;width:100%;"></div>';
		echo "</div>";
		
	}
	
}