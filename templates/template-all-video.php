<?php
/**
*Template Name: All Video
*/

get_header();
$posts_per_page = 12;

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$category_name = 'latest-release';
$args = array(
	'category_name' => $category_name,
	'post_type' => 'post',
	'post__not_in' => array(129),	
	'posts_per_page' => $posts_per_page,
	'paged' => $paged,
);

$content_posts = new WP_Query($args);

$total_posts = $content_posts->found_posts;
?>

<div class="video ff-container-fluid">
	<div class="video-wrapper ff-container">
		<div class="video-content">
			<?php
			if($content_posts->have_posts()){

				while( $content_posts->have_posts()) : $content_posts->the_post();
					if(get_post_type() == 'post'){
						$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
						$link = esc_url($featured_img_url);

						// $artist = get_post_meta(get_the_ID(), 'artist', true);	
			?>
				<div class="latest-video" data-video="<?php echo get_the_content();?>">
				
				<div class="latest-video__img" style="background-image: url('<?php echo $link;?>')">						
				</div>
				<div class="latest-video__detail">
					<div class="outer-v">
						<div class="inner-v">
							<div class="latest-video__icon"></div>
						</div>
					</div>
					<div class="latest-video__title">
						<?php echo the_title();?>
					</div>
				</div>
			</div>
			<?php 
					}
				endwhile;
			}
			?>
		</div>
	</div>

	<div class="pagination ff-container">
		<div class="pagination-wrapper">
			<?php
			$total_pages = ceil($total_posts / $posts_per_page);			
			if($total_posts > 1){
				$big = 999999999;
				$current_page = max(1, get_query_var('paged'));						
		        echo paginate_links(array(
		            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		            'format' => '?paged/%#%',
		            'current' => $current_page,
		            'total' =>$total_pages,
		            'prev_text' => __('<i class="fa fa-chevron-left"></i>'),
					'next_text' => __('<i class="fa fa-chevron-right"></i>'),
					'type' => 'list'
		            // 'prev_next' => false
		        ));
			    
			}
			?>
		</div>
	</div>
</div>
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
<?php
get_footer();
?>