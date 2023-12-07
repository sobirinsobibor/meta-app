@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tabel Jenis Perangkat</h1>
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
                <table id="zero_configuration_table_deviceType" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>jenis Perangkat</th>
                            <th>Status</th>
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
{{-- modal new --}}
<div class="modal fade" id="exampleModalCenter_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-2">Tambah Data Baru <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    @csrf
                    <div class="form-group">
                        <label for="device_type_name_new">Device Type Name</label>
                        <input type="text" class="form-control" id="device_type_name_new" name="device_type_name" required>
                    </div>
                    <div class="form-group">
                        <label for="device_type_active_status_select_new"> Status</label>
                        <select class="form-control" id="device_type_active_status_select_new" name="device_type_active_status">
                            <option value="true">Aktif</option>
                            <option value="false">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
<!-- Modal edit -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-2">Edit Data <span id="device_type_name_placeholder"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post">
                    @method('put')
                    @csrf
                    <input type="hidden" readonly name="device_type_id" id="device_type_id">
                    <div class="form-group">
                        <label for="device_type_name">Device Type Name</label>
                        <input type="text" class="form-control" id="device_type_name" name="device_type_name" required>
                    </div>
                    <div class="form-group">
                        <label for="device_type_active_status_select"> Status</label>
                        <select class="form-control" id="device_type_active_status_select" name="device_type_active_status">
                            <option value="true">Aktif</option>
                            <option value="false">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>

<!-- Content-->
@endsection

@section('page-js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

{{-- datatable button --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        $('#zero_configuration_table_deviceType').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    text:'+ Add New',
                    attr:{
                        id:'id-btn-add-new',
                        class:'btn btn-primary',
                        'data-toggle':"modal",
                        'data-target':"#exampleModalCenter_new"
                    }
                }
            ],
            processing:true,
            serverSide: true,
            ajax: '/admin/master/devicetypejson',
            columns: [
                { data: 'id', name: 'id', visible: false},
                { data: 'device_type_name', name: 'device_type_name' },
                {
                    data: 'device_type_active_status', 
                    name: 'device_type_active_status',
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
                    render: function (data) {
                        // Tombol aksi Edit dengan modal
                        var editButton = '<button type="button" id="btn-edit" class="btn btn-warning btn-sm rounded" data-toggle="modal" data-target="#exampleModalCenter" data-device_type_id="' + data.id + '" data-device_type_active_status="'+data.device_type_active_status+'" data-device_type_name="' + data.device_type_name + '">'
                                         + '<i class="nav-icon i-Pen-3"></i> </button>';                
                        // Gabungkan tombol aksi dalam satu kolom
                        return editButton;
                    }
                },
            ]
        })
    })
</script>
<script>
// Menangkap klik tombol edit
$('#zero_configuration_table_deviceType').on('click', 'button#btn-edit', function () {
    const deviceTypeId = $(this).data('device_type_id'); 
    const deviceTypeName = $(this).data('device_type_name'); 
    const devicetypeActiveStatus = $(this).data('device_type_active_status'); 
    const editForm = $('#editForm'); // Dapatkan elemen form

    $('#device_type_id').val(deviceTypeId); 
    $('#device_type_name').val(deviceTypeName);
    $('#device_type_name_placeholder ').text(deviceTypeName);

    console.log(deviceTypeId)

    if (devicetypeActiveStatus === true) {
        $('#device_type_active_status_select').val('true');
    } else {
        $('#device_type_active_status_select').val('false');
    }
    editForm.attr('action', '/admin/master/jenis-perangkat/' + deviceTypeId);
});
</script>

@endsection