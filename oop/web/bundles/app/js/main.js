(function(){

    Leopard = {

        hbTemplateFolder: '/bundles/app/ajax/HandlebarsTpl/',

        init: function() {

            this.adminLoginBtnClick();
        },

        adminLoginBtnClick: function() {
            // getting name of template and data associated and make AJAX call
            
            var THIS = this, jqObj, urlVal, dataObject;

            $adminLoginBtns.click(function() {

                dataObject = {};
                jqObj = this, urlVal = $(jqObj).attr('data-url_val');

                $.each($(jqObj).data(), function(k, v) {
                    if( k !== 'url_val' ) {

                        dataObject[k] = v;
                    }
                });

                // call the Handlebars template with AJAX
                THIS.handlebarsModel(urlVal, dataObject, 'body');

                // if we are adding user form to the page
                if( urlVal == 'dialogue' ) {
                    // fading effect of overlay
                    THIS.setTimeoutFn("$('.overlay').addClass('whiteBg');", 10);

                    $('.overlay').click(function(e) {
                        $(this).add('.js-ajaxElems').remove();
                    });
                    THIS.ajaxFormSend();
                }
            });
        },

        handlebarsModel: function(name, dataObject, parent) {
            // load Handlebars template
            
            var compiledTemplate = this.getHandlebarsTemplate(this.hbTemplateFolder + name);
            $('.' + dataObject.class).remove();
            $(parent).append(compiledTemplate(dataObject));

        },

        setTimeoutFn: function(fn, delay) {
            // generic funtion for setTimeout functions

            setTimeout(function() {
                eval(fn);
            }, delay);
        },

        ajaxFormSend: function() {
            // submitting forms by AJAX

            var THIS = this, ajaxForm = $('.form-wrap form.ajaxForm'), url, key, dataObj = {};

            ajaxForm.submit(function() {

                var url = $(this).attr('action'), submitButton = $(this).find('input[type="submit"]'), loader = submitButton.closest('div').find('.loading');

                submitButton.addClass('hidden');
                loader.removeClass('hidden');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: ajaxForm.serialize(),
                    success: function(data) {

                        dataObj = JSON.parse(data);
                    },
                    complete: function(jqx) {

                        if(dataObj.authent) {
                            THIS.changeURL('/app/example/admin');
                        }else{
                            console.log(dataObj.error);
                            THIS.handlebarsModel('partMsg', { 'class': 'error_message', response : dataObj.error }, 'body');
                            submitButton.removeClass('hidden');
                            loader.addClass('hidden');
                        }
                    }
                });
                return false; // avoid submit
            });
        },

        changeURL: function(url) {
            // redirect
            
            window.location.href = url;
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