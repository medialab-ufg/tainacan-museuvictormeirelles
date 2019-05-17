<?php


// Estilos
function museuindio_enqueue_styles() {
    $parent_style = 'tainacan-interface';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'museuindio_enqueue_styles', 99 );

add_action('tainacan-interface-single-item-bottom', function() {
	
	global $TAINACAN_BASE_URL;
	
	$meta_repo = \Tainacan\Repositories\Metadata::get_instance();
	
	var_dump(tainacan_get_item()->get_collection_id());
	
	$col_id = tainacan_get_item()->get_collection_id();
	
	$r = $meta_repo->fetch_one([
		'metadata_type' => 'Tainacan\Metadata_Types\Relationship',
		'meta_query' => [
			[
				'key' => 'metadata_type_options',
				'value' => tainacan_get_item()->get_collection_id(),
				'compare' => 'LIKE'
			]
		]
	], 'OBJECT');
	
	$meta_id = $r->get_id();
	
	?>
	
	<div class="wp-block-tainacan-dynamic-items-list"
		id="wp-block-tainacan-dynamic-items-list_kkf3imfeoijf093"
		search-url="http://localhost/wp-admin/admin.php?page=tainacan_admin#/collections/18004/items?meta_query[0][key]=<?php echo $meta_id; ?>&meta_query[0][value]=<?php echo get_the_ID(); ?>"
		collection-id="<?php echo $col_id; ?>"
		show-image="true"
		show-name="true"
		show-search-bar="true"
		show-collection-header="0"
		layout="grid"
		collection-background-color=""
		collection-text-color=""
		grid-margin=""
		max-items-number="30"
		order="random"
		tainacan-api-root=<?php echo home_url('wp-json/tainacan/v2'); ?>
		tainacan-base-url="<?php echo $TAINACAN_BASE_URL; ?>"
		
		></div>
	
	<?php
	
	
	//foreach ($rels as $r) 
		var_dump($r->get_name(), $r->get_metadata_type_options());

});
