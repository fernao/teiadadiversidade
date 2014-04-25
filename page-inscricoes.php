<?php
/*
Template Name: Cadastro
*/
if (isset($_POST['action']) && $_POST['action'] == 'inscricao') {
    $errors = array();
    
    if (!isset($_POST['concordo']) || $_POST['concordo'] != 1) {
        $errors['termos'] = __('É preciso concordar com os termos de uso da plataforma', 'minc');
    }         
    if (strlen($user_email) == 0) {
        $errors['email'] =  __('O e-mail é obrigatório.', 'teiadadiversidade');
    }
    if (!filter_var( $user_email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] =  __('O e-mail informado é inválido.', 'teiadadiversidade');
    }
    
    if (!validaCPF($_POST['cpf'])) { 
        $errors['valid_cpf'] =  __('CPF inválido', 'teiadadiversidade');
    }
    
    if (strlen($_POST['nome']) == 0) {
        $errors['email'] =  __('O nome é obrigatório.', 'teiadadiversidade');
    }

    if (strlen($_POST['estado']) == 0 || strlen($_POST['municipio']) == 0) {
        $errors['local'] = __('Por favor selecione um estado e um município', 'teiadadiversidade');
    }

    if (!validaCEP($_POST['cep'])) { 
        $errors['valid_cep'] =  __('CEP inválido', 'teiadadiversidade');
    }
    
    if (strlen($_POST['logradouro']) == 0) {
        $errors['email'] =  __('O logradouro é obrigatório.', 'teiadadiversidade');
    }    

    if (strlen($_POST['atuacao']) == 0) {
        $errors['atuacao'] =  __('A área de atuação é obrigatória.', 'teiadadiversidade');
    }    

    if (strlen($_POST['ocupacao']) == 0) {
        $errors['ocupacao'] =  __('A ocupação é obrigatória.', 'teiadadiversidade');
    }

    // sanitizacao dos campos
    // caso haja erro, repassa
    $data['nome'] = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $data['cpf'] = filter_var($_POST['cpf'], FILTER_SANITIZE_STRING);
    $data['estado'] = filter_var($_POST['estado'], FILTER_SANITIZE_STRING);
    $data['municipio'] = filter_var($_POST['municipio'], FILTER_SANITIZE_STRING);
    $data['logradouro'] = filter_var($_POST['logradouro'], FILTER_SANITIZE_STRING);
    $data['complemento'] = filter_var($_POST['complemento'], FILTER_SANITIZE_STRING);
    $data['bairro'] = filter_var($_POST['bairro'], FILTER_SANITIZE_STRING);
    $data['localizacao'] = filter_var($_POST['localizacao'], FILTER_SANITIZE_STRING);
    $data['ocupacao'] = filter_var($_POST['ocupacao'], FILTER_SANITIZE_STRING);
    $data['atuacao'] = filter_var($_POST['atuacao'], FILTER_SANITIZE_STRING);
    $data['telefone_cel'] = filter_var($_POST['telefone_cel'], FILTER_SANITIZE_NUMBER_INT);
    $data['telefone_res'] = filter_var($_POST['telefone_res'], FILTER_SANITIZE_NUMBER_INT);
    $data['telefone_com'] = filter_var($_POST['telefone_com'], FILTER_SANITIZE_NUMBER_INT);
    $data['website'] = filter_var($_POST['website'], FILTER_VALIDATE_URL);
    $data['facebook'] = filter_var($_POST['facebook'], FILTER_SANITIZE_STRING);
    $data['twitter'] = filter_var($_POST['twitter'], FILTER_SANITIZE_STRING);
    $data['youtube'] = filter_var($_POST['youtube'], FILTER_SANITIZE_STRING);
    $data['google_plus'] = filter_var($_POST['google_plus'], FILTER_SANITIZE_STRING);
    $data['website'] = filter_var($_POST['website'], FILTER_SANITIZE_URL);
    $data['outras_redessociais'] = filter_var($_POST['outras_redessociais'], FILTER_SANITIZE_STRING);
    $data['curriculo'] = filter_var($_POST['curriculo'], FILTER_SANITIZE_STRING);
    
    foreach($data as $key => $value) {
      if ($value === false) {
	$errors[$key] = __('Dados inválidos no campo: ' . $key, 'teiadadiversidade');
	}
    }	
    
    // se tudo passar sem erro:
    if (!sizeof($errors) > 0) {

      
      $fileNameCsv = dirname(__FILE__) . '/data/inscricoes.csv';

      // se arquivo nao existir, cria
      if(!is_file($fileNameCsv)) {
        fclose(fopen($fileNameCsv,"x"));
      }
      
      $fp = fopen($fileNameCsv, 'a');
      
      if(file_get_contents($fileNameCsv) == '') {  
	$header = array_keys($data);
	fputcsv($fp, $header);
      }
      
      fputcsv($fp, $data);
      fclose($fp);
      chmod($fileNameCsv, 0400);
    } else {
      foreach($errors as $type=>$msg)
	$msgs['error'][] = $msg;
    }
}

the_post();

?>

<?php get_header(); ?>
	<div id="primary" class="content-area form-inscricao">
		<div id="content" class="site-content" role="main">

		<header>					
			<h1>Cadastro</h1>					
		</header>
		<div class="post-content clearfix">
            <?php print_msgs($msgs);?>
            
                    <form method="POST" name="inscricao" id="form-inscricao" action="">
                    <input id="action" type="hidden" name="action" value="inscricao" />
                    <h3 class="subtitulo">Dados para realização da inscrição na TEIA 2014</h3>
                    <h4>Dados pessoais</h4>
                        <label>Nome *</label><br />
                        <input id="nome" type="text" name="nome" class="texto" value="<?php echo isset($_POST['nome']) ? esc_attr($_POST['nome']) : ''; ?>" /><br />
                        <label>Email *</label><br />
                        <input id="email" type="text" name="user_email" class="texto" value="<?php echo isset($_POST['user_email']) ? esc_attr($_POST['user_email']) : ''; ?>" /><br />
                        <label>CPF *</label><br />
                        <input id="cpf" type="text" name="cpf" class="cpf" value="<?php echo isset($_POST['cpf']) ? esc_attr($_POST['cpf']) : ''; ?>" /><br />
                        <input id="natureza_juridica" type="hidden" name="natureza_juridica" value="1" />
                   <h4 class="subtitulo">Endereço</h4>
                        <label>Estado *</label><br />
                        <select name="estado" id="estado">
                            <option value=""> Selecione </option>
                            <?php $states = get_states(); ?>
                            <?php foreach ($states as $s): ?>
                                <option value="<?php echo $s->sigla; ?>"  <?php if (isset($_POST['estado']) && $_POST['estado'] == $s->sigla) echo 'selected'; ?>  >
                                    <?php echo $s->nome; ?>
                                </option>
                            <?php endforeach; ?>
                        </select><br />
                        <label>Município *</label><br />
                        <select name="municipio" id="municipio">
                            <option value="">Selecione</option>
                        </select><br />			
                        <label>CEP *</label><br />
                        <input id="cep" type="text" name="cep" class="cep" value="<?php echo isset($_POST['cep']) ? esc_attr($_POST['cep']) : ''; ?>" /><br />
                        <label>Bairro *</label><br />
                        <input id="bairro" type="text" name="bairro" class="texto" value="<?php echo isset($_POST['bairro']) ? esc_attr($_POST['bairro']) : ''; ?>" /><br />
                        <label>Logradouro *</label><br />
                        <input id="logradouro" type="text" name="logradouro" class="texto" value="<?php echo isset($_POST['logradouro']) ? esc_attr($_POST['logradouro']) : ''; ?>" /><br />
                        <label>Complemento </label><br />
                        <input id="complemento" type="text" name="complemento" class="texto" value="<?php echo isset($_POST['complemento']) ? esc_attr($_POST['complemento']) : ''; ?>" /><br />
                        <label>Localização </label><br />
                        <input id="localizacao" type="text" name="localizacao" class="texto" value="<?php echo isset($_POST['localizacao']) ? esc_attr($_POST['localizacao']) : ''; ?>" /><br />
  
                 <h4 class="subtitulo">Atuação</h4>
                        <label>Área de Atuação</label><br />
                        <select name="atuacao" id="atuacao">
                            <?php $areas = teiadadiversidade_get_theme_option('areas_atuacao'); $areas = explode("\n", $areas); ?>
                            <?php foreach ($areas as $area) : ?>
                                <?php $san_area = esc_attr(trim($area)); ?>
                                <option value="<?php echo $san_area; ?>" <?php if (isset($_POST['atuacao']) && $_POST['atuacao'] == $san_area) echo 'selected'; ?> ><?php echo $area; ?></option>
                            <?php endforeach; ?>
                            <option value="outra_area_cultura" <?php if (isset($_POST['atuacao']) && $_POST['atuacao'] == 'outra_area_cultura') echo 'selected'; ?> >Outra área de cultura</option>
                            <option value="nao_cultura" <?php if (isset($_POST['atuacao']) && $_POST['atuacao'] == 'nao_cultura') echo 'selected'; ?> >Não ligado(a) a nenhuma área cultural</option>
                        </select>
                        <span id="atuacao_outra_container">
                            <br />
                            Especifique: <br /> <input type="text" name="atuacao_outra" value="<?php echo isset($_POST['atuacao_outra']) ? esc_attr($_POST['atuacao_outra']) : ''; ?>" />
                        </span>
                        <br />
                        <label>Ocupação</label><br />
                        <select name="ocupacao" id="ocupacao">
                            <?php $areas = teiadadiversidade_get_theme_option('ocupacoes'); $areas = explode("\n", $areas); ?>
                            <?php foreach ($areas as $area) : ?>
                                <?php $san_area = esc_attr(trim($area)); ?>
                                <option value="<?php echo $san_area; ?>" <?php if (isset($_POST['ocupacao']) && $_POST['ocupacao'] == $san_area) echo 'selected'; ?> ><?php echo $area; ?></option>
                            <?php endforeach; ?>
                            <option value="outra" <?php if (isset($_POST['ocupacao']) && $_POST['ocupacao'] == 'outra') echo 'selected'; ?> >Outra</option>
                        </select>
                        
                        <span id="ocupacao_outra_container">
                            <br />
                            Especifique: <br /> <input type="text" name="ocupacao_outra" value="<?php echo isset($_POST['ocupacao_outra']) && esc_attr($_POST['ocupacao_outra']); ?>" />
                        </span>

                 <h4 class="subtitulo">Informações para contato</h4>
                        <label>Telefone residencial</label><br />
                        <input id="telefone_res" type="text" name="telefone_res" class="telefone" value="<?php echo isset($_POST['telefone_res']) ? esc_attr($_POST['telefone_res']) : ''; ?>" /><br />

                        <label>Telefone comercial</label><br />
                        <input id="telefone_com" type="text" name="telefone_com" class="telefone" value="<?php echo isset($_POST['telefone_com']) ? esc_attr($_POST['telefone_com']) : ''; ?>" /><br />

                        <label>Telefone celular</label><br />
                        <input id="telefone_cel" type="text" name="telefone_cel" class="telefone" value="<?php echo isset($_POST['telefone_cel']) ? esc_attr($_POST['telefone_cel']) : ''; ?>" /><br />

                        <label>Website</label><br />
                        <input id="website" type="text" name="website" class="texto" value="<?php echo isset($_POST['website']) ? esc_attr($_POST['website']) : ''; ?>" /><br />

                        <label>Facebook</label><br />
                        <input id="facebook" type="text" name="facebook" class="texto" value="<?php echo isset($_POST['facebook']) ? esc_attr($_POST['facebook']) : ''; ?>" /><br />

                        <label>Twitter</label><br />
                        <input id="twitter" type="text" name="twitter" class="texto" value="<?php echo isset($_POST['twitter']) ? esc_attr($_POST['twitter']) : ''; ?>" /><br />

                        <label>Google +</label><br />
                        <input id="google_plus" type="text" name="google_plus" class="texto" value="<?php echo isset($_POST['google_plus']) ? esc_attr($_POST['google_plus']) : ''; ?>" /><br />
 
                        <label>Youtube</label><br />
                        <input id="youtube" type="text" name="youtube" class="texto" value="<?php echo isset($_POST['youtube']) ? esc_attr($_POST['youtube']) : ''; ?>" /><br />

                        <label>Outras redes sociais</label><br />
                        <input id="outras_redessociais" type="text" name="outras_redessociais" class="texto" value="<?php echo isset($_POST['outras_redessociais']) ? esc_attr($_POST['outras_redessociais']) : ''; ?>" /><br />
                        <label>Currículo</label><br />
                        <textarea id="curriculo" name="curriculo"><?php echo isset($_POST['curriculo']) ? esc_attr($_POST['curriculo']) : ''; ?></textarea><br />
			
                    </p>
                    <p><input type="checkbox" name="concordo" value="1" <?php isset($_POST['concordo']) ? checked($_POST['concordo'], true) : ''; ?>/> Li e concordo com os <a href="/teiadadiversidade/<?php echo network_site_url('termos-de-uso'); ?>">termos de uso</a> da inscrição / SNIIC.</p>
                    <input type="submit" value="Cadastrar" class="button-submit" />
                </form>
		</div>
		<!-- .post-content -->
	</div>
	<!-- .post -->

<!-- #main-section -->
<aside id="main-sidebar" class="span-6 append-1 last">
	<?php get_sidebar(); ?>
</aside>
<?php get_footer(); ?>
