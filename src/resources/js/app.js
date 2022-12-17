import './bootstrap';

export function loadImage() {
    let image = $("#image");
    $.get("/api/image/get", function(data){
        image.attr("src", data.sourceUrl);
        image.data( "id", data.id )
    });
}


function setStatus(status) {
    let image = $("#image");
    $.ajax({
        url: "/api/image/setStatus",
        data: {
            "id": image.data( "id" ),
            "status": status
        },
        type: "GET",
        success: function(response) {
            loadImage();
        },
    });
}

$('.image-action').click(function(){
    let status = $(this).data('status')
    setStatus(status);

});

