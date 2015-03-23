(function(){

    Leopard = {

        hbTemplateFolder: '/bundles/app/ajax/HandlebarsTpl/',

        init: function() {

            this.adminLoginBtnClick();
        },

        adminLoginBtnClick: function() {
            // getting name of template and data associated and make AJAX call
            
            var THIS = this, jqObj, urlVal, dataObject = {};

            $adminLoginBtns.click(function() {

                jqObj = this, urlVal = $(jqObj).attr('data-url_val');

                $.each($(jqObj).data(), function(k, v) {
                    if( k !== 'url_val' ) {

                        dataObject[k] = v;
                    }
                });

                // call the Handlebars template with AJAX
                THIS.handlebarsModel(urlVal, dataObject);
            });
        },

        handlebarsModel: function(name, dataObject) {
            // load Handlebars template
            
            var compiledTemplate = this.getHandlebarsTemplate(this.hbTemplateFolder + name);
            $('body').append(compiledTemplate(dataObject));
            setTimeout(function() {
                $('.overlay').addClass('whiteBg');
            }, 50);
            this.ajaxFormSend();
        },

        ajaxFormSend: function() {
            // submitting forms by AJAX

            var ajaxForm = $('.form-wrap form.ajaxForm'), url, key;

            ajaxForm.submit(function() {

                var url = $(this).attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: ajaxForm.serialize(),
                    success: function(data) {

                        var dataObj = JSON.parse(data);
                    }
                });
                return false; // avoid submit
            });
        },

        getHandlebarsTemplate: function(name) {
            // Handlebars template function
            
            if (Handlebars.templates === undefined || Handlebars.templates[name] === undefined) {
                $.ajax({
                    dataType : 'text',
                    url : name + '.handlebars',
                    success : function(data) {
                        if (Handlebars.templates === undefined) {
                            Handlebars.templates = {};
                        }
                        Handlebars.templates[name] = Handlebars.compile(data);
                    },
                    async : false
                });
            }
            return Handlebars.templates[name];
        }
    };

    $(document).ready(function() {

        $adminLoginBtns = $('.admin_log li');

        Leopard.init();
    });
}());