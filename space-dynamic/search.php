<?php get_header(); ?>

<div class="container" style="margin-top: 120px; margin-bottom: 60px;">
    <div class="row">
        <div class="col-lg-8">
            <div class="section-heading">
                <h1>Search Results for: "<?php echo get_search_query(); ?>"</h1>
            </div>

            <?php if (have_posts()) : ?>
                <div class="search-results">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-meta">
                                <span><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
                            </div>
                            <div class="search-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="main-blue-button">
                                <a href="<?php the_permalink(); ?>">Read More</a>
                            </div>
                        </article>
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
                <div class="no-results">
                    <h2>Nothing found</h2>
                    <p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
                    <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="col-lg-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>