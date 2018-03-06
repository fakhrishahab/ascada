<?php
/**
*Template Name: News Page
*/

get_header();

$posts_per_page = 12;

$page_id = get_the_ID();
$category = get_the_category($page_id);

foreach($category as $cat){
	$selected_category = $cat->cat_ID;
}

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$args = array(
	'post_type' => 'post',
	'cat' => $selected_category,
	'posts_per_page' => $posts_per_page,
	'paged' => $paged,
	'post__not_in' => array(17),
);

$content_posts = new WP_Query($args);

$total_posts = $content_posts->found_posts;

?>

<div class="news ff-container-fluid">
	<div class="news-wrapper ff-container">
		<div class="news-content">

			<?php
			if($content_posts->have_posts()){

				while( $content_posts->have_posts()) : $content_posts->the_post();
					if(get_post_type() == 'post'){
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
									echo "<div class='news-item__artist'>Artis : <span class='artist-name'>".$artist."</span></div>";
								}
							?>
							<div class="news-item__tagline"><?php echo wp_trim_words(the_content(), 25, '  ...'); ?></div>
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

<?php
get_footer();
?>