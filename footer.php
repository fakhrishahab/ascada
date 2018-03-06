<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ascada
 */

?>

	</div><!-- #content -->
	<?php
		$copyright_text = get_theme_mod('ascada_footer_copyright');

		$facebook_image = get_theme_mod('ascada_facebook_image');
		$facebook_link = get_theme_mod('ascada_facebook_link');
		$twitter_image = get_theme_mod('ascada_twitter_image');
		$twitter_link = get_theme_mod('ascada_twitter_link');
		$instagram_image = get_theme_mod('ascada_instagram_image');
		$instagram_link = get_theme_mod('ascada_instagram_link');
		$youtube_image = get_theme_mod('ascada_youtube_image');
		$youtube_link = get_theme_mod('ascada_youtube_link');

		$html = '';
	?>
	<footer>
		<div class="ff-container-fluid footer-copyright">
			<div class="ff-container footer-copyright-wrapper">
				<div class="footer-copyright__text">
					<?php echo $copyright_text;?>
				</div>

				<div class="footer-copyright__socmed">
					<?php
						if($facebook_image || $twitter_image || $instagram_image || $youtube_image){
					?>
					<ul>
						<?php
							if($facebook_image){
								$html .= '<li><a href='.$facebook_link.'><img src='.$facebook_image.'></a></li>';
							}

							if($twitter_image){
								$html .= '<li><a href='.$twitter_link.'><img src='.$twitter_image.'></a></li>';
							}

							if($instagram_image){
								$html .= '<li><a href='.$instagram_link.'><img src='.$instagram_image.'></a></li>';
							}

							if($youtube_image){
								$html .= '<li><a href='.$youtube_link.'><img src='.$youtube_image.'></a></li>';
							}

							echo $html;
						?>
						
					</ul>
					<?php }	?>
				</div>
			</div>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
