$("body").on("click", ".upload-image", function (e) {
    // e.preventDefault();
    var folder=$(this).attr('data-folder');
    var link=$(this).parents("form").attr('action');
    console.log(link);
    link=link+"/"+folder;
    $(this).parents("form").attr('action',link);
    console.log(link);
    $(this).parents("form").ajaxForm(options);
});

// var base_url = 'http://localhost:8080/AThang/Project_TMN/public';
var base_url = window.location.origin ;
var options = {
    complete: function (response) {
        var folder=response.responseJSON.folder;
        if ($.isEmptyObject(response.responseJSON.error)) {
            var files = response.responseJSON.uploadedFileNames;
            files.map(function (image) {
                appendImages(folder,image);
            });


        } else {
            printErrorMsg(response.responseJSON.error);
        }
    }
};
function appendImages(folder,responseText) {
    console.log("folder",folder);
    var id='img-'+folder;
    var uploadedImagesContainer = document.getElementById(id);
    console.log(uploadedImagesContainer);
    var daString = "<div class=\'col-xs-6 col-md-2 \' id='" + responseText.split('.jpg')[0] + "'>" +
        "<div class=\'thumbnail\'>" +
        "<a href=\'#\' class=\'chooseimg\'>" +
        "<img src='" + base_url + "/uploads/"+folder+"/" + responseText + "\' class=\"img-responsive\">" +
        "</a>" +
        "<div class=\'caption\'>" +
        "<p class=\'text-center\'>" +
        "<a href=\'" + base_url + '/deletefile/'+folder+'/' + responseText.split('.jpg')[0] + "\'  class=\'btn btn-danger btn-xs deletebtn\' role=\'button\'>Delete</a>" +
        "</p>" +
        "</div>" +
        "</div>" +
        "</div>";
    uploadedImagesContainer.innerHTML += daString;


}

function printErrorMsg(msg) {
    var errMsg = document.getElementById('print-error-msg');

    var dataString = "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">" +
        "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>" +
        msg +
        "</div>";
    errMsg.innerHTML += dataString;
}

