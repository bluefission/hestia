    $(document).on('click', '#strapBtn', function() {
        strap = new Strap();
        strap.clear();
        strap.open();
        strap.type("1 Notifiation from Cubiqle");
    });

    $(document).on('click', '#handheldBtn', function() {
        handheld = new Handheld();
        handheld.clear();
        handheld.open();
        handheld.type('handheldContent1', "Testing...", 100);
    });


    $(document).on('click', '#envBtn', function() {
    	$('.carousel').slideToggle();
    });

	$(document).on('click', '#consoleBtn', function() {
        laptop = new Console();
        laptop.clear();
        laptop.open();
        laptop.type('consoleContent1', "Loading... Salient OS Matsuri Laptop Device. Enter login credentials.", 100);
	});

	$(document).on('click', '#talkBtn', function() {

        dialogue = new Dialogue();
        dialogue.clear();
        dialogue.open();
        dialogue.add('<div style="width:30%;display:inline-block;">'+
                            '<div class="mmry-ln">'+
                                '<div class="grid">'+
                                    '<div class="grid__item">'+
                                        '<div class="glitch glitch--style-1">'+
                                            '<div class="glitch__img"></div>'+
                                            '<div class="glitch__img"></div>'+
                                            '<div class="glitch__img"></div>'+
                                            '<div class="glitch__img"></div>'+
                                            '<div class="glitch__img"></div>'+
                                        '</div>'+
                                        '<h2 class="grid__item-title">The Freelancer<span class="glitch-in">//coder</span></h2>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>');
        dialogue.type('dialogueContent1', "Some smartass once said that ideas are worthless, and he has no idea what he's talking about. Every human thing starts off as an idea, and if you have the palate for believing in God, then everything else started as one of His. Fact is, ideas are like money that anyone can print, that some know how to spend, and that a few even know the value of. And like money, it only has real value in circulation. In fact, this economy of ideas is the only thing keeping our tenuous Atlantis from sinking into a proverbial ocean. No. Far from worthless, ideas are substantial. They even cast shadows. When bathed in the light of truth anyway. And this world is filled with ideas. Full of shadows.",
         50);
	});

