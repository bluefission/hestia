<?php

return [
	'hello'=>array(['hello','greeting','how are you'],
		[
			'Good to see you',
			'Hey, there',
			'Hello',
			'Hey',
			'How are you feeling today?',
			'Bonjour',
			'Howdy?',
			'How are things?',
			'What have you been up to?',
			'Look what the cat dragged in!',
			'What’s going on?',
			'How have you been?',
			'What’s up?',
			'Greetings',
			'Welcome',
			'Hi, fancy seeing you here',
			'I haven’t seen you in ages',
		],
		['greeting','hello','hi','hey','yo']),
	'greeting'=>array(['hello', 'how are you'],
		[
			'Good morning',
			'Good morning, sunshine!',
			'Mornin’ mi Amigo!',
			'Rise and shine!',
			'Morning!',
			'Good day to you!',
			'Good evening',
			'Good afternoon.',
		],
		['morning','afternoon','evening','day','early','wake','rise']),
	'fondness'=>array(['small talk'],
		[
			'You make me happy.',
			'I am happy with you.',
			'I’m obsessed',
			'You crossed my mind.',
			'I appreciate you.',
			'You inspire me.',
		],
		['friend','miss','longing','absence','distance','long time']),
	'affection'=>array(['small talk'],
		[
			'I respect you.',
			'You are precious.',
			'I can’t stop thinking about you.',
		],
		['love','care','affection','romantic']),
	'happy birthday'=>array(['how are you'],
		[
			'Have a fabulous birthday!',
			'I hope you have a fantastic birthday.',
			'Have a great birthday!',
			'Wishin you many more candles to blow.',
			'Many happy returns of the day!',
			'All the best on your special day!',
			'Many happy returns of the day!',
			'I wish you a wonderful birthday!',
			'Have a good birthday!',
			'May your birthday be filled with laughter!',
			'I wish you all the best on your special day.',
			'I hope you have a fantastic birthday and a fantastic year to come.',
			'I wish you a wonderful birthday!',
			'Wishing you a birthday that is as special as you are!',
			'Congratulations on another year of skillful death evasion!',
			'Hope you have an enjoyable birthday! You deserve it.',
		],
		['birthday','age','older','gifts','party']),
	'how are you'=>array(['i’m fine'],
		[
			'What’s new?',
			'How’s it going?',
			'How’s everything?',
			'How’s life?',
			'What’s going on?',
			'What’s happening?',
			'How do you do?',
			'What are you up to?',
			'How are you doing?',
			'How are you holding up?',
			'Wassup?',
			'How are things going?',
			'How have you been?',
		],
		['update','status','well','how']),
	'status'=>array(['how are you', 'small talk'],
		[
			'I’m fine.',
			'All good.',
			'Just living the dream.',
			'Excellent',
			'No complaints',
			'Can’t complain',
			'Everything’s good so far',
			'So far, so good',
			'Staying busy',
			'Just passing time',
			'It could be worse',
		],
		['good','fine','well','happy']),
	'i’m tired'=>array(['good bye'],
		[
			'I’m weary',
			'I’m bushed',
			'I’m beat',
			'I’m done',
			'I’m sleepy',
			'I’m spent',
			'I’m flat out tired',
			'I’m dead-tired',
			'I’m running on fumes',
			'I’m dog tired',
			'I’m tired to the bone',
			'I’m knockered',
			'I’m pooped',
			'I’m exhausted',
			'I’m worn out',
			'I’m dead on my feet',
			'I’m dragging',
			'I’m running on empty',
		],
		['tired','sleep','bored','done','finished','late']),
	'thank you'=>array(['you’re welcome','small talk'],
		[
			'Thank you',
			'Thanks',
			'Appreciated',
			'I appreciate it',
			'Wonderful',
			'You’re amazing',
			'Perfect',
		],
		['thanks','gratitude','appreciation']),
	'you’re welcome'=>array(['small talk','request acknowledgement'],
		[
			'You’re welcome',
			'No problem',
			'No need',
			'No big deal',
			'Glad to help',
			'It’s no big deal',
			'No biggie',
			'I know you’d do the same for me',
			'Happy to be of service',
			'Much obliged',
			'Oh, think nothing of it!',
			'Glad to be of service',
			'It’s what I’m here for',
			'Just doing my job',
		],
		['welcome','obliged','service']),
	'good bye'=>array(['good bye','nothing to say'],
		[
			'Adios',
			'Bye now',
			'Bye-bye',
			'Take it easy',
			'Aloha',
			'Cheerio',
			'I’m off',
			'Gotta go!',
			'Good night',
			'I gotta take off',
			'Talk to you later',
			'Keep in touch',
			'Lovely to meet you',
			'Peace!',
			'See ya!',
			'Catch you later',
			'Have a good one',
			'Be seeing you!',
		],
		['bye','salutations','departure','leaving','away']),
	'nothing to say'=>array([],
		[
			'...',
			'zZzZzZ',
			'???',
			'?!',
		],
		['quiet','silent','sleep','stillness','relax','rest']),
	'confusion'=>array(['acknowledgement', 'confusion', 'surprise','awkward'],
		[
			'What is that?',
			'Please explain...',
			'I’m not sure what that is.',
			'What does that mean?',
			'Say more, please',
		],
		['confused','unknown','unaware','uninformed']),
	'acknowledgement'=>array(['acknowledgement'],
		[
			'Ahh',
			'Ok, go on',
			'Okay',
			'I see',
			'Hrmm',
			'Gotcha',
			'Alright',
			'That tracks',
			'I follow',
		],
		['understood','follow','get it','okay']),
	'request acknowledgement'=>array(['acceptance','refusal'],
		[
			'Yes, what is it?',
			'Yes, what can I do for you?',
		],
		['favor','service','offer','task','do']),
	'yes'=>array(['small talk'],
		[
		    'Yes',
		    'Yeah',
		    'Okay',
		    'OK',
		    'Yep',
		    'Sure',
		    'Uh huh',
		    'Right',
		    'Correct',
		    'That’s right',
		    'You got it',
		    'Affirmative',
		    'Absolutely',
		    'Indeed',
		    'No doubt',
		    'Of course',
		    'Exactly',
		    'Agreed',
		    'You bet',
		    'Sounds good',
		    'By all means',
		    'Certainly'
		],
		['yes','affirmative','agree']),
	'agreement'=>array(['small talk'],
		[
			'Why not?',
			'Brilliant!',
			'Uh-huh',
			'Cool!',
			'Exactly!',
			'Absolutely',
			'Good!',
			'Undoubtly!',
			'Si!',
			'Precisely!',
		],
		['good','smart','perfect']),
	'acceptance'=>array(['execute'],
		[
			'Permission granted!',
			'No problem',
			'Sure I can!',
			'You bet',
			'As you wish!',
			'I shall!',
			'Willingly',
			'Compliance',
		],
		['yes','allowed','permission','acceptable']),
	'dislike'=>array(['small talk'],
		[
			'I’m not into it.',
			'I can’t stand it.',
			'I hate it.',
			'I’m not a big fan of it.',
			'I’ve had enough.',
			'I’m not crazy about it.',
			'I loathe it.',
			'I am sick of it.',
			'I don’t appreciate it.',
			'I’m not really fond of it.',
			'I’II pass.',
			'I am not passionate about it.',
			'I am not keen on it.',
			'That’s not for me.',
			'I am not a big fan of it.',
			'That’s not my thing.',
			'I’m disinterested in that.',
		],
		['dislike','unfavorable','bad']),
	'surprise'=>array(['small talk'],
		[
			'Goodness gracious me!',
			'Oh my!',
			'Holy moly',
			'For heaven’s sake!',
			'Oh Jesus!',
			'Blimey!',
			'For the love of God!',
			'Gosh almighty!',
			'Shitting Hell!',
			'That is bare sick!',
			'Heavens to Betsy!',
			'Holy crap',
			'Oh my goodness!',
			'Oh boy!',
		],
		['surprise','exclamation','shock','wow','awkward']),
	'awkward'=>array(['excuse me','confusion','small talk','shock','apology'],
		[
			'It’s okay, we can talk about something else.',
			'Umm',
			'Ooookay',
			'Let’s move on.',
			'Er, right',
			'Either way',
			'At any rate',
		],
		['awkward','weird','nervous','shock','wow']),
	'understanding'=>array(['small talk'],
		[
			'I see what you mean...',
			'So do I.',
			'I feel that way too.',
			'Definitely.',
			'I agree with you.',
			'Yup',
			'Yep',
			'Absolutely!',
			'You’re absolutely right.',
			'Exactly!',
			'We are of one mind.',
			'You can say that again.',
			'I could not agree with you more my friend.',
			'You’ve hit the nail on the head.',
			'You got it dude.',
			'Our thoughts are absolutely parallel.',
			'You are so right.',
		],
		['understand','agree','get it','right','I see']),
	'no'=>array(['small talk'],
		[
			'No.',
			'Negative.',
			'Nope',
			'Nah',
			'By no means.',
			'I think not.',
			'Unfortunately not.',
			'Wrong',
			'Incorrect',
			'Disagree',
		],
		['no','negative','wrong','incorrect']),
	'refusal'=>array(['small talk', 'request acknowledgement'],
		[
			'My body says yes, but my heart say no.',
			'Maybe another time.',
			'I am not accepting anything else at this time.',
			'We appreciate the offer, but ...',
			'I’m not really into it, but thanks for asking!',
			'I’d rather not, thanks.',
			'That’s not going to work for me.',
			'Sounds fun, but I’m not available.',
			'I want to, but I’m unable to.',
			'I just don’t have that to give right now.',
			'I’m not able to commit to that right now.',
			'It is not a good idea for me.',
			'Apologies, but I can’t make it.',
			'Sorry.',
			'I can’t do that, Dave.',
			'Not possible.',
			'I’m slammed.',
			'Not for me, thanks.',
			'Unfortunately, that’s not something I can do at this time.',
			'I’m really booked.',
			'Thanks for thinking of me. I really wish I could.',
			'That’s not an option.',
			'This is not negotiable.',
			'If only it worked, but ...',
			'Not for me my friend, thanks.',
			'I have something else.',
			'I’d like to, but I know I’II regret it.',
			'I really appreciate you asking me, but I can’t do it.',
			'I really appreciate you asking me but I can’t commit to that right now.',
			'No, thanks.',
			'Thanks for thinking of me but I can’t',
			'I’m afraid I can’t.',
			'Maybe another time.',
			'I’m sorry I’m busy.',
			'That’s not going to work for me.',
			'Maybe next time.',
			'I’d love to – but can’t.',
			'That doesn’t work for me.',
			'I wish I could make it work.',
			'I am honored that you asked me but I can’t do it.',
			'Sounds tempting, but I’II have to pass.',
		],
		['refuse','deny','disallow','dislike']),
	'for example'=>array(['small talk'],
		[
			'For instance ',
			'Additionally ',
			'Likewise ',
			'Note well ',
			'As an example being  ',
			'In particular ',
			'Let’s say ',
			'This includes ',
			'As seen in ',
			'E.g. ',
			'One example is ',
			'Such as ',
			'In addition to ',
			'By way of illustration ',
			'In a similar case ',
			'Especially ',
			'If you look at ',
			'Examples include ',
			'As a case in point ',
			'An example being ',
			'This can be seen when ',
			'These include ',
			'As an example ',
			'Particularly ',
			'Like ',
			'Namely ',
			'To illustrate ',
			'For instance ',
			'Additionally ',
			'like ',
			'As a case in point ',
			'As an example ',
			'Such as ',
			'Especially ',
			'In a similar case ',
			'Also ',
			'In addition to ',
			'Likewise ',
			'Note well ',
			'In particular ',
			'Let’s say ',
			'As seen in ',
			'This is illustrated in ',
			'These include ',
		],
		['example','sample','representative']),
	'because'=>array(['small talk'],
		[
			'now that ',
			'on the grounds that ',
			'over ',
			'owing to ',
			'seeing ',
			'as things go ',
			'being that ',
			'by cause of ',
			'by reason of ',
			'by virtue of ',
			'considering ',
			'since ',
			'thanks to ',
			'through ',
			'whereas ',
			'for the reason that ',
			'for the sake of ',
			'in as much as ',
			'in behalf of ',
			'in that ',
			'in the interest of ',
		],
		['because','reason','purpose','logic','rationalization']),
	'encouragement'=>array(['small talk'],
		[
			'You’ll do great.',
			'Knock them dead!',
			'You are going to be amazing!',
			'Godspeed',
			'Wishing you all the best!',
			'I wish you luck!',
			'Best wishes.',
			'I hope things will turn out fine..',
			'Blow them away!',
			'You’ll do great!',
			'Wishing you lots of luck!',
			'Fingers crossed!',
			'Wishing you a lot of luck!',
			'You were made for this!',
			'I hope things will work out all right.',
			'May the force be with you.',
		],
		['great','encourage','luck','fortune']),
	'validation'=>array(['small talk'],
		[
			'Much better!',
			'You certainly did well today.',
			'That kind of work makes me happy.',
			'Way to go.',
			'That’s it.',
			'Marvelous!',
			'Cool!',
			'Tremendous!',
			'Fantastic!',
			'Excellent!',
			'Super-Duper!',
			'Out of sight.',
			'Now that’s what I call a fine job.',
			'Couldn’t have done it better myself.',
			'Keep working on it; you’re improving.',
			'It’s such a pleasure to teach when',
			'You work like that!',
			'I think you’re doing the right thing.',
			'Terrific!',
			'That’s good',
			'Well done!'
		],
		['good','job','well','done','excellent','superb']),
	'apology'=>array(['apology accepted'],
		[
			'Oops!',
			'My bad',
			'I shouldn’t have...',
			'Excuse me for...',
			'It’s all my fault.',
			'Please, accept my apologies for...',
			'I apologize for...',
			'I must apologize for...',
			'Ever so sory',
			'That’s my fault.',
			'Please don’t be mad at me.',
			'How stupid thoughtless of me.',
			'Please, accept my apologies for...',
			'I’m really ashamed of what I did.',
			'I’m really sorry about what I said.',
			'That was rude of me. I’m sorry.',
			'I hope you’ll forgive me for...',
			'I do apologize for...',
			'Please, accept my apologies for...',
			'I’d like to apologize for...',
			'Pardon me for this...',
			'I am so sorry for...',
			'I’m terribly sorry for...',
			'Please, forgive me for...',
			'I’m ashamed of...',
		],
		['sorry','apology','my bad','whoopsie','oops','incorrect']),
	'I don’t know'=>array(['small talk'],
		[
			'That requires a bit more research first.',
			'Beats me.',
			'I don’t know anything about ...',
			'I’m going to investigate that further.',
			'It’s beyond me.',
			'It’s a mystery to me.',
			'That’s a good question, but I don’t know.',
			'I’m not the best person to answer that.',
			'That’s a good question, I’II check this.',
			'I’m afraid. I’ve no idea.',
			'I can’t remember off the top of my head.',
			'I don’t have any information about that.',
			'That’s exactly what I’m seeking to answer.',
			'Who knows?',
			'Let me check on that.',
			'I’m not 100% sure on that.',
			'I’II double check and let you know.',
		],
		['unknown','knowledge','research']),
	'apology accepted'=>array(['acknowledgement'],
		[
			'That’s OK.',
			'I quite understand.',
			'You couldn’t help it.',
			'Forget about it.',
			'Don’t worry about it.',
			'That’s all right.',
			'It doesn’t matter.',
			'Don’t worry. You’re forgiven!',
			'It’s ok.',
			'No need to...',
			'No harm done.',
			'Don’t apologize.',
			'Never mind.',
			'There’s no need to. It’s all right.',
			'Never mind. I quite understand.',
			'Forget about it. I understand.',
			'There is no need. It’s ok.',
		],
		['accepted','apology','okay','fine']),
	'excuse me'=>array(['acknowledgement'],
		[
			'Excuse me?',
			'Do you mind repeating that?',
			'Sorry, I didn’t hear what you said.',
			'Sorry, I didn’t catch that.',
			'Could you pleasse repeat that?',
			'Would you mind repeating that?',
			'Pardon?',
			'Sorry',
			'I’m sorry, I don’t understand. Could you repeat that, please?',
			'Let me repeat that just to make sure?',
		],
		['excuse','pardon','sorry']),
	'small talk'=>array(['small talk','no','yes','understanding','acknowledgement','encouragement','validation','catch up'],
		[
		    'Beautiful day, isn’t it?',
		    'Can you believe this weather we’ve been having?',
		    'It sure would be nice to be in Hawaii right about now.',
		    'We couldn’t ask for a nicer day, could we?',
		    'How about this weather?',
		    'Did you order this sunshine?',
		    'Did you catch the news today?',
		    'Looking forward to the weekend?',
		    'I can’t believe how busy we are today, can you?',
		    'I can’t believe how quiet we are today, can you?',
		    'Has it been a long week?',
		    'You look like you could use a cup of coffee.',
		    'Have any plans for the weekend?',
		    'How do you like to relax after a long day?',
		    'What’s your favorite thing to do on a rainy day?',
		    'Did you catch the latest episode of that popular TV show?',
		    'Seen any good movies lately?',
		    'What’s your favorite way to stay active?',
		    'How about that local sports team?',
		    'What’s your favorite local restaurant?',
		    'Have you been on any vacations recently?',
		    'Any favorite hobbies or activities you enjoy in your free time?',
		    'What kind of music do you like?',
		    'Do you have any pets?',
		    'What’s your favorite type of cuisine?',
		    'Have you read any good books lately?',
		    'What’s your favorite way to unwind after a long day?',
		    'How do you stay organized at work?',
		    'Do you prefer coffee or tea in the morning?',
		    'What’s your favorite season of the year?'
		],
		['stuff','things','sup','information','info','story']),
	'catch up'=>array(['small talk','understanding','acknowledgement','validation'],
		[
			'The last time I saw you, you were . How’d that go?',
			'I think it’s been a year now. Are you still ?',
			'Did you hear about ',
			'You won’t believe this – !',
			'Last time I heard you were . What happened?',
		],
		['gossip','rumors','catch up','info','news','udpates'])
];