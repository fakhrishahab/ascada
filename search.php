<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ascada
 */

get_header(); 
$s = get_search_query();
$param = $_GET['type'];

$page_id = url_to_postid($param);

$category = get_the_category($page_id);

foreach($category as $cat){
	$selected_category = $cat->cat_ID;
}

$posts_per_page = 12;

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$args = array(
	// 'post_type' => 'post',
	'cat' => $selected_category,
	// 'cat' => '12',
	// 'post__not_in' => array(129),
	// 'posts_per_page' => $posts_per_page,
	'paged' => $paged,
	's' => $s
);

$content_posts = new WP_Query($args);

$total_posts = $content_posts->found_posts;
?>s

<div class="search-page ff-container-fluid">
	<div class="search-page-wrapper ff-container">
		<div class="search-page-content">
		<?php
			if($content_posts->have_posts()){
				if($param == 'news'){					
					while( $content_posts->have_posts()) : $content_posts->the_post();
						$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
						$link = esc_url($featured_img_url);
						$artist = get_post_meta(get_the_ID(), 'artist', true);	
		?>
					<div class="news-item">
						<div class="news-item__img" style="background-image: url('<?php echo $link;?>')">	
						</div>

						<div class="news-item__description">
							<div class="news-item__title"><a href="<?php echo the_guid();?>"><?php echo the_title();?></a></div>
							<?php
								if(!empty($artist)){
									echo '<div class="news-item__artist">Artis : <span class="artist-name">'.$artist.'</span></div>';
								}
							?>
							<div class="news-item__tagline"><?php echo wp_trim_words(the_content(), 25, '  ...'); ?></div>
						</div>
					</div>
		<?php
					endwhile;

				}elseif($param == 'all-video'){
					while( $content_posts->have_posts()) : $content_posts->the_post();
						$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
						$link = esc_url($featured_img_url);
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
					endwhile;
				}

				
		?>

					
		<?php
			}else{
		?>

			<div class="notfound-content">
				<div class="notfound-content-wrapper">
					<div class="notfound-content__img">
						<img src="<?php echo get_template_directory_uri().'/assets/not-found.png'?>" alt="">	
					</div>
					<div class="notfound-content__description">
						<div class="notfound-content__headline">Oooooppss..</div>
						<div class="notfound-content__detail">Article that you are looking for is not found</div>
					</div>
				</div>				
			</div>
		<?php
			}

		?>
		</div>
	</div>

	<div class="pagination ff-container">
		<div class="pagination-wrapper">
			<?php
			$total_pages = ceil($total_posts / $posts_per_page);	
			if($total_posts > 1){
				$current_page = max(1, get_query_var('paged'));		
				$big = 999999999;				
		        echo paginate_links(array(
		            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		            'format' => '?paged/%#%',
		            'current' => $current_page,
		            'total' =>$content_posts->max_num_pages,
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
