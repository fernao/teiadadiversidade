jQuery(document).ready(function() {

    /*** Inicio headlines ***/
    jQuery('div.hlTabs').tabs();
    
    // oculta todos slides menos o primeiro
    jQuery('div.hlTabs div:gt(0)').hide();
    
    // apartir do primeiro, até os próximos
    var duration_cycle = setInterval(function(){ jQuery('div.hlTabs div:first').hide().next().fadeIn('slow','linear').end().appendTo('div.hlTabs');}, 4000);
    
    // se selecionar o slide, ocultar os outros slides e parar o ciclo
    jQuery(".hlTabs a.ui-tabs-anchor").click(function(){
	jQuery('div.hlTabs div').each( function(){
	    if( 'false' == jQuery(this).attr('aria-expanded'))
		jQuery(this).hide();
	});
	clearTimeout(duration_cycle);
    });
    /*** fim headlines ***/

    /* preload dos backgrounds rollover */
    preload = function(img) {
      var imagem = new Image()
      imagem.src = img;
    }

    delegados = function() {
	jQuery('#texto_delegado').html('<p><strong>ATENÇÃO: Para delegados/delegadas do Fórum Nacional do Pontos de Cultura, é necessário preencher um formulário de inscrições específico na plataforma Corais: <a target="_blank" href="http://corais.org/teiadadiversidade/node/80752">formulário de inscrições específico.</a></strong></p>');
	jQuery('#inscricao-participante').hide();
    }
    
    participante = function() {
	jQuery('#inscricao-participante').show();
    }

    
    
/*
    preload([
    	'/wp-content/themes/teiadadiversidade/img/culturaviva.txt.png',
	'/wp-content/themes/teiadadiversidade/img/programacao.txt.png',
	'/wp-content/themes/teiadadiversidade/img/galeria.txt.png',
	'/wp-content/themes/teiadadiversidade/img/tvteia.txt.png',
	'/wp-content/themes/teiadadiversidade/img/radioteia.txt.png',
	'/wp-content/themes/teiadadiversidade/img/colaborativa.txt.png',
	'/wp-content/themes/teiadadiversidade/img/inscricoes.txt.png',
	'/wp-content/themes/teiadadiversidade/img/localizacao.txt.png',
	'/wp-content/themes/teiadadiversidade/img/localizacao.txt.png',
	'/wp-content/themes/teiadadiversidade/img/imprensa.txt.png',
	'/wp-content/themes/teiadadiversidade/img/contato.txt.png',
	'/wp-content/themes/teiadadiversidade/img/culturaviva.txt.pq.png',
	'/wp-content/themes/teiadadiversidade/img/programacao.txt.pq.png',
	'/wp-content/themes/teiadadiversidade/img/galeria.txt.pq.png',
	'/wp-content/themes/teiadadiversidade/img/tvteia.txt.pq.png',
	'/wp-content/themes/teiadadiversidade/img/radioteia.txt.pq.png',
	'/wp-content/themes/teiadadiversidade/img/colaborativa.txt.pq.png',
	'/wp-content/themes/teiadadiversidade/img/inscricoes.txt.pq.png',
	'/wp-content/themes/teiadadiversidade/img/localizacao.txt.pq.png',
 	'/wp-content/themes/teiadadiversidade/img/imprensa.txt.pq.png',
	'/wp-content/themes/teiadadiversidade/img/contato.txt.pq.png'
	]);	
*/
/* rand do fundo */
cores = ['#D4EAEE',
	'#E5EBC7',
	'#F1E3E8'];

	var bgIndex = Math.floor(Math.random() * 3);
	jQuery('body').css('background-color', cores[bgIndex]);
});

