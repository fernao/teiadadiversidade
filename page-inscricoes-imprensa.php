<?php
/*
Template Name: Cadastro
*/
$successMessage = "";

if (isset($_POST['action']) && $_POST['action'] == 'inscricao') {
    $errors = array();
    
    if (strlen($_POST['email']) == 0) {
        $errors['email'] =  __('O e-mail é obrigatório.', 'teiadadiversidade');
    }
    if (!filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] =  __('O e-mail informado é inválido.', 'teiadadiversidade');
    }
    
    if (strlen($_POST['nome']) == 0) {
        $errors['nome'] =  __('O nome é obrigatório.', 'teiadadiversidade');
    }

    if (strlen($_POST['estado']) == 0 || strlen($_POST['municipio']) == 0) {
        $errors['local'] = __('Por favor selecione um estado e um município', 'teiadadiversidade');
    }
    
    if (strlen($_POST['nome_empresa']) == 0) {
        $errors['nome_empresa'] =  __('O nome da empresa é obrigatório.', 'teiadadiversidade');
    }

    if (strlen($_POST['cargo']) == 0) {
        $errors['cargo'] =  __('O cargo é obrigatório.', 'teiadadiversidade');
    }

    if (strlen($_POST['telefone']) == 0) {
        $errors['telefone'] =  __('O telefone é obrigatório.', 'teiadadiversidade');
    }

    
    // sanitizacao dos campos
    // caso haja erro, repassa
    $data['nome'] = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $data['profissao'] = filter_var($_POST['profissao'], FILTER_SANITIZE_STRING);
    $data['estado'] = filter_var($_POST['estado'], FILTER_SANITIZE_STRING);
    $data['municipio'] = filter_var($_POST['municipio'], FILTER_SANITIZE_STRING);

    $data['nome_empresa'] = filter_var($_POST['nome_empresa'], FILTER_SANITIZE_STRING);
    $data['cargo'] = filter_var($_POST['cargo'], FILTER_SANITIZE_STRING);
    $data['veiculo'] = filter_var($_POST['veiculo'], FILTER_SANITIZE_STRING);
    $data['telefone'] = filter_var($_POST['telefone'], FILTER_SANITIZE_STRING);
    $data['ramal'] = filter_var($_POST['ramal'], FILTER_SANITIZE_STRING);
    $data['website'] = filter_var($_POST['website'], FILTER_SANITIZE_STRING);
    $data['facebook'] = filter_var($_POST['facebook'], FILTER_SANITIZE_STRING);
    $data['twitter'] = filter_var($_POST['twitter'], FILTER_SANITIZE_STRING);
    $data['outros'] = filter_var($_POST['outros'], FILTER_SANITIZE_STRING);
    $data['receber'] = filter_var($_POST['receber'], FILTER_SANITIZE_STRING);


    foreach($data as $key => $value) {
      if ($value === false) {
	$errors[$key] = __('Dados inválidos no campo: ' . $key, 'teiadadiversidade');
	}
    }	
    
    // se tudo passar sem erro:
    if (!sizeof($errors) > 0) {

      
      $fileNameCsv = dirname(__FILE__) . '/data/inscricoes-imprensa.csv';

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
      //      chmod($fileNameCsv, 0400);

      $successMessage = "<h4 style='color: #c00'>Inscrição realizada com sucesso!</h4><br/>
<a href='http://culturadigital.br/teiadadiversidade/'>Voltar para a página inicial</a>";

      $_POST = '';
            
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

<?php if ($successMessage != "") { print $successMessage; }  ?>


		<header>					
			<h1>Cadastro de imprensa</h1>					
		</header>
		<div class="post-content clearfix">
            <?php print_msgs($msgs);?>
                    <form method="POST" name="inscricao" id="form-inscricao" action="">
                    <input id="action" type="hidden" name="action" value="inscricao" />
                    <h4>Dados pessoais</h4>
                        <label>Nome *</label><br />
                        <input id="nome" type="text" name="nome" class="texto" value="<?php echo isset($_POST['nome']) ? esc_attr($_POST['nome']) : ''; ?>" /><br />
                        <label>Profissão *</label><br />
                        <input id="profissao" type="text" name="profissao" class="texto" value="<?php echo isset($_POST['profissao']) ? esc_attr($_POST['profissao']) : ''; ?>" /><br />
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
                      <label>Email *</label><br />
                        <input id="email" type="text" name="email" class="texto" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>" /><br />

                        <label>Nome da Empresa *</label><br />
                        <input id="nome_empresa" type="text" name="nome_empresa" class="texto" value="<?php echo isset($_POST['nome_empresa']) ? esc_attr($_POST['nome_empresa']) : ''; ?>" /><br />
                        <label>Cargo *</label><br />
                        <input id="cargo" type="text" name="cargo" class="texto" value="<?php echo isset($_POST['cargo']) ? esc_attr($_POST['cargo']) : ''; ?>" /><br />

                      <label>Veículo *</label><br />
<?php 
  $veiculos = [
	       'tv' => 'TV',
	       'radio' => 'Rádio',
	       'midia_digital' => 'Mídia Digital',
	       'midia_impressa' => 'Mídia Impressa'
	       ];
?>
                        <select name="veiculo" id="veiculo">
                                <option></option>
                            <?php foreach ($veiculos as $veiculo_key => $veiculo_nome) : ?>
                                <option value="<?php print $veiculo_key ?>"  <?php if (isset($_POST['veiculo']) && $_POST['veiculo'] == $veiculo_nome) echo 'selected'; ?>  >
                                    <?php echo $veiculo_nome; ?>
                                </option>
                            <?php endforeach; ?>
                        </select><br />
				
                        <label>Telefone *</label><br />
                        <input id="telefone" type="text" name="telefone" class="texto" value="<?php echo isset($_POST['telefone']) ? esc_attr($_POST['telefone']) : ''; ?>" /><br />
                        <label>Ramal</label><br />
                        <input id="ramal" type="text" name="ramal" class="texto" value="<?php echo isset($_POST['ramal']) ? esc_attr($_POST['ramal']) : ''; ?>" /><br />
                        <label>Website</label><br />
                        <input id="website" type="text" name="website" class="texto" value="<?php echo isset($_POST['website']) ? esc_attr($_POST['website']) : ''; ?>" /><br />
                        <label>Facebook</label><br />
                        <input id="facebook" type="text" name="facebook" class="texto" value="<?php echo isset($_POST['facebook']) ? esc_attr($_POST['facebook']) : ''; ?>" /><br />
                        <label>Twitter</label><br />
                        <input id="twitter" type="text" name="twitter" class="texto" value="<?php echo isset($_POST['twitter']) ? esc_attr($_POST['twitter']) : ''; ?>" /><br />
                        <label>Outros</label><br />
                        <input id="outros" type="text" name="outros" class="texto" value="<?php echo isset($_POST['outros']) ? esc_attr($_POST['outros']) : ''; ?>" /><br />

  <input id="receber" type="checkbox" name="receber" class="receber" value="sim"  <?php if (isset($_POST[$dia_key]) && $_POST[$dia_key] == $dia_key) echo 'checked'; ?>  &nbsp;
<label> &nbsp;Deseja receber releases e boletins informativos sobre a TEIA da Diversidade por e-mail? </label><br /><br />
                      <input type="submit" value="Cadastrar" class="button-submit" />
</div>
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
