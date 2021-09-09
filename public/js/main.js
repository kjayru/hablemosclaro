try {

    CKFinder.config({
        connectorPath: '/ckfinder/connector',

     });
   //("") CKFinder.start();
    CKFinder.widget( 'file-editor',{
           width: '100%',
           height: 700
       });



} catch (error) {
    console.log("no inicializado");
}



/**EDITOR  */
try {
    var newCKEdit = CKEDITOR.replace('contenido', {
        height: '600px',




    });
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.plugins.addExternal('youtube', '/js/ckfinder/plugins/youtube/');
    CKEDITOR.config.extraPlugins = 'youtube';

    // Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
    CKEDITOR.config.toolbar = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
	'/',
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
	{ name: 'others', items: [ '-' ] },
	{ name: 'about', items: [ 'About' ] }
];



   // CKEDITOR.plugins.addExternal('slider', '/js/ckfinder/plugins/slider/');
   // CKEDITOR.config.extraPlugins = 'slider';

   /* CKEDITOR.on( 'instanceCreated', function( e ){
        e.editor.addCss("@font-face{'Alfa Slab One', cursive; src:url('http://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap');"  );
          });*/

          CKEDITOR.editorConfig = function( config ) {

            //config.contentsCss = 'https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap';

            //config.font_names = config.font_names + 'Alfa Slab One/Alfa Slab One;';
            //config.font_names = config.font_names + 'Open Sans/Open Sans;';


            }

    CKEDITOR.config.contentsCss = '/assets/public/css/site.css?v=2';
    CKEDITOR.config.templates_files = [ '/ckeditor/plugins/templates/templates/default.js' ];

    CKFinder.config({ connectorPath: '/ckfinder/connector' });


    CKFinder.setupCKEditor(newCKEdit, '/');

} catch (e) {
    console.log("no iniciado");
}


$(".btn-abrirpopup").on('click',function (e) {
    e.preventDefault();
    $("#imageBanner").html("");
    CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {

                var file = evt.data.files.first();


                var folder = file.get('folder');
                var folderName1 = folder.get('name');
                var parentFolder1 = folder.get('parent');
                if (parentFolder1 != null) {
                    var folderName2 = parentFolder1.get('name');
                    var parentFolder2 = parentFolder1.get('parent');
                }
                if (parentFolder2 != null) {
                    var folderName3 = parentFolder2.get('name');
                    var parentFolder3 = parentFolder2.get('parent');
                }

                var pathfile = null;

                if (parentFolder3 == null) {
                    pathfile = folderName3 + '/' + folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder2 == null) {
                    pathfile = folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder1 == null) {
                    pathfile = folderName1 + '/' + file.get('name');
                }
                if (folder == null) {
                    pathfile = file.get('name');
                }

                document.getElementById('imageBanner').value = pathfile;

                $("#urlbanner").attr("src", hostedUrl + "/" + pathfile);

            });

        }
    });
});



$(".btn-abrirpopup2").on('click',function (e) {
    e.preventDefault();
    $("#imageTablet").html("");
    CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {

                var file = evt.data.files.first();


                var folder = file.get('folder');
                var folderName1 = folder.get('name');
                var parentFolder1 = folder.get('parent');
                if (parentFolder1 != null) {
                    var folderName2 = parentFolder1.get('name');
                    var parentFolder2 = parentFolder1.get('parent');
                }
                if (parentFolder2 != null) {
                    var folderName3 = parentFolder2.get('name');
                    var parentFolder3 = parentFolder2.get('parent');
                }

                var pathfile = null;

                if (parentFolder3 == null) {
                    pathfile = folderName3 + '/' + folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder2 == null) {
                    pathfile = folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder1 == null) {
                    pathfile = folderName1 + '/' + file.get('name');
                }
                if (folder == null) {
                    pathfile = file.get('name');
                }

                document.getElementById('imageTablet').value = pathfile;

                $("#urltablet").attr("src", hostedUrl + "/" + pathfile);

            });

        }
    });
});


$(".btn-abrirpopup3").on('click',function (e) {
    e.preventDefault();
    $("#imageMovil").html("");
    CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {

                var file = evt.data.files.first();


                var folder = file.get('folder');
                var folderName1 = folder.get('name');
                var parentFolder1 = folder.get('parent');
                if (parentFolder1 != null) {
                    var folderName2 = parentFolder1.get('name');
                    var parentFolder2 = parentFolder1.get('parent');
                }
                if (parentFolder2 != null) {
                    var folderName3 = parentFolder2.get('name');
                    var parentFolder3 = parentFolder2.get('parent');
                }

                var pathfile = null;

                if (parentFolder3 == null) {
                    pathfile = folderName3 + '/' + folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder2 == null) {
                    pathfile = folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder1 == null) {
                    pathfile = folderName1 + '/' + file.get('name');
                }
                if (folder == null) {
                    pathfile = file.get('name');
                }

                document.getElementById('imageMovil').value = pathfile;

                $("#urlmovil").attr("src", hostedUrl + "/" + pathfile);

            });

        }
    });
});

$(".btn-abrirpopup4").on('click',function (e) {
    e.preventDefault();
    $("#imageCard").html("");
    CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {

                var file = evt.data.files.first();


                var folder = file.get('folder');
                var folderName1 = folder.get('name');
                var parentFolder1 = folder.get('parent');
                if (parentFolder1 != null) {
                    var folderName2 = parentFolder1.get('name');
                    var parentFolder2 = parentFolder1.get('parent');
                }
                if (parentFolder2 != null) {
                    var folderName3 = parentFolder2.get('name');
                    var parentFolder3 = parentFolder2.get('parent');
                }

                var pathfile = null;

                if (parentFolder3 == null) {
                    pathfile = folderName3 + '/' + folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder2 == null) {
                    pathfile = folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder1 == null) {
                    pathfile = folderName1 + '/' + file.get('name');
                }
                if (folder == null) {
                    pathfile = file.get('name');
                }

                document.getElementById('imageCard').value = pathfile;

                $("#urlcard").attr("src", hostedUrl + "/" + pathfile);

            });

        }
    });
});




$(".btn-abrirpopup5").on('click',function (e) {
    e.preventDefault();
    $("#imageMeta").html("");
    CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {

                var file = evt.data.files.first();


                var folder = file.get('folder');
                var folderName1 = folder.get('name');
                var parentFolder1 = folder.get('parent');
                if (parentFolder1 != null) {
                    var folderName2 = parentFolder1.get('name');
                    var parentFolder2 = parentFolder1.get('parent');
                }
                if (parentFolder2 != null) {
                    var folderName3 = parentFolder2.get('name');
                    var parentFolder3 = parentFolder2.get('parent');
                }

                var pathfile = null;

                if (parentFolder3 == null) {
                    pathfile = folderName3 + '/' + folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder2 == null) {
                    pathfile = folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder1 == null) {
                    pathfile = folderName1 + '/' + file.get('name');
                }
                if (folder == null) {
                    pathfile = file.get('name');
                }

               // document.getElementById('gallery').value = pathfile;


                document.getElementById('imageMeta').value = pathfile;

                $("#urlmeta").attr("src", hostedUrl + "/" + pathfile);


            });

        }
    });
});


$("#tipo").on('change',function(){
    let valor = $(this).val();

    if(valor==2){
        $(".row__video").fadeIn(350,'swing');
        $(".row__author").hide();
    }
    if(valor==3){
        $(".row__author").fadeIn(350,'swing');
        $(".row__video").hide();
    }
});

try {
    $('.select2').select2();
} catch (error) {
    console.log("no inicializado");
}




$(".btn-abrirautor").on('click',function (e) {
    e.preventDefault();
    $("#imageAutor").html("");
    CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {

                var file = evt.data.files.first();


                var folder = file.get('folder');
                var folderName1 = folder.get('name');
                var parentFolder1 = folder.get('parent');
                if (parentFolder1 != null) {
                    var folderName2 = parentFolder1.get('name');
                    var parentFolder2 = parentFolder1.get('parent');
                }
                if (parentFolder2 != null) {
                    var folderName3 = parentFolder2.get('name');
                    var parentFolder3 = parentFolder2.get('parent');
                }

                var pathfile = null;

                if (parentFolder3 == null) {
                    pathfile = folderName3 + '/' + folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder2 == null) {
                    pathfile = folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder1 == null) {
                    pathfile = folderName1 + '/' + file.get('name');
                }
                if (folder == null) {
                    pathfile = file.get('name');
                }

                document.getElementById('imageAutor').value = pathfile;

                $("#urlautor").attr("src", hostedUrl + "/" + pathfile);

            });

        }
    });
});


$(".btn-abrirpop1").on('click',function (e) {
    e.preventDefault();
    $("#imagenfacebook").html("");
    CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {

                var file = evt.data.files.first();


                var folder = file.get('folder');
                var folderName1 = folder.get('name');
                var parentFolder1 = folder.get('parent');
                if (parentFolder1 != null) {
                    var folderName2 = parentFolder1.get('name');
                    var parentFolder2 = parentFolder1.get('parent');
                }
                if (parentFolder2 != null) {
                    var folderName3 = parentFolder2.get('name');
                    var parentFolder3 = parentFolder2.get('parent');
                }

                var pathfile = null;

                if (parentFolder3 == null) {
                    pathfile = folderName3 + '/' + folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder2 == null) {
                    pathfile = folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder1 == null) {
                    pathfile = folderName1 + '/' + file.get('name');
                }
                if (folder == null) {
                    pathfile = file.get('name');
                }

                document.getElementById('imagenfacebook').value = pathfile;

                $("#urlfacebook").attr("src", hostedUrl + "/" + pathfile);

            });

        }
    });
});


$(".btn-abrirpop2").on('click',function (e) {
    e.preventDefault();
    $("#imagentwitter").html("");
    CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {

                var file = evt.data.files.first();


                var folder = file.get('folder');
                var folderName1 = folder.get('name');
                var parentFolder1 = folder.get('parent');
                if (parentFolder1 != null) {
                    var folderName2 = parentFolder1.get('name');
                    var parentFolder2 = parentFolder1.get('parent');
                }
                if (parentFolder2 != null) {
                    var folderName3 = parentFolder2.get('name');
                    var parentFolder3 = parentFolder2.get('parent');
                }

                var pathfile = null;

                if (parentFolder3 == null) {
                    pathfile = folderName3 + '/' + folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder2 == null) {
                    pathfile = folderName2 + '/' + folderName1 + '/' + file.get('name');
                }
                if (parentFolder1 == null) {
                    pathfile = folderName1 + '/' + file.get('name');
                }
                if (folder == null) {
                    pathfile = file.get('name');
                }

                document.getElementById('imagentwitter').value = pathfile;

                $("#urltwitter").attr("src", hostedUrl + "/" + pathfile);

            });

        }
    });
});

$(".btn___opciones").on("click", function () {
    id = $(this).data("id");
    $("#questionoption").val(id);
    console.log(id);
    htm = '';
    $.ajax({
        url: "/admin/options/" + id,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response!='') {

                $.each(response, function (i, e) {
                  htm += `<tr>
            <td>${i + 1}</td>
            <td>${e.opcion}</td>
            <td width="10%">
             <a href="#" data-id="${
                 e.id
             }" class="btn-xs btn btn-outline-info btn__editar_opcion" data-id="${
                      e.id
                  }" data-question="${
                      e.question_id
                  }"  data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></a>
             <a href="#"   data-id="${
                 e.id
             }" data-question="${e.question_id}"  class="btn btn-xs btn-dangers btn__option_destroy"><i class="far fa-trash-alt"></i></a>

            </td>
            </tr>`;
                });

                $(".tbopciones").html(htm);

            } else {
                $(".tbopciones").html(`<tr><td colspan="3" class="text-center firsttd">No tiene opciones cargadas</td></tr>`);
            }
        }
    })
});


$(".btn__saveoption").on('click', function (e) {
    let token = $("meta[name=csrf-token]").attr("content");
    let question_id = $("#questionoption").val();
    let option = $("#inputoption").val();

    let datasend = ({ '_token': token, '_method': 'POST', 'question_id': question_id, 'option': option });

    $.ajax({
        url: "/admin/options",
        type: "POST",
        dataType: 'json',
        data: datasend,
        success: function (response) {

            $(".firsttd").remove();
            $(".tbopciones").append(`<tr>
            <td></td>
            <td>${response.opcion}</td>
            <td width="10%">
             <a href="#" data-id="${response.id}" data-question="${question_id}" class="btn-xs btn btn-outline-info btn__editar_opcion"><i class="far fa-edit"></i></a>
             <a href="#"   data-id="${response.id}"  data-question="${question_id}" class="btn btn-xs btn-dangers btn__option_destroy"><i class="far fa-trash-alt"></i></a>

            </td>
            </tr>`);

            $("#inputoption").val('');

        }
    });
});

$(document).on("click", ".btn__editar_opcion", function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    let question_id = $(this).data("question");

    $("#questionoptionedit").val(question_id);

    $("#option_edit_id").val(id);

    $.ajax({
        url: `/admin/options/${id}/edit`,
        type: "GET",
        dataType: "json",
        success: function (response) {
            $("#inputoptionedit").val(response.opcion);
        }
    })
    console.log("identificador :"+id);
 });


$(".btn__actualizar_option").on('click', function (e) {
    let id =  $("#option_edit_id").val();

     let token = $("meta[name=csrf-token]").attr("content");
     let question_id = $("#questionoptionedit").val();
     let option = $("#inputoptionedit").val();

     let datasend = {
         _token: token,
         _method: "PUT",
         question_id: question_id,
         option: option,

     };


     $.ajax({
         url: "/admin/options/"+id,
         type: "POST",
         dataType: "json",
         data: datasend,
         beforeSend: function () {
             htm = "";
             $(".tbopciones").empty();
         },
         success: function (response) {
              updateOpcion(response, question_id);
             $("#editModal").modal('hide');
             $(".tbopciones").html(htm);
         },
     });

});

$(document).on("click", ".btn__option_destroy", function () {
    let id = $(this).data("id");
    let question_id = $(this).data("question");

    let token = $("meta[name=csrf-token]").attr("content");

    let datasend = {
        _token: token,
        _method: "DELETE",
        id: id,
        question_id :question_id
    };

    $.ajax({
        url: "/admin/options/" + id,
        type: "POST",
        dataType: "json",
        data: datasend,

        success: function (response) {
            $(".mensaje__text").html("Opción eliminada");
            updateOpcion(response, question_id);
            $(".tbopciones").html(htm);
        },
    });


});


$(document).on("focus", "#inputoption", function () {
    $(".mensaje__text").html("");
});


function updateOpcion(response, question_id) {
     htm = "";
    $(".tbopciones").empty();

    $.each(response, function (i, e) {
        htm += `<tr>
                    <td>${i + 1}</td>
                    <td>${e.opcion}</td>
                    <td width="10%">
                    <a href="#" data-id="${
                        e.id
                    }" class="btn-xs btn btn-outline-info btn__editar_opcion" data-question="${question_id}"  data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></a>
                    <a href="#"   data-id="${
                        e.id
                    }" data-question="${question_id}" class="btn btn-xs btn-dangers btn__option_destroy"><i class="far fa-trash-alt"></i></a>

                    </td>
                </tr>`;
    });
}


$(".btn___resultados").on("click", function () {



    id = $(this).data("id");
    $("#questionoption").val(id);
    let quiz_id = $("#quizid").val();
    let token = $("meta[name=csrf-token]").attr("content");

     let datasend = {
         _token: token,
         _method: "POST",
         quiz_id: quiz_id,
         question_id: id,
     };


    htm = "";
    $.ajax({
        url: "/admin/options/" + id,
        type: "GET",
        dataType: "json",
        success: function (response) {

            if (response != "") {
                $.each(response, function (i, e) {
                    htm += `<a href="#" id="preg-${e.id}" data-id="${e.id}" data-question="${e.question_id}" class="list-group-item list-group-item-action opcion__seleccion">${e.opcion}</a>`;
                });

                $(".list__opcion").html(htm);

                 $.ajax({
                     url: "/admin/options/getresult",
                     type: "POST",
                     dataType: "json",
                     data: datasend,
                     success: function (response) {
                         console.log(response.option_id);
                         let pregunta = "#preg-"+ response.option_id;
                         $(pregunta).addClass("active")
                     },
                 });


            } else {
                $(".list__opcion").html(
                    `<a href="#" class="text-center firsttd">No tiene opciones cargadas</a>`
                );
            }
        },
    });






});



$(".btn__registrar_opcion").on('click', function (e) {
    e.preventDefault();
    let quizid = $("#quizid").val();
    let question = $("#resquestion").val();
    let option = $("#resoption").val();
    let token = $("meta[name=csrf-token]").attr("content");

    let datasend = {
        _token: token,
        _method: "POST",
        quiz_id: quizid,
        question_id: question,
        option_id:option

    };

    $.ajax({
        url: "/admin/options/setresult",
        type: "POST",
        dataType: "json",
        data: datasend,
        beforeSend: function () {

        },
        success: function (response) {
            alert("Registrado");
        },
    });
});

$(document).on("click", ".opcion__seleccion", function (e) {
    e.preventDefault();

    $(".opcion__seleccion").removeClass("active");
    let resquestion = $(this).data("question");
    let resoption = $(this).data("id");

    $("#resquestion").val(resquestion);
    $("#resoption").val(resoption);

    $(this).addClass("active");

});
