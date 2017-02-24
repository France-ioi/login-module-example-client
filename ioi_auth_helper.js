// system

function IOIAuthHelper(params) {
    this.params = params;
    window.__IOIAuthHelper = this;
}

IOIAuthHelper.prototype.popup = function(url) {
    var win = window.open(url, '__IOI_AUTH_POPUP', 'menubar=no, status=no, scrollbars=yes, menubar=no, width=500, height=600')
    win.focus();
    return win;
}

IOIAuthHelper.prototype.formatURL = function(uri, query) {
    var q = [];
    for(var k in query) {
        if(query.hasOwnProperty(k)) {
            q.push(k + '=' + encodeURIComponent(query[k]));
        }
    }
    return uri + (q.length > 0 ? (uri.indexOf('?') === -1 ? '?' : '&') + q.join('&') : '');
}

IOIAuthHelper.prototype.callback = function(name, args) {
    var p = name.split('.');
    var callback = this.params[p[0]] && this.params[p[0]][p[1]] ? this.params[p[0]][p[1]] : false;
    if(!callback) {
        console.log('IOIAuthHelper callback missed: ' + name)
    } else try {
        callback(args);
    } catch (e) {
        console.error('IOIAuthHelper: ' + e)
    }
}


// platform authorization popup

IOIAuthHelper.prototype.oauth = function(state) {
    if(!this.params.oauth) return;
    var q = {
        client_id: this.params.oauth.client_id,
        redirect_uri: this.params.oauth.redirect_uri,
        state: state || '',
        scope: 'account',
        response_type: 'code'
    };
    var url = this.formatURL(this.params.oauth.url, q);
    this.win = this.popup(url);
}

IOIAuthHelper.prototype.oauthCallback = function(result) {
    this.win && this.win.close();
    this.callback(result.error ? 'oauth.onError' : 'oauth.onSuccess', result);
}


// logout popup

IOIAuthHelper.prototype.logout = function(state) {
    if(!this.params.logout) return;
    var q = {
        redirect_uri: this.params.logout.redirect_uri
    };
    var url = this.formatURL(this.params.logout.url, q);
    this.win = this.popup(url);
}

IOIAuthHelper.prototype.logoutCallback = function(result) {
    this.win && this.win.close();
    this.callback(result.error ? 'logout.onError' : 'logout.onSuccess', result);
}


// account details popup

IOIAuthHelper.prototype.account = function(state) {
    if(!this.params.account) return;
    var q = {
        redirect_uri: this.params.account.redirect_uri
    };
    var url = this.formatURL(this.params.account.url, q);
    this.win = this.popup(url);
}

IOIAuthHelper.prototype.accountCallback = function(result) {
    this.win && this.win.close();
    this.callback(result.error ? 'account.onError' : 'account.onSuccess', result);
}