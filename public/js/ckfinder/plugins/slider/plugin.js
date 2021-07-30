/*
* Slider Plugin
*
* @author Wile <wiltinoco@gmail.com>
* @version 1.0.0
*/
(function () {
CKEDITOR.plugins.add('slider', {

    init: function (editor) {

        editor.addCommand('slider', new CKEDITOR.dialogCommand('slider', {
            allowedContent: 'div{*}(*); iframe{*}[!width,!height,!src,!frameborder,!allowfullscreen,!allow]; object param[*]; a[*]; img[*]'
        }));

        editor.ui.addButton('Slider', {
            label : "SLI",
            toolbar : 'insert',
            command : 'slider',
            icon : this.path + 'images/icon.png'
        });

        CKEDITOR.dialog.add('slider', function (instance) {

            var texto,
					disabled = editor.config.texto_disabled_fields || [];
            return {

                title : "Insertar slide",
					minWidth : 510,
					minHeight : 200,
					onShow: function () {
						for (var i = 0; i < disabled.length; i++) {
							this.getContentElement('sliderPlugin', disabled[i]).disable();
						}
					},
                    contents :
						[{
							id : 'sliderPlugin',
							expand : true,
							elements :

                            [{
                                id : 'txtEmbed',
                                type : 'textarea',
                                label : "texto 1",
                                onChange : function (api) {
                                    handleEmbedChange(this, api);
                                },
                                onKeyUp : function (api) {
                                    handleEmbedChange(this, api);
                                },
                                validate : function () {
                                    if (this.isEnabled()) {
                                        if (!this.getValue()) {
                                            alert("texto2");
                                            return false;
                                        }
                                        else
                                        if (this.getValue().length === 0 || this.getValue().indexOf('//') === -1) {
                                            alert("texto 3");
                                            return false;
                                        }
                                    }
                                }
                            },
                            {
                                type : 'html',
                                html : 'texto 4'+ '<hr>'
                            }
                        ]

                        }
                    ],
					onOk: function()
					{
                        var content = '';
						var responsiveStyle = '';

                        if(this.getContentElement('sliderPlugin', 'txtEmbed').isEnabled()){
                            content = this.getValueOf('sliderPlugin', 'txtEmbed');
                        }else{

                            content += 'TEXTO ESPECIGICADO ...';

                        }
                        var element = CKEDITOR.dom.element.createFromHtml(content);
						instance.insertElement(element);

                    }

            }


        });
    }

});
});




function handleEmbedChange(el, api) {
	if (el.getValue().length > 0) {
		el.getDialog().getContentElement('sliderPlugin', 'txtUrl').disable();
	}
	else {
		el.getDialog().getContentElement('sliderPlugin', 'txtUrl').enable();
	}
}
