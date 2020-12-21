<?php get_header(); ?>
<div class="row mb-2">
	<?php
		if(have_posts()): 
			while(have_posts()):  
				the_post();
	?>
	<div class="col-md-6">
	  <div class="card flex-md-row mb-4 box-shadow h-md-250">
		<div class="card-body d-flex flex-column align-items-start">
		  <strong  class="d-inline-block mb-2 text-primary"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong>
			
		  <div class="mb-1 text-muted"><?php echo get_the_date( 'F j, Y' ); ?></div>
		  <p class="card-text mb-auto">
				<?php 
					$content = get_the_content();					
						$content = substr($content, 0, 250) . '...';						
					echo $content;
				?>
			</p>
		  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Continue reading</a>
		</div>		
	  </div>
	</div> 
	<?php
			endwhile;
		endif;       
	?>	
 </div>
<?php get_footer(); ?>
