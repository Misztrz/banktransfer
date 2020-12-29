  $(document).ready(function() {    
  
    //status toggle switch - update info - admin panel
    $("#statuscheck").click(function(){
		if ($("#statuscheck").prop("checked") == true)
		    $("#status").removeAttr("disabled", "disabled");
		else
		    $("#status").attr("disabled", "disabled");
	});
	
	
	// for toast to work
	$('.toast').toast('show');
});




/*Search button for coupons */
$(document).ready(function(){
	
	 $(".myTable").click(function(){
		 $(".update-data-no").val($(this).children('td:eq(0)').text());
		    
		   $.ajax({
                type: "POST",
                url: "../coupons/control.php",	
                data: {session: $(this).children('td:eq(0)').text()},				
		   });
		    
		 for(var i=1; i < 5; i++)
		 {
			 $('.update-data-rest:eq('+ (i-1) +')').val($(this).children('td:eq(' + i +')').text());
		 }
		 
		 location.replace(location.pathname);
		   });
		
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".myTable").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	  });
    });
});