/*
 * Diaspora
 * @author LoeiFy
 * @url http://lorem.in
 */

var home = location.href;

var D = {

    L: function(url, f) {
		$.ajax({
			type: 'GET',
			url: url,
			timeout: 7000,
			success: function(data) {f(data)},
			error: function() {window.location.href = url}
		})
    },

    P: function() {
		return !!('ontouchstart' in window);
	},

    PS: function() {
		window.addEventListener('popstate', function(e) {
			var state = e.state;

			if (!state) return;

			document.title = state.title;

			if (state.url == home) {
                $('#preview').html('')
			} else {
			}
		})
    },

	HS: function(tag, flag) {
		$(tag).on('click', function(e) {
			e.preventDefault();

			var url = $(this).attr('href'), title = $(this).text(),
                state = {t: title, u: url};

            D.L(url, function(data) {

                switch (flag) {

                    case 'push':
                        history.pushState(state, title, url)
                    break;

                    case 'replace':
				        history.replaceState(state, title, url)
                    break;

                }

                document.title = title;

                $('#preview').html($(data).filter('#single'))

            })

		})
	}

}

$(function($) {

    D.HS('.inner', 'push')

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
