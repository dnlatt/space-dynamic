<?php get_header(); ?>

<div class="container" style="margin-top: 120px; margin-bottom: 60px;">
    <div class="row">
        <div class="col-lg-8">
            <div class="section-heading">
                <h1><?php 
                    if (is_category()) {
                        echo 'Category: ' . single_cat_title('', false);
                    } elseif (is_tag()) {
                        echo 'Tag: ' . single_tag_title('', false);
                    } elseif (is_author()) {
                        echo 'Author: ' . get_the_author();
                    } elseif (is_date()) {
                        echo 'Archive: ' . get_the_date('F Y');
                    } else {
                        echo 'Blog Archive';
                    }
                ?></h1>
            </div>

            <?php if (have_posts()) : ?>
                <div class="row">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-lg-6 mb-4">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-item'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-content">
                                    <div class="post-meta">
                                        <span><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                        <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
                                    </div>
                                    
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                    
                                    <div class="main-blue-button">
                                        <a href="<?php the_permalink(); ?>">Read More</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('Previous', 'space-dynamic'),
                        'next_text' => __('Next', 'space-dynamic'),
                    ));
                    ?>
                </div>
            <?php else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
        
        <div class="col-lg-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>