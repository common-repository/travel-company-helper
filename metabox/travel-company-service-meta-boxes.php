<?php
function travel_company_service_add_meta_box() {
	add_meta_box( 'service_icon', 'Service Icon', 'travel_company_service_icon_callback', 'service', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'travel_company_service_add_meta_box' );

function travel_company_service_icon_callback( $post ) {
	wp_nonce_field( 'travel_company_save_service_icon_data', 'travel_company_service_icon_meta_box_nonce' );
	
	$value = get_post_meta( $post->ID, '_service_icon_value_key', true );?>
	<p>
		<?php echo sprintf('Use font awesome icon: Eg: %1$s. %2$s See more here %3$s', 'fa fa-rocket','<a href="'. esc_url('https://fontawesome.com/v4.7.0/icons/').'" target="_blank">','</a>');?>
	</p>
	<div class="admin_metabox_section">	
		<label for="travel_company_service_icon_field"><?php esc_html_e('Icons','travel-company-helper');?></lable>
		<input type="text" id="travel_company_service_icon_field" name="travel_company_service_icon_field" value="<?php echo esc_attr( $value );?>" size="25" />
	</div>
<?php }

function travel_company_save_service_icon_data( $post_id ) {
	
	if( ! isset( $_POST['travel_company_service_icon_meta_box_nonce'] ) ){
		return;
	}
	
	if( ! wp_verify_nonce( $_POST['travel_company_service_icon_meta_box_nonce'], 'travel_company_save_service_icon_data') ) {
		return;
	}
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}
	
	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	if( ! isset( $_POST['travel_company_service_icon_field'] ) ) {
		return;
	}
	
	$my_data = sanitize_text_field( $_POST['travel_company_service_icon_field'] );
	
	update_post_meta( $post_id, '_service_icon_value_key', $my_data );
	
}

add_action( 'save_post', 'travel_company_save_service_icon_data' );