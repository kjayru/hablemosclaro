try {

    CKFinder.config({ connectorPath: '/ckfinder/connector' });
    CKFinder.start();
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


$(".btn-abrirpopup").click(function (e) {
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


$(".btn-seoimagen").click(function (e) {
    e.preventDefault();
    $("#seoimagen").html("");
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


                document.getElementById('seoimageninput').value = pathfile;

                $("#urlseoimagen").attr("src", hostedUrl + "/" + pathfile);


            });

        }
    });
});
