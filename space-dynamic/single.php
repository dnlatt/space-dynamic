<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
    <div class="page-heading header-text" style="margin-top: 120px; margin-bottom: 60px;">
        <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <?php display_breadcrumb(' / ', 'breadcrumb'); ?>
            <h3><?php the_title(); ?></h3>
            </div>
        </div>
        </div>
    </div>

    <div class="container">
    <div class="single-page section">
        <div class="container">
        <div class="row">
            
            <div class="col-lg-8">
            <div class="main-image">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="main-content">
                <span><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                <span class="category"><?php the_category(', '); ?></span>
                
            </div> 

            <?php the_content(); ?>
            
            <footer class="entry-footer">
                <?php the_tags('<p>Tags: ', ', ', '</p>'); ?>
            </footer>
            </div>
            <div class="col-lg-4">
            <div class="info-table">
                <?php get_sidebar(); ?>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>

</article>
<?php endwhile; ?>
<?php get_footer(); ?>