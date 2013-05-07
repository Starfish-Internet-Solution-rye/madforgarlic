$(window).load(function(){
	
	
	image_div	= '';
	album_id	= '';
	size_id		= '';
	image_id	= '';
	cke 		= false;
	var editor	= '';
	texteditor = false;
	editor		= '';
	
//-------------------------------------------------------------------------------------------------


//show photo chooser
	$('span.show_photo_chooser,img.show_photo_chooser,a.cke_button__image').live('click',function(){
		
		if($(this).hasClass('cke_button__image')){
			texteditor = true;
			editor = CKEDITOR.currentInstance;
		}
		image_div	= $(this).attr('id');
		image_id	= $(this).closest('div.image_group').find('input').val();
		
		if(image_id != 0)
			$.php('/ajax/image_library/photo_chooser',{image_div:image_div, image_id:image_id});
		else
			$.php('/ajax/image_library/photo_chooser',{image_div:image_div});
		
		php.complete = function(){
			
			album_id	= $('#default_album_id').val();
			size_id		= $('#default_size_id').val();
            
            if(album_id || !image_id){ //check if image id is correct		
            	$('#photo_chooser').show();
            	$('#photo_chooser #images_listing_container .image_holder div.active').scrollToMe();
			}
            else{
			    $('#popUp_background,.imageId_error').fadeIn(function(){
			        $('.popUp_btn').live('click',function(){
			            $('#popUp_background,.imageId_error').fadeOut();
			        });
			    });
			}
			
		};
		
		
	});
	
//-------------------------------------------------------------------------------------------------	
	//album images are shown
	$('#photo_chooser #leftColumn #sideNavigation span').live('click',function(){

		$('#photo_chooser #leftColumn #sideNavigation li.active').removeClass('active');
		$(this).closest('li').addClass('active');
		
		album_id	= $(this).attr('id');
		size_id		= '';
		image_id	= '';
		
		
		loadPhotoChooserImages();

	});
	
//-------------------------------------------------------------------------------------------------	
//album sizes are shown
	$('#photo_chooser_sizes').live('change',function(){

		size_id		= $(this).val();
		image_id	= '';
		
		loadPhotoChooserImages();
	});
	
//-------------------------------------------------------------------------------------------------	
//choose image
	
	$('#photo_chooser #images_listing_container .image_holder').live('click',function(){
		
		$('.image_holder > div.active').removeClass('active');
	    $(this).find('> div').addClass('active');
	    
		image_id	= $(this).attr('id');
		
		$.php('/ajax/image_library/photo_chooser_details', { image_id:image_id });
	});

	$('.chosen_image').live('click',function(){
		image_path	= $(this).attr('data-src');
		image_id	= $(this).attr('id');
		
		if(texteditor)
		{
			image_path = image_path.replace("_thumb","");
			editor.insertHtml('<img src="'+image_path+'" title="'+$(this).attr('data-title')+'" style="width:'+$(this).attr('data-width')+'px; height:'+$(this).attr('data-height')+'px;" alt="'+$(this).attr('data-alt')+'" />');
			texteditor = false;
			
			var dialog = CKEDITOR.dialog.getCurrent();
	    	dialog.hide();
		}

		else{
			if(image_div != ''){
				$("div#"+image_div+" div#img").css({'background-image':'url('+image_path+')'});
				$("div#"+image_div+" input[type=hidden].image_id").val(image_id);
			}
			
		}
		
		$('#photo_chooser').fadeOut(150, function(){
			$('#photo_chooser').html('');
		});
		
		$("div#"+image_div+" div#img").scrollToMe();
		
	});

	$('.close_photo_chooser').live('click',function(){
		
		$('#photo_chooser').fadeOut(150, function(){
			$('#photo_chooser').html('');
		});
	});
	
//-------------------------------------------------------------------------------------------------	
        
    //product actions
    $(".product_actions").click(function(){
        $("#productCategories_action").css({"visibility":"visible"}).slideDown("slow");
        $(".transparent_background").show();
    
    });
    
        $(".transparent_background").click(function(){
            $("#productCategories_action,#available_sizesContainer").slideUp("slow");
            $(".transparent_background").hide();
        });
        
//-------------------------------------------------------------------------------------------------
        //resize leftColumn navigation when it get too long
        var has_images_column = $('#applicationContent').find('#applicationSideBar').attr('id');
        var module = $('body').attr('id');
        var multiplier = 1;
        
        if(module == 'image_library')
        {
        	multiplier = 2;
        }
        
        var left_column_height = (($('#leftColumn #heading:first').outerHeight() * multiplier) + $('#leftColumn #sideNavigation').outerHeight() + 20);
        if(has_images_column == 'applicationSideBar' || module == 'articles' || module == 'products' && has_images_column == 'applicationSideBar' ){
        	if(left_column_height > 600){
        		$('#leftColumn').css({
        			'height':'600px',
        			'overflow':'auto'
        		});
        		$('#nav_list span.nav,#leftColumn #heading,#sideNavigation').css({
        			'width':'279px'
        		});
        	}
        }

//-------------------------------------------------------------------------------------------------
        //Album Rename
        $('.text_container div.fleft span.sprite').live('click',function(){
        	$(this).closest('#album_container').find('.renameAlbum_popUp').fadeIn();
        	$('#popUp_background').fadeIn();
        });
//-------------------------------------------------------------------------------------------------
        //Text Editor Table
        $('.table_dialog span.cancel_table').live('click',function(){
        	$('.table_dialog,#popUp_background').fadeOut();
        });        
      //-------------------------------------------------------------------------------------------     
        
//-------------------------------------------------------------------------------------------------
        //ADD IMAGE       
        $('#add_photos').click(function(){
        	
    		image_counter = ($('#product_photos').children().length) - 1;
    		
    		$('.image_clone > div').clone().attr('id','gallery_image_'+image_counter).appendTo('#product_photos');
    		$('#product_photos').find('#gallery_image_'+image_counter+' span.show_photo_chooser').attr('id','gallery_image_'+image_counter);
    		$('#gallery_image_'+image_counter).find('input.image_id').attr('name','image_id[]');
    		$('#gallery_image_'+image_counter).find('input.gallery_image_id').attr('name','gallery_image_id[]');
    		
    		
    	});
        
      //DELETE IMAGE
        $('span.delete_photo').live('click',function(){
    		$(this).parent().remove();
    	});
//-------------------------------------------------------------------------------------------------
        //Generate url for dialogs
        $('[class*="_dialog"] input[name="title"]').keyup(function(){
        	var url = $(this).val();
        	for(var i = url.length-1; i >=0; i--)
        		url = url.replace(' ','-');
        	$(this).closest('[class*="_dialog"]').find('input[name*="_url"]').val('/'+url.toLowerCase());
        });
        
});



//-------------------------------------------------------------------------------------------------

function loadPhotoChooserImages()
{
		$.php('/ajax/image_library/photo_chooser_images',
			{
				image_div:image_div,
				album_id:album_id,
				size_id:size_id,
				image_id:image_id
			}
		);
		
		$('#photo_chooser div#contentColumn:first').remove();
	
}

//-------------------------------------------------------------------------------------------------

jQuery.fn.extend({
	scrollToMe: function () {
	    var x = jQuery(this).offset().top - 100;
	    jQuery('html,body').animate({scrollTop: x}, 500);
	}});