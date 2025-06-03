<?php

// Security check - prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup functionality
 */
function space_dynamic_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'space-dynamic'),
    ));
}
add_action('after_setup_theme', 'space_dynamic_theme_setup');

/**
 * Handle all theme scripts and styles
 */
function space_dynamic_scripts() {
    // Enqueue styles
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.css');
    wp_enqueue_style('space-dynamic-style', get_template_directory_uri() . '/assets/css/space-dynamic.css');
    wp_enqueue_style('animated', get_template_directory_uri() . '/assets/css/animated.css');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.css');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
    
    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), '', true);
    wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/assets/js/owl-carousel.js', array('jquery'), '', true);
    wp_enqueue_script('animation-js', get_template_directory_uri() . '/assets/js/animation.js', array('jquery'), '', true);
    wp_enqueue_script('imagesloaded-js', get_template_directory_uri() . '/assets/js/imagesloaded.js', array('jquery'), '', true);
    wp_enqueue_script('templatemo-custom', get_template_directory_uri() . '/assets/js/templatemo-custom.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'space_dynamic_scripts');

/**
 * Widget areas and custom widgets
 */

// Register widget areas
function space_dynamic_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'space-dynamic'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'space-dynamic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'space_dynamic_widgets_init');

// Wordpress Admin Customizer

/**
 * Hero Section Customization with Live Preview
 */
function space_dynamic_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => __('Hero Banner Section', 'space-dynamic'),
        'priority' => 30,
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Welcome to Space Dynamic',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage', // Enable live preview
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'space-dynamic'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default' => 'We Make <em>Digital Ideas</em> &amp; <span>SEO</span> Marketing',
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage', // Enable live preview
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'space-dynamic'),
        'section' => 'hero_section',
        'type' => 'textarea',
        'description' => __('HTML tags like <em> and <span> are allowed', 'space-dynamic'),
    ));
    
    // Hero Description
    $wp_customize->add_setting('hero_description', array(
        'default' => 'Space Dynamic is a professional looking HTML template using a Bootstrap 5.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage', // Enable live preview
    ));
    
    $wp_customize->add_control('hero_description', array(
        'label' => __('Hero Description', 'space-dynamic'),
        'section' => 'hero_section',
        'type' => 'textarea',
    ));
    
    // Banner Right Image
    $wp_customize->add_setting('banner_right_image', array(
        'default' => get_template_directory_uri() . '/assets/images/banner-right-image.png',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage', // Enable live preview
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_right_image', array(
        'label' => __('Banner Right Image', 'space-dynamic'),
        'section' => 'hero_section',
        'settings' => 'banner_right_image',
        'description' => __('Upload an image for the right side of the banner. Recommended size: 600x500px', 'space-dynamic'),
    )));
    
    // Banner Image Alt Text
    $wp_customize->add_setting('banner_image_alt', array(
        'default' => 'team meeting',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage', // Enable live preview
    ));
    
    $wp_customize->add_control('banner_image_alt', array(
        'label' => __('Banner Image Alt Text', 'space-dynamic'),
        'section' => 'hero_section',
        'type' => 'text',
        'description' => __('Alt text for the banner image (important for SEO and accessibility)', 'space-dynamic'),
    ));
    
    // Show/Hide Banner Image
    $wp_customize->add_setting('show_banner_image', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport' => 'postMessage', // Enable live preview
    ));
    
    $wp_customize->add_control('show_banner_image', array(
        'label' => __('Show Banner Image', 'space-dynamic'),
        'section' => 'hero_section',
        'type' => 'checkbox',
        'description' => __('Check to show the banner image, uncheck to hide it', 'space-dynamic'),
    ));
    
    // Banner Image Animation
    $wp_customize->add_setting('banner_image_animation', array(
        'default' => 'fadeInRight',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage', // Enable live preview
    ));
    
    $wp_customize->add_control('banner_image_animation', array(
        'label' => __('Banner Image Animation', 'space-dynamic'),
        'section' => 'hero_section',
        'type' => 'select',
        'choices' => array(
            'fadeInRight' => __('Fade In Right', 'space-dynamic'),
            'fadeInLeft' => __('Fade In Left', 'space-dynamic'),
            'fadeInUp' => __('Fade In Up', 'space-dynamic'),
            'fadeInDown' => __('Fade In Down', 'space-dynamic'),
            'fadeIn' => __('Fade In', 'space-dynamic'),
            'bounceInRight' => __('Bounce In Right', 'space-dynamic'),
            'slideInRight' => __('Slide In Right', 'space-dynamic'),
        ),
        'description' => __('Choose animation effect for the banner image', 'space-dynamic'),
    ));
}
add_action('customize_register', 'space_dynamic_customize_register');

/**
 * Helper function to get banner image with fallback
 */
function get_banner_image_url() {
    $banner_image = get_theme_mod('banner_right_image');
    
    if (empty($banner_image)) {
        // Fallback to default image
        $banner_image = get_template_directory_uri() . '/assets/images/banner-right-image.png';
    }
    
    return esc_url($banner_image);
}

/**
 * Helper function to get banner image alt text
 */
function get_banner_image_alt() {
    $alt_text = get_theme_mod('banner_image_alt', 'team meeting');
    return esc_attr($alt_text);
}

/**
 * Helper function to get banner animation class
 */
function get_banner_animation() {
    $animation = get_theme_mod('banner_image_animation', 'fadeInRight');
    return esc_attr($animation);
}

/* Project Customization with Live Preview */

function customize_project_section($wp_customize) {
    
    // Project Section
    $wp_customize->add_section('project_section', array(
        'title'       => __('Project Section', 'textdomain'),
        'description' => __('Customize the project section image, heading, and paragraph', 'textdomain'),
        'priority'    => 35,
    ));

    // Project Section Image
    $wp_customize->add_setting('project_section_image', array(
        'default'           => get_template_directory_uri() . '/assets/images/services-left-image.png',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'project_section_image', array(
        'label'       => __('Project Section Image', 'textdomain'),
        'description' => __('Upload or select an image for the left side of the project section', 'textdomain'),
        'section'     => 'project_section',
        'settings'    => 'project_section_image',
    )));

    // Project Section Heading
    $wp_customize->add_setting('project_section_heading', array(
        'default'           => 'Grow your website with our <em>SEO</em> service &amp; <span>Project</span> Ideas',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('project_section_heading', array(
        'label'       => __('Project Section Heading', 'textdomain'),
        'description' => __('You can use HTML tags like &lt;em&gt; and &lt;span&gt; for styling', 'textdomain'),
        'section'     => 'project_section',
        'type'        => 'textarea',
        'input_attrs' => array(
            'rows' => 3,
            'placeholder' => 'Enter your project heading...'
        ),
    ));

    // Project Section Paragraph
    $wp_customize->add_setting('project_section_paragraph', array(
        'default'           => "Unlock your website's full potential with powerful SEO strategies tailored to drive traffic, boost visibility, and increase conversions. Plus, explore unique project ideas designed to set your brand apart and keep your audience engaged.",
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('project_section_paragraph', array(
        'label'       => __('Project Section Paragraph', 'textdomain'),
        'description' => __('Enter the description text for your project section', 'textdomain'),
        'section'     => 'project_section',
        'type'        => 'textarea',
        'input_attrs' => array(
            'rows' => 6,
            'placeholder' => 'Enter your project description...'
        ),
    ));

    // Optional: Heading Tag Selection
    $wp_customize->add_setting('project_heading_tag', array(
        'default'           => 'h2',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('project_heading_tag', array(
        'label'   => __('Heading Tag', 'textdomain'),
        'section' => 'project_section',
        'type'    => 'select',
        'choices' => array(
            'h1' => 'H1',
            'h2' => 'H2',
            'h3' => 'H3',
            'h4' => 'H4',
            'h5' => 'H5',
            'h6' => 'H6',
        ),
    ));

    // Optional: Image Alt Text
    $wp_customize->add_setting('project_image_alt', array(
        'default'           => 'Project Services Image',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('project_image_alt', array(
        'label'       => __('Image Alt Text', 'textdomain'),
        'description' => __('Alternative text for the image (for accessibility)', 'textdomain'),
        'section'     => 'project_section',
        'type'        => 'text',
    ));

    // Optional: Section Visibility
    $wp_customize->add_setting('show_project_section', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('show_project_section', array(
        'label'   => __('Show Project Section', 'textdomain'),
        'section' => 'project_section',
        'type'    => 'checkbox',
    ));
}
add_action('customize_register', 'customize_project_section');

// Function to display the Project Section
function display_project_section() {
    // Check if section should be displayed
    if (!get_theme_mod('show_project_section', true)) {
        return;
    }

    // Get customizer values
    $image_url = get_theme_mod('project_section_image', get_template_directory_uri() . '/assets/images/services-left-image.png');
    $image_alt = get_theme_mod('project_image_alt', 'Project Services Image');
    $heading_tag = get_theme_mod('project_heading_tag', 'h2');
    $heading_text = get_theme_mod('project_section_heading', 'Grow your website with our <em>SEO</em> service &amp; <span>Project</span> Ideas');
    $paragraph_text = get_theme_mod('project_section_paragraph', "Unlock your website's full potential with powerful SEO strategies tailored to drive traffic, boost visibility, and increase conversions. Plus, explore unique project ideas designed to set your brand apart and keep your audience engaged.");
    ?>

    <div id="services" class="our-services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="left-image">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" data-customize-setting-link="project_section_image">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="section-heading">
                        <<?php echo esc_html($heading_tag); ?> data-customize-setting-link="project_section_heading"><?php echo wp_kses_post($heading_text); ?></<?php echo esc_html($heading_tag); ?>>
                        <p data-customize-setting-link="project_section_paragraph"><?php echo wp_kses_post($paragraph_text); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}

// Shortcode for Project Section
function project_section_shortcode($atts) {
    ob_start();
    display_project_section();
    return ob_get_clean();
}
add_shortcode('project_section', 'project_section_shortcode');

// Helper functions to get individual elements
function get_project_section_image() {
    $image_url = get_theme_mod('project_section_image', get_template_directory_uri() . '/assets/images/services-left-image.png');
    $image_alt = get_theme_mod('project_image_alt', 'Project Services Image');
    
    return '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" data-customize-setting-link="project_section_image">';
}

function get_project_section_heading() {
    $heading_tag = get_theme_mod('project_heading_tag', 'h2');
    $heading_text = get_theme_mod('project_section_heading', 'Grow your website with our <em>SEO</em> service &amp; <span>Project</span> Ideas');
    
    return '<' . esc_html($heading_tag) . ' data-customize-setting-link="project_section_heading">' . wp_kses_post($heading_text) . '</' . esc_html($heading_tag) . '>';
}

function get_project_section_paragraph() {
    $paragraph_text = get_theme_mod('project_section_paragraph', 'Space Dynamic HTML5 template is free to use for your website projects. However, you are not permitted to redistribute the template ZIP file on any CSS template collection websites. Please contact us for more information. Thank you for your kind cooperation.');
    
    return '<p data-customize-setting-link="project_section_paragraph">' . wp_kses_post($paragraph_text) . '</p>';
}

function customize_agency_heading($wp_customize) {
    
    // Agency Heading Section
    $wp_customize->add_section('agency_heading_section', array(
        'title'       => __('Agency Heading', 'textdomain'),
        'description' => __('Customize the agency services heading text', 'textdomain'),
        'priority'    => 40,
    ));

    // Agency Heading Text
    $wp_customize->add_setting('agency_heading_text', array(
        'default'           => 'See What Our Agency <em>Offers</em> &amp; What We <span>Provide</span>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('agency_heading_text', array(
        'label'       => __('Agency Heading Text', 'textdomain'),
        'description' => __('You can use HTML tags like &lt;em&gt; and &lt;span&gt; for styling. Use &amp; for ampersand (&)', 'textdomain'),
        'section'     => 'agency_heading_section',
        'type'        => 'textarea',
        'input_attrs' => array(
            'rows' => 3,
            'placeholder' => 'Enter your agency heading text...'
        ),
    ));

    // Blog Heading Section
    $wp_customize->add_section('blog_heading_section', array(
        'title'       => __('Blog Heading', 'textdomain'),
        'description' => __('Customize the Blog heading text', 'textdomain'),
        'priority'    => 40,
    ));

    // Blog Heading Text
    $wp_customize->add_setting('blog_heading_text', array(
        'default'           => '<h2>Check Out What Is <em>Trending</em> In Our Latest <span>News</span></h2>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('blog_heading_text', array(
        'label'       => __('Blog Heading Text', 'textdomain'),
        'description' => __('You can use HTML tags like &lt;em&gt; and &lt;span&gt; for styling. Use &amp; for ampersand (&)', 'textdomain'),
        'section'     => 'blog_heading_section',
        'type'        => 'textarea',
        'input_attrs' => array(
            'rows' => 3,
            'placeholder' => 'Enter your blog heading text...'
        ),
    ));
}
add_action('customize_register', 'customize_agency_heading');

/**
 * Live Preview JavaScript
 */
function space_dynamic_customize_preview_js() {
    wp_enqueue_script(
        'space-dynamic-customize-preview',
        get_template_directory_uri() . '/js/customize-preview.js',
        array('jquery', 'customize-preview'),
        '1.0.0',
        true
    );
}
add_action('customize_preview_init', 'space_dynamic_customize_preview_js');

/**
 * Add selective refresh support for widgets
 */
function space_dynamic_customize_register_partials($wp_customize) {
    // Ensure selective refresh is available
    if (!isset($wp_customize->selective_refresh)) {
        return;
    }

    // Hero Section Partials
    $wp_customize->selective_refresh->add_partial('hero_subtitle', array(
        'selector' => '.hero-subtitle',
        'render_callback' => function() {
            return get_theme_mod('hero_subtitle', 'Welcome to Space Dynamic');
        },
    ));

    $wp_customize->selective_refresh->add_partial('hero_title', array(
        'selector' => '.hero-title',
        'render_callback' => function() {
            return get_theme_mod('hero_title', 'We Make <em>Digital Ideas</em> &amp; <span>SEO</span> Marketing');
        },
    ));

    $wp_customize->selective_refresh->add_partial('hero_description', array(
        'selector' => '.hero-description',
        'render_callback' => function() {
            return get_theme_mod('hero_description', 'Space Dynamic is a professional looking HTML template using a Bootstrap 5.');
        },
    ));

    // Project Section Partials
    $wp_customize->selective_refresh->add_partial('project_section_heading', array(
        'selector' => '[data-customize-setting-link="project_section_heading"]',
        'render_callback' => function() {
            return get_theme_mod('project_section_heading', 'Grow your website with our <em>SEO</em> service &amp; <span>Project</span> Ideas');
        },
    ));

    $wp_customize->selective_refresh->add_partial('project_section_paragraph', array(
        'selector' => '[data-customize-setting-link="project_section_paragraph"]',
        'render_callback' => function() {
            return get_theme_mod('project_section_paragraph', "Unlock your website's full potential with powerful SEO strategies tailored to drive traffic, boost visibility, and increase conversions. Plus, explore unique project ideas designed to set your brand apart and keep your audience engaged.");
        },
    ));

    // Agency Heading Partial
    $wp_customize->selective_refresh->add_partial('agency_heading_text', array(
        'selector' => '.agency-heading',
        'render_callback' => function() {
            return get_theme_mod('agency_heading_text', 'See What Our Agency <em>Offers</em> &amp; What We <span>Provide</span>');
        },
    ));

    // Blog Heading Partial
    $wp_customize->selective_refresh->add_partial('blog_heading_text', array(
        'selector' => '.blog-heading',
        'render_callback' => function() {
            return get_theme_mod('blog_heading_text', '<h2>Check Out What Is <em>Trending</em> In Our Latest <span>News</span></h2>');
        },
    ));
}
add_action('customize_register', 'space_dynamic_customize_register_partials', 20);


/**
 * Contact form handling
 */

// Handle contact form
function handle_contact_form() {
    if (isset($_POST['contact_form']) && wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        $name = sanitize_text_field($_POST['name']);
        $surname = sanitize_text_field($_POST['surname']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        
        // Send email or save to database
        $to = get_option('admin_email');
        $subject = 'Contact Form Submission from ' . $name . ' ' . $surname;
        $body = "Name: $name $surname\nEmail: $email\nMessage: $message";
        $headers = array('Content-Type: text/html; charset=UTF-8');
        
        wp_mail($to, $subject, $body, $headers);
        
        wp_redirect(add_query_arg('contact', 'success', home_url()));
        exit;
    }
}
add_action('init', 'handle_contact_form');


/**
 * Register custom post types
 */

// Custom Post Type for Portfolio
function create_portfolio_post_type() {
    register_post_type('portfolio',
        array(
            'labels' => array(
                'name' => __('Portfolio'),
                'singular_name' => __('Portfolio Item')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-portfolio',
        )
    );
}
add_action('init', 'create_portfolio_post_type');

// Custom Post Type for Services
function create_services_post_type() {
    register_post_type('services',
        array(
            'labels' => array(
                'name' => __('Services'),
                'singular_name' => __('Service')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-admin-tools',
        )
    );
}
add_action('init', 'create_services_post_type');



/**
 * Utility functions for the theme
 */

/**
 * Dynamic Breadcrumb Function
 */
function generate_dynamic_breadcrumb($separator = ' / ') {
    $breadcrumb = '';
    $home_text = 'Home';
    
    // Start with Home link
    $breadcrumb .= '<a href="' . home_url() . '">' . $home_text . '</a>';
    
    if (is_single()) {
        // For single posts
        $post_type = get_post_type();
        
        if ($post_type == 'post') {
            // Blog posts - show category hierarchy
            $categories = get_the_category();
            if (!empty($categories)) {
                $main_category = $categories[0];
                
                // Get category hierarchy
                $category_parents = array();
                $parent_id = $main_category->parent;
                
                while ($parent_id) {
                    $parent = get_category($parent_id);
                    $category_parents[] = $parent;
                    $parent_id = $parent->parent;
                }
                
                // Reverse to show from top level
                $category_parents = array_reverse($category_parents);
                
                // Add parent categories
                foreach ($category_parents as $parent_cat) {
                    $breadcrumb .= $separator . '<a href="' . get_category_link($parent_cat->term_id) . '">' . $parent_cat->name . '</a>';
                }
                
                // Add main category
                $breadcrumb .= $separator . '<a href="' . get_category_link($main_category->term_id) . '">' . $main_category->name . '</a>';
            }
        } else {
            // Custom post types
            $post_type_object = get_post_type_object($post_type);
            if ($post_type_object && $post_type_object->has_archive) {
                $breadcrumb .= $separator . '<a href="' . get_post_type_archive_link($post_type) . '">' . $post_type_object->labels->name . '</a>';
            }
        }
        
        // Current post title
        $breadcrumb .= $separator . '<span class="current">' . get_the_title() . '</span>';
        
    } elseif (is_page()) {
        // For pages - show page hierarchy
        global $post;
        
        if ($post->post_parent) {
            $parent_pages = array();
            $parent_id = $post->post_parent;
            
            while ($parent_id) {
                $page = get_page($parent_id);
                $parent_pages[] = $page;
                $parent_id = $page->post_parent;
            }
            
            $parent_pages = array_reverse($parent_pages);
            
            foreach ($parent_pages as $parent_page) {
                $breadcrumb .= $separator . '<a href="' . get_permalink($parent_page->ID) . '">' . get_the_title($parent_page->ID) . '</a>';
            }
        }
        
        $breadcrumb .= $separator . '<span class="current">' . get_the_title() . '</span>';
        
    } elseif (is_category()) {
        // Category archive
        $category = get_queried_object();
        
        // Get category parents
        if ($category->parent) {
            $parent_categories = array();
            $parent_id = $category->parent;
            
            while ($parent_id) {
                $parent = get_category($parent_id);
                $parent_categories[] = $parent;
                $parent_id = $parent->parent;
            }
            
            $parent_categories = array_reverse($parent_categories);
            
            foreach ($parent_categories as $parent_cat) {
                $breadcrumb .= $separator . '<a href="' . get_category_link($parent_cat->term_id) . '">' . $parent_cat->name . '</a>';
            }
        }
        
        $breadcrumb .= $separator . '<span class="current">' . $category->name . '</span>';
        
    } elseif (is_tag()) {
        // Tag archive
        $tag = get_queried_object();
        $breadcrumb .= $separator . '<span class="current">Tag: ' . $tag->name . '</span>';
        
    } elseif (is_author()) {
        // Author archive
        $author = get_queried_object();
        $breadcrumb .= $separator . '<span class="current">Author: ' . $author->display_name . '</span>';
        
    } elseif (is_date()) {
        // Date archive
        if (is_year()) {
            $breadcrumb .= $separator . '<span class="current">' . get_the_date('Y') . '</span>';
        } elseif (is_month()) {
            $breadcrumb .= $separator . '<a href="' . get_year_link(get_the_date('Y')) . '">' . get_the_date('Y') . '</a>';
            $breadcrumb .= $separator . '<span class="current">' . get_the_date('F Y') . '</span>';
        } elseif (is_day()) {
            $breadcrumb .= $separator . '<a href="' . get_year_link(get_the_date('Y')) . '">' . get_the_date('Y') . '</a>';
            $breadcrumb .= $separator . '<a href="' . get_month_link(get_the_date('Y'), get_the_date('m')) . '">' . get_the_date('F') . '</a>';
            $breadcrumb .= $separator . '<span class="current">' . get_the_date() . '</span>';
        }
        
    } elseif (is_search()) {
        // Search results
        $breadcrumb .= $separator . '<span class="current">Search Results for: ' . get_search_query() . '</span>';
        
    } elseif (is_404()) {
        // 404 page
        $breadcrumb .= $separator . '<span class="current">404 - Page Not Found</span>';
        
    } elseif (is_post_type_archive()) {
        // Custom post type archive
        $post_type_object = get_queried_object();
        $breadcrumb .= $separator . '<span class="current">' . $post_type_object->labels->name . '</span>';
    }
    
    return $breadcrumb;
}

/**
 * Display breadcrumb
 * Usage: display_breadcrumb();
 */
function display_breadcrumb($separator = ' / ', $wrapper_class = 'breadcrumb') {
    if (!is_front_page()) {
        echo '<span class="' . $wrapper_class . '">' . generate_dynamic_breadcrumb($separator) . '</span>';
    }
}


/* Display Services Posts */

function display_services_grid($number_of_services = 4, $show_read_more = true) {
    $services_query = new WP_Query(array(
        'post_type' => 'services',
        'posts_per_page' => $number_of_services,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));
    
    if ($services_query->have_posts()) :
        echo '<div class="services"><div class="row">';
        $delay = 0.5;
        
        while ($services_query->have_posts()) : $services_query->the_post();
            // Get thumbnail URL from featured image
            $service_icon = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
            $service_excerpt = get_the_excerpt();
            
            if (empty($service_icon)) {
                $service_icon = get_template_directory_uri() . '/assets/images/default-service-icon.png';
            }
            ?>

            <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="<?php echo $delay; ?>s">
                    <div class="icon">
                        <img src="<?php echo esc_url($service_icon); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    </div>
                    <div class="right-text">
                        <h4><?php the_title(); ?></h4>
                        <p><?php echo $service_excerpt ? esc_html($service_excerpt) : esc_html(wp_trim_words(get_the_content(), 100, '...')); ?></p>
                    </div>
                </div>
            </div>
            
            <?php
            $delay += 0.2;
        endwhile;
        
        echo '</div></div>';
        wp_reset_postdata();
    endif;
}



// Display Portfolio Items

function display_portfolio_grid($number_of_portfolios = 4, $show_read_more = true) {
    $portfolio_query = new WP_Query(array(
        'post_type' => 'portfolio',
        'posts_per_page' => $number_of_portfolios,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));
    
    if ($portfolio_query->have_posts()) :
        echo '<div class="portfolios"><div class="row">';
        
        
        while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
            // Get thumbnail URL from featured image
            $portfolio_icon = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
            $portfolio_excerpt = get_the_excerpt();
            
            if (empty($portfolio_icon)) {
                $portfolio_icon = get_template_directory_uri() . '/assets/images/default-portfolio-icon.png';
            }
            ?>

            <div class="col-lg-3 col-sm-6">
                <a href="#">
                    <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                        <div class="hidden-content">
                            <h4><?php the_title(); ?></h4>
                            <p><?php echo $portfolio_excerpt ? esc_html($portfolio_excerpt) : esc_html(wp_trim_words(get_the_content(), 100, '...')); ?></p>
                        </div>
                        <div class="showed-content">
                            <img src="<?php echo esc_url($portfolio_icon); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>
                    </div>
                </a>
            </div>
            
            <?php
        endwhile;
        
        echo '</div></div>';
        wp_reset_postdata();
    endif;
}


?>