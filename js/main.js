///@author: jvhti@hotmail.com

if (typeof jQuery === 'undefined') {
    throw new Error('Main requer jQuery');
}
/*
var loadedPage = "";
var loadedPageItem = null;

function openButDontActive(url){
    $(loadedPageItem).removeClass('active');
    loadedPageItem = null;
    loadedPage = "";
    loadContent(url);
}
function loadContent(curl){
    $.ajax({
        url: curl,
        cache: false,
        complete: function(t){ 
            //console.log("Response: "+t);
            $('#content').html(t.responseText);
        }
    });
}

$( document ).ready(function() {
    $('li.openContent > a').each(function(){
        if($(this).attr('default') != null && $(this).attr('default') == 'true'){
            loadContent($(this).attr('href'));
            loadedPageItem = $(this).parent();
            if(!$(this).parent().hasClass('active'))
                $(this).parent().addClass('active');
        }
        $(this).on('click', function(e){
            e.preventDefault();
            // console.log("Abrindo: "+$(this).attr('href'));
            var url = $(this).attr('href');
            if(loadedPage != url && url != "#"){
                loadContent(url);
                if(loadedPageItem != null)
                    $(loadedPageItem).removeClass('active');
                loadedPageItem = $(this).parent();
                $(this).parent().addClass('active');
            }
        });
    });
});*/

/*global $*/
function loadContent(curl, newhash){
    if(newhash != undefined)
        document.location.hash = newhash;
    $(".loading").fadeTo(400, 0.5);
    $.ajax({
        url: curl,
        cache: false,
        complete: function(t){
            $(".loading").fadeTo(400, 0);
            $('#content').html(t.responseText);
        }
    });
}
    
$(document).ready(function(){
    $("a[data-tab-link='true']").each(function(){
        if($(this).attr("data-tab-link") != "true")
            return;
         $(this).on('click', function(e){
            e.preventDefault();
            document.location.hash = $(this).attr("id");
             updateLocation();
         });
    });
    
    
    function updateLocation(){
        var url = $(document.location.hash).attr("href");    
        if(url != undefined)    
            loadContent(url);
        else{
            if(document.location.hash.search("edit")){
                var id = document.location.hash.slice(document.location.hash.indexOf(':')+1);
                loadContent("res/cadastrarContato.php?id="+id);
            }
        }
    }
    
    if(document.location.hash == "")
        document.location.hash = $('a[data-tab-link="true"][data-tab-default="true"]').attr('id');
    updateLocation();
});