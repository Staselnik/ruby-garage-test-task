

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
    init: function() {
        var $container = this.$container;
        $container.find('a#sign-up-link').click(function(e) {
            e.preventDefault();
            $container.modal('hide');
            SignUpForm.show();
        });

    },
    'show' : function () {
        this.$container.modal('show')  ;
    }
};

var SignUpForm = {
    $container : $('#signup-form'),
    init: function() {
        var $container = this.$container;
        $container.find('a#login-link').click(function(e) {
            e.preventDefault();
            $container.modal('hide');
            LoginForm.show();
        });

    },

    'show' : function () {
        this.$container.modal('show')  ;
    }
};





$(document).ready(
    function() {
        LoginForm.init();
        SignUpForm.init();






        'use strict';

        if(!TokenRepository.get()) {
            LoginForm.show();
        }



    }
);