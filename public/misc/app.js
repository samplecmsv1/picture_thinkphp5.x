$(function(){
	$('.fa-upload,.fa-plus,.fa-list').addClass('fa-2x');
	$("img.lazy").lazyload({
	    effect : "fadeIn"
	});
  
	ajaxForm('.ajaxform');   
	$('.remove').click(function(){
		$('#myModalRemove #myModalRemoveLink').attr('href',$(this).attr('href'));
		$('#myModalRemove').modal();
		return false;
	});
	$('.flash').fadeOut(3000);
	
});

 
  
function ajaxForm(){
	var id = arguments[0] ? arguments[0] : 1;
    var fun = arguments[1] ? arguments[1] : 2; 
	if($(id)[0]){  
		$(id).ajaxForm({ 
				dataType:'json',
			    success:function(d){ 
			    	if(d.label){
			    		$('#myModal .modal-title').html(d.label);
			    	}
		    		if(d.msg){
			    		$('#myModal .modal-body').html(d.msg);
			    	}
		    		$('#myModal .modal-header').removeClass('alert-danger')
		    			.removeClass('alert-success');
			    	if(d.status){
			    		if(typeof(fun)=='function'){
							fun(d);
						} 
			    		$('#myModal .modal-header').addClass('alert-success');
			    		
			    		$('#myModal').modal();
			    		setTimeout(function(){
			    			$('#myModal').modal('hide');
			    		},3000);
			    		if(d.url){
			    			window.location.href = d.url;
			    		}
 			    		return true;
			    	}else{
			    		
			    		$('#myModal .modal-header').addClass('alert-danger');
			    		$('#myModal').modal();
			    		setTimeout(function(){
			    			$('#myModal').modal('hide');
			    		},3000);
  			    		return false; 
			    	}
			    } 
		});
	}

}


function autocomplate(ele,url){
	$(ele).autocomplete({
		source: function( request, response ) {
	        $.ajax({
	          url: url,
	          dataType: "jsonp",
	          data: {
	            q: request.term
	          },
	          success: function( data ) {
	            response(data);
	          }
	        });
	      },
	      minLength: 1,
	      select: function( event, ui ) {
		      $('#user2').val(ui.item.key);
	      }
	});
}
