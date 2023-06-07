<?php get_header(); ?>
    <div id="content-wrap" class="sublime-container clearfix">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile;; ?>
            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->

        <?php get_sidebar(); ?>
    </div><!-- /#content-wrap -->

    <div class="sublime-container">
        <?php
        if ( comments_open() || get_comments_number() )
            comments_template( '', true );
        ?>
    </div>
<?php get_footer(); ?>