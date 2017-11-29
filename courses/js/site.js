jQuery(function($) {
	courses();
});
function courses(){

	jQuery('input.cocher').on('click',function(){
		//var id = jQuery(this).attr('class').split(' ')[0].split('_')[1];
		var id = jQuery(this).attr('data-idmodif');
		//var nouveau_nom = jQuery('input.nouveau_nom_'+id).val();

		var coche = 'non';
		
		if( jQuery(this).is(':checked') ){
			coche = 'oui';
		}

		var url_action = "./cocher.php";
		var T_mes_donnees = {
			id_courses:    id,
			coche:       coche,
			//nouveau_nom: nouveau_nom
		};

		var ma_requete_ajax = jQuery.ajax({
			url: url_action, // url du fichier cible
			data: T_mes_donnees, // donnees envoyes au serveur => au fichier : url_action
			//dataType: 'script',
			error: function(xhr, status, error){
				jQuery('.echec').fadeIn();
			},
			success: function(data, status, xhr){
				jQuery('.reussi').fadeIn();
				jQuery('tr#id_'+id).toggleClass('checked');
			},
		});
	});
}

