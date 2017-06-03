<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
    <script src="https://use.fontawesome.com/e48fabcf5a.js"></script>
		<?php wp_head(); ?>
	</head>
	
<body <?php body_class(); ?>>
	
	<div class="container">
	
		<!-- site-header -->
		<header class="site-header">
			

      <?php
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      ?>
      <div class="logo-bar">
        <a href="<?php echo home_url(); ?>"><img class="site-logo" src="<?php echo $image[0] ?>"></a>
      </div>
			
			
			<nav class="site-nav">
				
				<?php
				
				$args = array(
					'theme_location' => 'primary'
				);
				
				?>
				
				<?php wp_nav_menu(  $args ); ?>
			</nav>
			
		</header><!-- /site-header -->
    <header class="mobile-header">
      <?php
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      ?>
      <div class="logo-bar">
        <a href="<?php echo home_url(); ?>"><img class="site-logo" src="<?php echo $image[0] ?>"></a>
      </div>
			
			<div class="dropdown">
        <button class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <div class="dropdown-content">
          <?php
            $args = array(
              'theme_location' => 'primary'
            );
          ?>
          
          <?php wp_nav_menu(  $args ); ?>
        </div>
      </div>
    </header>