
/*Upload file*/
$(document).ready(function () {
    $('#upload').change( function () {
        const form = new FormData();
        form.append('file', $(this)[0].files[0]);

        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            data: form,
            url: '/admin/upload/services',

            success: function (results) {

                console.log(results);
            }
        })
    });
});