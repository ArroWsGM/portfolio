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
//return user for editing
function getUserAjax(url, token){
	$.ajax({
		url:url,
		headers: {'X-CSRF-TOKEN': token},
		//data:{_token: token},
		type:'POST',
		beforeSend: function(){
		},
		success: function(json){
			//var res = JSON.parse(json);
			//echo(json);
			//echo(token);
			$('#user-edit-form input[name=id]').val(json.id);
			$('#user-edit-form input[name=name]').val(json.name);
			$('#user-edit-form input[name=email]').val(json.email);
			$('#user-edit-modal').modal('show');
		},
		error: function(event, jqxhr, settings, thrownError){
			console.log(event);
			console.log(jqxhr);
			console.log(settings);
			console.log(thrownError);
		}
	});
}
//return project property for editing
function getPropertyAjax(url, token){
	$.ajax({
		url:url,
		headers: {'X-CSRF-TOKEN': token},
		//data:{_token: token},
		type:'POST',
		beforeSend: function(){
			$('#property-edit-modal .alert').remove();
		},
		success: function(json){
			//var res = JSON.parse(json);
			//echo(json);
			//echo(token);
			$('#property-edit-form input[name=id]').val(json.id);
			$('#property-edit-form input[name=property_name]').val(json.property_name);
			$('#property-edit-form input[name=property_class]').val(json.property_class);
			$('#property-edit-form select[name=property_group]').val(json.property_group);
			$('#property-edit-modal').modal('show');
		},
		error: function(event, jqxhr, settings, thrownError){
			console.log(event);
			console.log(jqxhr);
			console.log(settings);
			console.log(thrownError);
		}
	});
}
//update user
function updateUserAjax(data, token){
	$.ajax({
		url:data.url,
		headers: {'X-CSRF-TOKEN': token},
		data: data,
		type:'POST',
		beforeSend: function(){
		},
		success: function(json){
			$('#user-edit-form .form-group').removeClass('has-error');
			$('#user-edit-form .form-group span').remove();
			$('#user-edit-modal .alert').remove();
			$('#user-edit-form .user-password input').val('');

			if(json.success){
				$('#user-edit-modal .modal-body').append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.success+'</div>');
				var row = $('tr[data-id='+data.id+']');
				row.find('.user-name a').html(json.result.name);
				row.find('.user-email a').html(json.result.email);
				row.find('.user-updated_at').html(json.result.updated_at);
			} else {
				$('#user-edit-modal .modal-body').append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.error+'</div>');
			}
		},
		error: function(event, jqxhr, settings, thrownError){
			$('#user-edit-form .form-group').removeClass('has-error');
			$('#user-edit-form .form-group span').remove();
			$('#user-edit-modal .alert').remove();
			if(event.status == 422){
				$.each(event.responseJSON, function(key, value){
					switch(key){
						case 'name':
							$.each(value, function(){
								$('#user-edit-form .user-name').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
						case 'email':
							$.each(value, function(){
								$('#user-edit-form .user-email').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
						case 'password':
							$.each(value, function(){
								$('#user-edit-form .user-password').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
					}
				});
			} else {
				console.log(event);
				console.log(jqxhr);
				console.log(settings);
				console.log(thrownError);
			}
		}
	});
}
//update project property
function updatePropertyAjax(data, token){
	$.ajax({
		url:data.url,
		headers: {'X-CSRF-TOKEN': token},
		data: data,
		type:'POST',
		beforeSend: function(){
		},
		success: function(json){
			$('#property-edit-form .form-group').removeClass('has-error');
			$('#property-edit-form .form-group span').remove();
			$('#property-edit-modal .alert').remove();

			if(json.success){
				$('#property-edit-modal .modal-body').append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.success+'</div>');
				var row = $('tr[data-id='+data.id+']');
				row.find('.property-icon span').attr('class', json.result.property_class);
				row.find('.property-name').html(json.result.property_name);
				row.find('.property-class').html(json.result.property_class);
				row.find('.property-group').html(json.result.property_group);
			} else {
				$('#property-edit-modal .modal-body').append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.error+'</div>');
			}
		},
		error: function(event, jqxhr, settings, thrownError){
			$('#property-edit-form .form-group').removeClass('has-error');
			$('#property-edit-form .form-group span').remove();
			$('#property-edit-modal .alert').remove();
			if(event.status == 422){
				$.each(event.responseJSON, function(key, value){
					switch(key){
						case 'name':
							$.each(value, function(){
								$('#property-edit-form .property-name').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
						case 'email':
							$.each(value, function(){
								$('#property-edit-form .property-class').addClass('has-error').append('<span class="help-block">' + this + '</span>');
							});
							break;
					}
				});
			} else {
				console.log(event);
				console.log(jqxhr);
				console.log(settings);
				console.log(thrownError);
			}
		}
	});
}
//delete project gallery item
function deleteGalleryItemAjax(url, token, item){
	$.ajax({
		url:url,
		headers: {'X-CSRF-TOKEN': token},
		type:'POST',
		beforeSend: function(){
			item.find('.item-error').remove();
		},
		success: function(json){
			if(json.success)
				item.remove();
			else
				$('#ajax-response').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.error+'</div>');
		},
		error: function(event, jqxhr, settings, thrownError){
			console.log(event);
			console.log(jqxhr);
			console.log(settings);
			console.log(thrownError);
		}
	});
}
//edit project: set form field visibility
function setGalleryFields(type){
	switch(type){
		case 'video_embed':
			$('#item-url').hide();
			$('#item-url').find('input[name=item_url]').val('');
			$('#item-alt').find('input[name=item_alt]').val('');
			$('#item-embed').show();
			break;
		case 'video':
			$('#item-url').show();
			$('#item-alt').hide();
			$('#item-alt').find('input[name=item_alt]').val('');
			$('#item-embed').hide();
			$('#item-embed').find('input[name=item_embed]').val('');
			break;
		default:
			$('#item-url').show();
			$('#item-alt').show();
			$('#item-embed').hide();
			$('#item-embed').find('input[name=item_embed]').val('');
	}
}
function setGalleryForm(){
	var val = $('#project-edit-form select[name=item_type]').val();
	setGalleryFields(val);
}
//delete project property
function deleteProjectPropertyAjax(url, token, property_id, item){
	$.ajax({
		url:url,
		headers: {'X-CSRF-TOKEN': token},
		type:'POST',
		beforeSend: function(){
			
		},
		success: function(json){
			if(json.success){
				var html = '<li class="text-center property-add" data-id="' + item.data('property_id')  + '">' + item.html(); + '</li>';
				item.remove();
				$('.all-properties-list').append(html);
			}
			else
				$('#ajax-response').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.error+'</div>');
		},
		error: function(event, jqxhr, settings, thrownError){
			console.log(event);
			console.log(jqxhr);
			console.log(settings);
			console.log(thrownError);
		}
	});
}
//set message status
function setStatusAjax(data, token){
	$.ajax({
		url:data.url,
		data: {id: data.id},
		headers: {'X-CSRF-TOKEN': token},
		type:'POST',
		beforeSend: function(){
			$('#alert-holder').empty();
		},
		success: function(json){
			if(json.success){
				data.node.attr('class', data.class);
				$('#alert-holder').append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.success+'</div>');
			}
			else
				$('#alert-holder').append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+json.error+'</div>');
		},
		error: function(event, jqxhr, settings, thrownError){
			console.log(event);
			console.log(jqxhr);
			console.log(settings);
			console.log(thrownError);
		}
	});
}
/*****************************************
 *	Event listeners
 *****************************************/
//edit user button
$(document).on('click', '.btn-edit', function(e){
	e=e||window.event;
	e.preventDefault();

	var url = $(this).attr('href');
	var token = $(this).data('token');
	if($(this).hasClass('btn-editproperty'))
		getPropertyAjax(url, token);
	else
		getUserAjax(url, token);
});
//update user pop-up button
$(document).on('click', '.btn-update-user', function(){
	var token = $(this).data('token'),
		data = {};

	data.url = $('#user-edit-form').attr('action');	
	data.id = $('#user-edit-form input[name=id]').val();
	data.name = $('#user-edit-form input[name=name]').val();
	data.email = $('#user-edit-form input[name=email]').val();
	data.password = $('#user-edit-form input[name=password]').val();

	updateUserAjax(data, token);
});
//update project properties pop-up button
$(document).on('click', '.btn-update-property', function(){
	var token = $(this).data('token'),
		data = {};

	data.url = $('#property-edit-form').attr('action');	
	data.id = $('#property-edit-form input[name=id]').val();
	data.property_name = $('#property-edit-form input[name=property_name]').val();
	data.property_class = $('#property-edit-form input[name=property_class]').val();
	data.property_group = $('#property-edit-form select[name=property_group]').val();

	updatePropertyAjax(data, token);
});
//edit project
$(document).on('change', '#project-edit-form select[name=item_type]', function(){
	var val = $(this).val();
	setGalleryFields(val);
});
$(window).load(function(){
	$('#gallery .gallery-item').height($('#gallery .gallery-item').width()*10/16);
});
//delete projects gallery item
$(document).on('click', '.gallery-item .btn-delete', function(){
	var token = $('#project-edit-form input[name=_token]').val(),
		url = $(this).data('url'),
		item = $(this).parent('.gallery-item');

	deleteGalleryItemAjax(url, token, item);
});
//delete projects gallery item
$(document).on('click', '.property-add', function(){
	var html = $(this).html(),
	    id = $(this).data('id').toString(),
	    list = $('#properties-toadd'),
	    input = $('input[name=properties_toadd]'),
	    val = input.val();

	if(val == ''){
		input.val(id);
		list.append('<li class="text-center" data-id="' + id + '">' + html + '</li>');
	} else {
		var chunks = val.split(',');
		if($.inArray(id, chunks) >= 0){
			chunks = $.grep(chunks, function(value) {
				return value != id;
			});
			val = chunks.join();
			list.find('li[data-id='+ id +']').remove();
		} else {
			val = chunks.join();
			val = val + ',' + id;
			list.append('<li class="text-center" data-id="' + id + '">' + html + '</li>');
		}
		input.val(val);
	}

});
//delete project property
$(document).on('click', '.project-properties .property-remove', function(){
	var a = confirm('Delete property?');
	if(a){	
		var token = $('#project-edit-form input[name=_token]').val(),
			url = $(this).data('url'),
			property_id = $(this).data('property_id'),
			item = $(this);

		deleteProjectPropertyAjax(url, token, property_id, item);
	} else return false;
});
//change message status
$(document).on('change', '#set-status', function(){
	var token = $('#_token').data('token'),
		data = {};
	data.url = $(this).data('url');
	data.class = $(this).find(':selected').data('class');
	data.id = $(this).val();
	data.node = $(this).parents('tr');

	setStatusAjax(data, token);
});
/*****************************************
 *
 *	AJAX load & errors
 *
 *****************************************/
	$(document).on('ajaxStart', function(){
		$('.loadanimation').show();
	});
	$(document).on('ajaxStop', function(){
		$('.loadanimation').hide();
	});
	$(document).ajaxError(function(event, jqxhr, settings, thrownError){
		console.log(event);
		console.log(jqxhr.responseText);
		console.log(settings);
		console.log(thrownError);
	});
/*****************************************
 *	document ready function
 *****************************************/
$(function(){
	$('[data-toggle="tooltip"]').tooltip();
	setGalleryForm();

	if($('.tinymce-field').length){
		tinymce.init({
		  selector: '.tinymce-field',
		  height: 300,
		  plugins: [
		    'advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code'
		  ],
		  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
		});
	}
});