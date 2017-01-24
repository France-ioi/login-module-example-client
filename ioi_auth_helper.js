function IOIAuthHelper(params) {

    this.login_module_url = 'http://login-module.dev/authorization';

    this.params = (function(params) {
        var required = ['client_id', 'redirect_uri', 'onAuthorize', 'onDeny'], valid = true;
        for(var i=0; i<required.length; i++) {
            if(typeof params[required[i]] === 'undefined') {
                valid = false;
                console.error('IOIAuthHelper parameter missed: ' + required[i]);
            }
        }
        return valid ? params : false;
    })(params);
    this.win = null;
}

IOIAuthHelper.prototype.getRequestURL = function(status) {
    var p = [];
    p.push('client_id=' + encodeURIComponent(this.params.client_id));
    p.push('redirect_uri=' + encodeURIComponent(this.params.redirect_uri));
    p.push('status=' + encodeURIComponent(status));
    p.push('scope=');
    p.push('response_type=code');
    return this.login_module_url +  '?' + p.join('&');
}

IOIAuthHelper.prototype.callback = function(name, args) {
    if(!this.params[name]) {
        console.log('IOIAuthHelper callaback missed: ' + e)
    } else try {
        this.params[name](args);
    } catch (e) {
        console.error('IOIAuthHelper: ' + e)
    }
}

IOIAuthHelper.prototype.authorize = function(state) {
    if(!this.params) return;
    var url = this.getRequestURL(state || '');
    var win = window.open(url, 'ioi_login', 'menubar=no, status=no, scrollbars=no, menubar=no, width=500, height=600')
    win.focus();

    var chan = Channel.build({
        window: win,
        origin: '*',
        scope: 'ioi_login'
    })

    var self = this;
    chan.bind('authorize', function(t, params) {
        win.close()
        self.callback('onAuthorize', params);
    });

    chan.bind('deny', function(t, params) {
        win.close()
        self.callback('onDeny', params);
    });
}