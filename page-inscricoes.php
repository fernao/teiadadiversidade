<?php
/*
Template Name: Cadastro
*/
$successMessage = "";

if (isset($_POST['action']) && $_POST['action'] == 'inscricao') {
    $errors = array();
    
    if (!isset($_POST['concordo']) || $_POST['concordo'] != 1) {
        $errors['termos'] = __('É preciso concordar com os termos de uso da plataforma', 'minc');
    }         
    if (strlen($_POST['email']) == 0) {
        $errors['email'] =  __('O e-mail é obrigatório.', 'teiadadiversidade');
    }
    if (!filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] =  __('O e-mail informado é inválido.', 'teiadadiversidade');
    }
    
    if (!validaCPF($_POST['cpf'])) { 
        $errors['cpf'] =  __('CPF inválido', 'teiadadiversidade');
    }
    
    if (strlen($_POST['nome']) == 0) {
        $errors['nome'] =  __('O nome é obrigatório.', 'teiadadiversidade');
    }

    if (strlen($_POST['estado']) == 0 || strlen($_POST['municipio']) == 0) {
        $errors['local'] = __('Por favor selecione um estado e um município', 'teiadadiversidade');
    }

    if (!validaCEP($_POST['cep'])) { 
        $errors['cep'] =  __('CEP inválido', 'teiadadiversidade');
    }
    
    if (strlen($_POST['logradouro']) == 0) {
        $errors['logradouro'] =  __('O logradouro é obrigatório.', 'teiadadiversidade');
    }    
    
    if (strlen($_POST['atuacao']) == 0) {
        $errors['atuacao'] =  __('A área de atuação é obrigatória.', 'teiadadiversidade');
    }    

    if (strlen($_POST['ocupacao']) == 0) {
        $errors['ocupacao'] =  __('A ocupação é obrigatória.', 'teiadadiversidade');
    }

    if (strlen($_POST['data_nascimento']) == 0) {
        $errors['data_nascimento'] =  __('Data de nascimento é obrigatória.', 'teiadadiversidade');
    }

    if (strlen($_POST['estado_civil']) == 0) {
        $errors['estado_civil'] =  __('Estado Civil é obrigatório.', 'teiadadiversidade');
    }

    if (strlen($_POST['rg']) == 0) {
        $errors['rg'] =  __('RG é obrigatório.', 'teiadadiversidade');
    }

    if (strlen($_POST['orgao_emissor']) == 0) {
        $errors['orgao_emissor'] =  __('Órgão emissor é obrigatório.', 'teiadadiversidade');
    }

    if (strlen($_POST['sexo']) == 0) {
        $errors['sexo'] =  __('Preencha o sexo.', 'teiadadiversidade');
    }

    if (strlen($_POST['data_chegada']) == 0) {
        $errors['data_chegada'] =  __('Informe a data de chegada.', 'teiadadiversidade');
    }

    if (strlen($_POST['data_saida']) == 0) {
        $errors['data_saida'] =  __('Informe a data de saída.', 'teiadadiversidade');
    }

    if (strlen($_POST['telefone_emergencia']) == 0) {
        $errors['telefone_emergencia'] =  __('Informe um telefone de emergência.', 'teiadadiversidade');
    }
    if (strlen($_POST['entidade_nome']) == 0) {
        $errors['entidade_nome'] =  __('Informe o nome da entidade à qual você está vinculado.', 'teiadadiversidade');
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
    $data['data_nascimento'] = filter_var($_POST['data_nascimento'], FILTER_SANITIZE_STRING);
    $data['estado_civil'] = filter_var($_POST['estado_civil'], FILTER_SANITIZE_STRING);
    $data['sexo'] = filter_var($_POST['sexo'], FILTER_SANITIZE_STRING);
    $data['rg'] = filter_var($_POST['rg'], FILTER_SANITIZE_STRING);
    $data['orgao_emissor'] = filter_var($_POST['orgao_emissor'], FILTER_SANITIZE_STRING);
    $data['data_chegada'] = filter_var($_POST['data_chegada'], FILTER_SANITIZE_STRING);
    $data['data_saida'] = filter_var($_POST['data_saida'], FILTER_SANITIZE_STRING);
    $data['telefone_emergencia'] = filter_var($_POST['telefone_emergencia'], FILTER_SANITIZE_STRING);   
 
    $data['representa_ponto_de_cultura'] = filter_var($_POST['representa_ponto_de_cultura'], FILTER_SANITIZE_STRING);
    $data['representa_gestor'] = filter_var($_POST['representa_gestor'], FILTER_SANITIZE_STRING);    
    $data['representa_outro'] = filter_var($_POST['representa_outro'], FILTER_SANITIZE_STRING);    
    $data['entidade_nome'] = filter_var($_POST['entidade_nome'], FILTER_SANITIZE_STRING);    
    $data['entidade_funcao'] = filter_var($_POST['entidade_funcao'], FILTER_SANITIZE_STRING);    
    $data['entidade_telefone'] = filter_var($_POST['entidade_telefone'], FILTER_SANITIZE_STRING);    
    $data['entidade_email'] = filter_var($_POST['entidade_email'], FILTER_SANITIZE_STRING);    
    $data['entidade_homepage'] = filter_var($_POST['entidade_homepage'], FILTER_SANITIZE_STRING);

    $data['observacoes_clinicas'] = filter_var($_POST['observacoes_clinicas'], FILTER_SANITIZE_STRING);
    $data['observacoes_clinicas_detalhes'] = filter_var($_POST['observacoes_clinicas_detalhes'], FILTER_SANITIZE_STRING);
    $data['alergia'] = filter_var($_POST['alergia'], FILTER_SANITIZE_STRING);
    $data['alergia_detalhes'] = filter_var($_POST['alergia_detalhes'], FILTER_SANITIZE_STRING);
    $data['tipo_sanguineo'] = filter_var($_POST['tipo_sanguineo'], FILTER_SANITIZE_STRING);
    $data['fator_rh'] = filter_var($_POST['fator_rh'], FILTER_SANITIZE_STRING);
    $data['plano_saude'] = filter_var($_POST['plano_saude'], FILTER_SANITIZE_STRING);
    $data['plano_saude_detalhes'] = filter_var($_POST['plano_saude_detalhes'], FILTER_SANITIZE_STRING);
    
    $data['deficiencia'] = filter_var($_POST['deficiencia'], FILTER_SANITIZE_STRING);    
    $data['deficiencia_detalhes'] = filter_var($_POST['deficiencia_detalhes'], FILTER_SANITIZE_STRING);    
    $data['deficiencia_acompanhante'] = filter_var($_POST['deficiencia_acompanhante'], FILTER_SANITIZE_STRING);    
    $data['deficiencia_acompanhante_parentesco'] = filter_var($_POST['deficiencia_acompanhante_parentesco'], FILTER_SANITIZE_STRING);    
    $data['deficiencia_observacoes'] = filter_var($_POST['deficiencia_observacoes'], FILTER_SANITIZE_STRING);    

    $data['alimentacao'] = filter_var($_POST['alimentacao'], FILTER_SANITIZE_STRING);    
    $data['alimentacao_especifica'] = filter_var($_POST['alimentacao_especifica'], FILTER_SANITIZE_STRING);    
    $data['alimentacao_alergia'] = filter_var($_POST['alimentacao_alergia'], FILTER_SANITIZE_STRING);    
    $data['alimentacao_alergia_detalhes'] = filter_var($_POST['alimentacao_alergia_detalhes'], FILTER_SANITIZE_STRING);    

    $data['outras_observacoes'] = filter_var($_POST['outras_observacoes'], FILTER_SANITIZE_STRING);    
    
    $data['presenca'] = filter_var($_POST['presenca'], FILTER_SANITIZE_STRING);    
    
    $data['segmentos_ponto_cultura'] = filter_var($_POST['segmentos_ponto_cultura'], FILTER_SANITIZE_STRING);       
    $data['segmentos_gestor'] = filter_var($_POST['segmentos_gestor'], FILTER_SANITIZE_STRING);       
    $data['segmentos_indigena'] = filter_var($_POST['segmentos_indigena'], FILTER_SANITIZE_STRING);       
    $data['segmentos_matriz_africana'] = filter_var($_POST['segmentos_matriz_africana'], FILTER_SANITIZE_STRING);       
    $data['segmentos_cigano'] = filter_var($_POST['segmentos_cigano'], FILTER_SANITIZE_STRING);       
    $data['segmentos_pesquisador'] = filter_var($_POST['segmentos_pesquisador'], FILTER_SANITIZE_STRING);       
    $data['segmentos_brasil_plural'] = filter_var($_POST['segmentos_brasil_plural'], FILTER_SANITIZE_STRING);       
    $data['segmentos_representante_comites'] = filter_var($_POST['segmentos_representante_comites'], FILTER_SANITIZE_STRING);       
    $data['segmentos_outros'] = filter_var($_POST['segmentos_outros'], FILTER_SANITIZE_STRING);    

    $data['dialogos_forum_nacional_pontos_cultura'] = filter_var($_POST['dialogos_forum_nacional_pontos_cultura'], FILTER_SANITIZE_STRING);    
    $data['dialogos_forum_indigena'] = filter_var($_POST['dialogos_forum_indigena'], FILTER_SANITIZE_STRING);    
    $data['dialogos_forum_culturas_negras'] = filter_var($_POST['dialogos_forum_culturas_negras'], FILTER_SANITIZE_STRING);    
    $data['dialogos_forum_gestores_culturaviva'] = filter_var($_POST['dialogos_forum_gestores_culturaviva'], FILTER_SANITIZE_STRING);    
    $data['dialogos_encontro_pontos_memoria'] = filter_var($_POST['dialogos_encontro_pontos_memoria'], FILTER_SANITIZE_STRING);    
    $data['dialogos_encontro_pontos_leitura'] = filter_var($_POST['dialogos_encontro_pontos_leitura'], FILTER_SANITIZE_STRING);
    $data['dialogos_encontro_pesquisadores_politicas_culturais'] = filter_var($_POST['dialogos_encontro_pesquisadores_politicas_culturais'], FILTER_SANITIZE_STRING);    
    $data['dialogos_seminario_acessibilidade'] = filter_var($_POST['dialogos_seminario_acessibilidade'], FILTER_SANITIZE_STRING);    
    $data['dialogos_conferencia_livre_educacao_cultura'] = filter_var($_POST['dialogos_conferencia_livre_educacao_cultura'], FILTER_SANITIZE_STRING);    
    
    
    
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
			<h1>Cadastro</h1>					
		</header>
		<div class="post-content clearfix">
            <?php print_msgs($msgs);?>


<P>  ATENÇÃO: COM EXCEÇÃO DOS DELEGADOS ELEITOS NOS FÓRUNS ESTADUAIS DE PONTOS DE CULTURA, ESTE CADASTRO NÃO GARANTE PARTICIPAÇÃO IMEDIATA NO EVENTO E NEM COBERTURA DE CUSTOS POR PARTE DO MINISTÉRIO DA CULTURA, SENDO PORTANTO UMA PRÉ INSCRIÇÃO PASSÍVEL DE VALIDAÇÃO POR PARTE DA ORGANIZAÇÃO DO EVENTO. POR FAVOR AGUARDE RETORNO POR EMAIL. </P>
            
                    <form method="POST" name="inscricao" id="form-inscricao" action="">
                    <input id="action" type="hidden" name="action" value="inscricao" />
                    <h3 class="subtitulo">Dados para realização da inscrição na TEIA 2014</h3>
                        <label>Presença</label><br />
  <input id="presenca" type="radio" name="presenca" class="presenca" value="participante"  <?php if (isset($_POST['presenca']) && $_POST['presenca'] == 'participante') echo 'checked'; ?>  onclick="participante()"> Participante<br/>
  <input id="presenca" type="radio" name="presenca" class="presenca" value="convidado"  <?php if (isset($_POST['presenca']) && $_POST['presenca'] == 'convidado') echo 'checked'; ?>  onclick="participante()"> Convidado/Convidada<br/>
  <input id="presenca_delegado" type="radio" name="presenca" class="presenca" value="delegado"  <?php if (isset($_POST['presenca']) && $_POST['presenca'] == 'delegado') echo 'checked'; ?> onclick="delegados()" > Delegado/delegada do Fórum Nacional dos Pontos de Cultura
<br/><br/>
<div id="texto_delegado"></div>
				<br/>
<div id="inscricao-participante">
                    <h4>Dados pessoais</h4>
                        <label>Nome *</label><br />
                        <input id="nome" type="text" name="nome" class="texto" value="<?php echo isset($_POST['nome']) ? esc_attr($_POST['nome']) : ''; ?>" /><br />
                        <label>Email *</label><br />
                        <input id="email" type="text" name="email" class="texto" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>" /><br />
                        <label>CPF *</label><br />
                        <input id="cpf" type="text" name="cpf" class="cpf" value="<?php echo isset($_POST['cpf']) ? esc_attr($_POST['cpf']) : ''; ?>" /><br />
                        <input id="natureza_juridica" type="hidden" name="natureza_juridica" value="1" />
                        <label>Data Nascimento</label><br />
                        <input id="data_nascimento" type="text" name="data_nascimento" class="data_nascimento" value="<?php echo isset($_POST['data_nascimento']) ? esc_attr($_POST['data_nascimento']) : ''; ?>" /><br />

                        <label>Estado civil</label><br />
                        <input id="estado_civil" type="text" name="estado_civil" class="estado_civil" value="<?php echo isset($_POST['estado_civil']) ? esc_attr($_POST['estado_civil']) : ''; ?>" /><br />

                        <label>Sexo</label><br />
                        <select name="sexo" id="sexo">
                            <option value=""> Selecione </option>
  <?php $sexos = ['masculino', 'feminino']; ?>
                            <?php foreach ($sexos as $sexo): ?>
                                <option value="<?php echo $sexo; ?>"  <?php if (isset($_POST['sexo']) && $_POST['sexo'] == $sexo) echo 'selected'; ?>  >
                                    <?php echo $sexo; ?>
                                </option>
                            <?php endforeach; ?>
                        </select><br />

                        <label>RG</label><br />
                        <input id="rg" type="text" name="rg" class="rg" value="<?php echo isset($_POST['rg']) ? esc_attr($_POST['rg']) : ''; ?>" /><br />

                        <label>Órgão emissor</label><br />
                        <input id="orgao_emissor" type="text" name="orgao_emissor" class="orgao_emissor" value="<?php echo isset($_POST['orgao_emissor']) ? esc_attr($_POST['orgao_emissor']) : ''; ?>" /><br />
                        <label>Telefone de emergência</label><br />
                        <input id="telefone_emergencia" type="text" name="telefone_emergencia" class="telefone_emergencia" value="<?php echo isset($_POST['telefone_emergencia']) ? esc_attr($_POST['telefone_emergencia']) : ''; ?>" /><br />

                   <h4 class="subtitulo">Sua participação no encontro</h4>
                        <label>Data de chegada</label><br />
                        <input id="data_chegada" type="text" name="data_chegada" class="data_chegada" value="<?php echo isset($_POST['data_chegada']) ? esc_attr($_POST['data_chegada']) : ''; ?>" /><br />
                        <label>Data de saída</label><br />
                        <input id="data_saida" type="text" name="data_saida" class="data_saida" value="<?php echo isset($_POST['data_saida']) ? esc_attr($_POST['data_saida']) : ''; ?>" /><br />

				<label>Segmentos</label><br />
<?php 
				$segmentos_lst = [
						  'segmentos_ponto_cultura' => 'Ponto de cultura',
						  'segmentos_gestor' => 'Gestor/gestora',
						  'segmentos_indigena' => 'Indígena',
						  'segmentos_matriz_africana' => 'Matriz africana',
						  'segmentos_cigano' => 'Cigana/cigano',
						  'segmentos_pesquisador' => 'Pesquisadora/pesquisador',
						  'segmentos_brasil_plural' => 'Programa Brasil Plural (LGBT, Gênero, Infância, Juventude, Quilombola, Pessoas com deficiência, Idosos, Povos e Comunidades Tradicionais, Culturas Populares)',
						  'segmentos_representante_comites' => 'Representante de comitês / colegiados / conselhos'
						  ];
?>
<?php foreach ($segmentos_lst as $seg_key => $seg_value) { ?>
<input id="<?php echo $seg_key ?>" type="checkbox" name="<?php echo $seg_key ?>" class="segmentos" value="sim"  <?php if (isset($_POST[$seg_key]) && $_POST[$seg_key] == $seg_key) echo 'checked'; ?>  >
 <?php echo $segmentos_lst[$seg_key]; ?><br/>
 <?php } ?>
Outros &nbsp;<input id="segmentos_outros" type="text" name="segmentos_outros" class="segmentos_outros" value="<?php echo isset($_POST['segmentos_outros']) ? esc_attr($_POST['segmentos_outros']) : ''; ?>" /><br />
 <br/>
                        <label>Diálogos da Cidadania e da Diversidade</label><br />
<?php 
 $dialogos_lst = [
		  'dialogos_forum_nacional_pontos_cultura' => 'Fórum Nacional dos Pontos de Cultura',
		  'dialogos_forum_indigena' => 'Fórum Indígena',
		  'dialogos_forum_culturas_negras' => 'Fórum Culturas Negras',
		  'dialogos_forum_gestores_culturaviva' => 'Fórum de Gestores Estaduais e Municipais do Programa Cultura Viva',
		  'dialogos_encontro_pontos_memoria' => 'Encontro dos Pontos de Memória',
		  'dialogos_encontro_pontos_leitura' => 'Encontro dos Pontos de Leitura',
		  'dialogos_encontro_pesquisadores_politicas_culturais' => 'Encontro de Pesquisadores de Políticas Culturais',
		  'dialogos_seminario_acessibilidade' => 'I Seminário Nacional de Acessibilidade em Ambientes Culturais',
		  'dialogos_conferencia_livre_educacao_cultura' => 'Conferência Livre de Educação e Cultura',
 ];
?>
<?php foreach ($dialogos_lst as $dia_key => $dia_value) { ?>
<input id="dialogos" type="checkbox" name="<?php echo $dia_key ?>" class="dialogos" value="sim"  <?php if (isset($_POST[$dia_key]) && $_POST[$dia_key] == $dia_key) echo 'checked'; ?>  >
 <?php echo $dialogos_lst[$dia_key]; ?><br/>
 <?php } ?>
 <br/>
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
  
                 <h4 class="subtitulo">Atuação *</h4>
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


                 <h4 class="subtitulo">Dados da instituição / entidade que representa</h4>
<?php 
				$entidade_tipo = [
						  'representa_ponto_de_cultura' => 'Ponto de cultura',
						  'representa_gestor' => 'Gestor/gestora',
						  'representa_outro' => 'Outro'
						  ];
?>
<?php foreach ($entidade_tipo as $ent_key => $value) { ?>
<input id="<?php echo $ent_key ?>" type="checkbox" name="<?php echo $ent_key ?>" class="<?php $ent_key ?>" value="sim"  <?php if (isset($_POST[$ent_key]) && $_POST[$ent_key] == $ent_key) echo 'checked'; ?>  >
 <?php echo $entidade_tipo[$ent_key]; ?><br/>
 <?php } ?>
Especifique &nbsp;<input id="segmentos_outros" type="text" name="segmentos_outros" class="segmentos_outros" value="<?php echo isset($_POST['segmentos_outros']) ? esc_attr($_POST['segmentos_outros']) : ''; ?>" /><br />

                        <label>Nome da instituição / Entidade *</label><br />
                        <input id="entidade_nome" type="text" name="entidade_nome" class="entidade_nome" value="<?php echo isset($_POST['entidade_nome']) ? esc_attr($_POST['entidade_nome']) : ''; ?>" /><br />
                        <label>Sua função na entidade</label><br />
                        <input id="entidade_funcao" type="text" name="entidade_funcao" class="entidade_funcao" value="<?php echo isset($_POST['entidade_funcao']) ? esc_attr($_POST['entidade_funcao']) : ''; ?>" /><br />
                        <label>Telefone</label><br />
                        <input id="entidade_telefone" type="text" name="entidade_telefone" class="entidade_telefone" value="<?php echo isset($_POST['entidade_telefone']) ? esc_attr($_POST['entidade_telefone']) : ''; ?>" /><br />
                        <label>Email</label><br />
                        <input id="entidade_email" type="text" name="entidade_email" class="entidade_email texto" value="<?php echo isset($_POST['entidade_email']) ? esc_attr($_POST['entidade_email']) : ''; ?>" /><br />
                        <label>Homepage</label><br />
                        <input id="entidade_homepage" type="text" name="entidade_homepage" class="texto entidade_homepage" value="<?php echo isset($_POST['entidade_homepage']) ? esc_attr($_POST['entidade_homepage']) : ''; ?>" /><br />

                 <h4 class="subtitulo">Observações clínicas</h4>
                        <label>Necessita algum tipo de observação clínica?</label><br />
			<input id="observacoes_clinicas" type="radio" name="observacoes_clinicas" class="observacoes_clinicas" value="sim" <?php if (isset($_POST['observacoes_clinicas']) && $_POST['observacoes_clinicas'] == 'sim') echo 'checked'; ?>  > Sim
			<input id="observacoes_clinicas" type="radio" name="observacoes_clinicas" class="observacoes_clinicas" value="não" <?php if (isset($_POST['observacoes_clinicas']) && $_POST['observacoes_clinicas'] == 'não') echo 'checked'; ?>  > Não<br/>
                        <label>Especifique</label><br />
			<input id="observacoes_clinicas_detalhes" type="text" name="observacoes_clinicas_detalhes" class="observacoes_clinicas_detalhes" value="<?php echo isset($_POST['observacoes_clinicas_detalhes']) ? esc_attr($_POST['observacoes_clinicas_detalhes']) : ''; ?>" /><br />

                        <label>Possui alguma alergia?</label><br />
			<input id="alergia" type="radio" name="alergia" class="alergia" value="sim" <?php if (isset($_POST['alergia']) && $_POST['alergia'] == 'sim') echo 'checked'; ?>  > Sim
			<input id="alergia" type="radio" name="alergia" class="alergia" value="não" <?php if (isset($_POST['alergia']) && $_POST['alergia'] == 'não') echo 'checked'; ?>  > Não<br/>
                        <label>Especifique</label><br />
			<input id="alergia_detalhes" type="text" name="alergia_detalhes" class="alergia_detalhes" value="<?php echo isset($_POST['observacoes_clinicas_detalhes']) ? esc_attr($_POST['observacoes_clinicas_detalhes']) : ''; ?>" /><br />

                        <label>Tipo sanguíneo</label><br />
			<input id="tipo_sanguineo" type="radio" name="tipo_sanguineo" class="tipo_sanguineo" value="A" <?php if (isset($_POST['tipo_sanguineo']) && $_POST['tipo_sanguineo'] == 'A') echo 'checked'; ?>  > Tipo A
			<input id="tipo_sanguineo" type="radio" name="tipo_sanguineo" class="tipo_sanguineo" value="B" <?php if (isset($_POST['tipo_sanguineo']) && $_POST['tipo_sanguineo'] == 'B') echo 'checked'; ?>  > Tipo B
			<input id="tipo_sanguineo" type="radio" name="tipo_sanguineo" class="tipo_sanguineo" value="AB" <?php if (isset($_POST['tipo_sanguineo']) && $_POST['tipo_sanguineo'] == 'AB') echo 'checked'; ?>  > Tipo AB
			<input id="tipo_sanguineo" type="radio" name="tipo_sanguineo" class="tipo_sanguineo" value="O" <?php if (isset($_POST['tipo_sanguineo']) && $_POST['tipo_sanguineo'] == 'O') echo 'checked'; ?>  > Tipo O
																				     <br/>
                        <label>Fator RH</label><br />
			<input id="fator_rh" type="radio" name="fator_rh" class="fator_rh" value="negativo" <?php if (isset($_POST['fator_rh']) && $_POST['fator_rh'] == 'negativo') echo 'checked'; ?>  > Negativo
			<input id="fator_rh" type="radio" name="fator_rh" class="fator_rh" value="positivo" <?php if (isset($_POST['fator_rh']) && $_POST['fator_rh'] == 'positivo') echo 'checked'; ?>  > Positivo
<br/>
                        <label>Plano de saúde</label><br />
			<input id="plano_saude" type="radio" name="plano_saude" class="plano_saude" value="sim" <?php if (isset($_POST['plano_saude']) && $_POST['plano_saude'] == 'sim') echo 'checked'; ?>  > Sim
			<input id="plano_saude" type="radio" name="plano_saude" class="plano_saude" value="não" <?php if (isset($_POST['plano_saude']) && $_POST['plano_saude'] == 'não') echo 'checked'; ?>  > Não<br/>
                        <label>Especifique</label><br />
		        <input id="plano_saude_detalhes" type="text" name="plano_saude_detalhes" class="plano_saude_detalhes" value="<?php echo isset($_POST['plano_saude_detalhes']) ? esc_attr($_POST['plano_saude_detalhes']) : ''; ?>" /><br />


                 <h4 class="subtitulo">Pessoa com deficiência</h4>
                        <label>Possui algum tipo de deficiência?</label><br />
			<input id="deficiencia" type="radio" name="deficiencia" class="deficiencia" value="nenhuma" <?php if (isset($_POST['deficiencia']) && $_POST['deficiencia'] == 'nenhuma') echo 'checked'; ?>  > Nenhuma
			<input id="deficiencia" type="radio" name="deficiencia" class="deficiencia" value="auditiva" <?php if (isset($_POST['deficiencia']) && $_POST['deficiencia'] == 'auditiva') echo 'checked'; ?>  > Auditiva
			<input id="deficiencia" type="radio" name="deficiencia" class="deficiencia" value="visual" <?php if (isset($_POST['deficiencia']) && $_POST['deficiencia'] == 'visual') echo 'checked'; ?>  > Visual
			<input id="deficiencia" type="radio" name="deficiencia" class="deficiencia" value="locomocao" <?php if (isset($_POST['deficiencia']) && $_POST['deficiencia'] == 'locomocao') echo 'checked'; ?>  > Locomoção
																				     <input id="deficiencia" type="radio" name="deficiencia" class="deficiencia" value="outra" <?php if (isset($_POST['deficiencia']) && $_POST['deficiencia'] == 'outra') echo 'checked'; ?>  > Outra <br/>
              <label>Especifique</label><br />
		<input id="deficiencia_detalhes" type="text" name="deficiencia_detalhes" class="deficiencia_detalhes" value="<?php echo isset($_POST['deficiencia_detalhes']) ? esc_attr($_POST['deficiencia_detalhes']) : ''; ?>" /><br />

                        <label>Terá acompanhante?</label><br />
			<input id="deficiencia_acompanhante" type="radio" name="deficiencia_acompanhante" class="deficiencia_acompanhante" value="sim" <?php if (isset($_POST['deficiencia_acompanhante']) && $_POST['deficiencia_acompanhante'] == 'sim') echo 'checked'; ?>  > Sim
			<input id="deficiencia_acompanhante" type="radio" name="deficiencia_acompanhante" class="deficiencia_acompanhante" value="não" <?php if (isset($_POST['deficiencia_acompanhante']) && $_POST['deficiencia_acompanhante'] == 'não') echo 'checked'; ?>  > Não<br/>
                        <label>Grau de parentesco</label><br />
			<input id="deficiencia_acompanhante_parentesco" type="text" name="deficiencia_acompanhante_parentesco" class="deficiencia_acompanhante_parentesco" value="<?php echo isset($_POST['deficiencia_acompanhante_parentesco']) ? esc_attr($_POST['deficiencia_acompanhante_parentesco']) : ''; ?>" /><br />
                        <label>Observações</label><br />
			<textarea id="deficiencia_observacoes" type="text" name="deficiencia_observacoes" class="deficiencia_observacoes"><?php echo isset($_POST['deficiencia_observacoes']) ? esc_attr($_POST['deficiencia_observacoes']) : ''; ?></textarea><br />

                 <h4 class="subtitulo">Alimentação</h4>
                        <label>Possui alguma restrição?</label><br />
			<input id="alimentacao" type="radio" name="alimentacao" class="alimentacao" value="sem restrição" <?php if (isset($_POST['alimentacao']) && $_POST['alimentacao'] == 'sem restrição') echo 'checked'; ?>  > Sem restrição
			<input id="alimentacao" type="radio" name="alimentacao" class="alimentacao" value="vegetariano" <?php if (isset($_POST['alimentacao']) && $_POST['alimentacao'] == 'vegetariano') echo 'checked'; ?>  > Vegetariano/vegetariana<br/>
                        <label>Necessita alimentação específica?</label><br />
			<input id="alimentacao_especifica" type="radio" name="alimentacao_especifica" class="alimentacao_especifica" value="diabetico" <?php if (isset($_POST['alimentacao_especifica']) && $_POST['alimentacao_especifica'] == 'diabetico') echo 'checked'; ?>  > Diabético
			<input id="alimentacao_especifica" type="radio" name="alimentacao_especifica" class="alimentacao_especifica" value="diabetico" <?php if (isset($_POST['alimentacao_especifica']) && $_POST['alimentacao_especifica'] == 'diabetico') echo 'checked'; ?>  > Celíaco<br/>
                        <label>Alérgico a algum alimento?</label><br />
			<input id="alimentacao_alergia" type="radio" name="alimentacao_alergia" class="alimentacao_alergia" value="sim" <?php if (isset($_POST['alimentacao_alergia']) && $_POST['alimentacao_alergia'] == 'sim') echo 'checked'; ?>  > Sim
			<input id="alimentacao_alergia" type="radio" name="alimentacao_alergia" class="alimentacao_alergia" value="não" <?php if (isset($_POST['alimentacao_alergia']) && $_POST['alimentacao_alergia'] == 'não') echo 'checked'; ?>  > Não<br/>
                        <label>Especifique</label><br />
			<input id="alimentacao_alergia_detalhes" type="text" name="alimentacao_alergia_detalhes" class="alimentacao_alergia_detalhes" value="<?php echo isset($_POST['alimentacao_alergia_detalhes']) ? esc_attr($_POST['alimentacao_alergia_detalhes']) : ''; ?>" /><br />																				    
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
			
                        <label>Outras observações</label><br />
			<textarea id="outras_observacoes" type="text" name="outras_observacoes" class="outras_observacoes"><?php echo isset($_POST['outras_observacoes']) ? esc_attr($_POST['outras_observacoes']) : ''; ?></textarea><br />


                    </p>
                    <p><input type="checkbox" name="concordo" value="1" <?php isset($_POST['concordo']) ? checked($_POST['concordo'], true) : ''; ?>/> Li e concordo com os <a href="/teiadadiversidade/<?php echo network_site_url('termos-de-uso'); ?>">termos de uso</a> da inscrição.</p>
                    <input type="submit" value="Cadastrar" class="button-submit" />
</div> <!-- fim #inscricao-participante -->
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
