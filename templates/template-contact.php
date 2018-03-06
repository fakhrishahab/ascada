<?php
/**
*Template Name: Contacts Page
*/

get_header();

$company_name = get_theme_mod('ascada_company_name', 0);
$company_address = get_theme_mod('ascada_company_location', 0);
?>

<div class="ff-container-fluid contact">
	<div class="ff-container contact-wrapper">
		<div class="row">
			<div class="col-6 col-sm-12">
				<div class="contact-info">
					<div class="contact-info__name">
						<?php echo $company_name; ?>
					</div>
					<div class="contact-info__address">
						<?php echo htmlspecialchars_decode(esc_html($company_address)); ?>	
					</div>					
				</div>

				<div class="contact-form-wrapper">
					<?php 
						if(is_dynamic_sidebar('contactform')){
							dynamic_sidebar('contactform');
						}
					?>	
				</div>
					
			</div>

			<div class="col-6 col-sm-12">
				<?php 
					if(is_dynamic_sidebar('mapswidget')){
						dynamic_sidebar('mapswidget');
					}
				?>

			</div>
		</div>		
	</div>
</div>

<?php
get_footer();
?>