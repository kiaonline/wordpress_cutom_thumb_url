<?php
/***
 * Automatically rezise a thumbnail and insert as post attachment
 * developed by kiaonline - dialogo.digital
 */
if(!function_exists("get_custom_post_thumbnail_url")){
	function get_custom_post_thumbnail_url($post_id = null, $size = 'post-thumbnail',$crop = true){
		if($post_id == null){
			global $post;
			$post_id = $post->ID;
		}
		//get post thumbnail
		$post_thumbnail_url = get_the_post_thumbnail_url($post_id,$size);
		//if exists return it
		if($post_thumbnail_url) return $post_thumbnail_url;

		//get post thumbnail, get sizes and check if the image size exist
		$post_thumbnail_id 	= get_post_thumbnail_id( $post_id );
		//check meta for sent thumbnail
		$image_meta 		= get_post_meta( $post_thumbnail_id, '_wp_attachment_metadata', true );
		if(!$image_meta) return false;
		$sizes 				= array_keys($image_meta['sizes']);
		//if sizes exists return imagem url
		if(in_array($size,$sizes)){
			return wp_get_attachment_image_url( $post_thumbnail_id, $size);
		}
		
		$fullsizepath = get_attached_file( $post_thumbnail_id);
		if ( ! function_exists( 'wp_crop_image' ) ) {
			include( ABSPATH . 'wp-admin/includes/image.php' );
		}
		
		$new_sizes 		= explode("x",$size);
		$w 				= $new_sizes[0];
		$h 				= (isset($new_sizes[1])? $new_sizes[1] : $new_sizes[0]);
		
		add_image_size( $size, $w, $h, $crop );

		$metadata = wp_generate_attachment_metadata( $post_thumbnail_id, $fullsizepath );
		wp_update_attachment_metadata( $post_thumbnail_id, $metadata );
		return wp_get_attachment_image_url( $post_thumbnail_id, $size);
	}
}