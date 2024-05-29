<?php
require_once get_stylesheet_directory().DS.'inc'.DS.'getters.php';
add_shortcode('arts', function ($atts){
	try {
		$html = '';
		if(!empty($atts)){
			$count = (!empty($atts['items']))? $atts['items'] : get_option('posts_per_page');
			$cats = [];
			$authors = '';
			//parsed shortcode atts
			foreach ($atts as $k => $v){
				if($k == 'music' OR $k == 'photo'){
					$cats[$k] = $v;
				}
				if($k == 'author'){
					$authors = $v;
				}
			}
			$arts = getAnyPosts(
				[
					'count' => intval($count),
					'type' => 'arts'
				],
				$cats, $authors
			);
			if(!empty($arts)){
				$html = '<div class="arts-grid">';
				foreach ($arts as $art) {
					$html .= '<div class="arts-grid__art-item" id="'.$art['id'].'">';
					$html .= '<img src="'.$art['src'].'" alt="'.$art['title'].'">';
					$html .= '<div class="art-item__body">';
					$html .= '<span class="body__art-title">'.$art['title'].'</span>';
					$html .= '<div class="body__art-excerpt">';
					$html .= $art['excerpt'];
					$html .= '</div>';
					$html .= '<div class="body__art-author">';
					$html .= $art['author']['name'];
					$html .= '</div>';
					$html .= '<a href="'.$art['link'].'">'.__('Show this art', 'ttfc').'</a>';
					$html .= '</div>';
					$html .= '</div>';
				}
				$html .= '</div>';
			}else{
				$html = '<div class="arts-empty">';
				$html .= '<span>'.__('Arts not found', 'ttfc').'</span>';
				$html .= '</div>';
			}
		}else{
			Throw new \Exception("Invalid shortcode atts", 3);
		}
	} catch (\Exception $e){
		echo $e->getMessage();
	}
	return $html;
});