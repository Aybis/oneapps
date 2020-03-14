    // Declare Variable
    let url_list = $('#listrik').attr('url');
    let url_view = $('#listrik_view').attr('url');
    var bulan = $('#bulan');
    var tahun = $('#tahun');
    var urlnya = "";
    var d = new Date();
    var minTahun = (d.getFullYear() - 5);

    // Declare Array Bulan
    const months = ['Pilih Bulan', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
    'September', 'Oktober', 'November', 'Desember'
];
// Insert Value Option Dropdown Bulan
months.forEach(function (i, index) {
    bulan.append("<option value=" + index + ">" + i + "</option>")
})
// Insert Value Option Dropdown Tahun
for (let i = d.getFullYear(); i > minTahun; i--) {
    tahun.append('<option value="' + i + '">' + i + '</option>')
}

// Call DataTable
listDataListrik();
// Call FUnction on click modal
$('#modal-view-listrik').on('show.bs.modal', function (e) {
    var anim = 'fadeInUp';
    testAnim(anim);
})


// Function Animate Modal
function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
};

// Function ServerSide DataTable
function listDataListrik() {
    $('.panel-body').removeClass('fix')
    $('.panel-body').addClass('trans');

    $('#listrik').dataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        async: true,
        ajax: {
            url: url_list,
        },
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        }, {
            data: 'id_pelanggan',
            defaultContent: "",
        }, {
            data: 'nama_pelanggan',
            defaultContent: "",
        },
        {
            data: 'alamat_pelanggan',
            defaultContent: "",
        },
        {
            data: 'no_meter',
            defaultContent: "",
        },
        {
            data: 'kota',
            defaultContent: "",
        }, {
            data: 'witel',
            defaultContent: "",
        }, {
            data: 'divre',
            defaultContent: "",
        }, {
            data: 'area_pins',
            defaultContent: "",
        }, {
            data: 'modal_edit',
            'defaultContent': "",
            render(data) {
                return (
                    `
                    <div class="btn-group btn-hspace">
                              <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                              <ul role="menu" class="dropdown-menu pull-right">
                              <li><a href="#modal-view-listrik" data-toggle="modal" id="data-listrik" data-id="${data.id}" data-pelanggan="${data.id_pelanggan}"><span class="icon mdi mdi-assignment-o"></span>View</a></li>
                              <li><a href="/listrik/edit-listrik/${data.id_pelanggan}/" data-id="${data.id}""><span class="icon mdi mdi-assignment"></span>Edit</a></li>
                                <li class="divider"></li>
                                <li><a href="/listrik/delete-listrik/${data.id_pelanggan}"  data-id="${data.id}"><span class="icon mdi mdi-delete"></span>Delete</a></li>

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

// Function get Data from link to Modal
$('#listrik').on('click', '#data-listrik', function () {
    var pelanggan = $(this).data('pelanggan');
    detailData(pelanggan);

});

function detailData(data) {
    $.ajax({
        type: 'get',
        url: `${url_view}/${data}`,
        data: {
            id_pelanggan: data,
        },
        dataType: 'json', //return data will be json
        success: function (data) {
            // console.log(data);
            $('#modal-title').text(`${data.nama_pelanggan} - ${data.id_pelanggan} `);
            $('#no_meter').text(`${data.no_meter} `);
            $('#alamat').text(`${data.alamat_pelanggan} `);
            $('#tarif').text(`${data.tarif} `);
            $('#daya').text(`${data.daya} `);
            $('#witel').text(`${data.witel} `);
            $('#provinsi').text(`${data.provinsi} `);
            $('#area_pins').text(`${data.area_pins} `);
            $('#kota').text(`${data.kota} `);
            $('#divre').text(`${data.divre} `);
            $('#unitup').text(`${data.unitup} `);
            $('#tipe').text(`${data.tipe} `);
            $('#alamat_unitup').text(`${data.alamat_unitup}`);
            $('#status').text(data.status == "" ? "Belum Di Input" : data.status);
            $('#nde').text(data.nde == "" ? "Belum Di Input" : data.nde);
            $('#sto').text(data.sto == "" ? "Belum Di Input" : data.sto);
            $('#mdu').text(data.nama_mdu == "" ? "Belum Di Input" : data.nama_mdu);
            $('#koordinat').text(data.koordinat == "" ? "Belum Di Input" : data.koordinat);
            $('#keterangan').text(data.keterangan == "" ? "Belum Di Input" : data.keterangan);
        },
        error: function (data) {
            console.log(data);
        }
    });
}
