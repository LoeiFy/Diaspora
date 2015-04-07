/*
 * Diaspora
 * @author LoeiFy
 * @url http://lorem.in
 */

var Home = location.href;

var Diaspora = {

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
        history.replaceState({u: Home, t: document.title}, document.title, Home);
		window.addEventListener('popstate', function(e) {
			var state = e.state;

			if (!state) return;

			document.title = state.t;

			if (state.u == Home) {

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

                Diaspora.loading()

                Diaspora.L(state.u, function(data) {

                    document.title = state.t;

                    $('#preview').html($(data).filter('#single'))

                    setTimeout(function() {

                        $('#preview').addClass('show')

                        setTimeout(function() {
                            $('#container').hide()
                            setTimeout(function() {
                                $('#preview').css({
                                    'position': 'static',
                                    'overflow-y': 'auto'
                                })

                                Diaspora.loaded()
                            }, 500)
                        }, 300)

                        Diaspora.HS('.relate a', 'replace') 

                    }, 0)

                })

			}
		})
    },

	HS: function(tag, flag) {
		$(tag).on('click', function(e) {
			e.preventDefault()

            Diaspora.loading()

			var url = $(this).attr('href'), title = $(this).text(),
                state = {t: title, u: url};

            Diaspora.L(url, function(data) {

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

                switch (flag) {

                    case 'push': 
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

                                    Diaspora.loaded()
                                }, 500)
                            }, 300)

                            Diaspora.HS('.relate a', 'replace') 

                        }, 0)
                    break;

                    case 'replace':
                        Diaspora.HS('.relate a', 'replace') 
                        window.scrollTo(0, 0)
                        Diaspora.loaded()
                    break;
                }

            })

		})
	},

    loader: function() {
        var w = window.innerWidth;
        var css = '<style id="loaderstyle">@-moz-keyframes loader{0%{background-position:0 0}100%{background-position:'+ w +'px 0}}@-webkit-keyframes loader{0%{background-position:0 0}100%{background-position:'+ w +'px 0}}></style>';
        $('#loaderstyle').remove()
        $('head').append(css)
    },

    loading: function() {
        $('.loader').addClass('loading').show()
    },

    loaded: function() {
        $('.loader').removeClass('loading').hide()
    }

}

$(function($) {

    if ($('#preview').length) {

        Diaspora.PS()

        Diaspora.HS('.inner', 'push')

        Diaspora.loader()

        CBFimage({id: 'cover', cache: true})

    } else {

	    window.addEventListener('popstate', function(e) {

			if (e.state) location.href = e.state.u;

        })

    }

    $('body').on('click', '.icon-images', function() {
        $('.icon-text').removeClass('active')
        $(this).addClass('active')

        $('.images').css('height', $('.images').data('height'))

        if ($(this).hasClass('tg')) {
            $('.section').css('left', 0)
        } else {
            $('.zoom').Chocolat()
            $('.images').justifiedGallery({ margins : 5 }).on('jg.complete', function () {
                $('.section').css('left', 0)
                $('.icon-images').addClass('tg')
            })
        }

        setTimeout(function() { $('.article').css('height', '0') }, 0)
    })

    $('body').on('click', '.icon-text', function() {
        $('.icon-images').removeClass('active')
        $(this).addClass('active')

        $('.article').css('height', 'auto')
        $('.section').css('left', '-100%')
        setTimeout(function() {
            $('.images').data('height', $('.images').height()).css('height', '0') 
        }, 0)
    })

})
