<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ascada
 */

if(! function_exists('ascada_site_logo')){
	function ascada_site_logo(){
		$logo_responsive = get_theme_mod('ascada_responsive_image');
		$html = '';
		$logo = '';
		$tagline = get_bloginfo( 'description', 'display' );
		$title = get_bloginfo('name', 'display');

		if(function_exists('has_custom_logo')){
			$html .= get_custom_logo();

			$logo .= '<a href='.esc_url( home_url( '/' ) ).' class="custom-logo-link" rel="home" itemprop="url"><img src='.$logo_responsive.'></a>';
        // );
		}	

		echo '<div class="header-logo">';
		echo '<div class="header-logo-img">'.$html.'</div>';

		
		if($title || $tagline) :
			echo '<div class="header-description">';
			if($title || is_customize_preview()) :
				echo '<div class="header-description-title">'.$title.'</div>';
			endif;

			//echo '<div class="header-logo-mobile">'.$logo.'</div>';
			
			if($tagline || is_customize_preview()) :
				echo '<div class="header-description-tagline">'.$tagline.'</div>';
			endif;
			echo '</div>';

		endif;
		

		echo '</div>';
	}
}

add_action('ascada_site_start', 'ascada_site_header');
if(! function_exists('ascada_site_header')){
	function ascada_site_header(){
?>	

	<?php
	 if(!is_front_page()) { ?>		
	<header class="ff-container-fluid header-post">
	<?php }else{ ?>
	<header class="ff-container-fluid">
	<?php };?>
		<div class="ff-container header">
			<?php
				ascada_site_logo();
			?>
			
			<?php 
			
			if(is_page(17) || is_page(129) || is_search()){
				$param = $_GET['p'];
				$type = (is_search()) ? $param : basename(get_permalink());
			?>			
			<div class="header-search-wrapper">				
				<div class="header-search">
					<form action="<?php echo home_url();?>" role="search" method="get">
						<input type="text" placeholder="Pencarian" name="s" id="s" class="header-search__input">
						<input type="hidden" name="type" id="type" value="<?php echo $type;?>">
						<img class="header-search__icon" src="<?php echo get_template_directory_uri()?>/assets/search_icon.png" alt="">
					</form>			
					<!-- <i class="fa fa-search header-search__icon"></i> -->
				</div>
			</div>
			<?php } ?>

			<div class="header-menu-toggle">
				<span></span>
				<span></span>
				<span></span>
			</div>

			<div class="header-menu">
				<ul class="header-menu-list">
					<?php wp_nav_menu(array('theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'container' => '', 'items_wrap' => '%3$s')); ?>
					<!-- <li><a href="">Jual</a></li>
					<li><a href="">Tips</a></li>
					<li><a href="">FAQ</a></li> -->
				</ul>					
			</div>

			<div class="collapsable-menu">
				<ul class="collapsable-menu-list">
					<?php wp_nav_menu(array('theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'container' => '', 'items_wrap' => '%3$s')); ?>
				</ul>
				<?php 
				if(is_page(17) || is_page(129) || is_search()){
					$param = $_GET['p'];
					$type = (is_search()) ? $param : basename(get_permalink());
				?>
				<div class="header-search-wrapper__collapsable">
					<div class="header-search">
						<form action="<?php echo home_url();?>" role="search" method="get">
							<input type="text" placeholder="Pencarian" class="header-search__input" name="s" id="s">
							<input type="hidden" name="type" id="type" value="<?php echo $type;?>">
							<img class="header-search__icon" src="<?php echo get_template_directory_uri()?>/assets/search_icon.png" alt="">
						</form>
						<!-- <i class="fa fa-search header-search__icon"></i> -->
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="collapsable-menu__overlay"></div>
		</div>
	</header>
<?php
	}
}

if ( ! function_exists( 'ascada_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function ascada_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'ascada' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'ascada_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function ascada_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'ascada' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'ascada_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ascada_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'ascada' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'ascada' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ascada' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ascada' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ascada' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ascada' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'ascada_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function ascada_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
		?>
	</a>

	<?php endif; // End is_singular().
}
endif;
