<?php
/**
 * The template for displaying all singlenews posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#singlenews-post
 *
 * @package ascada
 */

get_header(); 


$this_post = get_post();

$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
$link = esc_url($featured_img_url);
$artist = get_post_meta(get_the_ID(), 'artist', true);

$args = array(
	'post_type' => 'post',
	'post_per_page' => 3,
	'post__not_in' => array(129, get_the_ID()),
	'meta_key' => 'artist',
	'meta_query' => array(array('key' => 'artist', 'value' => $artist))
);


$query = wp_get_recent_posts($args, ARRAY_A);
?>

<div class="singlenews ff-container-fluid">
	<div class="singlenews-wrapper ff-container">
		<div class="singlenews-thumbnail" style="background-image: url('<?php echo $link;?>')">			
		</div>
		<div class="singlenews-content">
			
			<?php the_title('<h1 class="singlenews-content__title">','</h1>');?>

			<div class="singlenews-content__meta">
				Artist : <span><?php echo $artist?></span> | 
				<?php
					 echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; 
				?>
			</div>

			<div class="singlenews-content__content">
				<div class="row">
					<div class="col-1">&nbsp;</div>
					<div class="col-1 col-sm-12 singlenews-content__sidebar">
						<?php
							if ( is_dynamic_sidebar('sliderwidget') ) {
								dynamic_sidebar('socialwidget');
							}
						?>
					</div>
					<div class="col-8 col-sm-12 singlenews-content__text">
						<?php
							while ( have_posts() ) : the_post();
							the_content();
							endwhile;
						?>	

						<div class="singlenews-content__tags">
							<?php
								$post_tag = [];
								$tags = get_tags( array( 'hide_empty' => false ) );
								if($tags){
									foreach($tags as $tag){
										if(has_tag($tag->slug)){
											array_push($post_tag, $tag->name);
											// print_r($tag->name);
										}else{
											$post_tag = [];
											// echo 'ga ada';
										}
									}
								}

								if(count($post_tag) >= 1){
									echo '<ul class="singlenews-content__tags-list">';

									foreach($post_tag as $posttag){
										echo '<li><a>'.$posttag.'</a></li>'; 
									}

									echo '</ul>';
								}
							?>
						</div>
					</div>

					<div class="col-2 col-sm-12">
						&nbsp;
					</div>
				</div>				
			</div>
			
		</div>
	</div>
	

	<?php
	if(!empty($query)){
	?>
	<div class="ff-container related">
		<div class="related-wrapper">
			<h2>Related Article</h2>
			<div class="related-article">
				<?php 
				// var_dump($query);
				foreach ($query as $data) : setup_postdata($data);
					$featured_img_url = get_the_post_thumbnail_url($data['ID'],'full'); 
					$link = esc_url($featured_img_url);

					$artist = get_post_meta(get_the_ID(), 'artist', true);	
				?>
					<div class="related-article__item">
						<div class="related-article__img" style="background-image: url('<?php echo $link;?>')"></div>
						<div class="related-article__content">
							<div class="related-article__title"><a href="<?php echo the_guid();?>"><?php echo $data['post_title']?></a></div>
							<?php 
							if(!empty($artist)){
								echo '<div class="related-article__artist">Artist : <span>'.$artist.'</span></div>';
							}
							?>
							<div class="related-article__text"><?php echo wp_trim_words($data['post_content'], 25, ' ...');?></div>
						</div>
					</div>
				<?php					
				endforeach;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
	<?php
	}
	?>
</div>


<?php
// get_sidebar();
get_footer();
