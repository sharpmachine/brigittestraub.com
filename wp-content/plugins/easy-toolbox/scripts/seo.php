<?php

//   ****** SEO KEYWORD ****** //

function my_seo_keywords() {

	if ( is_single() ) {
	// Get tags of the current post
		$page_keywords = get_the_tag_list('', ', ', ', '); 	
  	
	  	if ($page_keywords != '') {
	      $page_keywords = strtolower(htmlspecialchars(stripslashes(strip_tags(str_replace("\n", '', $page_keywords)))));
	      echo '<meta name="keywords" content="'.$page_keywords.'"/>'."\n";
	  	}
	}

	if ( is_home() ) {
		$keyword_home = get_option('etb_keyword_home');
		$keyword_home = strtolower(htmlspecialchars(strip_tags($keyword_home, ENT_QUOTES)));
      	echo '<meta name="keywords" content="'.$keyword_home.'"/>'."\n";
      	}
}


//   ****** SEO TITLE ****** //

function my_seo_title() {
	global $post, $posts;
	$separator  = 'sur';
	$blog_name  = get_bloginfo('name');
	$words = str_replace("-", ", ", strip_tags($post->post_title));
	$max_length = 65;

  if((!is_paged() ) && ( is_single() || is_page() || is_home() || is_category())) $follow_content = 'index, follow';
  else $follow_content = 'noindex, follow, noodp, noydir';

   if ( is_home() ) {
      $page_title = $blog_name;
  }
  
  if ( is_single() || is_page() ) {
      $page_title = the_title('','', FALSE);
  }
  
  if (  is_attachment() ) {
      $page_title = wp_html_excerpt (get_the_title($post->post_parent).' #'.strip_tags($post->ID) , $max_length);
  }

  
  if (is_category()) {
      $page_title = ''.single_cat_title('', FALSE);
  }
  
  if ( is_tag() ) {
      $page_title  = ''.single_tag_title('', FALSE);
  }
  
  if (is_date()) {
      $page_title = 'Post of ';
      if (is_day()) {
          $page_title .= get_the_time('j F Y', FALSE);
      }
      elseif (is_month()) {
          $page_title .= get_the_time('F Y', FALSE);
      }
      elseif (is_year()) {
          $page_title .= get_the_time('Y', FALSE);
      }
  }
  
  if (is_search()) {
       $page_title = 'Search results for: '.$_GET['s'];
  }
  
  
  
  if ($page_title != '');

  echo '<title>'.stripslashes(strip_tags($page_title)).'</title>'."\n";
  echo '<meta name="title" content="'.$page_title.'"/>'."\n";

}



//   ****** Description ****** //

function get_description($current_post) {
  $max_length = 140;
  $string = '';
  // If post has an excerpt?
  if ($current_post->post_excerpt != '') {
      $string = wp_html_excerpt ( $current_post->post_excerpt, $max_length);
  }
  else {
      // No excerpt, try to find the <!--more--> tag, or cut content.
      $char_count = min( $max_length, strpos($current_post->post_content, '<!--more-->')-1);
 
      // Extract description from the content
      $string = wp_html_excerpt ( $current_post->post_content, $max_length);
  }
  return ($string);
}



function my_seo_description() {
  global $post, $posts;
  $words = str_replace("-", ", ", strip_tags($post->post_title));
  $max_length = 140;

  
  if (is_home()) { 
  	$page_description = get_bloginfo('description');
      
  }
  
  if ( is_single() || is_page() ) {
  	$page_description = get_description($post);
    $page_keywords = get_the_tag_list( $before = '', $sep = ', ', $after = 'after' );
     
  }
  
  if (  is_attachment() ) {
      $page_description = wp_html_excerpt (get_the_title($post->post_parent).', toutes les photos', $max_length);
      $page_keywords = $words;
  }
  

  if (is_category()) {
  	$page_description = 'Toutes les photos de '.single_cat_title('', FALSE);
  
  }
  
  if ( is_tag() ) {
      
  }
  
  if (is_date()) {
      
  }
  
  if (is_search()) {
      if (sizeof($posts) > 0) {
          
	}
      else {
         
	}
  } 
  
	if ($page_description != '') {
      $page_description = htmlspecialchars(stripslashes(strip_tags(str_replace("\n", '', $page_description))));
      echo '<meta name="description" content="'.$page_description.'"/>'."\n";
  	}


} 


function my_seo_features() {
	my_seo_title();
	my_seo_description();
	my_seo_keywords();
	
}

add_action('wp_head', 'my_seo_features', 1);

?>