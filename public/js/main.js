try {

    CKFinder.config({ connectorPath: '/ckfinder/connector' });
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

   /* CKEDITOR.on( 'instanceCreated', function( e ){
        e.editor.addCss("@font-face{'Alfa Slab One', cursive; src:url('http://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap');"  );
          });*/

          CKEDITOR.editorConfig = function( config ) {

            config.contentsCss = 'https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap';

            config.font_names = config.font_names + 'Alfa Slab One/Alfa Slab One;';
            config.font_names = config.font_names + 'Open Sans/Open Sans;';


            }

    CKEDITOR.config.contentsCss = '/css/main.css?v=23033';
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
