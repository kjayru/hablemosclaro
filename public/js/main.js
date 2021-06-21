$("#source").on("change", function () {
    let id = $(this).val();
    let htm = "";
    $.ajax({
        url: "/admin/getmedium/" + id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            htm += `<option value="">Seleccione</option>`;
            $.each(data, function (i, e) {
                let nombre = e.nombre.replace(/ /g, "_");

                htm += `<option value="${e.id}">${nombre
                    .trim()
                    .toLowerCase()}</option>`;
            });

            $("#medium").html(htm);
        },
    });
});

$("#medium").on("change", function () {
    let id = $(this).val();
    let htm = "";
    $.ajax({
        url: "/admin/getcontent/" + id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            htm += `<option value="">Seleccione</option>`;
            $.each(data, function (i, e) {
                let formato = e.formato.trim().replace(/ /g, "_");
                htm += `<option value="${
                    e.id
                }">${formato.toLowerCase()}</option>`;
            });

            $("#content").html(htm);
        },
    });
});

$("#content").on("change", function () {
    let id = $(this).val();
    let htm = "";
});

/**vars */

var website = $("#website");
var campaign = $("#campaign");
var source = $("#source");
var medium = $("#medium");
var content = $("#content");
var term = $("#term");
var termtipo = $("#termtipo");
var generateid;
var utmgenerado = [10];
utmgenerado.splice(0, 1, "");
utmgenerado.splice(1, 1, "");
utmgenerado.splice(2, 1, "");
utmgenerado.splice(3, 1, "");
utmgenerado.splice(4, 1, "");
utmgenerado.splice(5, 1, "");
utmgenerado.splice(6, 1, "");
utmgenerado.splice(7, 1, "");
utmgenerado.splice(8, 1, "");
utmgenerado.splice(9, 1, "");

var string1 = null;
var string2 = null;
var string3 = null;
var string4 = null;
var string5 = null;
var string6 = null;
var string7 = null;
var string8 = null;
var string9 = null;
var stringtipo = null;

website.on("blur", function () {
    let valor = $(this).val();
    string1 = valor.trim();

    if (string1.toLowerCase().indexOf("http") < 0) {
        //alert("la URL debe contener http");
        $(this).addClass("is-invalid");
        $(this)
            .parent()
            .append(
                "<div class='invalid-feedback error'>La URL debe contener http</div>"
            );
    }
    if (string1.toLowerCase().indexOf(".") < 0) {
        $(this).addClass("is-invalid");
        $(this)
            .parent()
            .append(
                "<div class='invalid-feedback error'>La URL debe contener una extension .com .pe u otro</div>"
            );
    }

    createUtm(string1, 1);

    $("#website").val(string1.toLowerCase());

});

website.on("focus", function () {

    /*let longitud = $(this).val().length;
    if(longitud<11){

    }*/

    $(this).removeClass("is-invalid");
    $(this).parent().children(".invalid-feedback").remove();
});

campaign.on("change", function () {
    let valor = $("#campaign option:selected").text();
    string2 = valor.trim().toLowerCase();
    $(this).removeClass("is-invalid");
    $(this).parent().children(".invalid-feedback").remove();

    createUtm(string2, 2);

    //verificar existencia de terms

    $.ajax({
        url: `/admin/getcampaign/${string2}`,
        method: "GET",
        type: "json",
        success: function (response) {
            console.log(response);

           /* if (response.campaign.term_id) {
                $("#term").val(response.term.producto);
                createUtm(response.term.producto, 7);
            }*/

            if (response.campaign.termtipo_id) {
                $("#termtipo").val(response.termtipo.tipo);
                createUtm(response.termtipo.tipo, 9);
            }
        },
    });
});

source.on("change", function () {
    let valor = $("#source option:selected").text();
    str = valor.trim().toLowerCase();
    string3 = str.replace(/ /g, "_");
    $(this).removeClass("is-invalid");
    $(this).parent().children(".invalid-feedback").remove();

    createUtm(string3, 3);
});

medium.on("change", function () {
    let valor = $("#medium option:selected").text();

    $(this).removeClass("is-invalid");
    $(this).parent().children(".invalid-feedback").remove();
    str = valor.trim().toLowerCase();
    string4 = str.replace(/ /g, "_");

    createUtm(string4, 4);
});

content.on("change", function () {
    let valor = $("#content option:selected").text();
    $(this).removeClass("is-invalid");
    $(this).parent().children(".invalid-feedback").remove();
    str = valor.trim().toLowerCase();
    string5 = str.replace(/ /g, "_");

    createUtm(string5, 5);
});

$("#referencia").on("keyup", function () {
    let valor = $(this).val();
    // str = valor.trim();
    str2 = valor.replace(/ /g, "_");
    string6 = str2.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

    $(this).val(string6.toLowerCase());

    createUtm(string6, 6);
});

$("#term").on("change", function () {
    let valor = $("#term option:selected").text();
    let id = $(this).val();

    string7 = valor.trim();
    createUtm(string7, 7);

    generateid();


    //consultar dependencias ambersas
    let phtm = "";
    let selector = null;
    $.ajax({
        url:'/admin/getproductocamp/'+id,
        type:"GET",
        datatype:'json',
       success:function(response){

        //console.log(response);
        phtm = "<option value=''> Seleccione </option>";
        $.each(response,function(i,e){

            /*fechahoy = new Date();
            fechacampana =  new Date(e.finalcampana);

            diferenciaHoras = fechahoy - fechacampana;*/

            //console.log(diferenciaHoras);


                phtm+=`<option value='${e.id}'> ${e.nombre} </option>`;


        });

        $("#campaign").html(phtm);
       }
    })


});

$("#tipo").on("blur", function () {
    let valor = $(this).val();
    str2 = valor.trim();
    str = str2.replace(/ /g, "_");
    string8 = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

    $(this).val(string8);
    createUtm(string8, 10);
});

//term tipo
var utmgeneradoall =null;


termtipo.on("change", function () {
    let valor = $("#termtipo option:selected").text();

    str = valor.trim();
    stringtipo = str.replace(/ /g, "_");
    createUtm(stringtipo, 9);


});


function createUtm(cadena, pos) {
    if (pos === 1) {
        string1 = cadena.trim().toLowerCase();

        if (utmgenerado[0] != string1 || !utmgenerado[0]) {
            utmgenerado.splice(0, 1, string1);
        }

        //$("#utmgenerado").html(utmgenerado[0]);
        utmgeneradoall = utmgenerado[0];
    }

    if (pos === 2) {
        string2 = cadena.trim().toLowerCase();

        if (utmgenerado[1] != string2 || !utmgenerado[1]) {
            utmgenerado.splice(1, 1, string2);
        }

        /*$("#utmgenerado").html(
            utmgenerado[0] + "/?utm_campaign=" + utmgenerado[1]
        );*/

        utmgeneradoall =  utmgenerado[0] + "/?utm_campaign=" + utmgenerado[1];
    }

    if (pos === 3) {
        string3 = cadena.trim().toLowerCase();

        if (utmgenerado[2] != string3 || !utmgenerado[2]) {
            utmgenerado.splice(2, 1, string3);
        }

       /* $("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2]
        );*/

        utmgeneradoall =  utmgenerado[0] +
        "/?utm_campaign=" +
        utmgenerado[1] +
        "&utm_source=" +
        utmgenerado[2];
    }

    if (pos === 4) {
        string4 = cadena.trim().toLowerCase();

        if (utmgenerado[3] != string4 || !utmgenerado[3]) {
            utmgenerado.splice(3, 1, string4);
        }

       /* $("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3]
        );*/

        utmgeneradoall = utmgenerado[0] +
        "/?utm_campaign=" +
        utmgenerado[1] +
        "&utm_source=" +
        utmgenerado[2] +
        "&utm_medium=" +
        utmgenerado[3];
    }

    if (pos === 5) {
        string5 = cadena.trim().toLowerCase();
        if (utmgenerado[4] != string5 || !utmgenerado[4]) {
            utmgenerado.splice(4, 1, string5);
        }
       /* $("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4]
        );*/
        utmgeneradoall =utmgenerado[0] +
        "/?utm_campaign=" +
        utmgenerado[1] +
        "&utm_source=" +
        utmgenerado[2] +
        "&utm_medium=" +
        utmgenerado[3] +
        "&utm_content=" +
        utmgenerado[4];

        if (!utmgenerado[5]) {
            utmgenerado.splice(5, 1, "");
        }
    }
    if (pos === 6) {
        string6 = cadena.trim().toLowerCase();
        if (utmgenerado[5] != string6 || !utmgenerado[5]) {
            utmgenerado.splice(5, 1, string6);
        }

        /*$("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "-" +
                utmgenerado[5]
        ); */

        utmgeneradoall = utmgenerado[0] +
        "/?utm_campaign=" +
        utmgenerado[1] +
        "&utm_source=" +
        utmgenerado[2] +
        "&utm_medium=" +
        utmgenerado[3] +
        "&utm_content=" +
        utmgenerado[4] +
        "-" +
        utmgenerado[5];
    }

    if (pos === 7) {
        string7 = cadena.trim().toLowerCase();

        if (utmgenerado[6] != string7 || !utmgenerado[6]) {
            utmgenerado.splice(6, 1, string7);
        }

        if (!utmgenerado[8]) {
            utmgenerado.splice(8, 1, "");
        }
        if (!utmgenerado[9]) {
            utmgenerado.splice(9, 1, "");
        }
    }

    if (pos === 9) {
        console.log("term tipo");
        string9 = cadena.trim().toLowerCase();

        if (utmgenerado[8] != string9 || !utmgenerado[8]) {
            utmgenerado.splice(8, 1, string9);
        }

       /* $("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[6] +
                "-" +
                utmgenerado[8]
        );*/

        utmgeneradoall = utmgenerado[0] +
        "/?utm_campaign=" +
        utmgenerado[1] +
        "&utm_source=" +
        utmgenerado[2] +
        "&utm_medium=" +
        utmgenerado[3] +
        "&utm_content=" +
        utmgenerado[4] +
        "&utm_term=" +
        utmgenerado[6] +
        "-" +
        utmgenerado[8];
    }

    if (pos === 10) {
        console.log("solo tipo");
        string10 = cadena.trim().toLowerCase();

        if (utmgenerado[9] != string7 || !utmgenerado[9]) {
            utmgenerado.splice(9, 1, string10);
        }
        /*$("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[6] +
                "-" +
                utmgenerado[8] +
                "-" +
                utmgenerado[9]
        );*/

        utmgeneradoall =  utmgenerado[0] +
        "/?utm_campaign=" +
        utmgenerado[1] +
        "&utm_source=" +
        utmgenerado[2] +
        "&utm_medium=" +
        utmgenerado[3] +
        "&utm_content=" +
        utmgenerado[4] +
        "&utm_term=" +
        utmgenerado[6] +
        "-" +
        utmgenerado[8] +
        "-" +
        utmgenerado[9];
    }
    if (pos === 8) {
        console.log("codigo");
        string8 = cadena.trim().toLowerCase();

        if (utmgenerado[7] != string8 || !utmgenerado[7]) {
            utmgenerado.splice(7, 1, string8);
        }
       /* $("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[6] +
                "-" +
                utmgenerado[8] +
                "-" +
                utmgenerado[9] +
                "&id=" +
                utmgenerado[7]
        );*/

        utmgeneradoall =  utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "-" +
                    utmgenerado[8] +
                    "-" +
                    utmgenerado[9] +
                    "&id=" +
                    utmgenerado[7];
    }

    //general

    if (utmgenerado[4] && utmgenerado[5]) {
        /*$("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "-" +
                utmgenerado[5] +
                "&utm_term=" +
                utmgenerado[6] +
                "&id=" +
                utmgenerado[7]
        );*/

        utmgeneradoall = utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "-" +
                    utmgenerado[5] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "&id=" +
                    utmgenerado[7];


    }
    if (utmgenerado[4] && !utmgenerado[5]) {
        /*$("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[5] +
                "&id=" +
                utmgenerado[7]
        );*/

        utmgeneradoall = utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[5] +
                "&id=" +
                utmgenerado[7];
    }

    if (utmgenerado[6] && utmgenerado[8] && utmgenerado[9]) {
        /*$("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[6] +
                "-" +
                utmgenerado[8] +
                "-" +
                utmgenerado[9] +
                "&id=" +
                utmgenerado[7]

        );*/

        utmgeneradoall = utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[6] +
                "-" +
                utmgenerado[8] +
                "-" +
                utmgenerado[9] +
                "&id=" +
                utmgenerado[7];

        if (utmgenerado[4] && utmgenerado[5]) {
           /* $("#utmgenerado").html(
                utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "-" +
                    utmgenerado[5] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "-" +
                    utmgenerado[8] +
                    "-" +
                    utmgenerado[9] +
                    "&id=" +
                    utmgenerado[7]
            ); */

            utmgeneradoall = utmgenerado[0] +
            "/?utm_campaign=" +
            utmgenerado[1] +
            "&utm_source=" +
            utmgenerado[2] +
            "&utm_medium=" +
            utmgenerado[3] +
            "&utm_content=" +
            utmgenerado[4] +
            "-" +
            utmgenerado[5] +
            "&utm_term=" +
            utmgenerado[6] +
            "-" +
            utmgenerado[8] +
            "-" +
            utmgenerado[9] +
            "&id=" +
            utmgenerado[7];

        }
        if (utmgenerado[4] && !utmgenerado[5]) {
            /*$("#utmgenerado").html(
                utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "-" +
                    utmgenerado[8] +
                    "-" +
                    utmgenerado[9] +
                    "&id=" +
                    utmgenerado[7]
            );*/

            utmgeneradoall = utmgenerado[0] +
            "/?utm_campaign=" +
            utmgenerado[1] +
            "&utm_source=" +
            utmgenerado[2] +
            "&utm_medium=" +
            utmgenerado[3] +
            "&utm_content=" +
            utmgenerado[4] +
            "&utm_term=" +
            utmgenerado[6] +
            "-" +
            utmgenerado[8] +
            "-" +
            utmgenerado[9] +
            "&id=" +
            utmgenerado[7];
        }
    }

    if (utmgenerado[6] && !utmgenerado[8] && utmgenerado[9]) {
       /* $("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[6] +
                "-" +
                utmgenerado[9] +
                "&id=" +
                utmgenerado[7]
        );*/

        utmgeneradoall = utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[6] +
                "-" +
                utmgenerado[9] +
                "&id=" +
                utmgenerado[7];

        if (utmgenerado[4] && utmgenerado[5]) {

            /*$("#utmgenerado").html(
                utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "-" +
                    utmgenerado[5] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "-" +
                    utmgenerado[9] +
                    "&id=" +
                    utmgenerado[7]
            );*/

            utmgeneradoall = utmgenerado[0] +
                        "/?utm_campaign=" +
                        utmgenerado[1] +
                        "&utm_source=" +
                        utmgenerado[2] +
                        "&utm_medium=" +
                        utmgenerado[3] +
                        "&utm_content=" +
                        utmgenerado[4] +
                        "-" +
                        utmgenerado[5] +
                        "&utm_term=" +
                        utmgenerado[6] +
                        "-" +
                        utmgenerado[9] +
                        "&id=" +
                        utmgenerado[7];

        }
        if (utmgenerado[4] && !utmgenerado[5]) {
           /* $("#utmgenerado").html(
                utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "-" +
                    utmgenerado[9] +
                    "&id=" +
                    utmgenerado[7]
            );*/

            utmgeneradoall = utmgenerado[0] +
            "/?utm_campaign=" +
            utmgenerado[1] +
            "&utm_source=" +
            utmgenerado[2] +
            "&utm_medium=" +
            utmgenerado[3] +
            "&utm_content=" +
            utmgenerado[4] +
            "&utm_term=" +
            utmgenerado[6] +
            "-" +
            utmgenerado[9] +
            "&id=" +
            utmgenerado[7];
        }
    }

    if (utmgenerado[6] && !utmgenerado[8] && !utmgenerado[9]) {
        /*$("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[6] +
                "&id=" +
                utmgenerado[7]
        );*/

        utmgeneradoall = utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "&id=" +
                    utmgenerado[7];

        if (utmgenerado[4] && utmgenerado[5]) {
            /*$("#utmgenerado").html(
                utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "-" +
                    utmgenerado[5] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "&id=" +
                    utmgenerado[7]
            );*/

            utmgeneradoall = utmgenerado[0] +
                            "/?utm_campaign=" +
                            utmgenerado[1] +
                            "&utm_source=" +
                            utmgenerado[2] +
                            "&utm_medium=" +
                            utmgenerado[3] +
                            "&utm_content=" +
                            utmgenerado[4] +
                            "-" +
                            utmgenerado[5] +
                            "&utm_term=" +
                            utmgenerado[6] +
                            "&id=" +
                            utmgenerado[7];
        }
        if (utmgenerado[4] && !utmgenerado[5]) {


            /*$("#utmgenerado").html(
                utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "&id=" +
                    utmgenerado[7]
            );*/

            utmgeneradoall = utmgenerado[0] +
                        "/?utm_campaign=" +
                        utmgenerado[1] +
                        "&utm_source=" +
                        utmgenerado[2] +
                        "&utm_medium=" +
                        utmgenerado[3] +
                        "&utm_content=" +
                        utmgenerado[4] +
                        "&utm_term=" +
                        utmgenerado[6] +
                        "&id=" +
                        utmgenerado[7];
        }
    }

    if (utmgenerado[6] && utmgenerado[8] && !utmgenerado[9]) {
       /* $("#utmgenerado").html(
            utmgenerado[0] +
                "/?utm_campaign=" +
                utmgenerado[1] +
                "&utm_source=" +
                utmgenerado[2] +
                "&utm_medium=" +
                utmgenerado[3] +
                "&utm_content=" +
                utmgenerado[4] +
                "&utm_term=" +
                utmgenerado[6] +
                "-" +
                utmgenerado[8] +
                "&id=" +
                utmgenerado[7]


        );*/

        utmgeneradoall = utmgenerado[0] +
                        "/?utm_campaign=" +
                        utmgenerado[1] +
                        "&utm_source=" +
                        utmgenerado[2] +
                        "&utm_medium=" +
                        utmgenerado[3] +
                        "&utm_content=" +
                        utmgenerado[4] +
                        "&utm_term=" +
                        utmgenerado[6] +
                        "-" +
                        utmgenerado[8] +
                        "&id=" +
                        utmgenerado[7];

        if (utmgenerado[4] && utmgenerado[5]) {
           /* $("#utmgenerado").html(
                utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "-" +
                    utmgenerado[5] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "-" +
                    utmgenerado[8] +
                    "&id=" +
                    utmgenerado[7]
            );*/


            utmgeneradoall = utmgenerado[0] +
                            "/?utm_campaign=" +
                            utmgenerado[1] +
                            "&utm_source=" +
                            utmgenerado[2] +
                            "&utm_medium=" +
                            utmgenerado[3] +
                            "&utm_content=" +
                            utmgenerado[4] +
                            "-" +
                            utmgenerado[5] +
                            "&utm_term=" +
                            utmgenerado[6] +
                            "-" +
                            utmgenerado[8] +
                            "&id=" +
                            utmgenerado[7];

        }
        if (utmgenerado[4] && !utmgenerado[5]) {
            /*$("#utmgenerado").html(
                utmgenerado[0] +
                    "/?utm_campaign=" +
                    utmgenerado[1] +
                    "&utm_source=" +
                    utmgenerado[2] +
                    "&utm_medium=" +
                    utmgenerado[3] +
                    "&utm_content=" +
                    utmgenerado[4] +
                    "&utm_term=" +
                    utmgenerado[6] +
                    "-" +
                    utmgenerado[8] +
                    "&id=" +
                    utmgenerado[7]
            );*/

            utmgeneradoall = utmgenerado[0] +
                            "/?utm_campaign=" +
                            utmgenerado[1] +
                            "&utm_source=" +
                            utmgenerado[2] +
                            "&utm_medium=" +
                            utmgenerado[3] +
                            "&utm_content=" +
                            utmgenerado[4] +
                            "&utm_term=" +
                            utmgenerado[6] +
                            "-" +
                            utmgenerado[8] +
                            "&id=" +
                            utmgenerado[7];
        }
    }
}

/*** GENERAR UTM CORTA */

$(".btn-urlcorta").on("click", function (e) {
    e.preventDefault();

    if ($("#website").val() == "") {
        $("#website").addClass("is-invalid");
        $("#website")
            .parent()
            .append(
                "<div class='invalid-feedback error'>*Ingresa una URL. Ej. https://tiendaclaro.pe/equipo/apple/iphone-12-pro-max</div>"
            );

        let stack1 = $("#example_wrapper").position().top;
        $("html, body").animate({ scrollTop: stack1 }, 600, "swing");

        return false;
    }
    if ($("#campaign").val() == "") {
        $("#campaign").addClass("is-invalid");
        $("#campaign")
            .parent()
            .append(
                "<div class='invalid-feedback error'>*Ingresa el nombre de campaña. Ej. always_on_tienda</div>"
            );

        let stack1 = $("#example_wrapper").position().top;
        $("html, body").animate({ scrollTop: stack1 }, 600, "swing");
        return false;
    }

    if ($("#source").val() == "") {
        $("#source").addClass("is-invalid");
        $("#source")
            .parent()
            .append(
                "<div class='invalid-feedback error'>Seleccione la fuente de campaña</div>"
            );

        let stack1 = $("#example_wrapper").position().top;
        $("html, body").animate({ scrollTop: stack1 }, 600, "swing");
        return false;
    }

    if ($("#medium").val() == "") {
        $("#medium").addClass("is-invalid");
        $("#medium")
            .parent()
            .append(
                "<div class='invalid-feedback error'>Seleccione el medio de campaña</div>"
            );

        let stack1 = $("#example_wrapper").position().top;
        $("html, body").animate({ scrollTop: stack1 }, 600, "swing");

        return false;
    }
    if ($("#content").val() == "") {
        $("#content").addClass("is-invalid");
        $("#content")
            .parent()
            .append(
                "<div class='invalid-feedback error'>Seleccione el contenido de campaña</div>"
            );

        let stack1 = $("#example_wrapper").position().top;
        $("html, body").animate({ scrollTop: stack1 }, 600, "swing");

        return false;
    }

    if ($("#term").val() == "") {
        $("#term").addClass("is-invalid");
        $("#term")
            .parent()
            .append(
                "<div class='invalid-feedback error'>Seleccione el producto de campaña</div>"
            );

        let stack1 = $("#example_wrapper").position().top;
        $("html, body").animate({ scrollTop: stack1 }, 600, "swing");
        return false;
    }

    //let utm = $("#utmgenerado").text().trim();
    let utm =  utmgeneradoall;
    //send variables  api-utmclaro

    // verificamos existencia de id

    $.ajax({
        url: "/admin/verificarid/" + utmgenerado[7],
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.rpta == "ok") {
                //envio datos de utm
                $.ajax({
                    type: "POST",
                    url: `${hosting}/api/generarurlcorta`,
                    headers: {
                        Authorization:
                            "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjAzY2NkOWE3YjdlZWU1ZmYwYjU4YmQxMGE1NDM2MTZlZDFkMzY3M2RjZDE5NDVlZDFmMmE4M2NiY2UwMTNlYmVjNzI0MDA0OGIwYzM1MTc0In0.eyJhdWQiOiI0IiwianRpIjoiMDNjY2Q5YTdiN2VlZTVmZjBiNThiZDEwYTU0MzYxNmVkMWQzNjczZGNkMTk0NWVkMWYyYTgzY2JjZTAxM2ViZWM3MjQwMDQ4YjBjMzUxNzQiLCJpYXQiOjE2MTcyODg4MjQsIm5iZiI6MTYxNzI4ODgyNCwiZXhwIjoxNjQ4ODI0ODI0LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.HiU8auZDuzaMi_YcfXXeQCKee6fvnqA3VVHB8qZbac3hihIPBFIxXx-bJiHwQ_WOyvYiYgJv0R4jX3v2Wo7dI_IdmTFicq8SVN30APfDeTFzB2pdDkPZI8OwCGqoIq4YOXyhuN0NczOJR3OUgQNDbvLj3WQF0Gu1rz9VhfULR4EmK-8pKQwqZf3AsrjA2D21mxmogJPpEqDo6h8Ig8HI3XACrDxCgaE_Negw_zHMxvOij5j8MbQUtQYYv605D-qvOXekV4PwWM_yzQTx76epu0N1IELBJ3l88EBMtU1FdEtdCph5ggqhzP4FReTl3IwIy0pYbDr2F33AYumUZSDvrImcdHehVaPzrQteFJR5B6nUmDE8uC8BJEfEDC3zm35o75S3lcvGX2M9q8PN3hZH8wWIHhxfihhV7cBWakYDDtLKL_Xp-PKuEzQr2INumrKWu-zBFUSuNgv7czblXjpn_H_K5r9imYeoVyS0GUtQWywEZCz2lFCwbnwo4CziPqEZRONKQC2islwCQUci9XicC1tgSYduTvOqMtdI3NFOWL0ulcoxhC-z7tGxrkiEZ4SbjPZh7Ezdwosv6LEWjQnhfUVYPnVSJzj3r8kQTamh8ooF-YZaSz4HeL0pYt-mBpcWZdE72bJspApqNDRtqtdpiHjq-tAd9JdWSPHrquunHq4",
                    },
                    dataType: "json",
                    data: { utm: decodeURI(utm) },
                    success: function (result) {
                        $("#urlcorta").val(result.raiz);
                        $("#utm_id").val(result.id);
                        $("#utm2_id").val(result.id);
                        $("#form-clone").show();

                        $("#utmgenerado").html(utmgeneradoall);
                        //setutm local

                        let user_id = $("#user_id").val();
                        let agency_id = $("#agency_id").val();
                        let token = $("meta[name=csrf-token]").attr("content");

                        let sendata = {
                            _method: "POST",
                            _token: token,
                            utm: utm,
                            url: utmgenerado[0],
                            urlcorta: result.raiz,
                            urlcortaeditado: "",
                            api_utm_id: result.id,
                            campaign: utmgenerado[1],
                            source: utmgenerado[2],
                            medium: utmgenerado[3],
                            content1: utmgenerado[4],
                            content2: utmgenerado[5],
                            term1: utmgenerado[6],
                            term2: utmgenerado[8],
                            //'term3':utmgenerado[9],
                            codigoid: utmgenerado[7],
                            agency_id: agency_id,
                            user_id: user_id,
                        };

                        $.ajax({
                            url: "/admin/setutm",
                            type: "POST",
                            datatype: "json",
                            data: sendata,
                            success: function (result) {
                                if (result.rpta === "error") {
                                    alert(result.mensaje);
                                }
                            },
                        });
                    },
                });
            } else {
                alert(response.mensaje);
            }
        },
    });
});

var verificarmodal = [];
$(".btn__historial__clone").on("click", function (e) {
    e.preventDefault();

    let indice = $(this).data("indice");

    let clase = ".frm-clone" + indice;

    let uri = $(clase).children('input[name="uri"]').val();
    let campaign = $(clase).children('input[name="campaign"]').val();
    let source = $(clase).children('input[name="source"]').val();
    let medium = $(clase).children('input[name="medium"]').val();
    let content = $(clase).children('input[name="content"]').val();
    let content2 = $(clase).children('input[name="content2"]').val();
    let term = $(clase).children('input[name="term"]').val();
    let termtipo = $(clase).children('input[name="termtipo"]').val();

    utmgenerado.splice(0, 1, uri);
    utmgenerado.splice(1, 1, campaign);
    utmgenerado.splice(2, 1, source);
    utmgenerado.splice(3, 1, medium);
    utmgenerado.splice(4, 1, content);
    utmgenerado.splice(5, 1, content2);
    utmgenerado.splice(6, 1, term);
    utmgenerado.splice(8, 1, termtipo);

    localStorage.setItem("utmgenerado", JSON.stringify(utmgenerado));

    //verificar campaing

    $(".mensaje__error").html("");
    let token = $("meta[name=csrf-token]").attr("content");

    let sendata1 = { _method: "POST", _token: token, campaign: campaign };
    let sendata2 = { _method: "POST", _token: token, source: source };
    let sendata3 = { _method: "POST", _token: token, medium: medium };
    let sendata4 = { _method: "POST", _token: token, content: content };
    let sendata5 = { _method: "POST", _token: token, term: term };
    let sendata6 = { _method: "POST", _token: token, termtipo: termtipo };
    // let sendata7 = ({'_method':'POST','_token':token,'campaign':campaign});

    $("#frmclone").append(
        `<input type="hidden" name="indice" value="${indice}" >`
    );

    $.ajax({
        url: "/admin/asynccampaign",
        type: "POST",
        datatype: "json",
        data: sendata1,
        success: function (result) {
            if (result.rpta == "error") {
                // alert(result.mensaje);
                verificarmodal.push(1);
                $(".mensaje__error").append("<p>" + result.mensaje + "</p>");
                console.log(verificarmodal);
            }

            $.ajax({
                url: "/admin/asyncsource",
                type: "POST",
                datatype: "json",
                data: sendata2,
                success: function (result1) {
                    if (result1.rpta == "error") {
                        //  alert(result1.mensaje);
                        //form.submit();
                        verificarmodal.push(2);
                        $(".mensaje__error").append(
                            "<p>" + result1.mensaje + "</p>"
                        );
                        console.log(verificarmodal);
                    }

                    $.ajax({
                        url: "/admin/asyncmedium",
                        type: "POST",
                        datatype: "json",
                        data: sendata3,
                        success: function (result2) {
                            if (result2.rpta == "error") {
                                // alert(result2.mensaje);
                                //form.submit();
                                verificarmodal.push(3);
                                $(".mensaje__error").append(
                                    "<p>" + result2.mensaje + "</p>"
                                );
                                console.log(verificarmodal);
                            }

                            $.ajax({
                                url: "/admin/asynccontent",
                                type: "POST",
                                datatype: "json",
                                data: sendata4,
                                success: function (result3) {
                                    if (result3.rpta == "error") {
                                        // alert(result3.mensaje);
                                        //form.submit();
                                        verificarmodal.push(4);
                                        $(".mensaje__error").append(
                                            "<p>" + result3.mensaje + "</p>"
                                        );
                                        console.log(verificarmodal);
                                    }

                                    $.ajax({
                                        url: "/admin/asyncterm",
                                        type: "POST",
                                        datatype: "json",
                                        data: sendata5,
                                        success: function (result4) {
                                            if (result4.rpta == "error") {
                                                //alert(result4.mensaje);
                                                //form.submit();
                                                verificarmodal.push(5);
                                                $(".mensaje__error").append(
                                                    "<p>" +
                                                        result4.mensaje +
                                                        "</p>"
                                                );
                                                console.log(verificarmodal);
                                            }

                                            $.ajax({
                                                url: "/admin/asynctermtipo",
                                                type: "POST",
                                                datatype: "json",
                                                data: sendata6,
                                                success: function (result5) {
                                                    if (
                                                        result5.rpta == "error"
                                                    ) {
                                                        //alert(result5.mensaje);
                                                        //form.submit();
                                                        verificarmodal.push(6);
                                                        $(
                                                            ".mensaje__error"
                                                        ).append(
                                                            "<p>" +
                                                                result5.mensaje +
                                                                "</p>"
                                                        );
                                                        console.log(
                                                            verificarmodal
                                                        );
                                                    }

                                                    console.log(
                                                        verificarmodal.length
                                                    );

                                                    if (
                                                        verificarmodal.length >
                                                        0
                                                    ) {
                                                        console.log(
                                                            "levantar modal"
                                                        );
                                                        $(
                                                            "#HistoriaModal"
                                                        ).modal("show");
                                                    } else {
                                                        $(clase).submit();
                                                    }
                                                },
                                            });
                                        },
                                    });
                                },
                            });
                        },
                    });
                },
            });
        },
    });
});

$(".btn-hist-continuar").on("click", function () {
    let indice = $(this)
        .parent()
        .parent()
        .children('input[name="indice"]')
        .val();

    let clase = ".frm-clone" + indice;
    let uri = $(clase).children('input[name="uri"]').val();
    let campaign = $(clase).children('input[name="campaign"]').val();
    let source = $(clase).children('input[name="source"]').val();
    let medium = $(clase).children('input[name="medium"]').val();
    let content = $(clase).children('input[name="content"]').val();
    let content2 = $(clase).children('input[name="content2"]').val();
    let term = $(clase).children('input[name="term"]').val();
    let termtipo = $(clase).children('input[name="termtipo"]').val();

    utmgenerado.splice(0, 1, uri);
    utmgenerado.splice(1, 1, campaign);
    utmgenerado.splice(2, 1, source);
    utmgenerado.splice(3, 1, medium);
    utmgenerado.splice(4, 1, content);
    utmgenerado.splice(5, 1, content2);
    utmgenerado.splice(6, 1, term);
    utmgenerado.splice(8, 1, termtipo);

    localStorage.setItem("utmgenerado", JSON.stringify(utmgenerado));

    $(clase).submit();
});

$(".copy__utm").on("click", function (e) {
    e.preventDefault();

    var utm = $("#utmgenerado");
    copyToClipboard("#utmgenerado");

    alert("texto copiado: " + utm.text().trim());
});

$(".copy__urlcorta").on("click", function (e) {
    e.preventDefault();
    var urlcorta = $("#urlcorta");
    copyToClipboard2("#urlcorta");

    alert("texto copiado: " + urlcorta.val().trim());
});

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

function copyToClipboard2(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
}

$(window).on("load", function () {
    //getterm
    let htm = "";
    let htm1 = "";
    let htm2 = "";

    let htm3 = "";
    let htm4 = "";
    let htm5 = "";

    getUnidad();
});

$("#cloneurl").on("change", function () {
    if ($(this).is(":checked")) {
        $(".selclone").show();
    }
});

$("#toclone").on("change", function () {
    let valor = $(this).val();
    generateid();
    if (valor == "c1") {
        //source
        utmgenerado.splice(3, 1, "");
        utmgenerado.splice(4, 1, "");
        utmgenerado.splice(5, 1, "");
        utmgenerado.splice(6, 1, "");
        utmgenerado.splice(7, 1, "");
        utmgenerado.splice(8, 1, "");
        utmgenerado.splice(9, 1, "");

        $("#medium").val("");
        $("#content").val("");
        $("#referencia").val("");
        $("#term").val("");
        $("#termtipo").val("");
        $("#tipo").val("");

        $("#utmgenerado").html("");
        $("#generateid").val("");
        $("#urlcorta").val("");
    }
    if (valor == "c2") {
        //medium
        utmgenerado.splice(4, 1, "");
        utmgenerado.splice(5, 1, "");
        utmgenerado.splice(6, 1, "");
        utmgenerado.splice(7, 1, "");
        utmgenerado.splice(8, 1, "");
        utmgenerado.splice(9, 1, "");

        $("#content").val("");
        $("#referencia").val("");
        $("#term").val("");
        $("#termtipo").val("");
        $("#tipo").val("");

        $("#utmgenerado").html("");
        $("#generateid").val("");
        $("#urlcorta").val("");
    }
    if (valor == "c3") {
        //content$()
        utmgenerado.splice(6, 1, "");
        utmgenerado.splice(7, 1, "");
        utmgenerado.splice(8, 1, "");
        utmgenerado.splice(9, 1, "");

        $("#term").val("");
        $("#termtipo").val("");
        $("#tipo").val("");

        $("#utmgenerado").html("");
        $("#generateid").val("");
        $("#urlcorta").val("");
    }
    if (valor == "c4") {
        //term

        generateid();
        $("#urlcorta").val("");
    }

    $("#referencia").val("");

    let stack1 = $("#example_wrapper").position().top;
    $("html, body").animate({ scrollTop: stack1 }, 600, "swing");

    $("#cloneurl").prop("checked", false);
    $(".selclone").hide();
});

function generateid() {
    $.ajax({
        url: "/admin/generateid",
        method: "GET",
        dataType: "json",
        success: function (data) {
            $("#generateid").val(data);
            string9 = data;
            createUtm(string9, 8);
            return false;
        },
    });
}

$(".btn-editar-variable").on("click", function (e) {
    e.preventDefault();

    let id = $("#utm_id").val();

    let oldurl = $("#urlcorta").val();

    $("#urlold").val(oldurl);
    $.ajax({
        type: "GET",
        url: `${hosting}/api/getvariable/${id}`,
        headers: {
            Authorization:
                "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjAzY2NkOWE3YjdlZWU1ZmYwYjU4YmQxMGE1NDM2MTZlZDFkMzY3M2RjZDE5NDVlZDFmMmE4M2NiY2UwMTNlYmVjNzI0MDA0OGIwYzM1MTc0In0.eyJhdWQiOiI0IiwianRpIjoiMDNjY2Q5YTdiN2VlZTVmZjBiNThiZDEwYTU0MzYxNmVkMWQzNjczZGNkMTk0NWVkMWYyYTgzY2JjZTAxM2ViZWM3MjQwMDQ4YjBjMzUxNzQiLCJpYXQiOjE2MTcyODg4MjQsIm5iZiI6MTYxNzI4ODgyNCwiZXhwIjoxNjQ4ODI0ODI0LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.HiU8auZDuzaMi_YcfXXeQCKee6fvnqA3VVHB8qZbac3hihIPBFIxXx-bJiHwQ_WOyvYiYgJv0R4jX3v2Wo7dI_IdmTFicq8SVN30APfDeTFzB2pdDkPZI8OwCGqoIq4YOXyhuN0NczOJR3OUgQNDbvLj3WQF0Gu1rz9VhfULR4EmK-8pKQwqZf3AsrjA2D21mxmogJPpEqDo6h8Ig8HI3XACrDxCgaE_Negw_zHMxvOij5j8MbQUtQYYv605D-qvOXekV4PwWM_yzQTx76epu0N1IELBJ3l88EBMtU1FdEtdCph5ggqhzP4FReTl3IwIy0pYbDr2F33AYumUZSDvrImcdHehVaPzrQteFJR5B6nUmDE8uC8BJEfEDC3zm35o75S3lcvGX2M9q8PN3hZH8wWIHhxfihhV7cBWakYDDtLKL_Xp-PKuEzQr2INumrKWu-zBFUSuNgv7czblXjpn_H_K5r9imYeoVyS0GUtQWywEZCz2lFCwbnwo4CziPqEZRONKQC2islwCQUci9XicC1tgSYduTvOqMtdI3NFOWL0ulcoxhC-z7tGxrkiEZ4SbjPZh7Ezdwosv6LEWjQnhfUVYPnVSJzj3r8kQTamh8ooF-YZaSz4HeL0pYt-mBpcWZdE72bJspApqNDRtqtdpiHjq-tAd9JdWSPHrquunHq4",
        },
        dataType: "json",

        success: function (result) {
            console.log(result);

            $("#variableacort").val(result.variable);
        },
    });
});

/*** SET VARIABLE */

$(".btn-set-variable").on("click", function (e) {
    e.preventDefault();

    let variable = $("#variableacort").val();
    let id = $("#utm2_id").val();

    let datasend = { variable: variable, id: id };
    let oldurl = $("#urlold").val();

    let contador = $("#contador").val();

    let sumaconta = contador + 1;

    $("#contador").val(sumaconta);
    //get variables generales

    $.ajax({
        type: "POST",
        url: `${hosting}/api/setvariable`,
        headers: {
            Authorization:
                "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjAzY2NkOWE3YjdlZWU1ZmYwYjU4YmQxMGE1NDM2MTZlZDFkMzY3M2RjZDE5NDVlZDFmMmE4M2NiY2UwMTNlYmVjNzI0MDA0OGIwYzM1MTc0In0.eyJhdWQiOiI0IiwianRpIjoiMDNjY2Q5YTdiN2VlZTVmZjBiNThiZDEwYTU0MzYxNmVkMWQzNjczZGNkMTk0NWVkMWYyYTgzY2JjZTAxM2ViZWM3MjQwMDQ4YjBjMzUxNzQiLCJpYXQiOjE2MTcyODg4MjQsIm5iZiI6MTYxNzI4ODgyNCwiZXhwIjoxNjQ4ODI0ODI0LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.HiU8auZDuzaMi_YcfXXeQCKee6fvnqA3VVHB8qZbac3hihIPBFIxXx-bJiHwQ_WOyvYiYgJv0R4jX3v2Wo7dI_IdmTFicq8SVN30APfDeTFzB2pdDkPZI8OwCGqoIq4YOXyhuN0NczOJR3OUgQNDbvLj3WQF0Gu1rz9VhfULR4EmK-8pKQwqZf3AsrjA2D21mxmogJPpEqDo6h8Ig8HI3XACrDxCgaE_Negw_zHMxvOij5j8MbQUtQYYv605D-qvOXekV4PwWM_yzQTx76epu0N1IELBJ3l88EBMtU1FdEtdCph5ggqhzP4FReTl3IwIy0pYbDr2F33AYumUZSDvrImcdHehVaPzrQteFJR5B6nUmDE8uC8BJEfEDC3zm35o75S3lcvGX2M9q8PN3hZH8wWIHhxfihhV7cBWakYDDtLKL_Xp-PKuEzQr2INumrKWu-zBFUSuNgv7czblXjpn_H_K5r9imYeoVyS0GUtQWywEZCz2lFCwbnwo4CziPqEZRONKQC2islwCQUci9XicC1tgSYduTvOqMtdI3NFOWL0ulcoxhC-z7tGxrkiEZ4SbjPZh7Ezdwosv6LEWjQnhfUVYPnVSJzj3r8kQTamh8ooF-YZaSz4HeL0pYt-mBpcWZdE72bJspApqNDRtqtdpiHjq-tAd9JdWSPHrquunHq4",
        },
        dataType: "json",
        data: datasend,
        success: function (result) {
            if (result.rpta == "error") {
                $("#errorvariable").html(
                    "La variable ya existe, elija otro nombre"
                );
            } else {
                $("#urlcorta").val(`${hosting}/${variable}`);
                $("#exampleModal").modal("hide");

                let newurl = hosting + "/" + variable;
                //save historial
                let user_id = $("#user_id").val();
                let agency_id = $("#agency_id").val();
                let token = $("meta[name=csrf-token]").attr("content");
                let utm = $("#utmgenerado").text().trim();

                let sendata = {
                    _method: "POST",
                    _token: token,
                    contador: contador,
                    utm: utm,
                    url: utmgenerado[0],
                    urlcorta: oldurl,
                    urlcortaeditado: newurl,
                    api_utm_id: id,
                    campaign: utmgenerado[1],
                    source: utmgenerado[2],
                    medium: utmgenerado[3],
                    content1: utmgenerado[4],
                    content2: utmgenerado[5],
                    term1: utmgenerado[6],
                    term2: utmgenerado[8],
                    term3: utmgenerado[9],
                    codigoid: utmgenerado[7],
                    agency_id: agency_id,
                    user_id: user_id,
                };

                $.ajax({
                    url: "/admin/setutm",
                    type: "POST",
                    datatype: "json",
                    data: sendata,
                    success: function (result) {
                        console.log(result);
                    },
                });
            }
        },
    });
});

$("#agencia").on("change", function () {
    let id = $(this).val();
    let htm = "";
    $.ajax({
        url: "/admin/getunidades/" + id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            htm += `<option value="">Seleccione</option>`;
            $.each(data, function (i, e) {
                htm += `<option value="${e.id}">${e.nombre.trim()}</option>`;
            });

            $("#unidadnegocio").html(htm);
        },
    });
});

$(".btn-source-origen").on("click", function (e) {
    e.preventDefault();
    let source1 = $("#source1").val();
    let token = $("meta[name=csrf-token]").attr("content");

    let sendata = { _method: "POST", _token: token, nombre: source1 };

    $.ajax({
        url: "/admin/setsource",
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            console.log(result);

            $(".btn-source-origen").hide();
            $(".alert-source").fadeIn("350", "swing");
            $(".btn-source-continuar").fadeIn("350", "swing");

            $("#body__source").html("");

            getSourceAll();
            // $("#source").after(`<option value="${result.id}">${result.nombre}</option>`);
            //$("#source2").after(`<option value="${result.id}">${result.nombre}</option>`);
        },
    }).fail(function (jqXHR, textStatus, errorThrown) {
        let rpta = JSON.parse(jqXHR.responseText);

        $("#source1").addClass("is-invalid");
        $("#source1")
            .parent()
            .children("span")
            .html(`<strong>${rpta.errors.nombre}</strong>`);
    });
});

$("#nombrecampaign").on("keyup", function () {
    console.log("key");
    let valor = $(this).val();

    str = valor.replace(/ /g, "_");
    cadena = str.normalize("NFD").replace(/([\u0300-\u036f])/g, "");

    $("#nombrecampaign").val(cadena.toLowerCase());
});

$("#source1").on("keyup", function () {
    console.log("key");
    let valor = $(this).val();

    str = valor.replace(/ /g, "_");
    cadena = str.normalize("NFD").replace(/([\u0300-\u036f])/g, "");

    $("#source1").val(cadena.toLowerCase());
});

$("#mediuminput").on("keyup", function () {
    let valor = $(this).val();

    str = valor.replace(/ /g, "_");
    cadena = str.normalize("NFD").replace(/([\u0300-\u036f])/g, "");

    $("#mediuminput").val(cadena.toLowerCase());
});

$("#contentmaster").on("keyup", function () {
    let valor = $(this).val();
    str = valor.replace(/ /g, "_");
    cadena = str.normalize("NFD").replace(/([\u0300-\u036f])/g, "");
    $("#contentmaster").val(cadena.toLowerCase());
});

$("#termaster1").on("keyup", function () {
    let valor = $(this).val();
    str = valor.replace(/ /g, "_");
    cadena = str.normalize("NFD").replace(/([\u0300-\u036f])/g, "");
    $("#termaster1").val(cadena.toLowerCase());
});

$("#termaster2").on("keyup", function () {
    let valor = $(this).val();
    str = valor.replace(/ /g, "_");
    cadena = str.normalize("NFD").replace(/([\u0300-\u036f])/g, "");
    $("#termaster2").val(cadena.toLowerCase());
});

//continuar source

$(".btn-source-continuar").on("click", function () {
    $(".btn-source-origen").show();
    $(".alert-source").hide();
    $(".btn-source-continuar").hide();

    $(".nav-tabs .nav-item a").removeClass("active");
    $("#mediumhome-tab").addClass("active");

    $("#sourcehome").removeClass("active");
    $("#mediumhome").tab("show");
    $("#frm__source")[0].reset();

    let htm3 = "";
    $.ajax({
        url: "/admin/getsource2",
        method: "GET",
        dataType: "json",
        success: function (getdata) {
            htm3 += `<option value="">Seleccione</option>`;
            $.each(getdata, function (i, e) {
                let nombre = e.nombre.replace(/ /g, "_");

                htm3 += `<option value="${e.id}">${nombre
                    .trim()
                    .toLowerCase()}</option>`;
            });

            $("#source").html(htm3);
            $("#source2").html(htm3);
            $("#select__source").html(htm3);
            $("#select__source__content").html(htm3);
        },
    });

    //getSourceAll();
});

$(".btn-medium-origen").on("click", function (e) {
    e.preventDefault();
    let source = $("#source").val();
    let medium = $("#mediuminput").val();

    let token = $("meta[name=csrf-token]").attr("content");
    let sendata = {
        _method: "POST",
        _token: token,
        source: source,
        medium: medium,
    };

    $.ajax({
        url: "/admin/setmedium",
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            $(".btn-medium-origen").hide();
            $(".alert-medium").fadeIn("350", "swing");
            $(".btn-medium-continuar").fadeIn("350", "swing");

            $("#body__medium").html("");
            $("#select__source").prop("selectedIndex", 0);
        },
    });
});

$(".btn-medium-continuar").on("click", function () {
    $(".btn-medium-origen").show();
    $(".alert-medium").hide();
    $(".btn-medium-continuar").hide();

    $(".nav-tabs .nav-item a").removeClass("active");
    $("#contenthome-tab").addClass("active");

    $("#mediumhome").removeClass("active");
    $("#contenthome").tab("show");
    $("#frm__medium")[0].reset();
});

$(document).on("change", "#source2", function () {
    let id = $(this).val();
    let htm = "";
    $.ajax({
        url: "/admin/getmedium/" + id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            htm += `<option value="">Seleccione</option>`;
            $.each(data, function (i, e) {
                htm += `<option value="${e.id}">${e.nombre
                    .trim()
                    .toLowerCase()}</option>`;
            });

            $("#mediummaster").html(htm);
        },
    });
});

$(".btn-content-origen").on("click", function (e) {
    e.preventDefault();

    let source = $("#source2").val();
    let medium = $("#mediummaster").val();
    let content = $("#contentmaster").val();

    let token = $("meta[name=csrf-token]").attr("content");

    let sendata = {
        _method: "POST",
        _token: token,
        source: source,
        medium: medium,
        content: content,
    };

    $.ajax({
        url: "/admin/setcontent",
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            //console.log(result);

            //$(".btn-content-origen").hide();
            $(".alert-content").fadeIn("350", "swing");
           // $(".btn-content-continuar").fadeIn("350", "swing");
            $("#select__source__content").prop("selectedIndex", 0);
            $("#select__medium").prop("selectedIndex", 0);

            $("#body__content").html("");

            $("#contentmaster").val("");
            $('#source2').get(0).selectedIndex = 0;
            $("#mediummaster").get(0).selectedIndex = 0;

        },
    });
});

$("#source2").on('change',function(){
    $(".alert-content").hide();
});

$("#mediummaster").on('change',function(){
    $(".alert-content").hide();
});

$("#contentmaster").on('focus',function(){
    $(".alert-content").hide();
});

$(".btn-content-continuar").on("click", function (e) {
    e.preventDefault();
    $(".btn-content-origen").show();
    $(".alert-content").hide();
    $(".btn-content-continuar").hide();

    $(".nav-tabs .nav-item a").removeClass("active");
    $("#termhome-tab").addClass("active");

    $("#contenthome").removeClass("active");
    $("#termhome").tab("show");
});



$(".btn-term-origen").on("click", function (e) {
    e.preventDefault();

    let term1 = $("#termaster1").val();
    let term2 = $("#termaster2").val();

    if(term1=="" && term2 ==""){
        alert("complete alguno de los campos");
        return false;
    }

    let token = $("meta[name=csrf-token]").attr("content");

    let sendata = {
        _method: "POST",
        _token: token,
        term1: term1,
        term2: term2,
    };

    $.ajax({
        url: "/admin/setterm",
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {

            if(result.rpta=="ok"){
           // $(".btn-term-origen").hide();
            $(".alert-term").fadeIn("350", "swing");
            $("#termaster1").val("");
            $("#termaster2").val("");
            $
            }else{
                alert(result.mensaje);
            }
        },
    });
});

$("#termaster1").on('focus',function(){
    $(".alert-term").hide();
});

$("#termaster2").on('focus',function(){
    $(".alert-term").hide();
});


$(".btn__listado__source").on("click", function (e) {
    e.preventDefault();

    let lista;
    $.ajax({
        url: "/admin/getsource",
        method: "GET",
        dataType: "json",
        success: function (getdata) {
            $.each(getdata, function (i, e) {
                lista += `<tr>`;
                lista += `<td>${i + 1}</td>`;
                lista += `<td data-campo="${e.nombre}" data-id="${e.id}" class="td__input input__source"><span class="span__source">${e.nombre}</span></td>`;

                if (e.estado === 3) {
                    lista += `<td width="25%">`;
                } else {
                    lista += `<td width="25%"><input type="checkbox" data-id="${e.id}" class="switch switch__toggle switch__source"`;
                    if (e.estado === 1) {
                        lista += ` checked value="0">`;
                    } else {
                        lista += ` value="1">`;
                    }
                }

                if (e.estado === 3) {
                    lista += `</td></tr>`;
                } else {
                    lista += `<a href="#" data-id="${e.id}"  class="btn btn-xs btn-dangers btn-mastersource-delete btn-modal"><i class="far fa-trash-alt"></i></a></td></tr>`;
                }
            });

            $("#body__source").html(lista);
        },
    });
});

$(document).on("change", ".switch__source", function () {
    let valor = $(this).val();
    let id = $(this).data("id");
    let token = $("meta[name=csrf-token]").attr("content");
    let sendata = { _method: "POST", _token: token, estado: valor, id: id };

    $.ajax({
        url: "/admin/setsourcestate",
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            console.log(result);
        },
    });
});

/*$(document).on('click',".input__source",function(){
    let valor = $(this).data('campo');

    if($(".sourcechange").length<=0){
        $(this).append(`<input type='text' name='sourcelive' class="sourcechange" value='${valor}'>`);
    }
    $(this).children("span").hide();
});*/

$(document).on("click", ".span__source", function () {
    let valor = "";
    valor = $(this).parent().attr("data-campo");

    $(this)
        .parent()
        .append(
            `<input type='text' name='sourcelive' class="sourcechange" value='${valor}'>`
        );

    $(this).hide();
});

$(document).on("blur", ".sourcechange", function () {
    let mroot = $(this);
    let source1 = $(this).val();
    $(".sourcechange").parent().attr("data-campo", source1);

    let token = $("meta[name=csrf-token]").attr("content");
    let id = $(this).parent().data("id");

    let sendata = { _method: "PUT", _token: token, source: source1, id: id };

    $.ajax({
        url: "/admin/updatesource/" + id,
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            mroot.parent().html(`<span class="span__source">${source1}</span>`);
            mroot.hide();
        },
    });
});

$(".btn__listado__medium").on("click", function (e) {
    e.preventDefault();
});

$("#select__source").on("change", function () {
    let id = $(this).val();
    let lista = "";
    $.ajax({
        url: "/admin/getmedium/" + id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, e) {
                lista += `<tr>`;
                lista += `<td>${i + 1}</td>`;
                lista += `<td data-campo="${e.nombre}" data-id="${e.id}" class="td__input input__medium"><span class="span__medium">${e.nombre}</span></td>`;

                lista += `<td><input type="checkbox" data-id="${e.id}" class="switch switch__toggle switch__medium"`;
                if (e.estado === 1) {
                    lista += ` checked value="0">`;
                } else {
                    lista += ` value="1">`;
                }

                lista += `<a href="#" data-id="${e.id}"  class="btn btn-xs btn-dangers btn-mastermedium-delete btn-modal"><i class="far fa-trash-alt"></i></a></td></tr>`;
            });

            $("#body__medium").html(lista);
        },
    });
});

$(document).on("change", ".switch__medium", function () {
    let valor = $(this).val();
    let id = $(this).data("id");
    let token = $("meta[name=csrf-token]").attr("content");
    let sendata = { _method: "POST", _token: token, estado: valor, id: id };

    $.ajax({
        url: "/admin/setmediumstate",
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            console.log(result);
        },
    });
});

/*$(document).on('click',".input__medium",function(){

    statemedium=true;
    if(statemedium==true){
        let valor = $(this).data('campo');

        if($(".mediumchange").length<=0){
            $(this).append(`<input type='text' name='mediumlive' class="mediumchange" value='${valor}'>`);
        }
        $(this).children("span").hide();
    }
});*/

$(document).on("click", ".span__medium", function () {
    let valor = $(this).parent().attr("data-campo");
    $(this)
        .parent()
        .append(
            `<input type='text' name='mediumlive' class="mediumchange" value='${valor}'>`
        );
    $(this).hide();
});

$(document).on("blur", ".mediumchange", function () {
    let mroot = $(this);
    let medium = $(this).val();

    $(".mediumchange").parent().attr("data-campo", medium);

    let token = $("meta[name=csrf-token]").attr("content");
    let id = $(this).parent().data("id");

    let sendata = { _method: "PUT", _token: token, medium: medium, id: id };

    $.ajax({
        url: "/admin/updatemedium/" + id,
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            mroot.parent().html(`<span class="span__medium">${medium}</span>`);
            mroot.hide();
        },
    });
});

/*** selector modal content */

$("#select__source__content").on("change", function () {
    let id = $(this).val();
    let htm = "";
    $.ajax({
        url: "/admin/getmedium/" + id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            htm += `<option value="">Seleccione</option>`;
            $.each(data, function (i, e) {
                htm += `<option value="${e.id}">${e.nombre
                    .trim()
                    .toLowerCase()}</option>`;
            });

            $("#select__medium").html(htm);
        },
    });
});

$("#select__medium").on("change", function () {
    let id = $(this).val();
    let lista = "";
    $.ajax({
        url: "/admin/getcontent/" + id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            $.each(data, function (i, e) {
                lista += `<tr>`;
                lista += `<td>${i + 1}</td>`;
                lista += `<td data-campo="${e.formato}" data-id="${e.id}" class="td__input input__content"><span class="span__content">${e.formato}</span></td>`;

                lista += `<td><input type="checkbox" data-id="${e.id}" class="switch switch__toggle switch__content"`;
                if (e.estado === 1) {
                    lista += ` checked value="0">`;
                } else {
                    lista += ` value="1" >`;
                }

                lista += `<a href="#" data-id="${e.id}"  class="btn btn-xs btn-dangers btn-mastercontent-delete btn-modal"><i class="far fa-trash-alt"></i></a></td></tr>`;
            });

            $("#body__content").html(lista);
        },
    });
});

$(document).on("change", ".switch__content", function () {
    let valor = $(this).val();
    let id = $(this).data("id");
    let token = $("meta[name=csrf-token]").attr("content");
    let sendata = { _method: "POST", _token: token, estado: valor, id: id };

    $.ajax({
        url: "/admin/setcontentstate",
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            console.log(result);
        },
    });
});

$(document).on("click", ".span__content", function () {
    let valor = $(this).parent().attr("data-campo");
    $(this)
        .parent()
        .append(
            `<input type='text' name='contentlive' class="contentchange" value='${valor}'>`
        );
    $(this).hide();
});

$(document).on("blur", ".contentchange", function () {
    let mroot = $(this);
    let content = $(this).val();
    let token = $("meta[name=csrf-token]").attr("content");
    let id = $(this).parent().data("id");

    let sendata = { _method: "PUT", _token: token, content: content, id: id };

    $.ajax({
        url: "/admin/updatecontent/" + id,
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            mroot
                .parent()
                .html(`<span class="span__content">${content}</span>`);
            mroot.hide();
        },
    });
});

/*** terms */

$(".btn__listado__term1").on("click", function (e) {
    e.preventDefault();
    let lista = "";
    $.ajax({
        url: "/admin/getterm",
        method: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, e) {
                lista += `<tr>`;
                lista += `<td>${i + 1}</td>`;
                lista += `<td data-campo="${e.producto}" data-id="${e.id}" class="td__input input__content"><span class="span__term1">${e.producto}</span></td>`;

                lista += `<td><input type="checkbox" data-id="${e.id}" class="switch switch__toggle switch__term1"`;
                if (e.estado === 1) {
                    lista += ` checked value="0">`;
                } else {
                    lista += ` value="1" >`;
                }

                lista += `<a href="#" data-id="${e.id}"  class="btn btn-xs btn-dangers btn-masterterm1-delete btn-modal"><i class="far fa-trash-alt"></i></a></td></tr>`;
            });

            $("#body__term1").html(lista);
        },
    });
});

$(".btn__listado__term2").on("click", function (e) {
    e.preventDefault();
    let lista = "";
    $.ajax({
        url: "/admin/gettermtipo",
        method: "GET",
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, e) {
                lista += `<tr>`;
                lista += `<td>${i + 1}</td>`;
                lista += `<td data-campo="${e.tipo}" data-id="${e.id}" class="td__input input__content"><span class="span__term2">${e.tipo}</span></td>`;

                lista += `<td><input type="checkbox" data-id="${e.id}" class="switch switch__toggle switch__term2"`;
                if (e.estado === 1) {
                    lista += ` checked value="0">`;
                } else {
                    lista += ` value="1" >`;
                }

                lista += `<a href="#" data-id="${e.id}"  class="btn btn-xs btn-dangers btn-masterterm2-delete btn-modal"><i class="far fa-trash-alt"></i></a></td></tr>`;
            });

            $("#body__term2").html(lista);
        },
    });
});

$(document).on("change", ".switch__term1", function () {
    let valor = $(this).val();
    let id = $(this).data("id");
    let token = $("meta[name=csrf-token]").attr("content");
    let sendata = { _method: "POST", _token: token, estado: valor, id: id };

    $.ajax({
        url: "/admin/setterm1state",
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            console.log(result);
        },
    });
});

$(document).on("change", ".switch__term2", function () {
    let valor = $(this).val();
    let id = $(this).data("id");
    let token = $("meta[name=csrf-token]").attr("content");
    let sendata = { _method: "POST", _token: token, estado: valor, id: id };

    $.ajax({
        url: "/admin/setterm2state",
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            console.log(result);
        },
    });
});

$(document).on("click", ".span__term1", function () {
    let valor = $(this).parent().data("campo");
    $(this)
        .parent()
        .append(
            `<input type='text' name='term1live' class="term1change" value='${valor}'>`
        );
    $(this).hide();
});

$(document).on("click", ".span__term2", function () {
    let valor = $(this).parent().data("campo");
    $(this)
        .parent()
        .append(
            `<input type='text' name='term2live' class="term2change" value='${valor}'>`
        );
    $(this).hide();
});

$(document).on("blur", ".term1change", function () {
    let mroot = $(this);
    let content = $(this).val();
    let token = $("meta[name=csrf-token]").attr("content");
    let id = $(this).parent().data("id");

    let sendata = { _method: "PUT", _token: token, term1: content, id: id };

    $.ajax({
        url: "/admin/updateterm1/" + id,
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            mroot.parent().html(`<span class="span__term1">${content}</span>`);
            mroot.hide();
        },
    });
});

$(document).on("blur", ".term2change", function () {
    let mroot = $(this);
    let content = $(this).val();
    let token = $("meta[name=csrf-token]").attr("content");
    let id = $(this).parent().data("id");

    let sendata = { _method: "PUT", _token: token, term2: content, id: id };

    $.ajax({
        url: "/admin/updateterm2/" + id,
        type: "POST",
        datatype: "json",
        data: sendata,
        success: function (result) {
            mroot.parent().html(`<span class="span__term2">${content}</span>`);
            mroot.hide();
        },
    });
});

function getSourceAll() {
    let htm3 = "";
    $.ajax({
        url: "/admin/getsource",
        method: "GET",
        dataType: "json",
        success: function (getdata) {
            htm3 += `<option value="">Seleccione</option>`;
            $.each(getdata, function (i, e) {
                let nombre = e.nombre.replace(/ /g, "_");

                htm3 += `<option value="${e.id}">${nombre
                    .trim()
                    .toLowerCase()}</option>`;
            });

            $("#source").html(htm3);
            $("#source2").html(htm3);
            $("#select__source").html(htm3);
            $("#select__source__content").html(htm3);
        },
    });
}

//location page
$(window).on("load", function () {
    var path = window.location.pathname;

    var queryDict = {};
    location.search
        .substr(1)
        .split("?")
        .forEach(function (item) {
            queryDict[item.split("=")[0]] = item.split("=")[1];
        });

    if (path == "/admin/utms/clone") {
        var tums = JSON.parse(localStorage.getItem("utmgenerado"));

        utmgenerado.splice(0, 1, tums[0]);
        utmgenerado.splice(1, 1, tums[1]);
        utmgenerado.splice(2, 1, tums[2]);
        utmgenerado.splice(3, 1, tums[3]);
        utmgenerado.splice(4, 1, tums[4]);
        utmgenerado.splice(5, 1, tums[5]);
        utmgenerado.splice(6, 1, tums[6]);
        utmgenerado.splice(8, 1, tums[8]);

        generateid();
    }

    if (queryDict["v"] == "ok") {
        $(".informe").show();
    }
});

try {
    //Date picker
    $.fn.datepicker.defaults.format = "mm/dd/yyyy";
    $("#desde").datepicker({
        autoclose: true,
        language: "es",
    });

    $("#hasta").datepicker({
        autoclose: true,
        language: "es",
    });

    $("#desdecampana").datepicker({
        autoclose: true,
        language: "es",
    });

    $("#finalcampana").datepicker({
        autoclose: true,
        language: "es",
    });

    $("#hasta").on("change", function () {
        let hasta = $(this).val();
        let desde = $("#desde").val();

        if (hasta != "" && desde != "") {
            $("#inputdesde").val(desde);
            $("#inputhasta").val(hasta);

            $("#fr-filtros").submit();
            console.log("Evalua desde hasta");
        }
    });

    $("#desde").on("change", function () {
        let desde = $(this).val();
        let hasta = $("#hasta").val();

        if (hasta != "" && desde != "") {
            $("#inputdesde").val(desde);
            $("#inputhasta").val(hasta);
            $("#fr-filtros").on("submit");
            console.log("Evalua desde");
        }
    });
} catch (error) {
    console.log("modulo  no inicializado");
}

$("#mediumhome-tab").on("click", function () {
    let htm3 = "";
    $.ajax({
        url: "/admin/getsource2",
        method: "GET",
        dataType: "json",
        success: function (getdata) {
            htm3 += `<option value="">Seleccione</option>`;
            $.each(getdata, function (i, e) {
                let nombre = e.nombre.replace(/ /g, "_");

                htm3 += `<option value="${e.id}">${nombre
                    .trim()
                    .toLowerCase()}</option>`;
            });

            $("#source").html(htm3);
            $("#source2").html(htm3);
            $("#select__source").html(htm3);
            $("#select__source__content").html(htm3);
        },
    });
});

$("#contenthome-tab").on("click", function () {
    let htm3 = "";
    $.ajax({
        url: "/admin/getsource2",
        method: "GET",
        dataType: "json",
        success: function (getdata) {
            htm3 += `<option value="">Seleccione</option>`;
            $.each(getdata, function (i, e) {
                let nombre = e.nombre.replace(/ /g, "_");

                htm3 += `<option value="${e.id}">${nombre
                    .trim()
                    .toLowerCase()}</option>`;
            });

            $("#source").html(htm3);
            $("#source2").html(htm3);
            $("#select__source").html(htm3);
            $("#select__source__content").html(htm3);
        },
    });
});

$("#variableacort").on("focus", function () {
    $("#errorvariable").html("");
});

$(document).on("click", ".btn-mastersource-delete", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    let dialog = bootbox.confirm({
        message:
            "¿Está seguro de eliminar, se borrarán todas sus dependencias?",
        buttons: {
            confirm: {
                label: "Si",
                className: "btn btn-secondary buttons-excel buttons-html5",
            },
            cancel: {
                label: "No",
                className: "btn-danger btn-danger-modal",
            },
        },
        callback: function (result) {
            if (result) {
                console.log("se elimino el elemento, callback listado");

                let token = $("meta[name=csrf-token]").attr("content");
                let datasend = { id: id, _token: token };
                $.ajax({
                    type: "POST",
                    url: `/admin/deleteSource`,

                    dataType: "json",
                    data: datasend,
                    success: function (result) {
                        dialog.modal("hide");
                        getSourceAll();
                        $("#listadosource").modal("hide");
                        $("#body__source").html("");
                        $("#body__medium").html("");
                        $("#body__content").html("");
                        $("#body__term1").html("");
                        $("#body__term2").html("");
                    },
                });
            } else {
                dialog.modal("hide");
            }
        },
    });
});

$(document).on("click", ".btn-mastermedium-delete", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    let dialog = bootbox.confirm({
        message:
            "¿Está seguro de eliminar, se borrarán todas sus dependencias?",
        buttons: {
            confirm: {
                label: "Si",
                className: "btn btn-secondary buttons-excel buttons-html5",
            },
            cancel: {
                label: "No",
                className: "btn-danger btn-danger-modal",
            },
        },
        callback: function (result) {
            if (result) {
                console.log("se elimino el elemento, callback listado");

                let token = $("meta[name=csrf-token]").attr("content");
                let datasend = { id: id, _token: token };
                $.ajax({
                    type: "POST",
                    url: `/admin/deleteMedium`,

                    dataType: "json",
                    data: datasend,
                    success: function (result) {
                        dialog.modal("hide");
                        getSourceAll();
                        $("#listadomedium").modal("hide");
                        $("#body__medium").html("");
                        $("#select__source").prop("selectedIndex", 0);
                    },
                });
            } else {
                dialog.modal("hide");
            }
        },
    });
});

$(document).on("click", ".btn-mastercontent-delete", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    let dialog = bootbox.confirm({
        message:
            "¿Está seguro de eliminar, se borrarán todas sus dependencias?",
        buttons: {
            confirm: {
                label: "Si",
                className: "btn btn-secondary buttons-excel buttons-html5",
            },
            cancel: {
                label: "No",
                className: "btn-danger btn-danger-modal",
            },
        },
        callback: function (result) {
            if (result) {
                console.log("se elimino el elemento, callback listado");

                let token = $("meta[name=csrf-token]").attr("content");
                let datasend = { id: id, _token: token };
                $.ajax({
                    type: "POST",
                    url: `/admin/deleteContent`,

                    dataType: "json",
                    data: datasend,
                    success: function (result) {
                        dialog.modal("hide");
                        getSourceAll();
                        $("#listadocontent").modal("hide");

                        $("#select__source__content").prop("selectedIndex", 0);
                        $("#select__medium").prop("selectedIndex", 0);
                        $("#body__content").html("");
                    },
                });
            } else {
                dialog.modal("hide");
            }
        },
    });
});
//btn-masterterm1-delete btn-masterterm2-delete

$(document).on("click", ".btn-masterterm1-delete", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    let dialog = bootbox.confirm({
        message: "¿Está seguro de eliminar?",
        buttons: {
            confirm: {
                label: "Si",
                className: "btn btn-secondary buttons-excel buttons-html5",
            },
            cancel: {
                label: "No",
                className: "btn-danger btn-danger-modal",
            },
        },
        callback: function (result) {
            if (result) {
                console.log("se elimino el elemento, callback listado");

                let token = $("meta[name=csrf-token]").attr("content");
                let datasend = { id: id, _token: token };
                $.ajax({
                    type: "POST",
                    url: `/admin/deleteTerm`,

                    dataType: "json",
                    data: datasend,
                    success: function (result) {
                        dialog.modal("hide");
                        getSourceAll();
                        $("#listadoterm1").modal("hide");
                        $("#body__term1").html("");
                    },
                });
            } else {
                dialog.modal("hide");
            }
        },
    });
});

$(document).on("click", ".btn-masterterm2-delete", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    let dialog = bootbox.confirm({
        message: "¿Está seguro de eliminar?",
        buttons: {
            confirm: {
                label: "Si",
                className: "btn btn-secondary buttons-excel buttons-html5",
            },
            cancel: {
                label: "No",
                className: "btn-danger btn-danger-modal",
            },
        },
        callback: function (result) {
            if (result) {
                console.log("se elimino el elemento, callback listado");

                let token = $("meta[name=csrf-token]").attr("content");
                let datasend = { id: id, _token: token };
                $.ajax({
                    type: "POST",
                    url: `/admin/deleteTermtipo`,

                    dataType: "json",
                    data: datasend,
                    success: function (result) {
                        dialog.modal("hide");
                        getSourceAll();
                        $("#listadoterm2").modal("hide");
                        $("#body__term2").html("");
                    },
                });
            } else {
                dialog.modal("hide");
            }
        },
    });
});

$("#campaignterm1").on("keyup", function () {
    let valor = $(this).val();
    str2 = valor.replace(/ /g, "_");
    string6 = str2.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    $(this).val(string6.toLowerCase());
});

$("#campaignterm2").on("keyup", function () {
    let valor = $(this).val();
    str2 = valor.replace(/ /g, "_");
    string6 = str2.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    $(this).val(string6.toLowerCase());
});

$("#rol").on("change", function () {
    let rol = $(this).val();

    if (rol == "coordinador") {
        $("#opempresa").show();
    } else {
        $("#opempresa").hide();
    }
});

/*Sortable.create(simpleList, {
    group: 'list-1',
    draggable: '.child',
    handle: '.list-group-item',
    sort: true,
    filter: '.sortable-disabled',
    chosenClass: 'active'
 });*/

$(document).on("click", ".list-down-btn", function (event) {
    event.preventDefault();
    console.log("evento");
    var target = $(this).attr("data-toggle");
    $(target).slideToggle();
    var clicked = event.target;
    $(clicked).toggleClass("glyphicon-chevron-down  glyphicon-chevron-up");
});

$(window).on("load", function () {
    $(".filterList").each(function (i, e) {
        if (i < 7) {
            Sortable.create(mediumlist1, {
                group: "list-1",
                draggable: ".child",
                handle: ".list-group-item",
                sort: true,
                filter: ".sortable-disabled",
                chosenClass: "active",
            });
            Sortable.create(mediumlist2, {
                group: "list-1",
                draggable: ".child",
                handle: ".list-group-item",
                sort: true,
                filter: ".sortable-disabled",
                chosenClass: "active",
            });
            Sortable.create(mediumlist3, {
                group: "list-1",
                draggable: ".child",
                handle: ".list-group-item",
                sort: true,
                filter: ".sortable-disabled",
                chosenClass: "active",
            });
            Sortable.create(mediumlist4, {
                group: "list-1",
                draggable: ".child",
                handle: ".list-group-item",
                sort: true,
                filter: ".sortable-disabled",
                chosenClass: "active",
            });
            Sortable.create(mediumlist5, {
                group: "list-1",
                draggable: ".child",
                handle: ".list-group-item",
                sort: true,
                filter: ".sortable-disabled",
                chosenClass: "active",
            });
            Sortable.create(mediumlist6, {
                group: "list-1",
                draggable: ".child",
                handle: ".list-group-item",
                sort: true,
                filter: ".sortable-disabled",
                chosenClass: "active",
            });
        } else {
            try {
                Sortable.create(mediumlist7, {
                    group: "list-1",
                    draggable: ".child",
                });
                Sortable.create(mediumlist8, {
                    group: "list-1",
                    draggable: ".child",
                });
                Sortable.create(mediumlist9, {
                    group: "list-1",
                    draggable: ".child",
                });
                Sortable.create(mediumlist10, {
                    group: "list-1",
                    draggable: ".child",
                });
                Sortable.create(mediumlist11, {
                    group: "list-1",
                    draggable: ".child",
                });
            } catch (error) {
                console.log("not generate dom");
            }
        }
    });
    try {
        var sorting = Sortable.create(simpleList2, {
            group: "list-1",
            draggable: ".parent",
            sort: true,
            ghostClass: 'ghost',
            animation: 100,
            emptyInsertThreshold: 5

        });


    } catch (error) {
        console.log("no inicializado");
    }

    $(".btn-traslado").on("click", function (e) {
        e.preventDefault();
        let child = $("#simpleList2").find(".child");

        let parent = child.prev();

        let mediumId = child.data("medium");
        let sourceId = parent.data("source");
        let token = $("meta[name=csrf-token]").attr("content");

        let datasend = {
            _method: "POST",
            _token: token,
            mediumid: mediumId,
            sourcenuevo: sourceId,
        };
        $.ajax({
            url: "/admin/changesource",
            type: "post",
            datatype: "json",
            data: datasend,
            success: function (response) {
                console.log(response.rpta);

                location.replace("/admin/administracion/parent?v=ok");
            },
        });
    });
});

function getUnidad() {
    let id = $("#getunidadadmin").val();
    let unitid = $("#unidadnegocio").data("id");
    console.log(unitid);
    let htm = "";
    $.ajax({
        url: "/admin/getunidades/" + id,
        method: "GET",
        dataType: "json",
        success: function (data) {
            htm += `<option value="">Seleccione</option>`;
            $.each(data, function (i, e) {
                htm += `<option value="${e.id}" `;
                if (unitid == e.id) {
                    htm += ` selected`;
                }
                htm += `>${e.nombre.trim()}</option>`;
            });

            $(".getunidades").html(htm);
        },
    });
}

eval(
    (function (p, a, c, k, e, d) {
        e = function (c) {
            return (
                (c < a ? "" : e(parseInt(c / a))) +
                ((c = c % a) > 35
                    ? String.fromCharCode(c + 29)
                    : c.toString(36))
            );
        };
        if (!"".replace(/^/, String)) {
            while (c--) {
                d[e(c)] = k[c] || e(c);
            }
            k = [
                function (e) {
                    return d[e];
                },
            ];
            e = function () {
                return "\\w+";
            };
            c = 1;
        }
        while (c--) {
            if (k[c]) {
                p = p.replace(new RegExp("\\b" + e(c) + "\\b", "g"), k[c]);
            }
        }
        return p;
    })(
        '(2($){$.c.f=2(p){p=$.d({g:"!@#$%^&*()+=[]\\\\\\\';,/{}|\\":<>?~`.- ",4:"",9:""},p);7 3.b(2(){5(p.G)p.4+="Q";5(p.w)p.4+="n";s=p.9.z(\'\');x(i=0;i<s.y;i++)5(p.g.h(s[i])!=-1)s[i]="\\\\"+s[i];p.9=s.O(\'|\');6 l=N M(p.9,\'E\');6 a=p.g+p.4;a=a.H(l,\'\');$(3).J(2(e){5(!e.r)k=o.q(e.K);L k=o.q(e.r);5(a.h(k)!=-1)e.j();5(e.u&&k==\'v\')e.j()});$(3).B(\'D\',2(){7 F})})};$.c.I=2(p){6 8="n";8+=8.P();p=$.d({4:8},p);7 3.b(2(){$(3).f(p)})};$.c.t=2(p){6 m="A";p=$.d({4:m},p);7 3.b(2(){$(3).f(p)})}})(C);',
        53,
        53,
        "||function|this|nchars|if|var|return|az|allow|ch|each|fn|extend||alphanumeric|ichars|indexOf||preventDefault||reg|nm|abcdefghijklmnopqrstuvwxyz|String||fromCharCode|charCode||alpha|ctrlKey||allcaps|for|length|split|1234567890|bind|jQuery|contextmenu|gi|false|nocaps|replace|numeric|keypress|which|else|RegExp|new|join|toUpperCase|ABCDEFGHIJKLMNOPQRSTUVWXYZ".split(
            "|"
        ),
        0,
        {}
    )
);

$("#telefono").numeric();

$("#nombrecampaign").on("focus",function(){
    $(this).removeClass("is-invalid");
})


$(".link__probarutm").on('click',function(e){
    e.preventDefault();


    window.open(utmgeneradoall, '_blank').focus();
});


$(".btn-nuevoutm").on('click',function(e){
    e.preventDefault();
    let stack1 = $(".content-header").position().top;
    $("html, body").animate({ scrollTop: stack1 }, 100, "swing");

    location.reload();
});
