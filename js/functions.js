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
      imagem.src = img;
    }

    preload([
    	'img/culturaviva.txt.png',
	'img/programacao.txt.png',
	'img/galeria.txt.png',
	'img/tvteia.txt.png',
	'img/radioteia.txt.png',
	'img/colaborativa.txt.png',
	'img/inscricoes.txt.png',
	'img/localizacao.txt.png',
	'img/localizacao.txt.png',
	'img/imprensa.txt.png',
	'img/contato.txt.png',
	'img/culturaviva.txt.pq.png',
	'img/programacao.txt.pq.png',
	'img/galeria.txt.pq.png',
	'img/tvteia.txt.pq.png',
	'img/radioteia.txt.pq.png',
	'img/colaborativa.txt.pq.png',
	'img/inscricoes.txt.pq.png',
	'img/localizacao.txt.pq.png',
 	'img/imprensa.txt.pq.png',
	'img/contato.txt.pq.png'
	]);	
});

