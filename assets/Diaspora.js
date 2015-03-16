/*
 * Diaspora
 * @author LoeiFy
 * @url http://lorem.in
 */

var pop_hash = true,	// popstate mark
	can_load = true,	// load next page mark
	loaded = false,		// for post
	audio_id,			// audio id
	_height = $(window).height(),
	_width = $(window).width();

var loc = document.location,
	home_url = '';

var Util = {

	ajaxLoad: function(url, func) {
		$.ajax({
			type: 'GET',
			url: url,
			timeout: 7000,
			success: function(data) {func(data)},
			error: function() {window.location.href = url}
		})
	},

	/*scrollbarWidth: function() {
    	var $inner = $('<div style="width: 100%; height:200px;">test</div>'),
        	$outer = $('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
        	inner = $inner[0],
        	outer = $outer[0];
     
    	$('body').append(outer);
    	var width1 = inner.offsetWidth;
    	$outer.css('overflow', 'scroll');
    	var width2 = outer.clientWidth;
    	$outer.remove();
 
    	return (width1 - width2);
	},*/

	touchDevice: function() {
		return !!('ontouchstart' in window);
	},

	randomColor: function() {
		return 'color'+ Math.floor(Math.random() * 6);
	},

	initIsotope: function(id, item) {
		$(id).isotope({
			itemSelector: item,
			resizable: true,
			transformsEnabled: true
		})
	},

	initSwipe: function(id, func) {
		return Swipe(document.getElementById(id), {
			speed: 400,
			auto: 10000,
			continuous: true,
			stopPropagation: false,
			callback: function(index, elem) {func(index, elem)}
		})
	},

	// mp3
	mp3: function(id, url, py, fn, fs) {
		soundManager.setup({
        	url: '/wp-content/themes/anguli/js/swf/soundmanager2.swf', 
        	onready: function() {
          		soundManager.createSound({
            		id: id,
            		autoLoad: true,
            		autoPlay: false,
            		url: url,
					whileplaying: function() {
						var length = parseInt(this.duration),
							pos = parseInt(this.position),
							// audio current position
							audio_pos = (pos / length) * 100;

						var _time = pos / 1000,
							min = Math.floor(_time / 60),
							min_display = min < 10 ? '0'+ min : min,
							sec = Math.floor(_time % 60),
							sec_display = sec < 10 ? '0'+ sec : sec,
							// audio current time
							audio_time = min_display +':'+ sec_display;

						py(audio_pos, audio_time)
					},
					onfinish: function() {
						fn()
					}
          		})
				fs()
        	}
      	})

	},

	// full image background
	fullImage: function(id, w, h, func) {
		// reget window height
		_height = $(window).height();
		_width = $(window).width();

		var ratio = h / w;
		if (_height / _width > ratio) {
			$(id).height(_height).width(_height / ratio)
		} else {
			$(id).width(_width).height(_width * ratio)
		};
		$(id).css('left', (_width - $(id).width()) / 2);
		$(id).css('top', (_height - $(id).height()) / 2);
		func(_height);
	}

};

var Anguli = {

	init: function() {

		if (basket.get('zzgf')) Anguli.cssFont();

		// get home url
		home_url = loc.href;

		// full image cover
		Anguli.fullScreen();

		// index isotope
		Util.initIsotope('#wrapper', '.post');

		// index post preview
		Anguli.postPreview('.overlay');
		Anguli.postPreview('.post_view a');
		Anguli.poState();

		// audio
		if ($('#single').length && $('.audio').length) Anguli.playAudio();

		// menu bar
		//Anguli.showMenu();

		// load next page
		Anguli.nextPage();

		// single page
		Anguli.previewReady();

		if (!$('#post_frist').length) {
			// post comment
			var url = loc.host + loc.pathname;
			Anguli.addComment(url);
		};

		$('#footer span').click(function() {
			setTimeout(scrollTo, 0, 0, 0)
		});

		window.onload = function() {
			setTimeout(scrollTo, 0, 0, 0)

			if (!basket.get('zzgf')) Anguli.cssFont();
		};
	},

	cssFont: function() {
		if (Util.touchDevice()) return;
		basket.require({ url: '/wp-content/themes/anguli/font/zzgf.css', key: 'zzgf', unique: 0.3,  execute: false }).then(function(responses) {
			_stylesheet.appendStyleSheet(responses[0], function() {
				$('#pagination a, #menu-menu a, #add_comment, .related h3').addClass('zzgf')
			})
		})
	},

	loadHtml: function(title) {
		var str = '<div id="load_text" class="abs tac w">'+
				  '<h2 class="f30">'+ title +'</h2>'+
				  '</div>';
		return str;
	},

	playAudio: function() {
		var audioAttr = $('.audio'),
			a_id = audioAttr.attr('id'),
			a_url = audioAttr.data('url'),
			a_name = audioAttr.data('name'),
			a_img = audioAttr.data('img'),
			a_play = audioAttr.data('play'); 

		audio_id = a_id;

		$('<img class="abs db" src="'+ a_img +'" />')
			.load(function() {
				$('.audiowrap').fadeIn(500)
			})
			.error(function() {})
			.prependTo('.audiowrap')

		// play mp3
		Util.mp3(a_id, a_url, function(pos, time) {
			$('#audio_pos').css('width', pos+ '%')
			$('#audio_time').html(time)
		}, function() {
			$('#audio_play').removeClass('icon-pause').addClass('icon-play')
		}, function() {
			if (a_play == 1) {
				soundManager.play(a_id)
				audio_text()
			}
		})
		$('.audiowrap').click(function() {
			soundManager.togglePause(a_id)
			audio_text()
		})

		function audio_text() {
			if ($('#audio_play').hasClass('icon-play')) {
				$('#audio_play').removeClass('icon-play').addClass('icon-pause')
			} else {
				$('#audio_play').removeClass('icon-pause').addClass('icon-play')
			}
			$('#audio_name').html(a_name)
		}
	},

	startSwipe: function() {
		if (!$('#swipe').length) return;

		// calculate frist slide image's height
		// webkit sometime get img height = 0 
		var img_w = $('.swipe-wrap img:eq(0)').attr('width'),
			img_h = $('.swipe-wrap img:eq(0)').attr('height'),
			w_w = $('.single-gallery').width(),
			ra = img_w / img_h,
			r_h;

		if (img_w >= w_w) img_w = w_w;
		r_h = img_w / ra;

		// adjust swipe div height
		$('.swipe-wrap').css('height', r_h);

		// call swipe
		window.s_swipe = Util.initSwipe('swipe', function(index, elem) {
			$(elem).parent().css('height', $(elem).height());
			$('#pos').html(index + 1);
		});

		// get total slides
		$('#total').html(s_swipe.getNumSlides());

		// prev pic or next pic call
		$('#slider_left').click(function() {s_swipe.prev()});
		$('#slider_right').click(function() {s_swipe.next()});

		if (Util.touchDevice()) {
			$('#slider_left').hide();
			$('#slider_right').hide();
		}
	},

	previewReady: function() {
		// image post
		Util.initIsotope('.img_grid', '.postimgs');
		if (_width >= 600) {
			$('.postimgs').Chocolat();

			$(".single-standard .s_article a:has(img)").Chocolat();
		}

        $('.mark').off('click').on('click', function() {
            $(this).hide()

            $('.image_imgs').height($('.img_grid').css('height'))

            setTimeout(function() {
                $('.image_imgs').removeClass('oh')
            }, 500)
        })

        $('.shrink').off('click').on('click', function() {
            $('.image_imgs').height(150).addClass('oh').find('.mark').show()
        })


        if ($('#post_frist').length) {
		    $('#close').off('click').on('click', function() {
			    window.history.back()
		    })
            $('#single_logo a').hide()
        } else {
            $('#close').hide()
        }

		// audio
		if ($('#post_frist').length && $('.audio').length) Anguli.playAudio();

		// gallery post
		Anguli.startSwipe();

		Anguli.initLike();

        // Wechat share
        $('.wechat').off('click').on('click', function() {

            var url = 'http://'+ window.location.host + window.location.pathname;
            $('#qrcode img').attr('src', 'http://qr.liantu.com/api.php?w=200&text='+ url);
            $('#qrcode').show()

        })

        $('#qrcode div').off('click').on('click', function() {

            $('#qrcode').hide()

        })

        $('.image_imgs').height(150)
	},

	notHistory: function() {
		return !(window.history && history.pushState) || Util.touchDevice() || !$('#post_frist').length; 
	},

	postPreview: function(link) {
		if (Anguli.notHistory()) return;

		$('#preview_w').show();

		history.replaceState({ url: loc.href, title: document.title }, document.title, loc.href);

		$(link).click(function(e) {
			e.preventDefault();

			var url = $(this).attr('href'),
				title = $(this).attr('title') ? $(this).attr('title') : $(this).text();

			Anguli.previewDiv(true);

			Anguli.postToload(title, url, function() {
				// pushState
				history.pushState({ url: url, title: title }, title, url);
				document.title = title;
			})
		})
	},

	closeRotate: function() {
		// #close rotate
		loaded = false;
		setTimeout(function() {
			$('#close').show();

			$('#close').addClass('rotate').hover(function() {
				$(this).removeClass('rotate');
			}, function() {
				if(!loaded) $(this).addClass('rotate');
			})
		}, 300);
	},

	postToload: function(title, url, func) {
		Anguli.closeRotate();

		// show post title
		$('#preview').html(Anguli.loadHtml(title));

		// ga
		setTimeout(function() {
            _gaq.push(['_trackPageview', url])
        }, 0)

		Util.ajaxLoad(url, function(data) {
			$('#load_text').addClass(Util.randomColor());

			func();

			data = $(data).find('#s_wrapper');

			setTimeout(function() {
				$('#preview').html(data);

				Anguli.reState('.nav a');
				Anguli.reState('.related a');

				Anguli.previewReady();

				Anguli.addComment(url);

				loaded = true;
				$('#close').removeClass('rotate');

				// css font
				if (basket.get('zzgf')) Anguli.cssFont();
			}, 310)
		})
	},

	poState: function() {
		if (!pop_hash || Anguli.notHistory()) return;

		// only bind once
		pop_hash = false;

		window.addEventListener('popstate', function(event) {
			var state = event.state;

			// chrome will fire popstate frist time , and then state null
			if (!state) return;

			document.title = state.title;

			if (state.url == home_url) { // home url
				Anguli.previewDiv(false);

				soundManager.destroySound(audio_id)

				$('#close').hide();
				$('#preview').html('');
			} else { // post url
				Anguli.previewDiv(true);

				Anguli.postToload(state.title, state.url, function() {});
			}
		})
	}, 

	reState: function(link) {
		$(link).click(function(e) {
			e.preventDefault();

			soundManager.destroySound(audio_id)

			var url = $(this).attr('href'),
				title = $(this).text();

			Anguli.postToload(title, url, function() {
				// replaceState
				history.replaceState({ url: url, title: title }, title, url);
				document.title = title;
			})
		})
	},

	previewDiv: function(s) {
		if (s) {
			$('#preview_w').addClass('md-show');
			$('body').css('overflow', 'hidden');
		} else {
			$('body').css('overflow', 'auto');
			$('#preview_w').removeClass('md-show');
		}
	},

	addComment: function(url) {
		$('#add_comment').click(function(e) {
	   		e.preventDefault();

            var id = $(this).data('id');
			$('#comment-box').html('loading...');

	   		if (disqus_name != '') {

				$('#comment-box').html('<div id="disqus_thread"></div>');
				var disqus_shortname = disqus_name;
    			var disqus_url = url;
				(function() {
        			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        			dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    			})()

	   		} else if (duoshuoQuery.short_name != '') { 

				$.getScript('http://static.duoshuo.com/embed.js', function() {
					var el = document.createElement('div');
    				//el.setAttribute('data-url', url);
    				el.setAttribute('data-thread-key', id);
    				DUOSHUO.EmbedThread(el);
    				$('#comment-box').html(el);
				})

	   		} else {
				$('#comment-box').html('please set disqus name or duoshuo name');
	   		}

	   		$(this).remove();
		})
	},

	fullScreen: function() {
		if (!$('#post_frist').length) return;

		var s = $('#post_frist').data('img'),
			w = $('#post_frist').data('width'),
			h = $('#post_frist').data('height');

		if (false && !!document.createElement("canvas").getContext && !Util.touchDevice()) {
			var self, img, bg;

			$('#blur').each(function() {
				self = this;
				img = new Image;

				img.src = s;

				img.onload = function() {
					bg = new CanvasImage(self,this);
					bg.blur(3);
					reSize('#blur')

					$('#blur').fadeOut(3000)
					setInterval(function() {
						if ($('#blur').is(':hidden')) {
							$('#blur').fadeIn(2900)
						} else {
							$('#blur').fadeOut(2900)
						}
					}, 3000)
				};
			});

			$('<img id="cover" class="fix" src="'+ s +'" />').load(function() {
				reSize('#cover')
			}).insertBefore('#blur');

		} else {

			$('<img id="cover" class="fix scale" src="'+ s +'" />').load(function() {
				reSize('#cover')
                $(this).removeClass('scale')
			}).prependTo('body');
		}

		function reSize(id) {
			setTimeout(function() { $('#load_cover').fadeOut(500) }, 300);

			Util.fullImage(id, w, h, function(_height) {
				$('#post_frist').css('height', _height - 80);
			});

			$(window).on('resize', function() {
				Util.fullImage(id, w, h, function(_height) {
					$('#post_frist').css('height', _height - 80);
				})
			});
		}

	},

	/*
	showMenu: function() {
		// only fire index page
		if (!$('#post_frist').length) return;

		$(window).scroll(function() {
			if ($(document).scrollTop() > 300) {
				$('.icon-arrow-down').hide();
			} else {
				$('.icon-arrow-down').show();
			};

			if (Util.touchDevice()) return;

			if ($(document).scrollTop() > $(window).height()) {
				$('#header').fadeIn(500);
			} else {
				$('#header').fadeOut(500);
			}
		})
	},
	*/
 
	nextPage: function() {
		$('#pagination a').on('click', function(e) {
			if (Util.touchDevice() && (_width <= 600)) return;
			e.preventDefault();

			$(this).html('加载中..');
			if (!can_load) return;
			can_load = false;

			var next_link;
			Util.ajaxLoad($(this).attr('href'), function(data) {
				next_link = $(data).find('#pagination a').attr('href');
				if (next_link != undefined) {
					$('#pagination a').attr("href", next_link).html('加载更多');
				} else {
					$('#pagination a').hide();
				};

				data = $(data).find('.post');
				// call isotope
				$('#wrapper').append(data).isotope('appended', data, function() {
					can_load = true;
					Anguli.postPreview(data.find('.overlay'));
				})
			})
		})
	},

	//TZ_LIKE
	initLike: function() {
		function reloadLikes(who) {
			var text = $('#' + who).html();
			var patt= /(\d)+/;
		
			var num = patt.exec(text);
			num[0]++;
			text = text.replace(patt,num[0]);
			$('#' + who).html('<span class="count">' + text + '</span>');
		};	

		$('.likeThis').click(function() {
			var classes = $(this).attr('class');
			classes = classes.split(' ');
			
			if(classes[1] == 'active') return false;

			var classes = $(this).addClass('active');
			var id = $(this).attr('id');
			id = id.split('like-');
			$.ajax({
				type: 'POST',
				url: 'index.php',
				data: 'likepost=' + id[1],
				success: reloadLikes('like-' + id[1])
			});
				
			return false;
		})
	}

};

var CanvasImage=function(ele,img){
	this.element 			= ele;
	this.image 				= img;

	this.element.width 		= this.image.width;
	this.element.height 	= this.image.height;

	this.context 			= this.element.getContext("2d");
	
	this.context.drawImage(this.image,0,0);
};

CanvasImage.prototype.blur = function(i){
	this.context.globalAlpha = 0.5;

	for(var y=-i; y<=i; y+=2) {
		for(var x=-i; x<=i; x+=2) {
			this.context.drawImage(this.element, x, y);

			if(x >= 0 && y >= 0) {
				this.context.drawImage(this.element, -(x-1), -(y-1));
			}
		}
	}
	this.context.globalAlpha=1
};

// ready !	
$(document).ready(function() {

	Anguli.init();

});
