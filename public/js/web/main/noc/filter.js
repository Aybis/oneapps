
function monthAndYear(m='', y='', _token, condition='')
{
    $.ajaxSetup({
        cache:false,
    });

    $.ajax({
        url:url_chart_incident,
        type: 'get',
        data : {
            // _token : _token,
            month : m,
            year : y,
        },
        dataType : 'json',
        success : function(data){
            // declare variable for status miss and met
            let met = 0;
            let miss = 0;

            data.forEach( (element) => {
                // condition where data have miss or met
                if(element.timeStatus == "MET"){
                    met++;
                }else if(element.timeStatus == "MISS"){
                    miss++;
                }
            });

            chartIncident(met, miss);

        },
        error : function (data){
            // console.log(data);
        }
    });
    $.ajax({
        url         : url_chart_request,
        type        : 'get',
        data        : {
                        month : m,
                        year : y,
                    },
        dataType    : 'json',
        success     : function(data){
            // declare variable for status miss and met
            let met = 0;
            let miss = 0;

            data.forEach( (element) => {
                // condition where data have miss or met
                if(element.timeStatus == "MET"){
                    met++;
                }else if(element.timeStatus == "MISS"){
                    miss++;
                }
            });

            chartRequest(met, miss);

        },
        error : function (data){
            // console.log(data);
        }
    });

}
