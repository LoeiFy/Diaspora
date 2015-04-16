/*
 * image loading progress, canvas display image width custom blur
 *
 * how to use:
 * https://github.com/LoeiFy/CBFimage/blob/master/README.md
 *
 * @param   {string}    id          canvas id
 * @param   {boolean}   cache       whether to cache image data
 * @param   {function}  start       image load begin callback
 * @param   {function}  progress    image loading callback
 * @param   {function}  end         image loaded callback
 *
 * @version 1.0.0
 * @author LoeiFy@gmail.com
 * http://lorem.in/ | under MIT license
 */

;(function(window, undefined) {

    "use strict";

    var CBFimage = function(args) {
        // arguments
        args.tag = document.getElementById(args.id);
        if (!args.tag) return;
        args.ver = args.tag.getAttribute('version');
        args.url = args.tag.getAttribute('url');
        args.cache = args.cache.toString() === 'false' ? false : true;
        var blur = parseInt(args.tag.getAttribute('blur')) || 0;
        args.blur = blur <= 10 ? blur : 0;

        // style
        args.tag.parentNode.style.overflow = 'hidden';
        args.tag.style.opacity = '0';
        args.tag.style.display = 'block';
        args.tag.style.transition = 'opacity .5s ease-in-out';
        args.tag.style.WebkitTransition = 'opacity .5s ease-in-out';
        args.tag.style.MozTransition = 'opacity .5s ease-in-out';

        // process image
        getImage(args)
    }


    /* 
     * base64 Encode
     * http://www.philten.com/us-xmlhttprequest-image/
     */
    function base64Encode(inputStr) {
        var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
            outputStr = "",
            i = 0;
                   
        while (i < inputStr.length) {
            //all three "& 0xff" added below are there to fix a known bug 
            //with bytes returned by xhr.responseText
            var byte1 = inputStr.charCodeAt(i++) & 0xff,
                byte2 = inputStr.charCodeAt(i++) & 0xff,
                byte3 = inputStr.charCodeAt(i++) & 0xff,
                
                enc1 = byte1 >> 2,
                enc2 = ((byte1 & 3) << 4) | (byte2 >> 4),       
                enc3,
                enc4;

                if (isNaN(byte2)) {
                    enc3 = enc4 = 64;
                } else {
                    enc3 = ((byte2 & 15) << 2) | (byte3 >> 6);
                    if (isNaN(byte3)) {
                        enc4 = 64;
                    } else {
                        enc4 = byte3 & 63;
                    }
                }
            outputStr += b64.charAt(enc1) + b64.charAt(enc2) + b64.charAt(enc3) + b64.charAt(enc4);
        }         
        return outputStr;
    }

    /* 
     * image blur base on canvasBlur
     */
    function canvasBlur(ele, img) {
        this.element = ele;
        this.image = img;

        this.element.width = this.image.width;
        this.element.height = this.image.height;

        this.context = this.element.getContext('2d');
        this.context.drawImage(this.image,0,0)
    }
    canvasBlur.prototype.blur = function(i) {
        this.context.globalAlpha = 0.5;

        for (var y = -i; y <= i; y += 2) {
            for (var x = -i; x <= i; x += 2) {
                this.context.drawImage(this.element, x + 1, y + 1)

                if (x >= 0 && y >= 0) {
                    this.context.drawImage(this.element, -(x-1), -(y-1))
                }
            }
        }

        this.context.globalAlpha = 1;
    }

    /*
     * full background
     */
    function fullBg(id, w, h) {
        var _height = id.parentNode.offsetHeight,
            _width = id.parentNode.offsetWidth,
            ratio = h / w;

        if (_height / _width > ratio) {
            id.style.height = _height +'px';
            id.style.width = _height / ratio +'px';
        } else {
            id.style.width = _width +'px';
            id.style.height = _width * ratio +'px';
        }

        id.style.position = 'relative';
        id.style.left = (_width - parseInt(id.style.width)) / 2 +'px';
        id.style.top = (_height - parseInt(id.style.height)) / 2 +'px';
    }

    /* 
     * get image form localStorage or url
     */
    function getImage(args) {
        var imagesrc = window.localStorage.getItem('CBFimageSRC'),
            imagever = window.localStorage.getItem('CBFimageVER'),
            imageurl = window.localStorage.getItem('CBFimageURL'),
            img = new Image();

        if (imagever != args.ver || imageurl != args.url) {
            loadImage(args)
            return;
        }

        img.onerror = function() {
            loadImage(args)
        }

        img.onload = function() {
            setTimeout(function() {img2canvas(img, args)}, 500)
        }

        img.src = imagesrc;
    } 

    /* 
     * image load progress
     * http://blogs.adobe.com/webplatform/2012/01/13/html5-image-progress-events/
     */
    function loadImage(args) {
        var request = new XMLHttpRequest();
                    
        request.onloadstart = function() {
            args.start()
        }

        request.onprogress = function(e) {
            // It's possible total = 0
            if (parseInt(e.total) === 0) return;
            args.progress(e.loaded, e.total)
        }

        request.onload = function() {
            if (this.status == 200) {
                var img = new Image();
                img.src = 'data:image/jpeg;base64,' + base64Encode(request.responseText);
                img2canvas(img, args)

                // save to localStorage
                if (args.cache) {
                    window.localStorage.setItem('CBFimageSRC', img.src)
                    window.localStorage.setItem('CBFimageVER', args.ver)
                    window.localStorage.setItem('CBFimageURL', args.url)
                }
            }
        }

        request.onloadend = function() {
            args.end()
        }

        request.open("GET", args.url +'?'+ +new Date, true)
        request.overrideMimeType('text/plain; charset=x-user-defined')
        request.send(null)
    }

    /* 
     * canvas image and full size canvas
     * image must loaded (firefox)
     * image load form localStorage will fire complete 
     */
    function img2canvas(image, args) {
        image.onload = function() {
            var bg = new canvasBlur(args.tag, image);
            if (args.blur) bg.blur(args.blur);

            fullBg(args.tag, image.width, image.height)
            window.onresize = function() {
                if (!args.tag.parentNode.clientHeight) return;
                fullBg(args.tag, image.width, image.height)
            }

            args.tag.style.opacity = '1';
        }
        if (image.complete) image.onload();
    }

    window.CBFimage = window.CBFimage || CBFimage;

})(window)
