<?php
/*
 * Custom post type registration. Set up Articles, Language Lessons, and Recipes
 * TODO: Add all appropriate labels for search, add new, etc
*/

// Articles
if (get_option('travel_tales_articles')) {
	add_action('init', 'article_register');
	
	function article_register() {
		$args = array(
			'label' => __('Articles'),
			'singlar_label' => __('Article'),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
		);
		if (!get_option('travel_tales_lock_post_types')) {
			flush_rewrite_rules(false);
		}
		
		register_post_type('article', $args);
		register_taxonomy('topic', 
			array('article'), 
			array(
				'hierarchical' => true, 
				'label' => __('Topics'), 
				'singular_label' => __('Topic'), 
				'rewrite' => true
			)
		);
		if (!get_option('travel_tales_lock_post_types')) {
			flush_rewrite_rules(false);
		}
	} 
}

// Language lessons 
if (get_option('travel_tales_language_lessons')) {
	add_action('init', 'language_lesson_register');
	
	function language_lesson_register() {
		$args = array(
			'label' => __('Language Lessons'),
			'singlar_label' => __('Language Lesson'),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'rewrite' => true,
			'supports' => array('title', 'editor', 'thumbnail')
		);
		if (!get_option('travel_tales_lock_post_types')) {
			flush_rewrite_rules(false);
		}
	
		register_post_type('languagelesson', $args);
		
		register_taxonomy('language', 
			array('languagelesson'), 
			array(
				'hierarchical' => true, 
				'label' => __('Languages'), 
				'singular_label' => __('Language'), 
				'rewrite' => true
			)
		);
		if (!get_option('travel_tales_lock_post_types')) {
			flush_rewrite_rules(false);
		}
	}
}

// Recipes 
if (get_option('travel_tales_recipes')) {
	add_action('init', 'recipe_register');
	
	function recipe_register() {
		$args = array(
			'label' => __('Recipes'),
			'singlar_label' => __('Recipe'),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
		);
		if (!get_option('travel_tales_lock_post_types')) {
			flush_rewrite_rules(false);
		}
	
		register_post_type('recipe', $args);
		
		register_taxonomy('ingredients', 
			array('recipe'), 
			array(
				'hierarchical' => false, 
				'label' => __('Ingredients'), 
				'singular_label' => __('Ingredient'), 
				'rewrite' => true,
				'new_item_name' => __('Add Ingredient')
			)
		);
		if (!get_option('travel_tales_lock_post_types')) {
			flush_rewrite_rules(false);
		}
	}
}

?>