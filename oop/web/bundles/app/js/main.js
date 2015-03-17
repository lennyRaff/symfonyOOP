(function(){

    Leopard = {

        init: function() {

            this.adminLoginBtnClick();
        },

        ajaxModel: function(url) {

            var THIS = this, ajaxCache = sessionStorage.getItem('ajaxTwigs'), ajaxRes, key;

            if( ajaxCache ) {

                // ajaxRes = JSON.parse(ajaxCache);
                
                for( key in ajaxRes ) {
                    if( ajaxRes.hasOwnProperty(key) ) {
                        // THIS.insertAjax(ajaxRes[key]);
                        return;
                    }
                }
            }

            $.ajax({
                dataType: "json",
                type: "GET",
                data: {},
                url: '/app/example/ajax/' + url,
                success: function ($res) {

                    THIS.insertAjax($res);
                    THIS.sessionStore('ajaxTwigs', url, $res);
                },
                error: function() {
                }
            });
        },

        adminLoginBtnClick: function() {

            var THIS = this, jqObj, urlVal;

            $adminLoginBtns.click(function() {

                jqObj = this, urlVal = $(jqObj).attr('data-urlVal');
                THIS.ajaxModel(urlVal);
            });
        },

        sessionStore: function(key, url, val) {

            if( !sessionStorage.getItem(key) ) {

                sessionStorage.setItem( key, JSON.stringify({ url : val }) );
            }
        },

        insertAjax: function($res) {

            $('body').append($res);
        }
    };

    $(document).ready(function() {

        $adminLoginBtns = $('.admin_log li');

        Leopard.init();
    });
}());