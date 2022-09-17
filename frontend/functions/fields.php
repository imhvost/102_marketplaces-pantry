<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'marpan_crb_init_fields' );
function marpan_crb_init_fields() {
	
	$complex_labels = array(
		'plural_name'   => __( 'Элементы', DOMAIN ),
		'singular_name' => __( 'Элемент', DOMAIN ),
	);
	
	/* options */
	Container::make( 'theme_options', __( 'Опции темы', DOMAIN ) )
		->add_fields( array (
			Field::make( 'image', 'logo', __( 'Лого', DOMAIN ) ),
			Field::make( 'text', 'header_btn', __( 'Кнопка в шапке', DOMAIN ) ),
			Field::make( 'text', 'footer_btn', __( 'Кнопка в подвале', DOMAIN ) ),
			Field::make( 'text', 'copyright', __( 'Копирайт', DOMAIN ) )
				->set_help_text( __( '{Y} - текущий год', DOMAIN ) ),
			Field::make( 'textarea', 'modal_title', __( 'Попап - заголовок', DOMAIN ) )
				->set_rows( 3 ),
			Field::make( 'image', 'modal_img', __( 'Попап - картинка', DOMAIN ) )
				->set_type( array( 'image' ) ),
			Field::make( 'text', 'modal_sent_title', __( 'Попап отправлено - заголовок', DOMAIN ) ),
			Field::make( 'textarea', 'modal_sent_desc', __( 'Попап отправлено - описание', DOMAIN ) )
				->set_rows( 3 ),
		) )
	;
	
	/* promo */
	Container::make( 'post_meta', __( 'Промо', DOMAIN ) )
		->where( 'post_template', '!=', 'front-page.php' )
		->where( 'post_type', 'NOT IN', [ 'case' ] )
		->set_context( 'side' )
		->add_fields( array (
			Field::make( 'image', 'promo_img', __( 'Фоновая картинка', DOMAIN ) ),
			Field::make( 'checkbox', 'promo_show_form', __( 'Показывать форму', DOMAIN ) )
				->set_option_value( 'yes' ),
			Field::make( 'text', 'promo_form_submit', __( 'Кнопка формы', DOMAIN ) )
				->set_default_value( __( 'Рассчитать стоимость', DOMAIN ) )
				->set_conditional_logic( array(
						array(
							'field' => 'promo_show_form',
							'value' => true,
						)
				 ) ),
		) )
	;
	
	/* contacts */
	Container::make( 'post_meta', __( 'Поля', DOMAIN ) )
		->where( 'post_template', '=', 'page-contacts.php' )
		->add_fields( array (
			Field::make( 'complex', 'tels', __( 'Телефоны', DOMAIN ) )
				->setup_labels( $complex_labels )
				->set_collapsed( true )
				->set_layout( 'tabbed-vertical' )
				->add_fields( array(
					Field::make( 'text', 'tel', __( 'Телефон', DOMAIN ) )
						->set_required( true ),
				) )
				->set_header_template( '<%- tel %>' ),
			Field::make( 'complex', 'emails', __( 'Почтовые ящики', DOMAIN ) )
				->setup_labels( $complex_labels )
				->set_collapsed( true )
				->set_layout( 'tabbed-vertical' )
				->add_fields( array(
					Field::make( 'text', 'email', __( 'Почта', DOMAIN ) )
						->set_required( true ),
				) )
				->set_header_template( '<%- email %>' ),
			Field::make( 'complex', 'addresses', __( 'Адреса', DOMAIN ) )
				->setup_labels( $complex_labels )
				->set_collapsed( true )
				->set_layout( 'tabbed-vertical' )
				->add_fields( array(
					Field::make( 'text', 'address', __( 'Адрес', DOMAIN ) )
						->set_required( true ),
					Field::make( 'text', 'marker', __( 'Маркер', DOMAIN ) ),
					Field::make( 'text', 'lat', 'lat' ),
					Field::make( 'text', 'lng', 'lng' ),
				) )
				->set_header_template( '<%- address %>' ),
			Field::make( 'complex', 'social', __( 'Соцсети', DOMAIN ) )
				->setup_labels( $complex_labels )
				->set_collapsed( true )
				->set_layout( 'tabbed-vertical' )
				->add_fields( array(
					Field::make( 'text', 'title', __( 'Название', DOMAIN ) )
						->set_required( true ),
					Field::make( 'image', 'icon', __( 'Иконка', DOMAIN ) )
						->set_required( true ),
					Field::make( 'text', 'link', __( 'Ссылка', DOMAIN ) )
						->set_required( true ),
				) )
				->set_header_template( '<%- title %>' ),
			
		) )
	;
	
	/* home */
	Container::make( 'post_meta', __( 'Поля', DOMAIN ) )
		->where( 'post_template', '=', 'front-page.php' )
		->add_tab( __( 'Промо' ), array(
			Field::make( 'image', 'promo_img', __( 'Картинка', DOMAIN ) ),
			Field::make( 'textarea', 'promo_title', __( 'Заголовок', DOMAIN ) )
				->set_rows( 4 )
				->set_required( true ),
			Field::make( 'text', 'promo_form_title', __( 'Заголовок формы', DOMAIN ) ),
			Field::make( 'text', 'promo_form_btn', __( 'Кнопка формы', DOMAIN ) ),
		) )
		->add_tab( __( 'Преимущества' ), array(
			Field::make( 'text', 'advantages_title', __( 'Заголовок', DOMAIN ) ),
			Field::make( 'text', 'advantages_sub_title', __( 'Подзаголовок', DOMAIN ) ),
			Field::make( 'complex', 'advantages', __( 'Преимущества', DOMAIN ) )
				->setup_labels( $complex_labels )
				->set_collapsed( true )
				->set_layout( 'tabbed-vertical' )
				->add_fields( array(
					Field::make( 'image', 'icon', __( 'Иконка', DOMAIN ) ),
					Field::make( 'textarea', 'desc', __( 'Описание', DOMAIN ) )
						->set_rows( 3 )
						->set_required( true ),
				) )
				->set_header_template( '<%= desc %>' ),
		) )
		->add_tab( __( 'Услуги' ), array(
			Field::make( 'text', 'services_title', __( 'Заголовок', DOMAIN ) ),
			Field::make( 'textarea', 'services_desc', __( 'Описание', DOMAIN ) )
				->set_rows( 3 ),
			Field::make( 'association', 'services', __( 'Услуги', DOMAIN ) )
				->set_types( array(
					array(
						'type'      => 'post',
						'post_type' => 'service',
					)
				) ),
			Field::make( 'text', 'services_btn', __( 'Кнопка', DOMAIN ) ),
		) )
		->add_tab( __( 'Кейсы' ), array(
			Field::make( 'text', 'cases_title', __( 'Заголовок', DOMAIN ) ),
			Field::make( 'association', 'cases', __( 'Кейсы', DOMAIN ) )
				->set_types( array(
					array(
						'type'      => 'post',
						'post_type' => 'case',
					)
				) ),
		) )
		->add_tab( __( 'Обратная связь' ), array(
			Field::make( 'image', 'feedback_img', __( 'Картинка', DOMAIN ) ),
			Field::make( 'text', 'feedback_title', __( 'Заголовок', DOMAIN ) ),
			Field::make( 'text', 'feedback_form_btn', __( 'Кнопка формы', DOMAIN ) ),
			Field::make( 'textarea', 'feedback_form_agreement', __( 'Cогласие на обработку', DOMAIN ) )
				->set_rows( 3 ),
		) )
	;
	
	/* service */
	Container::make( 'post_meta', __( 'Карточка', DOMAIN ) )
		->where( 'post_type', '=', 'service' )
		->set_context( 'side' )
		->add_fields( array (
			Field::make( 'image', 'card_icon', __( 'Иконка', DOMAIN ) ),
			Field::make( 'text', 'card_title', __( 'Заголовок', DOMAIN ) ),
			Field::make( 'textarea', 'card_desc', __( 'Описание', DOMAIN ) )
				->set_rows( 4 ),
		) )
	;
	
	/* servics */
	Container::make( 'post_meta', __( 'Поля', DOMAIN ) )
		->where( 'post_template', '=', 'page-services.php' )
		->add_fields( array (
			Field::make( 'text', 'title', __( 'Заголовок', DOMAIN ) ),
			Field::make( 'textarea', 'desc', __( 'Описание', DOMAIN ) )
				->set_rows( 4 ),
			Field::make( 'association', 'services', __( 'Услуги', DOMAIN ) )
				->set_types( array(
					array(
						'type'      => 'post',
						'post_type' => 'service',
					)
				) ),
			Field::make( 'text', 'other_services_title', __( 'Другие услуги - заголовок', DOMAIN ) ),
			Field::make( 'text', 'other_services_sub_title', __( 'Другие услуги - подзаголовок', DOMAIN ) ),
		) )
	;
	
	/* case */
	Container::make( 'post_meta', __( 'Поля', DOMAIN ) )
		->where( 'post_type', '=', 'case' )
		->add_fields( array (
			Field::make( 'textarea', 'desc', __( 'Описание', DOMAIN ) )
				->set_rows( 4 ),
			Field::make( 'text', 'enter_point', __( 'Входная точка', DOMAIN ) )
				->set_attribute( 'type', 'number' ),
			Field::make( 'text', 'current_point', __( 'Текущий оборот', DOMAIN ) )
				->set_attribute( 'type', 'number' ),
			Field::make( 'text', 'currency', __( 'Валюта', DOMAIN ) )
				->set_default_value( __( '₽', DOMAIN ) ),
			Field::make( 'textarea', 'we_did', __( 'Мы провели', DOMAIN ) )
				->set_rows( 8 ),
			Field::make( 'text', 'btn', __( 'Кнопка', DOMAIN ) )
				->set_default_value( __( 'Оптимизируйте мой бизнес', DOMAIN ) ),
		) )
	;


}


?>