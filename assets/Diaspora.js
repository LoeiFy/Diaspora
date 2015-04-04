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
        history.replaceState({u: home, t: document.title}, document.title, home);
		window.addEventListener('popstate', function(e) {
			var state = e.state;

			if (!state) return;

			document.title = state.t;

			if (state.u == home) {
                $('#preview').css('position', 'fixed')
                setTimeout(function() {
                    $('#preview').removeClass('show')
                    $('#container').show()
                    window.scrollTo(0, parseInt($('#container').data('scroll')))
                    setTimeout(function() {
                        $('#preview').html('')
                    }, 300)
                }, 0)
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

                setTimeout(function() {
                    $('#preview').addClass('show')
                    $('#container').data('scroll', window.scrollY)
                    setTimeout(function() {
                        $('#container').hide()
                        setTimeout(function() {
                            $('#preview').css({
                                'position': 'static',
                                'overflow-y': 'auto'
                            })
                        }, 500)
                    }, 300)
                }, 0)

            })

		})
	}

}

$(function($) {

    D.PS()

    D.HS('.inner', 'push')

    //$('#preview').height(window.innerHeight)

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
