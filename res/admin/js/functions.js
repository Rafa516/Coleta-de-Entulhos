
//ALERT PARA ALTERAÇÃO DE FOTO
function alertAlterarFoto() {
  
       Swal.fire({
		  position: 'inherit',
		  icon: 'info',
		  title: '<p style="font-size: 20px;">Olá, após a alteração de foto você será redirecionado para a página de login.</p>',
		  showConfirmButton: true
		  
		})
    
}

//ALERT PARA ALTERAÇÃO DOS DADOS
function alertAlterarDados() {
  
       Swal.fire({
		  position: 'inherit',
		  icon: 'info',
		  title: '<p style="font-size: 20px;">Olá, após a confirmação de  alteração dos dados você será redirecionado para a página de login.</p>',
		  showConfirmButton: true
		  
		})
    
}

/*lightbox das imagens*/

	$(document).ready(function() {

	  $('.image-link').magnificPopup({
	  	type:'image',
	  	gallery:{enabled:true}
	  });
	  

	});





