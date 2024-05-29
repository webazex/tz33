<?php
/**
 * Возвращает нам массив с записями
 *
 * эта функция принимает три параметра:
 *
 * первый - основной массив, обязательный, в него вкючены основные параметры
 * такие как тип поста, количество элементов, включить пагинацию или нет.
 *
 * Второй - это необязательный массив с параметрами для meta_query. Relations, terms, taxonomies указываются тут.
 *
 * Третий - это необязательный параметр который может быть строкой или массивом строк с display_name автора
 *
 * @param array $args base $args.
 * Sample:
 * [
 *  'type' => 'custom-post-type',
 *  'count' => int (0 - 9999), // 0 - all posts
 *  'paginate' => bool true|false // default = false,
 *  'author' => string author-name
 * ]
 *
 * @param array $filters $filters, empty as default
 * Sample:
 * [
 *  'tax_rel' => OR | AND //default AND,
 *  'tax-name' => [int termId,...$termIdN],
 *  'tax-name2' => [int termId,...$termIdN],
 *  ....
 *  'tax-nameN' => [int termId,...$termIdN]
 * ]
 *
 * @param string | array $authors, empty as default
 *
 * Sample: ['Snow Jon', 'Lannister Tirion', ...] OR "Stark Sansa"
 * @return array Возвращает массив с arts.
 */
function getAnyPosts( array $data, array $filters = [], $authors = ''): array {
	try {
		$ret = [];
		$taxQuery = false;
		$metaQuery = false;
		if ( empty( $data['type'] ) ) {
			throw new \Exception( "Post type not setted", 2 );
		}
		if(!empty($authors)){
			$metaQuery = [
				'relation' => 'AND'
			];
			if(is_array($authors)){
				$authorIds = [];
				foreach ($authors as $author) {
					$authorsData = getUsers($author);
					foreach ($authorsData  as $authorItem ) {
						$authorIds[] = $authorItem['ID'];
					}
				}
			}
			if(is_string($authors)){
				$authorsData = getUsers($authors);
				foreach ($authorsData  as $authorItem ) {
					$authorIds[] = $authorItem['ID'];
				}
			}
			//check id exsist authorIds
			if(!empty($authorIds)){
				$metaQuery[] = [
					'key' => 'author-с',
					'type'    => 'numeric',
					'value' => $authorIds
				];
			}

		}
		$type  = $data['type'];
		if(!empty($data['count'])){
			if(intval($data['count']) === 0){
				$count = -1;
			}else{
				$count = intval( $data['count'] );
			}
		}else{
			$count = intval( get_option( 'posts_per_page' ) );
		}
		$args  = [
			'post_type'      => $type,
			'posts_per_page' => $count
		];
		if ( ! empty( $filters ) ) {
			foreach ( $filters as $tax => $terms ) {
				//setted relation
				if ( $tax == 'tax-rel' ) {
					$rel = ( ( is_string( $terms ) == "AND" ) or ( is_string( $terms ) == "OR" ) ) ? $terms : "AND";
					$taxQuery = [
						'relation' => $rel
					];
				}
				$taxQuery[] = [
					'taxonomy' => $tax,
					'field'    => 'id',
					'terms'    => ( is_array( $terms ) ) ? $terms : [ $terms ]
				];

				//check if rel not setted
				if ( empty( $taxQuery['relation'] ) ) {
					$taxQuery = [
						'relation' => 'AND'
					];
				}
			}
		}
		//checked exsist taxQuery
		if ( is_array( $taxQuery ) ) {
			$args['tax_query'] = $taxQuery;
		}
		//check exsist metaQuery
		if(is_array($metaQuery)){
			$args['meta_query'] = $metaQuery;
		}
		//В рамках цього тестового $paginate завжди false;
		$obj = new WP_Query( $args );
		if(!empty($obj->posts)){
			foreach ($obj->posts as $PostItemObj){
				$src = (get_the_post_thumbnail_url($PostItemObj->ID, 'full') !== false)?
					get_the_post_thumbnail_url($PostItemObj->ID, 'full') :
				getPlaceholderSrc();
				$dataAuthor = get_field('author', $PostItemObj->ID);
				$ret[$PostItemObj->ID] = [
					'id' => $PostItemObj->ID,
					'title' => $PostItemObj->post_title,
					'content' => $PostItemObj->post_content,
					'link' => get_permalink($PostItemObj->ID),
					'src' => $src,
					'excerpt' => (!empty($PostItemObj->post_excerpt))?
						$PostItemObj->post_excerpt :
						wp_trim_words($PostItemObj->post_content, '20', '...'),
					'author' => [
						'id' => $dataAuthor->data->ID,
						'name' => $dataAuthor->data->display_name
					]
				];
			}
		}
	} catch ( \Exception $e ) {
		echo $e->getLine();
		echo $e->getCode();
		echo $e->getMessage();
		echo $e->getFile();
	}
	return $ret;
}

function getUsers(string $displayName){
	global $wpdb;
	$query = $wpdb->prepare("SELECT `ID`, `display_name` FROM $wpdb->users WHERE `display_name` = %s;", $displayName);
	return $wpdb->get_results( $query, ARRAY_A );
}
