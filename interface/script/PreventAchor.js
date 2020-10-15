jQuery(document).ready(function($){
    $("a").click(function(event){
        link=$(this).attr("href");
        $.ajax({
            url: link,
        })
        .done(function(html) {
            $("#content").empty().append(html);
        })
        .fail(function() {
            console.log("error prevent.");
        })
        .always(function(){
            console.log("complete prevent.");
        });
        return false;
    });
});