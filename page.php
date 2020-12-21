<?php get_header(); ?>
<div class="row">
	<div class="col-sm-8">	  
			<?php
                if(have_posts()): // we have posts or not - checking

                        while(have_posts()):  // loop section
                                the_post();
                            ?>
								<p><?php the_content() ?></p>
                            <?php
                        endwhile;

                endif;       
			?>
	</div>
	<div class="col-sm-4">		
			<ul id="sidebar">
				<?php dynamic_sidebar( 'right-sidebar' ); ?>
			</ul>	    
	</div>
</div>
<?php get_footer(); ?>
