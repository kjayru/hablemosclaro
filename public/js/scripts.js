
$(".btn__suscripcion").on('click',function(){

    let token = $("meta[name=csrf-token]").attr("content");
    let email = $("#email").val();

    let interes = [];
    $(':checkbox:checked').each(function(i){
      interes[i] = $(this).val();
    });



    let datasend = ({'_token':token,'_method':'POST','email':email,'interes':interes});
    $.ajax({
        type: "POST",
        url: `/suscribirse`,
        data:datasend,
        dataType: "json",

        success: function (result) {
            console.log(result);
            if(result.rpta ==="ok"){
                $(".detalle_de_articulos__subscribe").html(
                    `<div class="suscripcion__gracias"> Gracias por suscribirte a Hablando Claro </div>`
                );
            }
        }
    });

});

