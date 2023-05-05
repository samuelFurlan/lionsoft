//Dispara requisição Ajax
function sendAjax(path, data, callback) {
    $.ajax({
        url: path,
        data: data,
        type: "POST",
        dataType: "json",
        success: function (data) {
            callback(data);
        }
    });
}
