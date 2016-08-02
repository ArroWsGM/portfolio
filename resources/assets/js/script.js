/*
 * console.log();
 */
function echo(string){
	console.log(string);
}
////////////////////////////////////////////////////////////////////////

/*****************************************
 *	Global variables
 *****************************************/
var hashTagActive = '';
var mainBlockSizeMult = 1.75, blocked = false;
var div = {}, touchtar;
var loadedProject;
/* mobile detector */
var isMobile = {
	Android: function() {
		return navigator.userAgent.match(/Android/i);
	},
	BlackBerry: function() {
		return navigator.userAgent.match(/BlackBerry/i);
	},
	iOS: function() {
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
	Opera: function() {
		return navigator.userAgent.match(/Opera Mini/i);
	},
	Windows: function() {
		return navigator.userAgent.match(/IEMobile/i);
	},
	NokiaBrowser: function() {
		return navigator.userAgent.match(/NokiaBrowser/i);
	},
	any: function() {
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows() || isMobile.NokiaBrowser());
	}
};
/*****************************************
 *	Functions
 *****************************************/
 //chain fadeTo animation
function showChain(elem){
	elem.fadeTo('fast', 1, function(){
		$(this).next().length && showChain($(this).next());
	});
}
//return cross-browser window width & height
function viewport() {
	var e = window, a = 'inner';
	if (!('innerWidth' in window)) {
		a = 'client';
		e = document.documentElement || document.body;
	}
	return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}
function isPortrait(img){
	if(img == undefined)
		return viewport().width<=viewport().height ? true : false;
	else
		return img[0].naturalHeight>=img[0].naturalWidth;
}
function rotate(dir){
	if(blocked) return;
	
	var slide = $('.carousel-item');
	var slideWidth = slide.eq(0).width();
	var margin1, margin2;
	var baseFontSize = 1;
	
	if(isMobile.any() && !isPortrait() && viewport().width<768){
		margin1 = '28%';
		margin2 = '35%';
	}
	else if(isMobile.any() && isPortrait() && viewport().width<768){
		margin1 = '6%';
		margin2 = '30%';
	}
	else{
		margin1 = '37.75%';
		margin2 = '26%';
	}
	
	blocked = true;
	slide.attr('style', '');
	
	if(dir=='next'){
		slide.eq(0).animate({
			left: margin1,
			width: slideWidth*mainBlockSizeMult,
			height: slideWidth*mainBlockSizeMult,
			zIndex: 2,
			fontSize: (baseFontSize*1.9)+'em',
		}, {
			step: function(now, fx){
				if (fx.prop == 'zIndex')
					if (now>1.5) $(this).css('zIndex', 2);
			}
		});
		slide.eq(1).animate({
			left: margin2,
			width: slideWidth,
			height: slideWidth,
			zIndex: 1,
			fontSize: baseFontSize+'em'
		}, {
			step: function(now, fx){
				if (fx.prop == 'zIndex')
					if (now<1.5) $(this).css('zIndex', 1);
					//echo(fx);
			},
			complete: function(){
				slide.attr('style', '');
				slide.last().prependTo(slide.parent());
			}
		});
		slide.eq(2).css('zIndex', 0).animate({
			right: '50%',
			width: slideWidth/2,
			height: slideWidth/2,
			fontSize: (baseFontSize/1.9)+'em'
		}, {
			complete: function(){
				slide.attr('style', '');
			}
		});
		slide.last().css('zIndex', 0).animate({
			right: margin2,
			width: slideWidth,
			height: slideWidth,
			fontSize: baseFontSize+'em'
		}, {
			complete: function(){
				slide.attr('style', '');
				blocked = false;
			}
		});
	}
	else{
		slide.eq(3).css('zIndex', 0).animate({
			left: margin2,
			width: slideWidth,
			height: slideWidth,
			fontSize: baseFontSize+'em'
		}, {
			complete: function(){
				slide.attr('style', '');
			}
		});
		slide.eq(2).animate({
			right: margin1,
			width: slideWidth*mainBlockSizeMult,
			height: slideWidth*mainBlockSizeMult,
			zIndex: 2,
			fontSize: (baseFontSize*1.9)+'em'
		}, {
			step: function(now, fx){
				if (fx.prop == 'zIndex')
					if (now>1.5) $(this).css('zIndex', 2);
			}
		});
		slide.eq(1).animate({
			right: margin2,
			width: slideWidth,
			height: slideWidth,
			zIndex: 1,
			fontSize: baseFontSize+'em'
		}, {
			step: function(now, fx){
				if (fx.prop == 'zIndex')
					if (now<1.5) $(this).css('zIndex', 1);
					//echo(fx);
			},
			complete: function(){
				slide.attr('style', '');
				slide.first().appendTo(slide.parent());
			}
		});
		slide.eq(0).css('zIndex', 0).animate({
			left: '50%',
			width: slideWidth/2,
			height: slideWidth/2,
			fontSize: (baseFontSize/1.9)+'em'
		}, {
			complete: function(){
				slide.attr('style', '');
				blocked = false;
			}
		});
	}
}
//return project
function getProjectAjax(url, token){
	$.ajax({
		url:url,
		//headers: {'X-CSRF-TOKEN': token},
		//data:{_token: token},
		type:'GET',
		beforeSend: function(){
			$('#project').empty();
		},
		success: function(json){
			if(json.success){
				$('#project').html(json.success).fadeIn();
				$('#gallery').height($('#gallery').width()/1.6);
			} else {
				echo(json.error);
			}
		},
		error: function(event, jqxhr, settings, thrownError){
			console.log(event);
			console.log(jqxhr);
			console.log(settings);
			console.log(thrownError);
			console.log(event.responseText);
		}
	});
}
//show project
function showProject(url){
	$('body').css('overflow', 'hidden');
	
	var projectId = url.split('/').pop(),
		token = $('#_token').data('token');

	if(projectId == loadedProject)
		$('#project').fadeIn();
	else{
		getProjectAjax(url, token);
		loadedProject = projectId;
	}
}
//project gallery
function changeImg(dir){
	var img = $('#gallery img'),
		current = img.filter('.active'),//.index();
		index = current.index(),
		next;
	if(dir == 'next'){
		if((index+1) < img.length){
			next = img.eq(index+1);
		} else {
			next = img.eq(0);
		}
	} else {
		if((index) == 0){
			next = img.eq(img.length-1);
		} else {
			next = img.eq(index-1);
		}
	}
	current.animate({
		'opacity': 0
	}, function(){
		current.removeClass('active').css('opacity', '');
		next.addClass('active').css('opacity', '');
	});
	next.animate('opacity', 100)
	//echo(img);
	//echo(current);
	//echo(index);
}

//send message
function sendMessageAjax(data, token){
	$.ajax({
		url:data.url,
		//headers: {'X-CSRF-TOKEN': token},
		data: data,
		type:'POST',
		beforeSend: function(){
			$('#message-form .form-group').removeClass('has-error');
			$('#message-form .form-group span').remove();
			$('#message-form .alert-holder .alert').remove();
		},
		success: function(json){
			if(json.success){
				$('#message-form .alert-holder').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.success+'</div>');
				$('#message-form input, #message-form textarea').val('');
			} else {
				$('#message-form .alert-holder').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.error+'</div>');
			}
		},
		error: function(event, jqxhr, settings, thrownError){
			if(event.status == 422){
				$.each(event.responseJSON, function(key, value){
					switch(key){
						case 'name':
							$.each(value, function(){
								$('#name').parents('.form-group').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
						case 'email':
							$.each(value, function(){
								$('#email').parents('.form-group').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
						case 'subject':
							$.each(value, function(){
								$('#subject').parents('.form-group').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
						case 'phone':
							$.each(value, function(){
								$('#phone').parents('.form-group').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
						case 'message':
							$.each(value, function(){
								$('#message').parents('.form-group').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
					}
				});
			} else {
				console.log(event);
				console.log(jqxhr);
				console.log(settings);
				console.log(thrownError);
				console.log(event.responseText);
			}
		}
	});
}
/*****************************************
 *	Event listeners
 *****************************************/
$(document).on('submit', '#message-form', function(e){
	e = e||window.event;
	e.preventDefault();
	var data = {},
		token = $('#_token').data('token');

	data.url = $(this).attr('action');
	data.name = $('#name').val();
	data.subject = $('#subject').val();
	data.email = $('#email').val();
	data.phone = $('#phone').val();
	data.message = $('#message').val();

	//echo(data);
	//echo(token);

	sendMessageAjax(data, token);
});
$(document).on('click', '#carousel .control', function(e){
	e=e||window.event;
	e.preventDefault();
	e.stopImmediatePropagation();
	if($(this).hasClass('next')){
		rotate('next');
	}
	else{
		rotate('prev');
	}
});
$(document).on('click', '.carousel-item:first-child', function(){
	rotate('next');
});
$(document).on('click', '.carousel-item:nth-child(3)', function(){
	rotate('prev');
});
$(document).on('click', '.carousel-item:nth-child(2)', function(){
	var url = $(this).data('url');
	showProject(url);
});
$(document).on('touchstart', '.carousel', function(e){
	e=e||window.event;
	e.preventDefault();
	e.stopImmediatePropagation();
	try{
		touchtar=$(e.target);
	}catch(err){
		touchtar=$(e.srcElement);
	}
	
	var touch = e.originalEvent.targetTouches[0];
	//div = {touchstartX: undefined, touchendX: undefined};
	div.touchstartX = undefined;
	div.touchendX = undefined;
	div.touchstartY = undefined;
	div.touchendY = undefined;
	div = this;
	
	//Сохраняем координаты объекта и курсора перед началом движения
	div.touchstartX = touch.pageX;
	div.touchstartY = touch.pageY;
	
	$(document).on('touchmove', '.carousel', function(e){
		e=e||window.event;
		var touch=e.originalEvent.targetTouches[0];
		div.touchendX = touch.pageX;
		div.touchendY = touch.pageY;
	});
})
.on('touchend', '.carousel', function(e){
	e=e||window.event;
	e.preventDefault();
	e.stopImmediatePropagation();
	var dir;
	var x=div.touchendX-div.touchstartX;
	var y=div.touchendY-div.touchstartY;
	if(Math.max(Math.abs(x), Math.abs(y))>40){
		if(Math.abs(x)>Math.abs(y))
			dir=(x<0)?'left':'right';
		else
			dir=(y<0)?'up':'down';
		if(dir == 'left')
			rotate('prev');
		else if(dir == 'right')
			rotate('next');
		else
		$('html,body').animate({
			scrollTop: -y
		}, 'fast');
	}
	else{
		if(touchtar.parents('.control').length)
			(touchtar.parents('.control').hasClass('prev')) ? rotate('prev') : rotate('next');
		else if(touchtar.hasClass('close-button')){
			var target = $($(this).data('target'));
			target.fadeOut(function(){$('body').css('overflow', 'auto')});
		} else if(touchtar.parents('.close-button').length) {
			var target = $(touchtar.parents('.close-button').data('target'));
			target.fadeOut(function(){$('body').css('overflow', 'auto')});
		} else if(touchtar.parents('.carousel-item').length)
			switch(touchtar.parents('.carousel-item').index()){
				case 0: rotate('next'); break;
				case 1:
					var url = touchtar.parents('.carousel-item').data('url');
					showProject(url);
					break;
				case 2: rotate('prev'); break;
				default: return false;
			}
	}
});
$(document).on('click', '.btn-popup', function(){
	var target = $($(this).data('target'));
	target.fadeIn();
});

/* Popup */
$(document).on('click', '.close-button', function(){
	var target = $($(this).data('target'));
	target.fadeOut(function(){$('body').css('overflow', 'auto')});
	$('.img-popover').click();
});
$(document).on('click', '.popup', function(e){
	e=e||window.event;
	try{
		tar=e.target;
	}catch(err){
		tar=e.srcElement;
	}
	
	if($(tar).parents('.popup-child').length) return;
	if($(tar).hasClass('popup-child')) return;
	
	$(this).fadeOut(function(){$('body').css('overflow', 'auto')});
	$('.img-popover').click();
});
$(document).on('click', '#gallery .control', function(e){
	e=e||window.event;
	e.preventDefault();
	e.stopImmediatePropagation();
	if($(this).hasClass('next')){
		changeImg('next');
	}
	else{
		changeImg('prev');
	}
});
$(document).on('click', '#gallery img', function(){
	if(isMobile.any()) return false;
	var target = $(this).parent('#gallery').find('img.active').data('target');
	if(target){
		$('.loadanimation').show();
		var img = $('<img class="img-popover">').attr('src', target)
		    .on('load', function(){
		        if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
					$('.loadanimation').hide();
		            alert('Image loading fail');
		        } else {
		        	if(!isPortrait() && !isPortrait(img)){
		        		if(img[0].naturalWidth/img[0].naturalHeight < 1.6){
			        		img.width(viewport().width*.6);
			        		img.css('left', viewport().width*.2);
		        		} else {
			        		img.width(viewport().width*.8);
			        		img.css('left', viewport().width*.1);
		        		}
		        	} else if(!isPortrait() && isPortrait(img)){
		        		img.height(viewport().height*.9);
		        		img.css('top', viewport().height*.05);
		        		img.width('auto');
		        		img.css('right', 0);
		        	}
		            $('body').append(img);
					$('.loadanimation').hide();
		        }
		    });
	}
});
$(document).on('click', '.img-popover', function(){
	$(this).remove();
});
$(document).on('click', '.btn-play', function(e){
	e=e||window.event;
	e.stopImmediatePropagation();
	
	var video = $($(this).data('target'));
	$(this).parent('.play').hide();
	video[0].play();
});
$(document).on('click', 'video', function(e){
	e=e||window.event;
	e.stopImmediatePropagation();
	
	$(this)[0].paused ? $(this)[0].play() : $(this)[0].pause();
});
$(window).load(function(){
	$('.loadanimation').hide();
});
/***********************
 ***********************
 *	AJAX load & errors *
 ***********************
 ***********************/
	$(document).on('ajaxStart', function(){
		$('.loadanimation').show();
	});
	$(document).on('ajaxStop', function(){
		$('.loadanimation').hide();
	});
	// $(document).ajaxError(function(event, jqxhr, settings, thrownError){
	// 	//console.log(event);
	// 	//console.log(jqxhr.responseText);
	// 	//console.log(settings);
	// 	//console.log(thrownError);
	// 	console.log(event.responseText);
	// });
/*****************************************
 *	document ready function
 *****************************************/
$(function(){
	//echo(isPortrait());
	$('[data-toggle="tooltip"]').tooltip();
	$('#phone').inputmask("+380(99)999-99-99");
});