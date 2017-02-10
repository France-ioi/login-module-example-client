function IOIAuthHelper(params) {

    this.params = (function(params) {
        var required = ['url', 'client_id', 'redirect_uri', 'onAuthorize', 'onError'], valid = true;
        for(var i=0; i<required.length; i++) {
            if(typeof params[required[i]] === 'undefined') {
                valid = false;
                console.error('IOIAuthHelper parameter missed: ' + required[i]);
            }
        }
        return valid ? params : false;
    })(params);
    this.win = null;

    window.__IOIAuthHelper = this;
}

IOIAuthHelper.prototype.getRequestURL = function(state) {
    var p = [];
    p.push('client_id=' + encodeURIComponent(this.params.client_id));
    p.push('redirect_uri=' + encodeURIComponent(this.params.redirect_uri));
    p.push('state=' + encodeURIComponent(state));
    p.push('scope=account');
    p.push('response_type=code');
    return this.params.url + (this.params.url.indexOf('?') === -1 ? '?' : '&') + p.join('&');
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
    this.win = window.open(url, 'ioi_login', 'menubar=no, status=no, scrollbars=no, menubar=no, width=500, height=600')
    this.win.focus();
}


IOIAuthHelper.prototype.popupCallback = function(result) {
    this.win.close();
    this.callback(result.error ? 'onError' : 'onAuthorize', result);
}