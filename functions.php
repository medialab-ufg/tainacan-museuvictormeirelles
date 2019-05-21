<?php


// Estilos
function museuindio_enqueue_styles() {
    $parent_style = 'tainacan-interface';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'museuindio_enqueue_styles', 99 );

add_action('tainacan-interface-single-item-after-metadata', function() {
	
	global $TAINACAN_BASE_URL;
	
	$meta_repo = \Tainacan\Repositories\Metadata::get_instance();
	$current_item = tainacan_get_item();
	$col_id = $current_item->get_collection_id();
	
	
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
	$meta_col_id = $r->get_collection_id();
	
	$meta_query_url = 'metaquery[0][key]=' . $meta_id . '&metaquery[0][value][0]=' . $current_item->get_id() . '&metaquery[0][compare]=IN';
	
	$search_url = admin_url('admin.php?page=tainacan_admin') . '#/collections/'.$meta_col_id.'/items?' . $meta_query_url;
	
	$link = trailingslashit( get_permalink( (int) $meta_col_id) ) . '#/?' . $meta_query_url;
	
	?>	
	
	<div class="border-bottom border-jelly-bean tainacan-title-page" style="border-width: 2px !important; margin-top: 30px;">
		<ul class="list-inline mb-1">
			<li class="list-inline-item text-midnight-blue font-weight-bold title-page">
				Obras de <?php echo $current_item->get_title(); ?>
			</li>
			
			<li class="list-inline-item float-right title-back">
				<a href="<?php echo $link; ?>">Ver todas</a>
			</li>
		</ul>
	</div>
	
	<div class="wp-block-tainacan-dynamic-items-list"
		id="wp-block-tainacan-dynamic-items-list_kkf3imfeoijf093"
		search-url="<?php echo $search_url; ?>"
		collection-id="<?php echo $meta_col_id; ?>"
		show-image="true"
		show-name="true"
		show-search-bar="true"
		show-collection-header="0"
		layout="grid"
		collection-background-color=""
		collection-text-color=""
		grid-margin=""
		max-items-number="12"
		order="random"
		tainacan-api-root=<?php echo home_url('wp-json/tainacan/v2'); ?>
		tainacan-base-url="<?php echo $TAINACAN_BASE_URL; ?>"
		
		></div>
	
	<?php
	
	
});
