///@author: jvhti@hotmail.com

if (typeof jQuery === 'undefined') {
    throw new Error('Main requer jQuery');
}

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
});

