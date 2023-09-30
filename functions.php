<?php
function my_enqueue_styles_scripts() {
	wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap');
	wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.min.css');
	wp_enqueue_script('index', get_template_directory_uri() . '/assets/js/index.min.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'my_enqueue_styles_scripts');


function my_theme_supports() {
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');
	add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'my_theme_supports');


function register_my_menus() {
	register_nav_menus(
			array(
					'primary-menu' => __('Primary Menu'),
					'footer-menu' => __('Footer Menu')
			)
	);
}
add_action('after_setup_theme', 'register_my_menus');


function display_latest_posts($num_posts, $offset, $category) {
	global $post;
	$linkSize = 'card__link link';
	$imageSize = 'card__image card__image_half-size';
	$descriptionSize = 'card__description card__description_small-size';
	$categoryColor = 'card__category card__category_black-theme link';

	$myposts = get_posts([
    'numberposts' => $num_posts,
    'offset'      => $offset,
    'category'    => $category,
		'post__not_in' => array( get_the_ID() )
	]);

	if (empty($myposts)) {
		return;
	}

	if( $myposts ){
		foreach( $myposts as $post ){
			setup_postdata( $post );
			$myCategory = get_my_category( $post->ID );

			if ( is_front_page() ) {
				if(in_category(9)) {
					$linkSize = 'card__link link';
					$imageSize = 'card__image card__image_half-size';
					$descriptionSize = 'card__description card__description_medium-size';
					$categoryColor = 'card__category card__category_black-theme link';
				} else if (in_category(8)) {
					$linkSize = 'card__link card__link_big link';
					$imageSize = 'card__image';
					$descriptionSize = 'card__description card__description_big-size';
					$categoryColor = 'card__category card__category_white-theme link';
				}
			}

			?>

			<div class="card">
				<a class="<?php echo $linkSize; ?>" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(
						array(380, 250),
						array(
							'class' => "$imageSize"
						)
					); ?>
					<p class="<?php echo $descriptionSize; ?>" >
						<?php the_title(); ?>
					</p>
				</a>
				<a class="<?php echo $categoryColor; ?>" href="<?php echo $myCategory->slug; ?>"> <?php echo $myCategory->name; ?></a>
			</div>
	<?php }} wp_reset_postdata();
}


function get_category_id() {
	$current_url = wp_make_link_relative(home_url(add_query_arg(null, null)));
	$category_name = basename(rtrim($current_url, '/'));
	$category = get_term_by('slug', $category_name, 'category');

	return $category ? $category->term_id : null;
}


function get_my_category($post_id) {
	$categories = get_the_category($post_id);
	foreach ($categories as $category) {
		if ($category->term_id <= 4) {
			return $category;
		}
	}
	return null;
}


class Category_Menu_Walker extends Walker_Nav_Menu {
	private $current_category_id;

	public function __construct($current_category_id) {
		$this->current_category_id = $current_category_id;
	}

	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$is_current_category = in_array('current-category', $classes) || ($item->object_id == $this->current_category_id);

		if ($is_current_category) {
			$classes[] = 'navigation__list-link_current';
		}

		$output .= '<li class="' . implode(' ', $classes) . '">';
		$output .= '<a href="' . $item->url . '">' . $item->title . '</a>';
	}
}


function exclude_search_page_by_title($query) {
	if ($query->is_search && !is_admin()) {
		$exclude_search_id = get_page_by_title('search', OBJECT, 'page')->ID;
		$exclude_home_id = get_page_by_title('home', OBJECT, 'page')->ID;

		$exclude_ids = array();
		if ($exclude_search_id) {
			$exclude_ids[] = $exclude_search_id;
		}
		if ($exclude_home_id) {
			$exclude_ids[] = $exclude_home_id;
		}

		if (!empty($exclude_ids)) {
			$query->set('post__not_in', $exclude_ids);
		}
	}
	return $query;
}
add_filter('pre_get_posts', 'exclude_search_page_by_title');


?>