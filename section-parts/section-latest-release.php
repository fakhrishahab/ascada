<?php
	$category_name = 'latest-release';
	$args = array(
		'numberposts' => 9,
		'offset' => 0,
		'category_name' => $category_name,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' =>'',
		'post_type' => 'post',
		'post__not_in' => array(129),
		'post_status' => 'draft, publish, future, pending, private',
		'suppress_filters' => true
	);

$recent_posts = wp_get_recent_posts($args, ARRAY_A);
?>

<section class="home-latest ff-container-fluid">
	<div class="ff-container">
		<h1>Latest Release</h1>
		<div class="home-latest-wrapper">
			
			<?php
				foreach($recent_posts as $post) : setup_postdata($post);
					$link = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), 'single-post-thumbnail');

					// if($post['post_type'] == 'post') :
			?>

			<div class="latest-video" data-video="<?php echo $post['post_content']?>">
				
				<div class="latest-video__img" style="background-image: url(<?php echo $link[0];?>)">						
				</div>
				<div class="latest-video__detail">
					<div class="outer-v">
						<div class="inner-v">
							<div class="latest-video__icon"></div>
						</div>
					</div>
					<div class="latest-video__title">
						<?php echo $post['post_title']?>
					</div>
				</div>
			</div>

			<?php
				// endif;
				endforeach;
				wp_reset_postdata();
			?>
						
		</div>
		<div class="home-latest__btn">
			<a href="<?php echo get_page_link(129);?>">LIHAT SEMUA VIDEO</a>
		</div>
	</div>
</section>

<div class="video-modal">
	<div class="video-modal__wrapper">
		<div class="video-modal__content">
			<div class="video-modal__close">
				<i class="fa fa-times" aria-hidden="true"></i>
			</div>
			<iframe src="" allowfullscreen autoplay="1" frameborder="0" id="video-model__frame"></iframe>
		</div>
	</div>
</div>