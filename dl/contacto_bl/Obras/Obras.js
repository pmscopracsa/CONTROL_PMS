$().ready(function(){
    $(".codigo").autocomplete("../Obras.php",{
        width:260,
        matchContains:true,
        selectFirst:false
    });
});