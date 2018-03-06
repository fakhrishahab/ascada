<?php
/**
*Template Name: All Artist
*/

get_header();

$category_id = 2;

$args = array(
	'post_type' => 'post',
	'cat' => '2, -12'
	// 'cat' => $category_id,
	// 'category__not_in' => array(13)
);

$all_artist = wp_get_recent_posts($args, ARRAY_A);

?>


<div class="ff-container-fluid content-post">
	<div class="ff-container content-wrapper">
		<div class="all-artist row">
			<div class="all-artist__list">
			<?php
				$html = '';
				$socmed = '';
				foreach ($all_artist as $artist) : setup_postdata($artist);

					if($artist['post_type'] == 'post'){
						$category = wp_get_post_categories($artist['ID']);
						$category_image = z_taxonomy_image_url($category[0]);
						
						$facebook = get_post_meta($artist['ID'], 'facebook', true);	
						$instagram = get_post_meta($artist['ID'], 'instagram', true);	
						$youtube = get_post_meta($artist['ID'], 'youtube', true);	
						$twitter = get_post_meta($artist['ID'], 'twitter', true);	

						if(! empty($facebook)){
							$socmed .= '<li><a href="'.$facebook.'"><img src="" alt=""></a></li>';
						}
						if(! empty($instagram)){
							$socmed .= '<li><a href="'.$instagram.'"><img src="" alt=""></a></li>';	
						}
						if(! empty($youtube)){
							$socmed .= '<li><a href="'.$youtube.'"><img src="" alt=""></a></li>';	
						}
						if(! empty($twitter)){
							$socmed .= '<li><a href="'.$twitter.'"><img src="" alt=""></a></li>';	
						}

			?>

				<div class="all-artist__item">
					<div class="all-artist__img" style="background-image:url(<?php echo $category_image; ?>)">						
					</div>
					<div class="all-artist__detail">
						<h2><?php echo $artist['post_title'];?></h2>
						<ul class="all-artist__socmed">
							<?php
								if(! empty($facebook)){
									echo '<li><a href="'.$facebook.'"><img src='.get_template_directory_uri().'/assets/fb.png alt=""></a></li>';
								}
								if(! empty($instagram)){
									echo '<li><a href="'.$instagram.'"><img src='.get_template_directory_uri().'/assets/ig.png alt=""></a></li>';	
								}
								if(! empty($youtube)){
									echo '<li><a href="'.$youtube.'"><img src='.get_template_directory_uri().'/assets/youtube.png alt=""></a></li>';	
								}
								if(! empty($twitter)){
									echo '<li><a href="'.$twitter.'"><img src='.get_template_directory_uri().'/assets/twitter.png alt=""></a></li>';	
								}
							?>
						</ul>
					</div>
				</div>

			<?php	
					}
					

					// print_r($artist);
					// echo $artist['post_title'].'<br/>';
					// echo $category['term_id'];
					// echo $category_image;

				// echo $artist['ID'];
				// echo get_post_meta($artist['ID'], 'facebook', true);		

				endforeach;
				wp_reset_postdata();
			?>		
			</ul>
		</div>
		
	</div>
</div>
<?php
get_footer();
?>