
function monthAndYear(m='', y='', _token)
{
    $.ajaxSetup({
        cache:false,
    });

    $.ajax({
        url:url_filter,
        type: 'POST',
        data : {
            _token : _token,
            month : m,
            year : y,
        },
        dataType : 'json',
        success : function(data){
            chartMet(data);
        },
        error : function (data){
            console.log(data);
        }
    });
}
