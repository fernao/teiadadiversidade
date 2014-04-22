<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

<h3>Notícias</h3>
<?php
$offset = $wp_query->query_vars['paged'];
$numberposts = 10;
    
if ($wp_query->query_vars['paged']) $cur_page = absint($wp_query->query_vars['paged']);
else $cur_page = 1;
 
// Get posts
$args = array(
        'posts_per_page' => $numberposts,
        'paged'=> $cur_page,
	'category_name' => 'noticias'
); 
$posts = query_posts($args);


if( $posts ) echo '<ul class="recent-posts">';
foreach($posts as $post) : setup_postdata($post); ?>
<h4><?php the_date(); ?></h4>

<div class="post-content">
<a href="<?php the_permalink(); ?>">
<h3><?php the_title(); ?></h3>
<div class="thumb-noticia">
        <?php if (has_post_thumbnail() ) {
        set_post_thumbnail_size( 150, 120 );
        the_post_thumbnail();
} ?>
</div>
<?php the_excerpt(); ?>
</a>
</div>

<?php endforeach; ?>
<?php 
    $page_links_total =  $wp_query->max_num_pages;
    $page_links = paginate_links( array(
            'base' => add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'prev_text' => __('&laquo;'),
            'next_text' => __('&raquo;'),
            'total' => $page_links_total,
            'current' => $cur_page
        ));
    if ( $page_links ) :
    ?>
    <div class="tablenav-pages">
		<?php $page_links_text = sprintf( '<p class="displaying-num">' . __( 'Exibindo %s &#8211; %s <br/>(total: %s notícias)' ) . '</p> <p class="nav-dir">%s</p>',
                    number_format_i18n( ( $cur_page - 1 ) * $wp_query->query_vars['posts_per_page'] + 1 ),
                    number_format_i18n( min( $cur_page * $wp_query->query_vars['posts_per_page'], $wp_query->found_posts ) ),
                    number_format_i18n( $wp_query->found_posts ),
                    $page_links
                ); print "<div class='paginacao'>$page_links_text</div>";
        ?>
    </div>
    <?php
    endif;
?>

<?php if ( is_active_sidebar( 'coluna_esquerda_interna-page' ) ) { ?>
<?php dynamic_sidebar('coluna_esquerda_interna-page'); ?>
<?php } else { ?>
<div id="coluna_esquerda_interna-page"></div>
<?php } ?>
<?php if ( is_active_sidebar( 'coluna_direita_interna-page' ) ) { ?>
 <?php dynamic_sidebar('coluna_direita_interna-page'); ?>
<?php } else { ?>
<div id="coluna_direita_interna-page"></div>
<?php } ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
