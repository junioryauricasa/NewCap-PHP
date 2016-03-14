function mensajeDiv(idDiv, tipoMensaje, mensaje) {
	if(tipoMensaje==1){
		tipoAlert="alert-success";
	}else{
		tipoAlert="alert-danger";
	}
	var html ="<div class='alert "+tipoAlert+"'"+ 
				"style='margin-top: 0px;'>"+
				"<a href='#' class='close' data-dismiss='alert' aria-label='close'"+
					"title='close'>×</a>"+mensaje+
			  "</div>";
	$('#'+idDiv).html(html);	
}
function cerrarMensajeDiv(){
	$('.alert').css('display','none');
}
function refresh(){
	location.reload();
}