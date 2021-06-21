AOS.init();

$.validator.methods.email = function( value, element ) {
    return this.optional( element ) || /[a-z0-9]+@[a-z0-9]+\.[a-z]+/.test( value );
  };
$.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== value;
   }, "Valor no es igual");

$.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
}, "Solo Letras y números  por favor");


var validaton =  $("#form-register").validate({

     rules: {
         ignore: [],

         'nombres':{
             required:true,

         },

        'tipodoc':{
             required:true

         },

         'numdoc':{
            required:true

        },

         'telefono':{
            required:true,
             maxlength:9

         },
         'email':{
             email:true,
             maxlength:50
         },
         'razon':{
            required:true

        },
        'ruc':{
            required:true

        },

     },
     messages: {
        'nombres': {
             required:"Ingrese sus nombres",

         },
         'tipodoc':{
             required:"Ingrese el tipo de documento"

         },
         'numdoc':{
            required:"Ingrese el número de documento",
            maxlength:"Ingrese los digitos segun el tipo de documento"
        },
         'telefono':{
              required:"Ingrese su número de celular",
              maxlength:"Ingrese solamente 9 digitos"

         },
         'email': "Ingrese un email válido",
         'razon':{
            required:"Ingrese la Razón Social"

        },
        'ruc':{
            required:"Ingrese el número de RUC",
            maxlength:"Ingrese 11 digitos"

        },

     }
 });


 var validrecover =  $("#form-recover").validate({
     rules:{
        'myname[0]':{
            email:true
        }
    },
    messages:{
        'myname[0]': {
            required:"Ingrese su email",
            email:"Ingrese un email válido",

        }
    }
 });




eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(2($){$.c.f=2(p){p=$.d({g:"!@#$%^&*()+=[]\\\\\\\';,/{}|\\":<>?~`.- ",4:"",9:""},p);7 3.b(2(){5(p.G)p.4+="Q";5(p.w)p.4+="n";s=p.9.z(\'\');x(i=0;i<s.y;i++)5(p.g.h(s[i])!=-1)s[i]="\\\\"+s[i];p.9=s.O(\'|\');6 l=N M(p.9,\'E\');6 a=p.g+p.4;a=a.H(l,\'\');$(3).J(2(e){5(!e.r)k=o.q(e.K);L k=o.q(e.r);5(a.h(k)!=-1)e.j();5(e.u&&k==\'v\')e.j()});$(3).B(\'D\',2(){7 F})})};$.c.I=2(p){6 8="n";8+=8.P();p=$.d({4:8},p);7 3.b(2(){$(3).f(p)})};$.c.t=2(p){6 m="A";p=$.d({4:m},p);7 3.b(2(){$(3).f(p)})}})(C);',53,53,'||function|this|nchars|if|var|return|az|allow|ch|each|fn|extend||alphanumeric|ichars|indexOf||preventDefault||reg|nm|abcdefghijklmnopqrstuvwxyz|String||fromCharCode|charCode||alpha|ctrlKey||allcaps|for|length|split|1234567890|bind|jQuery|contextmenu|gi|false|nocaps|replace|numeric|keypress|which|else|RegExp|new|join|toUpperCase|ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('|'),0,{}));


$("#tipodoc").on('change',function(){

    if($(this).val()=="DNI"){

        $("#numdoc").attr("maxlength","8");
    }

    if($(this).val()=="EX"){
        $("#numdoc").attr("maxlength","10");

    }
});

$("#telefono").numeric();

$("#numdoc").numeric();
$("#ruc").numeric();

