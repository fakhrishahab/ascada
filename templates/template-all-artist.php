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

						$kota_asal = get_post_meta($artist['ID'], 'kota asal', true);	

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
					<div class="all-artist__img" data-id="<?php echo $artist['ID'];?>" style="background-image:url(<?php echo $category_image; ?>)">						
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

				<div class="all-artist-overlay" data-modal=modal-<?php echo $artist['ID']?>>
					<div class="all-artist-modal">
						<div class="all-artist-modal__wrapper ff-container-fluid">
							<i class="fa fa-close all-artist-modal__close"></i>
							<div class="row">
								<div class="col-5 col-sm-12 all-artist-modal__img">
									
								</div>
								<div class="col-7 col-sm-12 all-artist-modal__content">
									<?php 
										echo apply_filters('the_content',$artist['post_content']);
									?>									
								</div>
							</div>
						</div>
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

			<!-- <div class="all-artist-overlay" data-modal='modal-'>
				<div class="all-artist-modal">
					<div class="all-artist-modal__wrapper ff-container-fluid">
						<div class="row">
							<div class="col-5 all-artist-modal__img">
								
							</div>
							<div class="col-7 all-artist-modal__content">
								<p>Artist : <b></b></p>
								<p>Kota Asal : <b></b></p>
								<p>
									'lorem'
								</p>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
		
	</div>
</div>
<?php
get_footer();
?>