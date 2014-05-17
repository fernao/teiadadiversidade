<?php

$inscricoes_queries = array();

$inscricoes_queries[] = 'DROP TABLE IF EXISTS `teia_inscricoes`;';
$inscricoes_queries[] = 'CREATE TABLE teia_inscricao (
  `id` int(11) NOT NULL AUTO_INCREMENT,
 nome VARCHAR(255),
 email VARCHAR(255),
 cpf VARCHAR(255) , 
 estado VARCHAR(255) , 
 municipio VARCHAR(255) , 
 logradouro VARCHAR(255) , 
 complemento VARCHAR(255) , 
 bairro VARCHAR(255) , 
 localizacao VARCHAR(255) , 
 ocupacao VARCHAR(255) , 
 atuacao VARCHAR(255) , 
 telefone_cel VARCHAR(255) , 
 telefone_res VARCHAR(255) , 
 telefone_com VARCHAR(255) , 
 website VARCHAR(255) , 
 facebook VARCHAR(255) , 
 twitter VARCHAR(255) , 
 youtube VARCHAR(255) , 
 google_plus VARCHAR(255) , 
 outras_redessociais VARCHAR(255) , 
 curriculo LONGTEXT,
 data_nascimento VARCHAR(255) , 
 estado_civil VARCHAR(255) , 
 sexo VARCHAR(255) , 
 rg VARCHAR(255) , 
 orgao_emissor VARCHAR(255) , 
 data_chegada VARCHAR(255) , 
 data_saida VARCHAR(255) , 
 telefone_emergencia VARCHAR(255) , 
 representa_ponto_de_cultura VARCHAR(255) , 
 representa_gestor VARCHAR(255) , 
 representa_outro VARCHAR(255) , 
 entidade_nome VARCHAR(255) , 
 entidade_funcao VARCHAR(255) , 
 entidade_telefone VARCHAR(255) , 
 entidade_email VARCHAR(255) , 
 entidade_homepage VARCHAR(255) , 
 observacoes_clinicas VARCHAR(255) , 
 observacoes_clinicas_detalhes TEXT , 
 alergia VARCHAR(255) , 
 alergia_detalhes VARCHAR(255) , 
 tipo_sanguineo VARCHAR(255) , 
 fator_rh VARCHAR(255) , 
 plano_saude VARCHAR(255) , 
 plano_saude_detalhes VARCHAR(255) , 
 deficiencia VARCHAR(255) , 
 deficiencia_detalhes VARCHAR(255) , 
 deficiencia_acompanhante VARCHAR(255) , 
 deficiencia_acompanhante_parentesco TEXT , 
 deficiencia_observacoes TEXT , 
 alimentacao VARCHAR(255) , 
 alimentacao_especifica VARCHAR(255) , 
 alimentacao_alergia VARCHAR(255) , 
 alimentacao_alergia_detalhes VARCHAR(255) , 
 outras_observacoes TEXT , 
 presenca VARCHAR(255) , 
 segmentos_ponto_cultura VARCHAR(255) , 
 segmentos_gestor VARCHAR(255) , 
 segmentos_indigena VARCHAR(255) , 
 segmentos_matriz_africana VARCHAR(255) , 
 segmentos_cigano VARCHAR(255) , 
 segmentos_pesquisador VARCHAR(255) , 
 segmentos_brasil_plural VARCHAR(255) , 
 segmentos_representante_comites VARCHAR(255) , 
 segmentos_outros VARCHAR(255) , 
 dialogos_forum_nacional_pontos_cultura VARCHAR(255) , 
 dialogos_forum_indigena VARCHAR(255) , 
 dialogos_forum_culturas_negras VARCHAR(255) , 
 dialogos_forum_gestores_culturaviva VARCHAR(255) , 
 dialogos_encontro_pontos_memoria VARCHAR(255) , 
 dialogos_encontro_pontos_leitura VARCHAR(255) , 
 dialogos_encontro_pesquisadores_politicas_culturais VARCHAR(255) , 
 dialogos_seminario_acessibilidade VARCHAR(255) , 
 dialogos_conferencia_livre_educacao_cultura VARCHAR(255) ,
  PRIMARY KEY  (`id`),
UNIQUE KEY cpf (`cpf`)
) ENGINE=MyISAM;';