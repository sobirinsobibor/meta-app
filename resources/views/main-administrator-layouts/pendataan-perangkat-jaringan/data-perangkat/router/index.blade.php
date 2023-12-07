@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tabel Perangkat jaringan Router</h1>
    <ul>
        <li><a href="">Starter</a></li>
        <li>Blank Page</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>

@if(session('message'))
    <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
        {{ session('message')['text'] }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<!-- Content-->
<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">

            <div class="table-responsive">
                <table id="zero_configuration_table_device" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>id_device</th>
                            <th>Nama Perangkat</th>
                            <th>Tahun Pembelian</th>
                            <th>Deskripsi</th>
                            <th>Jenis Perangkat</th>
                            <th>Merk Perangkat</th>
                            <th>Unit Kerja</th>
                            <th>status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>    
                </table>
            </div>

        </div>
    </div>
</div>

{{-- modal --}}
{{-- info modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="device_name"></p>
                <p>Perangkat akan dilakukan <span id="device_menu"></span> pada tanggal <span id="booking_date"></span> </p>
                <a id="link_to_menu" href="">Lihat Lebih Lanjut</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Content-->
@endsection

@section('page-js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#zero_configuration_table_device').DataTable({
            processing:true,
            serverSide: true,
            ajax: '/admin/pendataan/routerjson',
            columns: [
                { data: 'id', name: 'id', visible: false },
                { data: 'device_name', name: 'device_name' },
                { data: 'device_purchase_year', name:'device_purchase_year'},
                { data: 'device_description', name:'device_description'},
                { data: 'device_type_name', name:'device_types.device_type_name'},
                { data: 'device_brand_name', name:'device_brands.device_brand_name'},
                { data: 'team_unit_name', name: 'team_units.team_unit_name' },
                {
                    data: 'device_active_status', 
                    name: 'device_active_status',
                    render: function (data) {
                        return data ? '<button type="button" class="btn btn-success btn-sm  rounded">'
                                         + '<i class="nav-icon i-Yes"></i> </button>' 
                                    : '<button type="button" class="btn btn-danger btn-sm  rounded">'
                                         + '<i class="nav-icon i-Close"></i> </button>';
                    }
                    
                },
                {
                    data: null,
                    name: 'actions',
                    searchable: false,
                    render: function (data, type, row) {
                        if (row.id_menu !== 1) {
                            const infoButton = '<button type="button" class="btn btn-primary btn-sm rounded" id="btn-info" ' +
                                                'data-toggle="modal" data-target="#exampleModal" ' +
                                                'data-device-registration-id="' + row.device_registration_id + '" ' +
                                                'data-device-name="' + row.device_name + '" ' +
                                                'data-device-menu="' + row.menu_name + '" '+
                                                'data-id-menu="' + row.id_menu + '">' +
                                                '<i class="nav-icon bi bi-info-circle"></i> </button>';                            
                            const viewButton = '<button type="button" id="btn-edit" class="btn btn-warning btn-sm rounded" data-toggle="modal" data-target="#exampleModalCenter" >'
                                                    + '<i class="nav-icon i-Eye"></i> </button>';    
                           
                            return '<div class="btn-group ">'  + viewButton + infoButton + '</div>';
                        } else {
                           // Tombol aksi Edit dengan modal
                            const viewButton = '<button type="button" id="btn-edit" class="btn btn-warning btn-sm rounded" data-toggle="modal" data-target="#exampleModalCenter" >'
                                            + '<i class="nav-icon i-Eye"></i> </button>';                
                            return viewButton;
                         }

                    }
                },
            ]
        })
    })
</script>

<script>
    $(document).on('click', '#btn-info', function () {
    const deviceRegistrationId = $(this).data('device-registration-id');
    const deviceName = $(this).data('device-name');
    const deviceMenu = $(this).data('device-menu');
    const idMenu = $(this).data('id-menu');

    $.ajax({
        url: '/admin/pendataan/perangkat/searchMenu/'+idMenu+'/'+deviceRegistrationId, // Ganti dengan URL Anda
        method: 'GET', 
        
        success: function(response) {
            
            var menu = '';
            var variable = '';
            if (idMenu == 4) {
                menu = 'instalasi-perangkat'
                variable = 'device_installation'
            } else if (idMenu == 5) {
                menu ='pemeliharaan-perangkat'
                variable = 'device_maintenance'
            } else if (idMenu == 6) {
                menu = 'pelepasan-perangkat'
                variable = 'device_dismantle'
            }

            $('#device_name').text('Nama Perangkat: ' + deviceName);
            $('#device_menu').text( deviceMenu);
            $('#booking_date').text(response[variable+ '_booking_date']);

            const model = variable+ '_registration_id'
            const url = '/admin/layanan/' + menu + '/' + response[model];
            $('#link_to_menu').attr('href', url);
        },
        error: function() {
            alert('Terjadi kesalahan saat mengambil data.');
        }
    });

    
});
</script>


@endsection