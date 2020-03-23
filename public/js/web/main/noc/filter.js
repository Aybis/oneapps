
function monthAndYear(m='', y='', _token, condition='')
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
    $.ajax({
        url:url_chart_reg,
        type: 'POST',
        data : {
            _token : _token,
            month : m,
            year : y,
            condition : condition,
        },
        dataType : 'json',
        success : function(data){
            chartReg(data);

        },
        error : function (data){
            console.log(data);
        }
    });

}
