<?php

// cria opção para as áreas de atuação e ocupações
if (!get_option('teiadadiversidade-db-update-1')) {
    update_option('teiadadiversidade-db-update-1', 1);
    require_once('ocupacoes.php');
    
    $theme_options = get_option('teiadadiversidade_options', array());
    $theme_options = array_merge($theme_options, $ocupacoes);
    update_option('teiadadiversidade_options', $theme_options);
}

// cria as tabelas de municipios e ufs
if (!get_option('teiadadiversidade-db-update-2')) {
    update_option('teiadadiversidade-db-update-2', 1);
    global $wpdb;
    require_once('brasil.php');
    
    foreach ($brasil_queries as $query) {
        $wpdb->query($query);
    }
}

// cria tabela de inscricoes
if (!get_option('teiadadiversidade-db-update-3')) {
  update_option('teiadadiversidade-db-update-3', 1);
    global $wpdb;
    require_once('inscricoes.php');
    
    foreach ($inscricoes_queries as $query) {
        $wpdb->query($query);
    }
}