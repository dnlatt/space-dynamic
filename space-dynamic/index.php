<?php get_header(); ?>

<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                            <h6><?php echo get_theme_mod('hero_subtitle', 'Welcome to Space Dynamic'); ?></h6>
                            <h2><?php echo get_theme_mod('hero_title', 'We Make <em>Digital Ideas</em> &amp; <span>SEO</span> Marketing'); ?></h2>
                            <p><?php echo get_theme_mod('hero_description', 'Space Dynamic is a professional looking HTML template using a Bootstrap 5.'); ?></p>
                        </div>
                    </div>
                    <?php if (get_theme_mod('show_banner_image', true)) : ?>
                    <div class="col-lg-6">
                        <div class="right-image wow <?php echo get_theme_mod('banner_image_animation', 'fadeInRight'); ?>" data-wow-duration="1s" data-wow-delay="0.5s">
                            <img src="<?php echo get_theme_mod('banner_right_image', get_template_directory_uri() . '/assets/images/banner-right-image.png'); ?>" 
                                 alt="<?php echo get_theme_mod('banner_image_alt', 'team meeting'); ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="about" class="about-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-left-image.png" alt="person graphic">
                </div>
            </div>
            <div class="col-lg-8 align-self-center">
                <div class="services">
                    <div class="row">
                        <?php display_services_grid(4, true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="services" class="our-services section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
                <div class="left-image">
                    <?php echo get_project_section_image(); ?>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                <div class="section-heading">
                    <?php echo get_project_section_heading(); ?>
                    <?php echo get_project_section_paragraph(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="portfolio" class="our-portfolio section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s"><h2>
                    <?php echo wp_kses_post(get_theme_mod('agency_heading_text', 'See What Our Agency <em>Offers</em> &amp; What We <span>Provide</span>')); ?>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php display_portfolio_grid(4,true);?> 
        </div>
    </div>
</div>

<div id="blog" class="our-blog section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
                <div class="section-heading">
                    <h2><?php echo wp_kses_post(get_theme_mod('blog_heading_text', 'Check Out What Is <em>Trending</em> In Our Latest <span>News</span>')); ?></h2>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
                <div class="top-dec">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-dec.png" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
                <?php
                $featured_post = new WP_Query(array(
                    'posts_per_page' => 1,
                ));
                
                if ($featured_post->have_posts()) :
                    while ($featured_post->have_posts()) : $featured_post->the_post();
                ?>
                <div class="left-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/big-blog-thumb.jpg" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                    </a>
                    <div class="info">
                        <div class="inner-content">
                            <ul>
                                <li><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></li>
                                <li><i class="fa fa-users"></i> <?php the_author(); ?></li>
                                <li><i class="fa fa-folder"></i> <?php the_category(', '); ?></li>
                            </ul>
                            <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <div class="main-blue-button">
                                <a href="<?php the_permalink(); ?>">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
                <div class="right-list">
                    <ul>
                        <?php
                        $recent_posts = new WP_Query(array(
                            'posts_per_page' => 3,
                            'post__not_in' => array(get_the_ID())
                        ));
                        
                        if ($recent_posts->have_posts()) :
                            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                        ?>
                        <li>
                            <div class="left-content align-self-center">
                                <span><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            </div>
                            <div class="right-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-thumb-01.jpg" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                        </li>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
                <div class="section-heading">
                    <h2>Feel Free To Send Us a Message About Your Website Needs</h2>
                    <div class="phone-info">
                        <h4>For any enquiry, Call Us: <span><i class="fa fa-phone"></i> <a href="tel:<?php echo get_theme_mod('contact_phone', '010-020-0340'); ?>"><?php echo get_theme_mod('contact_phone', '010-020-0340'); ?></a></span></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
                <?php if (isset($_GET['contact']) && $_GET['contact'] == 'success') : ?>
                    <div class="alert alert-success">Thank you! Your message has been sent successfully.</div>
                <?php endif; ?>
                
                <form id="contact" action="" method="post">
                    <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                    <input type="hidden" name="contact_form" value="1">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <input type="text" name="name" id="name" placeholder="Name" autocomplete="on" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-6">
                            <fieldset>
                                <input type="text" name="surname" id="surname" placeholder="Surname" autocomplete="on" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <input type="email" name="email" id="email" placeholder="Your Email" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <textarea name="message" class="form-control" id="message" placeholder="Message" required></textarea>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <button type="submit" id="form-submit" class="main-button">Send Message</button>
                            </fieldset>
                        </div>
                    </div>
                    <div class="contact-dec">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contact-decoration.png" alt="">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>