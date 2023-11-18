$(document).ready(function(){
    console.log('coucou');

    $('#idbarrederecher').keypress(function() {
        if($(this).val().length > 2) {
            getVideoName($('#idbarrederecher').val());
        }
    });
})

function getVideoName(string_search) {
    $.ajax({
        url: "clip/search",
        method: "GET",
        dataType : "json",
    })
        .done(function(response){
            let data = JSON.stringify(response);
            console.log(data);
        })
        .fail(function(error){
            alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        })
}


