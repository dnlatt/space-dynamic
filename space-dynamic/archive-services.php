<?php get_header(); ?>

<div class="container" style="margin-top: 120px; margin-bottom: 60px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-heading text-center">
                <h1>Our Services</h1>
                <p>Discover what we can do for your business</p>
            </div>
        </div>
    </div>
    
    <div class="row">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-lg-6 mb-4">
                    <div class="service-item item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <div class="icon">
                            <?php 
                            $service_icon = get_post_meta(get_the_ID(), '_service_icon', true);
                            if ($service_icon) : ?>
                                <i class="<?php echo esc_attr($service_icon); ?>"></i>
                            <?php else : ?>
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="right-text">
                            <h4><?php the_title(); ?></h4>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <div class="main-blue-button">
                                <a href="<?php the_permalink(); ?>">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12">
                <p>No services found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>