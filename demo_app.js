var DemoApp = {

    base_url: '',
    user: null,
    win: null,

    init: function(params) {
        this.setUser(params.user);

        // init links
        var self = this;
        $('#nav a').each(function(i, e) {
            var action = $(e).attr('raction');
            $(e).click(function() {
                self.openPopup(action);
            });
        });

        // init callbacks
        this.createWindowCallback('__LoginModuleCallbackLogin', function(res) {
            res.user && self.setUser(res.user);
        });
        this.createWindowCallback('__LoginModuleCallbackLogout', function(res) {
            self.setUser(null);
        });
        this.createWindowCallback('__LoginModuleCallbackProfile', function(res) {
            res.user && self.setUser(res.user);
        });
        this.createWindowCallback('__LoginModuleCallbackClosePopup');
    },


    setUser: function(user) {
        this.user = user;
        $('#nav_guest').toggle(!user);
        $('#nav_user').toggle(!!user);
        $('#user_id').html(user ? 'User #' + user.id : '');
    },


    openPopup: function(redirect_action) {
        var url = '/popup_redirect.php?action=' + redirect_action;
        this.win = window.open(url, 'LOGIN_MODULE_POPUP', 'menubar=no, status=no, scrollbars=yes, menubar=no, width=500, height=600')
        this.win.focus();
    },


    closePopup: function() {
        this.win && this.win.close();
        this.win = null;
    },

    showResult: function(message, data) {
        $('#result').html(message + (data ? '\n' + JSON.stringify(data, null, '\t') : ''));
    },


    createWindowCallback: function(name, callback) {
        var self = this;
        window[name] = function(res) {
            self.showResult(name + ' result: ', res);
            callback && callback(res);
            self.win && self.win.close();
        }
    }
}