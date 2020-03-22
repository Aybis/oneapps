// Call Function
$(document).ready(function () {
    monthAndYear(getMonth+1, d.getFullYear(), _token);
    listDataDashboard(getMonth+1, d.getFullYear(), _token);
});


// Declare Variable
let url_list = $('#dashboard').attr('url');
let url_filter = $('#url_chart_met').attr('url');
let url_chart_reg = $('#url_chart_reg').attr('url');
let _token = $('#token').val();
let bulan = $('#bulan');
let tahun = $('#tahun');
let d = new Date();
var getMonth = d.getMonth();
let minTahun = (d.getFullYear() - 5);


// Declare Array Bulan
const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
    'September', 'Oktober', 'November', 'Desember'
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
$('#bulan').change(function () {
    let m = $('#bulan').val();
    let y = $('#tahun').val();
    if (m != '' && y != '') {
        monthAndYear(m, y, _token);
        listDataDashboard(m, y, _token);

    } else {
        alert('Both Date is required');
    }
});

// OnClick Year Function
$('#tahun').change(function () {
    let m = $('#bulan').val();
    let y = $('#tahun').val();
    if (m != '' && y != '') {
        monthAndYear(m, y, _token);
        listDataDashboard(m, y, _token);

    } else {
        alert('Both Date is required');
    }
});

// Function ServerSide DataTable
function listDataDashboard(m, y, _token) {
    $('.panel-body').removeClass('fix')
    $('.panel-body').addClass('trans');

    $('#dashboard').dataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        async: true,
        ajax: {
            url: url_list,
            type: 'get',
            data: {
                _token: _token,
                month: m,
                year: y,
            },
        },
        columns: [{
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
                data: 'status',
                defaultContent: "",
            }
        ],
    });
    // $('table tbody').addClass('animated fadeIn delay-1s');
}
