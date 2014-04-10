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
});
