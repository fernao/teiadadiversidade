<?php

require get_theme_root() . '/teiadadiversidade/includes/widget_destaque.php';

// my_register_sidebar
function my_register_sidebar($name)
{
  register_sidebar(
		   array(
			 'name'			=> $name,
			 'id' => $name,
			 'before_widget' => '<div id="' . $name . '" class="widget %2$s">',
			 'after_widget'	=> '</div>',
			 'before_title'	=> '<h2 class="widgettitle">',
			 'after_title'	=> '</h2>'
			 )
		   );
}

// cadastrar sidebars
if(function_exists('register_sidebar')) {
  my_register_sidebar('home_header');
  my_register_sidebar('home_destaque');
  my_register_sidebar('home_menu');
  my_register_sidebar('coluna_esquerda');
  my_register_sidebar('coluna_direita');
  my_register_sidebar('coluna_esquerda_interna-page');
  my_register_sidebar('coluna_direita_interna-page');
}

// permite que usuários comuns acessem apenas a página
// do seu perfil no admin
add_action('admin_init', function() {
    global $pagenow;
    
    $user = wp_get_current_user();

    if ($pagenow != 'profile.php' && in_array('subscriber', $user->roles)) {
        wp_redirect(admin_url('profile.php'));
        exit;
    }
});

// remove entradas do menu do wp-admin para usuários comuns
add_action('admin_menu', function() {
    $user = wp_get_current_user();
    
    if (in_array('subscriber', $user->roles)) {
        remove_menu_page('index.php');
        remove_menu_page('edit.php');
        remove_menu_page('edit.php?post_type=object');
        remove_menu_page('edit-comments.php');
        remove_menu_page('tools.php');
    }
});

add_action('wp_before_admin_bar_render', function() {
    $user = wp_get_current_user();
    
    if (in_array('subscriber', $user->roles)) {
        global $wp_admin_bar;
        
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('new-content');
    }
});

// redireciona a página de registro do wordpress para a página de registro do vale cultura
// TODO: redirecionar para o registro do SNIIC
add_action('login_form_register', function() {
    //    wp_safe_redirect(home_url('cadastro'));
    //    die;
});

// redireciona os usuários, exceto admins, para a página principal da consulta
add_filter("login_redirect", function($redirect_to, $request, $user) {
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array('administrator', $user->roles)) {
            return $redirect_to;
        } else {
            return home_url(get_theme_option('object_url'));
        }
    }
    
    return $redirect_to;
}, 10, 3);

// redireciona pagina de cadastro do WP para pagina propria de cadastro do tema
add_action('init', function() {
    global $pagenow;
    
    if ('wp-login.php' == $pagenow && isset($_REQUEST['action']) && $_REQUEST['action'] == 'register') {
        wp_redirect(home_url('cadastro'));
        exit();
    }
});
