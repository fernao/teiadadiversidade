<?php

if (isset($_GET['action']) && $_GET['action'] == 'consulta_inscricao') {
  if (!validaCPF($_GET['cpf'])) { 
    $errors['cpf'] =  __('CPF inválido', 'teiadadiversidade');
    $_GET['cpf'] = '';
  }

  $cpf = filter_var($_GET['cpf'], FILTER_SANITIZE_STRING);
  global $wpdb;
  $data = $wpdb->get_results($wpdb->prepare("SELECT nome, cpf FROM teia_inscricao WHERE cpf LIKE %s", $cpf));
  
  $data = $data[0];
  if (sizeof($data) == 0) {
    $msgs['error'] = "Inscrição não cadastrada.";
    $_GET['cpf'] = '';
  }
  
  // se tudo passar sem erro:
  if (!sizeof($errors) > 0) {
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
			<h1>Comprovante de pré-inscrição</h1>					
		</header>
		<div class="post-content clearfix">
  <?php print_msgs($msgs);?>
  
               <form method="GET" name="inscricao" id="form-inscricao" action="">
               <input id="action" type="hidden" name="action" value="consulta_inscricao" />
 
  <?php if (!isset($_GET['cpf']) || $_GET['cpf'] == '') { ?>
<label>Informe seu CPF:</label><br />
<input id="cpf" type="text" name="cpf" class="cpf" value="<?php echo isset($_GET['cpf']) ? esc_attr($_GET['cpf']) : ''; ?>" /><br />
  
   <input type="submit" value="Emitir comprovante" class="button-submit" />
   <?php } else { ?>
<img src="http://culturadigital.br/teiadadiversidade/wp-content/themes/teiadadiversidade/img/logo.teia.png"/><br/>
   <p>Comprovamos, para os devidos fins, que <strong><?php echo $data->nome ?></strong>, portador(a) do cpf <strong><?php echo $data->cpf ?></strong>, está pré-inscrito(a) na TEIA da Diversidade.</p>
    <p>Esse comprovante pode ser verificado na página:<br/>
<?php 
   $url = $_SERVER[HTTP_REFERER] . "?" . $_SERVER[REDIRECT_QUERY_STRING];
?>
    <a href="<?php print $url ?>"><?php print $url ?></a></p>
<a href="javascript: window.print();">imprimir</a>
<br/>
 <?php } ?>

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
