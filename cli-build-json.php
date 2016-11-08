<?php

$files = glob( 'json/*.json' );

$authors = array();
$terms = array();
$posts = array();

//$files = array_slice( array_reverse( $files ), 0, 1 );

foreach ( $files as $file ) {
	$records = json_decode( file_get_contents( $file ) );

	foreach ( $records->authors as $author_id => $author ) {
		if ( ! isset( $authors[ $author_id ] ) ) {
			$authors[ $author_id ] = $author;
		}
	}

	foreach ( $records->posts as $post ) {
		$post_id = (int) $post->post_id;

		if ( ! isset( $posts[ $post_id ] ) ) {
			$posts[ $post_id ] = $post;
		}
	}

	foreach ( $records->terms as $term ) {
		$term_id = (int) $term->term_id;

		if ( ! isset( $terms[ $term_id ] ) ) {
			$terms[ $term_id ] = $term;
		}
	}

	echo $file . "\n";
}

file_put_contents( 'posts.json', json_encode( $posts ) );
file_put_contents( 'terms.json', json_encode( $terms ) );
file_put_contents( 'authors.json', json_encode( $authors ) );

echo "Done!";
