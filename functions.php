<?php
/***
 Tema baseado no twentythirteen
 - desenvolvimento: fernao@riseup.net 
 - abril / 2014
 
 - funcoes utilizadas do tema minc cdigital
 - funcoes utilizadas do tema wp-consulta
 - funcoes utilizadas do tema consulta
 ***/

require(dirname(__FILE__) . '/includes/theme-options/theme-options.php');
require(dirname(__FILE__) . '/includes/widget_destaque.php');
require(dirname(__FILE__) . '/includes/db-updates.php');
wp_enqueue_script('teiadadiversidade-cadastro', get_stylesheet_directory_uri() . '/js/minc-cadastro.js', array('jquery'));
wp_localize_script('teiadadiversidade-cadastro', 'teiadadiversidade', array('ajaxurl' => admin_url('admin-ajax.php')));

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

/**
 * Retorna HTML com as cidades de um determinado estado.
 * 
 * @param string $uf sigla do estado
 * @param string $selected estado selecionado
 * @return string
 */
function teiadadiversidade_get_cities_options($uf, $currentCity = '') {
    global $wpdb;

    $uf_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM uf WHERE sigla LIKE %s", $uf));

    if (!$uf_id) {
        return "<option value=''>Selecione um estado...</option>";
    }

    $cidades = $wpdb->get_results($wpdb->prepare("SELECT * FROM municipio WHERE ufid = %d order by nome", $uf_id));

    $output = '';

    if (is_array($cidades) && count($cidades) > 0) {
        foreach ($cidades as $cidade) {
            $selected = selected($currentCity, $cidade->nome);
            $output .= "<option value='{$cidade->nome}' $selected>{$cidade->nome}</option>";
        }
    }

    return $output;
}

/**
 * Joga para a tela um HTML com as cidades de um estado.
 * 
 * @return null
 */
function teiadadiversidade_print_cities_options() {
    echo teiadadiversidade_get_cities_options($_POST['uf'], $_POST['selected']);
    die;
}

add_action('wp_ajax_nopriv_teiadadiversidade_get_cities_options', 'teiadadiversidade_print_cities_options');
add_action('wp_ajax_teiadadiversidade_get_cities_options', 'teiadadiversidade_print_cities_options');

/**
 * Retorna os estados
 */
function get_states() {
    global $wpdb;
    return $wpdb->get_results("SELECT * from uf ORDER BY sigla");
}

/**
 * Verifica se um CPF é válido ou não.
 * 
 * @param int $cpf
 * @return boolean
 */
function validaCPF($cpf) {
    // Verifiva se o número digitado contém todos os digitos
    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

    // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
        return false;
    } else {   // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}

function validaCEP($cep) {
  if (is_numeric($cep)) {
    return true;
  } else {
    return false;
  }
}


////////////////////

function print_msgs($msg, $extra_class='', $id=''){
    if (!is_array($msg)) {
        return false;
    }

    foreach($msg as $type=>$msgs) {
        if (!$msgs) {
            continue;
        }
        
        echo "<div class='$type $extra_class' id='$id'><ul>";

        if (!is_array($msgs)) {
            echo "<li>$msgs</li>";
        } else {
            foreach ($msgs as $m) {
                echo "<li>$m</li>";
            }
        }
        echo "</ul></div>";
    }
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
