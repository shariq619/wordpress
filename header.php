<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <title>Assignment 4 customized theme</title>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Assignment 4 customized theme</h1>
  <p>All the Lorem Ipsum generators on the Internet tend to repeat</p> 
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  
	<?php
	  $locationDetails = get_nav_menu_locations(); 
	  $menuID = $locationDetails['header']; 
	  $primaryMenuItems = wp_get_nav_menu_items($menuID);
	?>
	<ul class="navbar-nav">
		<?php
			foreach($primaryMenuItems as $key=>$value){
			?>
			   <li class="nav-item">
					<a class="nav-link"  href="<?php echo $value->url; ?>">
						<?php echo $value->title; ?>
					</a>
				</li>
			<?php
			}
		?>
	</ul>	
  </div>  
</nav>
<div class="container" style="margin-top:30px">