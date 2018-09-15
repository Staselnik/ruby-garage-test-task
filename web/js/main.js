

var TokenRepository = {

    set : function(token) {
        this._token = token;
    },
    get : function() {
        return this._token;
    }
};


var Storage = {
    save : function(key, data) {
        localStorage.setItem(key, data);
    },
    load : function (key) {
        return localStorage.getItem(key)
    }
};


var LoginForm = {
    $container : $('#login-form'),
    'show' : function () {
        this.$container.modal('show')  ;
    }
};

var SignUpForm = {

};





$(document).ready(
    function() {





        'use strict';

        if(!TokenRepository.get()) {
            LoginForm.show();
        }



    }
);