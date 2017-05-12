function echo(e){}function showChain(e){e.fadeTo("fast",1,function(){$(this).next().length&&showChain($(this).next())})}function viewport(){var e=window,t="inner";return"innerWidth"in window||(t="client",e=document.documentElement||document.body),{width:e[t+"Width"],height:e[t+"Height"]}}function deleteSettingAjax(e,t){$.ajax({url:e,type:"DELETE",beforeSend:function(){},success:function(e){var r=$("tr[data-id="+t+"]"),a=$("#alert-holder");r.remove(),a.html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+e.success+"</div>")},error:function(e,t,r,a){}})}function getUserAjax(e,t){$.ajax({url:e,type:"GET",beforeSend:function(){},success:function(e){$("#user-edit-form").attr("action",t),$("#user-edit-form input[name=id]").val(e.id),$("#user-edit-form input[name=name]").val(e.name),$("#user-edit-form input[name=email]").val(e.email),$("#user-edit-modal").modal("show")},error:function(e,t,r,a){}})}function updateUserAjax(e){$.ajax({url:e.url,data:e,type:"PUT",beforeSend:function(){},success:function(t){if($("#user-edit-form .form-group").removeClass("has-error"),$("#user-edit-form .form-group span").remove(),$("#user-edit-modal .alert").remove(),$("#user-edit-form .user-password input").val(""),t.success){$("#user-edit-modal .modal-body").append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+t.success+"</div>");var r=$("tr[data-id="+e.id+"]");r.find(".user-name a").html(t.result.name),r.find(".user-email a").html(t.result.email),r.find(".user-updated_at").html(t.result.updated_at)}else $("#user-edit-modal .modal-body").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+t.error+"</div>")},error:function(e,t,r,a){$("#user-edit-form .form-group").removeClass("has-error"),$("#user-edit-form .form-group span").remove(),$("#user-edit-modal .alert").remove(),422==e.status&&$.each(e.responseJSON,function(e,t){switch(e){case"name":$.each(t,function(){$("#user-edit-form .user-name").addClass("has-error").append('<span class="help-block">'+this+"</span>")});break;case"email":$.each(t,function(){$("#user-edit-form .user-email").addClass("has-error").append('<span class="help-block">'+this+"</span>")});break;case"password":$.each(t,function(){$("#user-edit-form .user-password").addClass("has-error").append('<span class="help-block">'+this+"</span>")})}})}})}function getPropertyAjax(e,t){$.ajax({url:e,type:"GET",beforeSend:function(){$("#property-edit-modal .alert").remove()},success:function(e){$("#property-edit-form").attr("action",t),$("#property-edit-form input[name=id]").val(e.id),$("#property-edit-form input[name=property_name]").val(e.property_name),$("#property-edit-form input[name=property_class]").val(e.property_class),$("#property-edit-form select[name=property_group]").val(e.property_group),$("#property-edit-modal").modal("show")},error:function(e,t,r,a){}})}function updatePropertyAjax(e){$.ajax({url:e.url,data:e,type:"PUT",beforeSend:function(){},success:function(t){if($("#property-edit-form .form-group").removeClass("has-error"),$("#property-edit-form .form-group span").remove(),$("#property-edit-modal .alert").remove(),t.success){$("#property-edit-modal .modal-body").append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+t.success+"</div>");var r=$("tr[data-id="+e.id+"]");r.find(".property-icon span").attr("class",t.result.property_class),r.find(".property-name").html(t.result.property_name),r.find(".property-class").html(t.result.property_class),r.find(".property-group").html(t.result.property_group)}else $("#property-edit-modal .modal-body").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+t.error+"</div>")},error:function(e,t,r,a){$("#property-edit-form .form-group").removeClass("has-error"),$("#property-edit-form .form-group span").remove(),$("#property-edit-modal .alert").remove(),422==e.status&&$.each(e.responseJSON,function(e,t){switch(e){case"property_name":$.each(t,function(){$("#property-edit-form .property-name").addClass("has-error").append('<span class="help-block">'+this+"</span>")});break;case"property_class":$.each(t,function(){$("#property-edit-form .property-class").addClass("has-error").append('<span class="help-block">'+this+"</span>")})}})}})}function deleteProjectPropertyAjax(e,t,r){$.ajax({url:e,type:"DELETE",beforeSend:function(){},success:function(e){if(e.success){var t='<li class="text-center property-add" data-id="'+r.data("property_id")+'">'+r.html();r.remove(),$(".all-properties-list").append(t)}else $("#ajax-response").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+e.error+"</div>")},error:function(e,t,r,a){}})}function deleteGalleryItemAjax(e,t){$.ajax({url:e,type:"DELETE",beforeSend:function(){t.find(".item-error").remove()},success:function(e){e.success?t.remove():$("#ajax-response").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+e.error+"</div>")},error:function(e,t,r,a){}})}function setGalleryFields(e){switch(e){case"video_embed":$("#item-url").hide(),$("#item-url").find("input[name=item_url]").val(""),$("#item-alt").find("input[name=item_alt]").val(""),$("#item-embed").show();break;case"video":$("#item-url").show(),$("#item-alt").hide(),$("#item-alt").find("input[name=item_alt]").val(""),$("#item-embed").hide(),$("#item-embed").find("input[name=item_embed]").val("");break;default:$("#item-url").show(),$("#item-alt").show(),$("#item-embed").hide(),$("#item-embed").find("input[name=item_embed]").val("")}}function setGalleryForm(){var e=$("#project-edit-form select[name=item_type]").val();setGalleryFields(e)}function setStatusAjax(e){$.ajax({url:e.url,data:{status_id:e.status_id},type:"PUT",beforeSend:function(){$("#alert-holder").empty()},success:function(t){t.success?(e.node.attr("class",e["class"]),$("#alert-holder").append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+t.success+"</div>")):$("#alert-holder").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+t.error+"</div>")},error:function(e,t,r,a){}})}var responseStatus,responseMsg;$(document).on("click",".remove-setting",function(e){e=e||window.event,e.preventDefault();var t=confirm("Delete?");if(!t)return!1;var r=$(this).attr("href"),a=$(this).parents("tr").data("id");deleteSettingAjax(r,a)}),$(document).on("click",".btn-edit",function(e){e=e||window.event,e.preventDefault();var t=$(this).attr("href"),r=$(this).data("action");$(this).hasClass("btn-editproperty")?getPropertyAjax(t,r):getUserAjax(t,r)}),$(document).on("click",".btn-update-user",function(){var e={};e.url=$("#user-edit-form").attr("action"),e.id=$("#user-edit-form input[name=id]").val(),e.name=$("#user-edit-form input[name=name]").val(),e.email=$("#user-edit-form input[name=email]").val(),e.password=$("#user-edit-form input[name=password]").val(),updateUserAjax(e)}),$(document).on("click",".btn-update-property",function(){var e={};e.url=$("#property-edit-form").attr("action"),e.id=$("#property-edit-form input[name=id]").val(),e.property_name=$("#property-edit-form input[name=property_name]").val(),e.property_class=$("#property-edit-form input[name=property_class]").val(),e.property_group=$("#property-edit-form select[name=property_group]").val(),updatePropertyAjax(e)}),$(document).on("submit",".delete-form",function(e){e=e||window.event;var t=confirm("Delete?");if(!t)return e.preventDefault(),!1}),$(document).on("change","#project-edit-form select[name=item_type]",function(){var e=$(this).val();setGalleryFields(e)}),$(window).load(function(){$("#gallery .gallery-item").height(10*$("#gallery .gallery-item").width()/16)}),$(document).on("click",".gallery-item .btn-delete",function(){var e=confirm("Delete property?");if(!e)return!1;var t=$(this).data("url"),r=$(this).parent(".gallery-item");deleteGalleryItemAjax(t,r)}),$(document).on("click",".property-add",function(){var e=$(this).html(),t=$(this).data("id").toString(),r=$("#properties-toadd"),a=$("input[name=properties_toadd]"),s=a.val();if(""==s)a.val(t),r.append('<li class="text-center" data-id="'+t+'">'+e+"</li>");else{var i=s.split(",");$.inArray(t,i)>=0?(i=$.grep(i,function(e){return e!=t}),s=i.join(),r.find("li[data-id="+t+"]").remove()):(s=i.join(),s=s+","+t,r.append('<li class="text-center" data-id="'+t+'">'+e+"</li>")),a.val(s)}}),$(document).on("click",".project-properties .property-remove",function(){var e=confirm("Delete property?");if(!e)return!1;var t=$(this).data("url"),r=$(this).data("property_id"),a=$(this);deleteProjectPropertyAjax(t,r,a)}),$(document).on("change",".set-status",function(){var e={};e.url=$(this).data("url"),e["class"]=$(this).find(":selected").data("class"),e.node=$(this).parents("tr"),e.status_id=$(this).val(),setStatusAjax(e)}),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$(document).on("ajaxStart",function(){$(".loadanimation").show()}),$(document).on("ajaxStop",function(){$(".loadanimation").hide()}),$(document).ajaxError(function(e,t,r,a){}),$(function(){$('[data-toggle="tooltip"]').tooltip(),setGalleryForm(),$(".tinymce-field").length&&tinymce.init({selector:".tinymce-field",width:"auto",height:300,plugins:["advlist autolink lists link image charmap print preview anchor","searchreplace visualblocks code fullscreen","insertdatetime media table contextmenu paste code"],toolbar:"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"})});