jQuery(document).ready(function($) {
	$('.add-taxo').live('click',function() {
		add_taxo_ajax();
		return false;
	});
	
	$('.add-cmf').live('click',function() {
		add_cmf_ajax();
		return false;
	});
	
	$('.remove_row').live('click',function(e) {
	e.preventDefault();
	$(this).parent().parent().css("background-color","#FF3700");
    $(this).parent().parent().fadeOut(400, function(){
            $(this).remove();
        });
    return false;
	});
	
	$("#numberpost").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
	
	function add_taxo_ajax(){
				taxo = $('#pretax').val(); 
				label = $('#prelabel').val();
				text = $('#preall').val();
				hide = $('input[name=pre_hide_empty]:checked').val();
				var tbl = $('#taxo_table tbody > tr:last > td');			
				counter = tbl.find('#taxcounter').val();	
				if(!counter) {counter = 0;}else{ counter++;}
				
				jQuery.ajax({
				 type: 'POST',	 
				 url: ajaxurl,
				 data: ({action : 'adding_taxo_ajax', taxo:taxo,label:label,text:text,hide:hide,counter:counter }),
				 success: function(html) {
				
				 $('#taxo_table').last().append(html);
				taxo = $('#pretax').val(""); 
				label = $('#prelabel').val("");
				text = $('#preall').val("");
				hide = $('input[name=pre_hide_empty]:checked').val("");
				 }
				 });
		}
		
	function add_cmf_ajax() {
		key = $('#precmfkey').val(); 
		metalabel = $('#precmflabel').val(); 
		all = $('#precmfall').val();
		compare = $('#precompare').val(); 
		opt = $('#preopt').val(); 
		var tbl = $('#cmf_table tbody > tr:last > td');			
		cmfcounter = tbl.find('#cmfcounter').val();
		if(!cmfcounter) {cmfcounter = 0;}else{ cmfcounter++;}
		
		jQuery.ajax({
				 type: 'POST',	 
				 url: ajaxurl,
				 data: ({action : 'adding_cmf_ajax', key:key,metalabel:metalabel,all:all,compare:compare,opt:opt,cmfcounter:cmfcounter }),
				 success: function(html) {
			
				$('#cmf_table').last().append(html);
				$('#precmfkey').val(""); 
				$('#precmflabel').val(""); 
				$('#precmfall').val("");
				$('#precompare').val(""); 
				$('#preopt').val(""); 
				
				 }
				 });
		
	}	
	
});  
