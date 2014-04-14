<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Teiadadiversidade
 * @since Teia 2014
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
        <?php
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-tabs', 'jquery');
                        wp_enqueue_script('functions', get_bloginfo('stylesheet_directory').'/js/functions.js', 'jquery');
			wp_head();
		?>
</head>

<body <?php body_class(); ?>>
	<div class="barra-colorida"></div>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div id="header-content">
                        <!-- #home-header -->
			  <div id="home_header-container">
			    <div id="logo-container">
			      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			        <div class="site-logo"></div>
			      </a>
			    </div>
                        <?php dynamic_sidebar('home_header'); ?>
			  </div>
                        <!-- #home-destaque -->
			  <div id="home_destaque-container">
                        <?php dynamic_sidebar('home_destaque'); ?>
			  </div>
                        <!-- #home-menu -->
			  <div id="home_menu-container">
                        <?php dynamic_sidebar('home_menu'); ?>
			  </div>
			</div>
		</header><!-- #masthead -->
   
		<div id="main" class="site-main">
<?php if ( is_active_sidebar( 'coluna_esquerda' ) ) { ?>
<?php dynamic_sidebar('coluna_esquerda'); ?>
<?php } else { ?>
<div id="coluna_esquerda"></div>
<?php } ?>
<?php if ( is_active_sidebar( 'coluna_direita' ) ) { ?>
 <?php dynamic_sidebar('coluna_direita'); ?>
<?php } else { ?>
<div id="coluna_direita"></div>
<?php } ?>						  
