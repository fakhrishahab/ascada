<div class="ff-container-fluid footer">
	<div class="ff-container footer-wrapper">
		<div class="row">
			<div class="col-4 col-sm-12">
				<div class="footer-img-wrapper">
					<div class="footer-img__img">
						<?php
							$logo = '';
							$logo_responsive = get_theme_mod('ascada_responsive_image');
							if(function_exists('has_custom_logo')){
								$html .= get_custom_logo();
								$logo_id = get_theme_mod('custom_logo');
								$image = wp_get_attachment_image_src($logo_id, 'full');

								$logo .= '<img src='.$image[0].'>';
				        		
				        		// echo $html;
							}	

							echo $logo;

						?>
					</div>

					<div class="footer-img__detail">
						<?php
							$tagline = get_bloginfo( 'description', 'display' );
							$title = get_bloginfo('name', 'display');

							if($title){
								echo '<div class="footer-img__title">'.$title.'</div>';
							}
							if($tagline){
								echo '<div class="footer-img__tagline">'.$tagline.'</div>';	
							}
						?>
						
					</div>
				</div>
			</div>
			<div class="col-4 col-sm-12">
					
				<ul class="footer-menu">
					<li class="footer-menu__title">Explore</li>
					<?php wp_nav_menu(array('theme_location' => 'menu-2', 'container' => '', 'items_wrap' => '%3$s')); ?>
				</ul>

				<ul class="footer-menu">
					<li class="footer-menu__title">About Us</li>
					<?php wp_nav_menu(array('theme_location' => 'menu-3', 'container' => '', 'items_wrap' => '%3$s')); ?>
				</ul>

			</div>
			<div class="col-4 col-sm-12">
				<div class="footer-address">
					<?php
						$company_name = get_theme_mod('ascada_company_name', 0);
						$company_address = get_theme_mod('ascada_company_location', 0);
					?>
					<div class="footer-address__name">
						<?php echo $company_name; ?>
					</div>
					<div class="footer-address__address">
						<?php echo htmlspecialchars_decode(esc_html($company_address)); ?>
					</div>
				</div>			

			</div>
		</div>
	</div>
</div>