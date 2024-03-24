<?php

class Kadence_Blocks_Pro_Query_Indexer_Woo {

	public function __construct() {
		if ( !class_exists( 'Woocommerce' ) ) {
			return;
		}

		add_filter( 'kadence_blocks_pro_query_index_object', [ $this, 'index' ], 20, 3 );

	}

	// Index the woo field
	public function index( $rows, $object_id, $facet ) {
		$source = explode( '/', $facet['source'] );

		if ( 'woocommerce' !== $source[0] ) {
			return $rows;
		}

		$post_type = get_post_type( $object_id );

		if (!in_array($post_type, ['product', 'product_variation'])) {
			return $rows;
		}

		$product = wc_get_product( $object_id );

		if ( empty( $product ) ) {
			return $rows;
		}

		$array   = explode( '/', $facet['source'] );
		$field   = end( $array );

		switch ( $field ) {
			case '_price':
			case '_regular_price':
			case '_sale_price':
				$call = $product->is_type('variable') ? 'get_variation' . $field : 'get' . $field;
				$facet_value = $product->$call( $product->is_type('variable') ? 'min' : null );
				$facet_name = $product->$call( $product->is_type('variable') ? 'max' : null );

				$tax_display_shop = get_option('woocommerce_tax_display_shop') === 'incl';
				$get_price_call = $tax_display_shop ? 'wc_get_price_including_tax' : 'wc_get_price_excluding_tax';

				$facet_value = $get_price_call( $product, [ 'price' => $facet_value ]);
				$facet_name = $get_price_call( $product, [ 'price' => $facet_name ]);
			break;
			case '_on_sale':
				$facet_value = (int) $product->is_on_sale();
				$facet_name  = $facet_value ? __( 'On Sale', 'kadence-blocks-pro' ) : '';
				break;
			case '_average_rating':
				$facet_value = $product->get_average_rating();
				$facet_name  = $facet_value;
				break;
			case '_stock_status':
				$in_stock = $product->is_in_stock();
				$facet_value = (int) $in_stock;
				$facet_name  = $in_stock ? __( 'In Stock', 'kadence-blocks-pro' ) : __( 'Out of Stock', 'kadence-blocks-pro' );
				break;
			default:
				$tax_name = wc_attribute_taxonomy_name_by_id( (int) $field );
				$facet_value = $product->get_attribute( $tax_name );
				$facet_name  = $facet_value;
				break;
		}

		if ( isset( $facet_value ) && isset( $facet_name ) ) {
			$rows[] = array(
				'facet_value' => $facet_value,
				'facet_name'  => $facet_name,
			);
		}

		return $rows;
	}

}
