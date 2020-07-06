// Declare Variable
let url_table           = $('#all').attr('url');
let url_chart_incident  = $('#url_chart_incident').data('url');
let url_chart_request   = $('#url_chart_request').data('url');
let url_export          = $('#url_export').data('url');
let _token              = $('#token').val();
let bulan               = $('.bulan');
let tahun               = $('.tahun');
let cust                = $('#customer').val();
let d                   = new Date();
var getMonth            = d.getMonth();
let minTahun            = (d.getFullYear() - 5);

// Call Function
setTimeout(function () {
    toggleLoaderIncident();
    toggleLoaderRequest();
    toggleLoaderTable();
    ajaxChartIncident(getMonth+1, d.getFullYear());
    ajaxChartRequest(getMonth+1, d.getFullYear());
    listDataDashboard(getMonth+1, d.getFullYear());
}, 1000);


// Declare Array Bulan
const months = [
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember',
    'All'
];

// Insert Value Option Dropdown Bulan
months.forEach(function (i, index) {
    if (getMonth == index) {
        bulan.append("<option value=" + (index + 1) + " selected>" + i + "</option>")
    } else {
        bulan.append("<option value=" + (index + 1) + ">" + i + "</option>")
    }
})
// Insert Value Option Dropdown Tahun
for (let i = d.getFullYear(); i > minTahun; i--) {
    tahun.append('<option value="' + i + '">' + i + '</option>')
}

// OnClick Month Function
$('.bulan').change(function () {
    let m = $('.bulan').val();
    let y = $('.tahun').val();
    let cust = $('#customer').val();
    if (m != '' && y != '') {
        ajaxChartIncident(m, y, cust);
        ajaxChartRequest(m, y);
        listDataDashboard(m, y);

    } else {
        alert('Both Date is required');
    }
});

// OnClick Year Function
$('.tahun').change(function () {
    let m   = $('.bulan').val();
    let y   = $('.tahun').val();
    let cust = $('#customer').val();
    if (m != '' && y != '') {
        ajaxChartIncident(m, y, cust);
        ajaxChartRequest(m, y);
        listDataDashboard(m, y);

    } else {
        alert('Both Date is required');
    }
});


// niftyModal
$.fn.niftyModal('setDefaults', {
    overlaySelector     : '.modal-overlay',
    contentSelector     : '.modal-content',
    closeSelector       : '.modal-close',
    classAddAfterOpen   : 'modal-show'
});

// Select2
$(".select2").select2({
    //   width: '100%'
});

$('#customer').on('change', function(){
    let m   = $('.bulan').val();
    let y   = $('.tahun').val();
    let cust = $(this).val();
    if (m != '' && y != '') {
        ajaxChartIncident(m, y, cust);
    }
})


//Show loading class toggle
function toggleLoaderIncident(){

    $('#toggle-incident').on('click',function(){
    var parent = $(this).parents('.widget, .panel');
    let m   = $('.bulan').val();
    let y   = $('.tahun').val();
    let cust = $('#customer').val();
    if( parent.length ){
            parent.addClass('be-loading-active');
        setTimeout(function () {
            ajaxChartIncident(m, y, cust);
            parent.removeClass('be-loading-active');
        }, 2000);
    }
    });
}

//Show loading class toggle
function toggleLoaderRequest(){

    $('#toggle-request').on('click',function(){
    var parent = $(this).parents('.widget, .panel');
    let m   = $('.bulan').val();
    let y   = $('.tahun').val();

    if( parent.length ){
            parent.addClass('be-loading-active');
        setTimeout(function () {
            ajaxChartRequest(m, y);
            parent.removeClass('be-loading-active');
        }, 2000);
    }
    });
}

//Show loading class toggle
function toggleLoaderTable(){

    $('#toggle-table').on('click',function(){
    var parent = $(this).parents('.widget, .panel');
    let m   = $('.bulan').val();
    let y   = $('.tahun').val();

    if( parent.length ){
            parent.addClass('be-loading-active');
        setTimeout(function () {
            listDataDashboard(m, y);
            parent.removeClass('be-loading-active');
        }, 2000);
    }
    });
}

// Function ServerSide DataTable
function listDataDashboard(m, y) {
    $('.panel-body').removeClass('fix')
    $('.panel-body').addClass('trans');

    $('#all').dataTable({
        scrollY     : "50vh",
        destroy     : true,
        processing  : true,
        serverSide  : true,
        async       : true,
        ajax: {
            url: url_table,
            type: 'get',
            data: {
                month: m,
                year: y,
            },
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }, {
                data: 'noticket',
                defaultContent: "",
            }, {
                data: 'customer',
                defaultContent: "",
            },
            {
                data: 'layanan',
                defaultContent: "",
            },
            {
                data: 'segment',
                defaultContent: "",
            },
            {
                data: 'opentiket',
                defaultContent: "",
            }, {
                data: 'durasipending',
                defaultContent: "",
            }, {
                data: 'resolvedtiket',
                defaultContent: "",
            }, {
                data: 'closedtiket',
                defaultContent: "",
            }, {
                data: 'timeStatus',
                defaultContent: "",
                searchable  : false,
            }, {
                data: 'edit',
                defaultContent: "",
                render(data) {
                    return (
                        `
                        <div class="btn-group btn-hspace">
                                  <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                  <ul role="menu" class="dropdown-menu pull-right">
                                    <li>
                                        <a href="/noc/edit/${data.id}/" data-id="${data.id}""><span class="icon mdi mdi-assignment"></span>Edit</a>
                                    </li>
                                        <li class="divider"></li>
                                    <li>
                                        <a href="/noc/delete/${data.id}"  data-id="${data.id}"><span class="icon mdi mdi-delete"></span>Delete</a>
                                    </li>
                                  </ul>
                                </div>
                        `
                        )
                    }
                }
        ],
    });
    // $('table tbody').addClass('animated fadeIn delay-1s');
}
