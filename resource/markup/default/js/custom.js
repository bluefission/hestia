/**
 * demo.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2017, Codrops
 * http://www.codrops.com
 */
{
	setTimeout(() => document.body.classList.add('render'), 60);
	const navdemos = Array.from(document.querySelectorAll('nav.demos > .demo'));
	const total = navdemos.length;
	const current = navdemos.findIndex(el => el.classList.contains('demo--current'));
	const navigate = (linkEl) => {
		document.body.classList.remove('render');
		document.body.addEventListener('transitionend', () => window.location = linkEl.href);
	};
	navdemos.forEach(link => link.addEventListener('click', (ev) => {
		ev.preventDefault();
		navigate(ev.target);
	}));
	document.addEventListener('keydown', (ev) => {
		const keyCode = ev.keyCode || ev.which;
		let linkEl;
		if ( keyCode === 37 ) {
			linkEl = current > 0 ? navdemos[current-1] : navdemos[total-1];
		}
		else if ( keyCode === 39 ) {
			linkEl = current < total-1 ? navdemos[current+1] : navdemos[0];
		}
		else {
			return false;
		}
		navigate(linkEl);
	});
	imagesLoaded('.glitch__img', { background: true }, () => {
		document.body.classList.remove('loading');
		document.body.classList.add('imgloaded');
	});
}

function randRange(data) {
       var newTime = data[Math.floor(data.length * Math.random())];
       return newTime;
}

function toggleSomething() {
       var timeArray = new Array(200, 300, 150, 250, 2000, 3000, 1000, 1500);

       // do stuff, happens to use jQuery here (nothing else does)
       jQuery(".glitch").toggleClass("hover");
		jQuery('.warble').toggleClass('glitchtext');
  	   

       clearInterval(timer);
       timer = setInterval(toggleSomething, randRange(timeArray));
}

var timer = setInterval(toggleSomething, 1000);
// 1000 = Initial timer when the page is first loaded


// Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Scrolls to the selected menu item on the page
    /*
    $(function() {
        $('a[href*=#]:not([href=#],[data-toggle],[data-target],[data-slide])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    */
    //#to-top button appears after scrolling
    var fixed = false;
    $(document).scroll(function() {
        if ($(this).scrollTop() > 250) {
            if (!fixed) {
                fixed = true;
                // $('#to-top').css({position:'fixed', display:'block'});
                $('#to-top').show("slow", function() {
                    $('#to-top').css({
                        position: 'fixed',
                        display: 'block'
                    });
                });
            }
        } else {
            if (fixed) {
                fixed = false;
                $('#to-top').hide("slow", function() {
                    $('#to-top').css({
                        display: 'none'
                    });
                });
            }
        }
    });
    // Disable Google Maps scrolling
    // See http://stackoverflow.com/a/25904582/1607849
    // Disable scroll zooming and bind back the click event
    var onMapMouseleaveHandler = function(event) {
        var that = $(this);
        that.on('click', onMapClickHandler);
        that.off('mouseleave', onMapMouseleaveHandler);
        that.find('iframe').css("pointer-events", "none");
    }
    var onMapClickHandler = function(event) {
            var that = $(this);
            // Disable the click handler until the user leaves the map area
            that.off('click', onMapClickHandler);
            // Enable scrolling zoom
            that.find('iframe').css("pointer-events", "auto");
            // Handle the mouse leave event
            that.on('mouseleave', onMapMouseleaveHandler);
        }
        // Enable map zooming with mouse scroll when the user clicks the map
    $('.map').on('click', onMapClickHandler);

    $(document).on('click', '.panel-heading span.icon_minim', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.removeClass('fa-minus').addClass('fa-plus');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.removeClass('fa-plus').addClass('fa-minus');
        }
    });
    $(document).on('focus', '.panel-footer input.chat_input', function (e) {
        var $this = $(this);
        if ($('#minim_chat_window').hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideDown();
            $('#minim_chat_window').removeClass('panel-collapsed');
            $('#minim_chat_window').removeClass('fa-plus').addClass('fa-minus');
        }
    });
    $(document).on('click', '#new_chat', function (e) {
        var size = $( ".chat-window:last-child" ).css("margin-left");
         size_total = parseInt(size) + 400;
        alert(size_total);
        var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
        clone.css("margin-left", size_total);
    });
    $(document).on('click', '.icon_close', function (e) {
        //$(this).parent().parent().parent().parent().remove();
        $( "#chat_window_1" ).remove();
    }); 
    $(document).on('click', '#btn-chat', function (e) {
        var text = $('#btn-input').val();
        // alert(text);
        if (text != "")
        {
            var msg = $('.msg_container').last().clone();
            msg.find('p').text(text);
            msg.appendTo('.msg_container_base');
            $('#btn-input').val("");
        }
    });

    $(document).on('click', '#strapBtn', function() {
	$('.toast').toast('show');
    });


    $(document).on('click', '#envBtn', function() {
	$('.carousel').slideToggle();
    });

	$(document).on('click', '#consoleBtn', function() {
		$('#consoleModal').modal('show');
		var content = 'Loading... Salient OS Matsuri Laptop Device. Enter login credentials.';
		
		var ele = '<span>' + content.split('').join('</span><span>') + '</span>';

		$(ele).hide().appendTo('#consoleText').each(function (i) {
			$(this).delay(100 * i).css({
				display: 'inline',
				opacity: 0
			}).animate({
				opacity: 1
			}, 100);
		});
	});

	$(document).on('click', '#talkBtn', function() {
		$('#dialogueModal').modal('show');
		var content = "Some smartass once said that ideas are worthless, and he has no idea what he's talking about. Every human thing starts off as an idea, and if you have the palate for believing in God, then everything else started as one of His. Fact is, ideas are like money that anyone can print, that some know how to spend, and that a few even know the value of. And like money, it only has real value in circulation. In fact, this economy of ideas is the only thing keeping our tenuous Atlantis from sinking into a proverbial ocean. No. Far from worthless, ideas are substantial. They even cast shadows. When bathed in the light of truth anyway. And this world is filled with ideas. Full of shadows.";


		var ele = '<span>' + content.split('').join('</span><span>') + '</span>';

		$(ele).hide().appendTo('#dialogueText').each(function (i) {
			$(this).delay(50 * i).css({
				display: 'inline',
				opacity: 0
			}).animate({
				opacity: 1
			}, 50);
		});
	});



jQuery(document).ready(function() {
	$('.toast').toast();
	$('.carousel').slideUp();

	$('.modal').modal({backdrop: 'static', keyboard: false});

	var f = document.getElementById('blink');
	setInterval(function() {
		f.style.display = (f.style.display == 'none' ? '' : 'none');
	}, 400);

	jQuery('.warble').attr('data-text', function() {
  		return jQuery(this).text();
	});
});