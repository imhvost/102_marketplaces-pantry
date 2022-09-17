//=include plugins.js

'use strict';

/* modal */

const FIXED_ELEMENTS = '.header';

const Modal = AccessibleMinimodal.init({
	style: {
		use: false
	},
	on: {
		beforeOpen: instance => {
			const btn = $(instance.openingNode);
			const input = $(instance.modal).find('[name="title"]');
			console.log(btn.data('title'));
			if(btn.data('title')){
				input.val(btn.data('title'));
			}else{
				input.val(input.data('title'));
			}
			const scrollbarWidth = instance.getScrollbarWidth();
			$(FIXED_ELEMENTS).css('margin-right', scrollbarWidth);
		},
		afterClose: () => {
			$(FIXED_ELEMENTS).css('margin-right', 0);
		}
	}
})

$('[href^="#modal-"]').each(function(){
	const t = $(this);
	t.attr('data-modal-open', t.attr('href').substring(1));
})

/* header-nav */

$(document).on('click', '.header-nav-open', function(event){
	$('html').addClass('header-nav-opened header-nav-is-open');
	return false;
})

$(document).on('click', '.header-nav-close', function(){
	closeHeaderNav()
	return false;
})

$(document).on('click', function(event){
	if($(event.target).closest('.header-nav-open, .header-nav-close, .header-nav-body, .modal').length) return;
	closeHeaderNav();
})

$(document).on('click', '.header-nav-is-open .header-menu .menu-item-has-children>a i', function(event){
	if(window.matchMedia('(min-width:1024px)').matches) return;
	event.stopPropagation();
	const li = $(this).closest('li');
	const subMenu = li.children('.sub-menu');
	if(li.hasClass('sub-menu-is-open')){
		closeMenu();
	}else{
		closeMenu();
		li.addClass('sub-menu-is-open')
		subMenu.slideDown(400);
	}
	function closeMenu(){
		const lis = li.parent().children('.menu-item-has-children');
		lis.removeClass('sub-menu-is-open');
		lis.children('.sub-menu').slideUp(400);
	}
	return false;
})

function closeHeaderNav(){
	if(!$('html').hasClass('header-nav-is-open')) return;
	$('html').removeClass('header-nav-is-open');
	setTimeout(() => {
		$('html').removeClass('header-nav-opened');
	}, 400);
}

/* header-fixed */

fixedHeader();
$(window).on('scroll resize', fixedHeader);

function fixedHeader(){
	if($(window).scrollTop() > 0){
		$('html').addClass('header-is-fixed');
	}else{
		$('html').removeClass('header-is-fixed');
	}
}

/* sliders */

function getSlidersNav(wrapp, navigation = true, pagination = true) {
	const options = {};
	if(pagination){
		options.pagination = {
			el: wrapp.find('.slider-pagination')[0],
			type: 'fraction',
			renderFraction: (currentClass, totalClass) => {
				return `<span class="${currentClass}"></span>&nbsp;&nbsp;—&nbsp;&nbsp;<span class="${totalClass}"></span>`
			}
		};
	}
	if(navigation){
		options.navigation = {
			nextEl: wrapp.find('.slider-arrow-next')[0],
			prevEl: wrapp.find('.slider-arrow-prev')[0],
		};
	}
	return options;
}

$('.partners-slider').each(function(){
	const wrapp = $(this).closest('.slider-wrapp');
	const slider = new Swiper(this, {
		speed: 400,
		spaceBetween: 14,
		watchSlidesProgress: true,
		loop: true,
		autoplay: {
			delay: 4000,
		},
		breakpoints: {
			0: {
				slidesPerView: 'auto',
			},
			1024: {
				slidesPerView: 4,
			},
		},
		...getSlidersNav(wrapp)
	});
})

$('.cases-slider').each(function(){
	const wrapp = $(this).closest('.slider-wrapp');
	const slider = new Swiper(this, {
		speed: 400,
		spaceBetween: 14,
		watchSlidesProgress: true,
		breakpoints: {
			0: {
				slidesPerView: 'auto',
			},
			1024: {
				slidesPerView: 3,
			},
		},
		...getSlidersNav(wrapp)
	});
})

$('.docs-slider').each(function(index){
	const t = $(this);
	const wrapp = t.closest('.slider-wrapp');
	t.find('.docs-item').attr('data-gallery', 'gallery-' + index)
	const slider = new Swiper(this, {
		speed: 400,
		spaceBetween: 14,
		watchSlidesProgress: true,
		breakpoints: {
			0: {
				slidesPerView: 'auto',
			},
			1024: {
				slidesPerView: 5,
			},
			1200: {
				slidesPerView: 6,
			},
		},
		...getSlidersNav(wrapp)
	});
})

/* glightbox */

const lightbox = GLightbox({
	openEffect: 'fade',
	closeEffect: 'fade',
	videosWidth: 1440,
});

lightbox.on('open', () => $(FIXED_ELEMENTS).addClass('gscrollbar-fixer'));

lightbox.on('close', () => $(FIXED_ELEMENTS).removeClass('gscrollbar-fixer'));

/* form */

$(document).on('submit', '.form', function(event){
	event.preventDefault();
	const t = $(this);
	t.find('.submit').attr('disabled', true);
	const formData = new FormData();
	formData.append('action', 'marpan_form_action');
	t.find('[name]:not([type="file"], [type="checkbox"], [type="radio"])').each(function(){
		formData.append($(this).attr('name'), $(this).val());
	})
	t.find('[name][type="checkbox"], [name][type="radio"]').each(function(index){
		if($(this).prop('checked')){
			formData.append($(this).attr('name'), $(this).val())
		}
	})
	const files = t.find('.file-input').length ? t.find('.file-input')[0].files : false;
	if(files){
		[].slice.call(files).forEach(function(item, index){
			formData.append('file-' + index, files[index], item.name);
		})
	}
	// for (var pair of formData.entries()) {
		 // console.log(pair[0]+ ', ' + pair[1]); 
	// }
	$.ajax({
		url: SITE_URL + '/wp-admin/admin-ajax.php',
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(answer){
			// console.log(answer);
			t.find('.submit').removeAttr('disabled');
			if(answer === 'sent'){
				Modal.openModal('modal-sent');
				clearFields();
			}else{
				alert(t.data('alert'));
			}
			function clearFields(){
				t.find('.input').val('');
				t.find('.form-block').removeClass('valid not-valid focus value');
				t.find('.file-input').val('');
				t.find('.file-label-title').text(t.find('.file-label-title').data('title') || '');
				t.find('[name][type="checkbox"], [name][type="radio"]').prop('checked', false).closest('label').removeClass('active');
			}
		}
	})
});

/* scroll-to-btn */

$('.scroll-to-btn').on('click', function(){
	scrollToBlock($(this).attr('href'), 1000);
	return false;
})

function scrollToBlock(to, speed, offset){
	if(typeof to === 'string') to = $(to);
	if(!to[0]) return;
	if(!offset){
		offset = window.matchMedia('(min-width:1024px)').matches ? 82 : 60;
	}
	speed = speed || 1000;
	$('html').stop().animate({
		scrollTop: to.offset().top - offset
	}, speed);
}

/* accordion */

$(document).on('click', '.accordion-item-toggle', function(){
	const t = $(this);
	const accordion = t.closest('.accordion');
	if(t.hasClass('active')){
		close();
	}else{
		close();
		t.addClass('active');
		t.closest('.accordion-item').find('.accordion-item-body').slideDown(400);
	}
	function close(){
		accordion.find('.accordion-item-toggle').removeClass('active');
		accordion.find('.accordion-item-body').slideUp(400);
	}
	return false;
})

/* tabs */

$(document).on('click', '.tabs-nav [data-tab]', function(event){
	const t = $(this);
	const li = t.parent();
	const tab = t.data('tab');
	const tabs = t.closest('.tabs-nav').data('tabs');
	if(li.hasClass('active')) return false;
	t.closest('.tabs-nav').find('li').removeClass('active');
	$(`.tab-block[data-tabs="${tabs}"]`).removeClass('active');
	$(`.tab-block[data-tab="${tab}"]`).addClass('active');
	li.addClass('active');
	return false;
})

/* contacts-map */

if($('.contacts-map').length && location.hostname !== 'localhost'){
	setTimeout(() => {
		$.getScript( 'https://api-maps.yandex.ru/2.1/?lang=' + $('html').attr('lang'), function( data, textStatus, jqxhr ) {
			if(textStatus === 'success' && jqxhr.status === 200){
				ymaps.ready(initMap)
			}
		});
	}, 4000);
}

function initMap() {
	$('.contacts-map').each(function(){
		const markers = JSON.parse($(this).find('script').text());
		const center = [Number(markers[0].lat), Number(markers[0].lng)];
		const myMap = new ymaps.Map(this, {
			center: center,
			zoom: 16,
			controls: ['zoomControl']
		}, {
			searchControlProvider: 'yandex#search'
		});
		markers.forEach(marker => {
			const myPlacemark = new ymaps.Placemark(
				myMap.getCenter(),
			{
				balloonContent: marker.address,
				iconCaption: marker.marker
			},{
				preset: 'islands#redDotIconWithCaption'
			});
			myMap.geoObjects.add(myPlacemark);
		})
	})
}

/* mask */

$('[type="tel"]').mask('+7 (999) 999-99-99');

/* home-promo-scroll-btn */

$(document).on('click', '.home-promo-scroll-btn', function(){
	const nextSection = $('.home-promo').next();
	scrollToBlock(nextSection);
	return false;
})