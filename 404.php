<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ascada
 */

get_header(); 
?>

<div class="ff-container-fluid">
	<div class="notfound ff-container">
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
	</div>
</div>

<?php
get_footer();
