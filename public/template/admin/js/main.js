$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Are you sure?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'json',
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else
                    alert("Error: " + result.message);
            }
        })
    }
}


/*Upload file*/
$(document).ready(function () {
    $('#upload').change(function () {
        const form = new FormData();
        form.append('file', $(this)[0].files[0]);

        // Thêm CSRF token cho Laravel
        form.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            data: form,
            url: '/admin/upload/services',

            beforeSend: function() {
                // Hiển thị loading
                $('#image_show').html('<p>Đang tải ảnh...</p>');
            },
            success: function (results) {
                console.log('Success:', results.url.original);
                if (results.error === false) {
                    $('#image_show').html('<a href="' +'/'+ results.url.original.url + '" target="_blank"><img src="' +'/'+ results.url.original.url + '" width="100px" style="max-width: 100px;"></a>');
                    $('#thumb').val('/' + results.url.original.url);
                } else {
                     alert('Tải ảnh thất bại: ' + (results.message || 'Lỗi không xác định'));
                }

            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
                alert('Có lỗi xảy ra khi tải ảnh. Vui lòng thử lại!');
                $('#image_show').html('');
            }
        })
    });
});
