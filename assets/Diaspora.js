/*
 * Diaspora
 * @author LoeiFy
 * @url http://lorem.in
 */

$(function($) {
    
    var loader = function() {
        var w = window.innerWidth;
        var css = '<style id="loaderstyle">@-moz-keyframes loader{0%{background-position:0 0}100%{background-position:'+ w +'px 0}}@-webkit-keyframes loader{0%{background-position:0 0}100%{background-position:'+ w +'px 0}}></style>';
        $('#loaderstyle').remove()
        $('head').append(css)
    }

    loader()

    //$('.loader').addClass('loading')

    $(window).on('resize', function() {
        $('.loader').removeClass('loading')
        loader()
        setTimeout(function() {$('.loader').addClass('loading')}, 0)
    })

    CBFimage({id: 'cover', cache: true})

})
