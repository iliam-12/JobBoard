function delPost(id) {
    var postarg = {
        'id' : id,
    };
    $.ajax({
        type: "POST",
        url: "http://localhost/T-WEB-501-MAR-5-1-jobboard-iliam.amara/functions/delPost.php",
        data: postarg,
        success: function (response) {
            location.reload()
        }
    });
}