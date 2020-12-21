<?php
get_header();
?>
<div class="row">
  <!-- Post Content Column -->
  <div class="col-lg-8">
	<!-- Title -->
	<h1 class="mt-4"><?php the_title(); ?></h1>
	<hr>
	<!-- Date/Time -->	<p>Posted on <?php echo get_the_date( 'F j, Y' ); ?></p>

	<hr>
	<!-- Post Content -->
	<p><?php the_content(); ?></p>	
	<hr>
  </div>
  <!-- Sidebar Widgets Column -->
  <div class="col-md-4">
		<ul id="sidebar">
			<?php dynamic_sidebar( 'right-sidebar' ); ?>
		</ul>	
  </div>
</div>
<?php get_footer(); ?>
