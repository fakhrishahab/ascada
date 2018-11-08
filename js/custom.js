var positionTop = jQuery(document).scrollTop();
jQuery(document).ready(function(){
	

	if(positionTop > 250){
		jQuery('header').addClass('header--sticky')
	}else{
		jQuery('header').removeClass('header--sticky')
	}

	jQuery('.latest-video').on('click', function(){
		// var title = jQuery(this).data('title');
		var video = jQuery(this).data('video');

		jQuery('.video-modal').addClass('video-modal--show');
		// jQuery('.video-modal').find('h2').html(title);
		jQuery('.video-modal').find('iframe').attr('src', video+'?autoplay=1');
		jQuery('body').css('overflow', 'hidden');
	});

	jQuery('.video-modal__close').on('click', function(){
		jQuery('.video-modal').find('iframe').attr('src', '');
		jQuery(this).parents('.video-modal').removeClass('video-modal--show');
		jQuery('body').css('overflow', 'auto');
	});

	var artistSwiper = new Swiper('.swiper-container', {
		direction: 'horizontal',
		autoplay: {
			delay: 5000,
		},
		// loop: true,
		slidesPerView : 4,
		initialSlide: 0,
		spaceBetween : 20,
		breakpoints: {
			2000: {
				loop: true
			},
			768:{
				slidesPerView: 2,
				loop: true
			},
			361:{
				slidesPerView: 1
			}
		}
	});

	jQuery('.header-menu-toggle').on('click', function(){
		jQuery('.collapsable-menu').addClass('collapsable-menu--active');
		jQuery('.collapsable-menu__overlay').addClass('collapsable-menu__overlay--active');
	});

	jQuery('.collapsable-menu__overlay').on('click', function(){
		jQuery('.collapsable-menu').removeClass('collapsable-menu--active');
		jQuery('.collapsable-menu__overlay').removeClass('collapsable-menu__overlay--active');
	})

	jQuery(document).on('scroll', function(evt){


		var scrollTop = jQuery(document).scrollTop();
		// var scroll = jQuery(document).scrollTop();
		// var top = (scroll / 100);
		// if(scrollTop <= 400){
		// 	var bgPositionY = parseFloat(jQuery('.n2-ss-background-image').css('background-position-y'));
		// 	// console.log(bgPositionY)
		// 	if(scrollTop > positionTop){
		// 		var posY = parseFloat(bgPositionY + (scrollTop / 100) * 1).toFixed(2);
		// 	}else{
		// 		// console.log(bgPositionY, positionTop)
		// 		if(bgPositionY <= 51){
		// 			posY = 50;
		// 		}else{
		// 			posY = parseFloat(bgPositionY - (positionTop / 100) * 1).toFixed(2) ;	
		// 		}
				
		// 	}
		// 	jQuery('.n2-ss-background-image').css('background-position-y', (posY)+'%');
		// 	positionTop = scrollTop;
		// }

		// positionTop = scroll;
		// console.log(scrollTop)
		if(scrollTop > 250){
			jQuery('header').addClass('header--sticky')
		}else{
			jQuery('header').removeClass('header--sticky')
		}
		// console.log(scrollTop);
		if(scrollTop > 670){
			jQuery('.sfsi_widget').addClass('social-fixed');
		}else{
			jQuery('.sfsi_widget').removeClass('social-fixed');
		}

	});

	jQuery('.all-artist__img').on('click', function(){
		var id = jQuery(this).data('id');
		var artistImg = jQuery(this).parent().clone();

		jQuery('.all-artist-overlay[data-modal=modal-'+id+']').addClass('all-artist-overlay--show');
		jQuery('.all-artist-overlay[data-modal=modal-'+id+']').find('.all-artist-modal__img').empty().append(artistImg);
		jQuery('body').css('overflow', 'hidden');
	});

	jQuery('.all-artist-modal__close').on('click', function(e){
		e.stopPropagation();
		e.preventDefault();
		jQuery(this).parents('.all-artist-overlay').removeClass('all-artist-overlay--show');
		jQuery('body').css('overflow', 'auto');
	});

	jQuery('.header-search__input').on('keyup', function(){
		var text = jQuery(this).val();
		console.log(jQuery(this).val());
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			url: '../wp-admin/admin-ajax.php',
			data: 'action=get_listing_names&name='+text,
			success: function(data) {
				console.log(data);
			}
		});
	});

});



