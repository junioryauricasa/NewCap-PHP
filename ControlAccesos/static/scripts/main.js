$(window).load(function(){
$(document).ready(function(){
  $('#myModalBienvenido').modal('show')
});
});//]]> 



  $(document).ready(function(){
   $("#rc").click(function () {
    $('#login').css("display","none")
    $('#recuperar').css("display","block")
   
        });
   });

 $(document).ready(function(){
   $("#lg").click(function () {
    $('#recuperar').css("display","none")
    $('#login').css("display","block")
   
        });
   });








  $(document).ready(function(){
   $("#masopt").click(function () {
      $(".moption").each(function() {
        displaying = $(this).css("display");
        if(displaying == "block") {
          $(this).fadeOut('fast',function() {
           $(this).css("display","none");
          });
        } else {
          $(this).fadeIn('fast',function() {
            $(this).css("display","block");
          });
        }
      });
    });
  });

    $(document).ready(function(){
        $("#divusuario").click(function () {
            $('#contactenos').hide();
            $('#vendedores').hide();
            $('#importacion').hide();            
            $('#usuarios').fadeIn();
            
         });
        });

$(document).ready(function(){
        $("#divvendedores").click(function () {
            $('#contactenos').hide();
            $('#usuarios').hide();
            $('#importacion').hide();            
            $('#vendedores').fadeIn();
            
         });
        });

$(document).ready(function(){
        $("#divcontactenos").click(function () {
            $('#usuarios').hide();
            $('#vendedores').hide();
            $('#importacion').hide();            
            $('#contactenos').fadeIn();
            
         });
        });

$(document).ready(function(){
        $("#divimportacion").click(function () {
            $('#contactenos').hide();
            $('#vendedores').hide();
            $('#usuarios').hide();            
            $('#importacion').fadeIn();
            
         });
        });


  



    $(document).ready(function(){
   $("#oprincipal").click(function () {

        var elemento = document.getElementById("oprincipal");
        if (elemento.className == "fa fa-chevron-circle-up") {
          elemento.className = "fa fa-chevron-circle-down";
        }else {
          elemento.className = "fa fa-chevron-circle-up";
        }

      $("#bprincipal").each(function() {
        displaying = $(this).css("display");
        if(displaying == "block") {
          $(this).fadeOut('fast',function() {
           $(this).css("display","none");
          });
        } else {
          $(this).fadeIn('fast',function() {
            $(this).css("display","block");
          });
        }
      });
    });
  });
  

    $(document).ready(function(){
   $("#omenu, .fa-chevron-circle-left").click(function () {

        var elemento = document.getElementById("omenu");
        if (elemento.className == "fa fa-chevron-circle-left") {
          elemento.className = "fa fa-chevron-circle-right";
        }else {
          elemento.className = "fa fa-chevron-circle-left";
        }

        var elemento = document.getElementById("contenedorprincipal");
        if (elemento.className == "col-md-10") {
          elemento.className = "col-md-12";
        }else {
          elemento.className = "col-md-10";
        }

       $("#menuprincipal").each(function() {
        displaying = $(this).css("display");
        if(displaying == "block") {
         
           $(this).css("display","none");
       
        } else {
          $(this).fadeIn('fast',function() {
            $(this).css("display","block");
          });
        }
      });
    });
  });




     $(document).ready(function(){
   $("#editrol").click(function () {


       $(".mostraredit").each(function() {
        displaying = $(this).css("display");
        if(displaying == "inline") {
         
           $(this).css("display","none");
       
        } else {
          $(this).fadeIn('fast',function() {
            $(this).css("display","inline");
          });
        }
      });
    });
  });



     $(document).ready(function(){

        $('#principal tbody tr').on('dblclick', function() {
            
            $('#myModalvolante').modal('show');
        });
        $('#principal tbody tr').on('doubletap', function() {
            
            $('#myModalvolante').modal('show');
        });


         $('#usuarios tbody tr').on('dblclick', function() {
            $('#myModalusuario').modal('show');
        });
        $('#usuarios tbody tr').on('doubletap', function() {
            $('#myModalusuario').modal('show');
        });

        $('#vendedores tbody tr').on('dblclick', function() {
            $('#myModalvendedor').modal('show');
        });
        $('#vendedores tbody tr').on('doubletap', function() {
            $('#myModalvendedor').modal('show');
        });


         $('#empresas tbody tr').on('dblclick', function() {
            $('#myModalempresa').modal('show');
        });
        $('#empresas tbody tr').on('doubletap', function() {
            $('#myModalempresa').modal('show');
        });
  });

        
$(document).ready(function(){
    $('[data-toggle="tooltip"][id="fechai"]').tooltip({
        placement : 'top',
        trigger: 'focus'
    });
    $('[data-toggle="tooltip"][id="masopt"]').tooltip({
        placement : 'top',
        trigger: 'hover'
    });
});

 $(document).ready(function() {
 $('.u-action-sav').on('submit', function(en) {
         //console.log("Done!") 
        $('.alert-success').show('fast');
             en.preventDefault();
     });
});

  $(document).ready(function() {
 $('.u-action-error').on('submit', function(en) {
         //console.log("Done!") 
        $('.alert-danger').show('fast');
             en.preventDefault();
     });
});







 $(document).ready(function() {
     $('.u-form-filter').on('submit', function(ev) {
         ev.preventDefault();
         $('.u-table-search').hide();
         $('.u-filter-loader').show();
         setTimeout(function() {
             $('.u-table-search').show('fast');
             $('.u-filter-loader').hide();
         }, 1000);
     });
     $('.u-table-search ,.u-tooltip-box').tooltip({
         selector: "[data-toggle=tooltip]",
         container: "body"
     });
     $('.u-action-check').on('submit', function(ev) {
         //console.log("Done!") 
         var isChecked = false;
         $('.w-action').each(function(i, e) {
             /* iterate through array or object */
             if ($(e).prop('checked')) {
                 isChecked = true;
             }
         });
         if (!isChecked) {
             $('.u-alert').show('fast');
             ev.preventDefault();
         } else {

         }
     });

     $('.check-crediticia').on('click', function() {
         var total = 0;
         $('.c-evaluacion').toggle();
         $('.x-row-crediticia').toggle();
         if ($('.check-crediticia').prop('checked')) {
             $('.x-grid-score tbody tr.x-sum').not('.x-row-crediticia').each(function(i, e) {
                 total += parseInt($(e).find('td:eq(2) strong').text());
             });
         } else {
             $('.x-grid-score tbody tr.x-sum').each(function(i, e) {
                 total += parseInt($(e).find('td:eq(2) strong').text());
             });
         }
         $('.x-total-score').text(total);
     });
     $('.check-domiciliaria').on('click', function() {
         var total = 0;
         $('.c-domiciliaria').toggle();
         $('.x-row-domiciliaria').toggle();
         if ($('.check-domiciliaria').prop('checked')) {
             $('.x-grid-score tbody tr.x-sum').not('.x-row-domiciliaria').each(function(i, e) {
                 total += parseInt($(e).find('td:eq(2) strong').text());
             });
         } else {
             $('.x-grid-score tbody tr.x-sum').each(function(i, e) {
                 total += parseInt($(e).find('td:eq(2) strong').text());
             });
         }
         $('.x-total-score').text(total);
     });

     $('.check-simular-cheque').on('click', function() {
         $('.tipo-credito').text('Cheque');
         $('.c-bancario').show();
         $('.c-referente').show();
     });
     $('.check-simular-pagare').on('click', function() {
         $('.tipo-credito').text('Pagare');
         $('.c-bancario').hide();
         $('.c-referente').show();
     });

     $('.check-edicion-crediticia').on('click', function() {
         $('.c-evaluacion .form-control').prop('disabled', function(i, val) {
             return !val;
         });
     });

     $('.c-documentos select.form-control').on('change', function(event) {
         var isComplete = true;
         $('.c-documentos select.form-control').each(function(i, e) {

             if ($(this).val() == 'Incompleto') {
                 isComplete = false;
             }
         })

         if (!isComplete) {
             $('.s-status-panel').removeClass('label-warning')
                 .addClass('label-danger').text('Rechazado');
         } else {

             $('.s-status-panel').removeClass('label-danger')
                 .addClass('label-warning').text('Recepcionado');
         }
     });

     $('.check-simular-aprobacion').on('click', function() {
         if ($('.check-simular-aprobacion').prop('checked')) {
             $('.x-validacion-inhabilitada').text('NO')
                 .removeClass('label-success').addClass('label-danger');
             $('.x-show-tooltip').show();
             $('.s-status-panel').removeClass('label-warning')
                 .addClass('label-danger').text('Negado');
         } else {
             $('.x-show-tooltip').hide();
             $('.x-validacion-inhabilitada').text('SI')
                 .removeClass('label-danger').addClass('label-success');
             $('.s-status-panel').removeClass('label-danger')
                 .addClass('label-warning').text('Pre-aprobado');
         }
     });

     $('.check-simular-politica').on('click', function() {
         $('.c-politica').toggle();
     });

     $('.x-change-crediticia').change(function(event) {
         if ($('.x-change-crediticia').val() == 'Aprobado') {
             $('.s-status-panel').text('Recepcionado')
                 .removeClass('label-danger').addClass('label-warning');
         } else {
             $('.s-status-panel').text('Rechazado')
                 .removeClass('label-warning').addClass('label-danger');
         }
     });

     $('.u-toggle').on('click', function(event) {
         event.preventDefault();
         $(this).parent().parent().next().toggle('fast');
     });

     $('#x-upload-file').on('change', function(event) {
         console.log("Cargando");
         $('.u-file-loader').show();
         setTimeout(function() {
             $('.u-file-loader').hide();
             if (Math.random() > 0.5) {
                 $('.x-score-file').show();
                 $('.x-total-score').text(16);
                 $('.x-verificacion-domiciliaria').text('SI')
                     .addClass('label-success').removeClass('label-danger');
                 $('.s-status-panel').text('Pre-aprobado')
                     .removeClass('label-danger').addClass('label-warning');
             } else {
                 $('.x-score-file').hide();
                 $('.x-total-score').text(11);
                 $('.x-verificacion-domiciliaria').text('NO')
                     .addClass('label-danger').removeClass('label-success');
                 $('.s-status-panel').text('Negado')
                     .removeClass('label-warning').addClass('label-danger');
             }
         }, 1000);
     });


     $('.check-editar-nivel').on('click', function() {
         $('.x-control-nivel').prop('disabled', function(i, val) {
             return !val;
         });
     });


     $('.x-control-nivel').on('change', function() {
         $('.x-field-credito').val($(this).val());
     });

     var nombres = ['abel', 'beto', 'carlos', 'diego', 'esteban', 'frank', 'gonzalo', 'hector', 'ivan', 'jesus', 'kalin', 'luis', 'mario', 'nestor', 'omar', 'pedro', 'quique', 'raul', 'sebastian', 'tito', 'ulices', 'viviana', 'xion', 'yabiku', 'zorro']
     $("#exampleInputPassword2").typeahead({
         source: nombres,
         items: 4
     });
 });
 function AbrirPopup(url, nombreVentana, largo, altura, colocarFocus, scrollbars) {
	    if (isNaN(largo)) { largo = 800; }
	    if (largo == 0) { largo = 800; }
	    if (isNaN(altura)) { altura = 600; }
	    if (altura == 0) { altura = 600; }
	    if (colocarFocus == undefined) { colocarFocus = true; }
	    if (isNaN(scrollbars)) { scrollbars = 0; }
	    var top = (screen.height - altura - 58) / 2;
	    var izquierda = (screen.width - largo - 18) / 2;
	    var caracteristicas = 'width=' + largo + ',height=' + altura + ',top=' + top + ',left=' + izquierda + ',scrollbars=' + scrollbars + ',toolbar=no,resizable=0,menubar=0';
	    nuevaVentana = window.open(url, nombreVentana, caracteristicas);
	    if (colocarFocus) {
	        if (window.focus) { nuevaVentana.focus(); }
	        if (!nuevaVentana.closed) { nuevaVentana.focus(); }
	    }
	    return false;
	}