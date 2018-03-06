<?php
$categories = get_categories( array(
    'orderby' => 'name',
    'hide_empty' => false,
    'parent'  => 2
) );

// foreach($categories as $category){
// 	// print_r($category);
// 	echo $category->name;
// 	echo z_taxonomy_image_url($category->term_id);
// 	// printf( '<a href="%1$s">%2$s</a>',
//  //        esc_url( get_category_link( $category->term_id ) ),
//  //        esc_html( $category->name )
//  //    );
// }
?>

<div class="ff-container-fluid home-artist-wrapper">
	<div class="ff-container home-artist-slider swiper-container">
		<div class="swiper-wrapper">
		<?php
			foreach($categories as $category) :
		?>
	
			<div class="home-artist__item swiper-slide">
				<div class="home-artist__img" style="background-image: url(<?php echo z_taxonomy_image_url($category->term_id);?>)">
				</div>
				<div class="home-artist__title"><?php echo $category->name;?></div>
			</div>

		<?php endforeach;?>
		</div>
	</div>
</div>
