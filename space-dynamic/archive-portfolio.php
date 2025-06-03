<?php get_header(); ?>

<div class="container" style="margin-top: 120px; margin-bottom: 60px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-heading text-center">
                <h1>Our Portfolio</h1>
                <p>Check out our latest work and projects</p>
            </div>
        </div>
    </div>
    
    <div class="row">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                            <div class="hidden-content">
                                <h4><?php the_title(); ?></h4>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <div class="main-blue-button">
                                    <a href="<?php the_permalink(); ?>">View Details</a>
                                </div>
                            </div>
                            <div class="showed-content">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/portfolio-image.png" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12">
                <p>No portfolio items found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>