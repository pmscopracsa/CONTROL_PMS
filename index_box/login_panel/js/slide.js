$(document).ready(function() {
	
    // Expand Panel
    $("#open").click(function(e){
        e.preventDefault();
            $("div#panel").slideDown("slow");

    });	

    // Collapse Panel
    $("#close").click(function(e){
        e.preventDefault();
            $("div#panel").slideUp("slow");	
    });		

    // Switch buttons from "Log In | Register" to "Close Panel" on click
    $("#toggle a").click(function (e) {
        e.preventDefault();
            $("#toggle a").toggle();
    });		
		
});