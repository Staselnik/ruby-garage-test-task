

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


var Controller = {
    signupRequest: function(data) {

    },

    loginRequest: function(login, password) {
        $.ajax({
            'url': '/api/v1/login',
            'method': 'POST',
            'data' : {
                'login' : login,
                'password' : password
            },
            'success': function (resp) {
                if(resp && resp.auth_token) {
                    TokenRepository.set(resp.auth_token);
                }
            },

            'error': function (resp) {
                //handle error
            }

        });

    },
}




var LoginForm = {
    $container : $('#login-form'),
    init: function() {
        var $container = this.$container;
        $container.find('a#sign-up-link').click(function(e) {
            e.preventDefault();
            $container.modal('hide');
            SignUpForm.show();
        });
        $container.find('form').on('submit', function(e) {
            e.preventDefault();
            Controller.loginRequest();
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
        'use strict';
        LoginForm.init();
        SignUpForm.init();

        if(!TokenRepository.get()) {
            LoginForm.show();
        }


    }
);