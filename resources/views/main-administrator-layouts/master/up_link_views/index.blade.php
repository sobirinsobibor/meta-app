@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tabel Up Link</h1>
    <ul>
        <li><a href="">Starter</a></li>
        <li>Blank Page</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>

@if(session('message'))
    <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show" role="alert" >
        {{ session('message')['text'] }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">

            <div class="table-responsive">
                <table id="zero_configuration_table_upLink" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>id Up Link Type</th>
                            <th>Up Link Type</th>
                            <th>id Up Link Capacity</th>
                            <th>Up Link Capacity</th>
                            <th>id Up Link Transmission Speed</th>
                            <th>Up Link Transmission Speed</th>
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


<!-- Content-->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data <span id='team_unit_name_placeholder'></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" >
                    @method('put')
                    @csrf
                    <input type="hidden" id="up_link_id" name="up_link_id">
                    <div class="row g-3 mb-2">
                        <div class="col">
                            <label for="id_up_link_type">Tipe up link</label>
                            <select class="form-control" id="id_up_link_type" name="id_up_link_type">
                                @foreach ($up_link_types as $item)
                                <option value="{{ $item->id }}" >{{ $item->up_link_type_name }}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="id_up_link_capacity">Kapasitas up link</label>
                            <select class="form-control" id="id_up_link_capacity" name="id_up_link_capacity">
                                @foreach ($up_link_capacities as $item)
                                <option value="{{ $item->id }}" >{{ $item->up_link_capacity_name }}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="id_up_link_transmission_speed">Kecepatan up link</label>
                            <select class="form-control" id="id_up_link_transmission_speed" name="id_up_link_transmission_speed">
                                @foreach ($up_link_transmission_speeds as $item)
                                <option value="{{ $item->id }}" >{{ $item->up_link_transmission_speed_name }}</option>    
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="up_link_status_select">Status</label>
                        <select class="form-control" id="up_link_status_select" name="up_link_active_status">
                            <option value="true">Aktif</option>
                            <option value="false">Tidak Aktif</option>
                        </select>
                    </div>
                    <!-- Field lainnya di sini -->
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data <span id='team_unit_name_placeholder'></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="" method="post" action="{{ route('admin.master.up-link') }}" >
                    @csrf
                    <div class="row g-3 mb-2">
                        <div class="col">
                            <label for="id_up_link_type">Tipe up link</label>
                            <select class="form-control" id="id_up_link_type" name="id_up_link_type">
                                @foreach ($up_link_types as $item)
                                <option value="{{ $item->id }}" >{{ $item->up_link_type_name }}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="id_up_link_capacity">Kapasitas up link</label>
                            <select class="form-control" id="id_up_link_capacity" name="id_up_link_capacity">
                                @foreach ($up_link_capacities as $item)
                                <option value="{{ $item->id }}" >{{ $item->up_link_capacity_name }}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="id_up_link_transmission_speed">Kecepatan up link</label>
                            <select class="form-control" id="id_up_link_transmission_speed" name="id_up_link_transmission_speed">
                                @foreach ($up_link_transmission_speeds as $item)
                                <option value="{{ $item->id }}" >{{ $item->up_link_transmission_speed_name }}</option>    
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="up_link_status_select">Status</label>
                        <select class="form-control" id="up_link_status_select" name="up_link_active_status">
                            <option value="true">Aktif</option>
                            <option value="false">Tidak Aktif</option>
                        </select>
                    </div>
                    <!-- Field lainnya di sini -->
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
        $('#zero_configuration_table_upLink').DataTable({
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
            ajax: '/admin/master/uplinkjson',
            columns: [
                { data: 'up_link_id', name: 'up_links.id', visible: false, searchable:false },
                { data: 'up_link_type_id', name: 'up_link_types.id', visible: false, searchable:false },
                { data: 'up_link_type_name', name: 'up_link_types.up_link_type_name' },
                { data: 'up_link_capacity_id', name: 'up_link_capacities.id', visible: false, searchable:false },
                { data: 'up_link_capacity_name', name: 'up_link_capacities.up_link_capacity_name' },
                { data: 'up_link_transmission_speed_id', name: 'up_link_transmission_speeds.id', visible: false, searchable:false },
                { data: 'up_link_transmission_speed_name', name: 'up_link_transmission_speeds.up_link_transmission_speed_name' },
                {
                    data: 'up_link_active_status', 
                    name: 'up_link_active_status',
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
                    render: function (data, row) {
                        // Tombol aksi Edit dengan modal
                        var editButton = '<button type="button" id="btn-edit" class="btn btn-warning btn-sm rounded" data-toggle="modal" data-target="#exampleModalCenter" data-up_link_id="' + data.up_link_id + '" data-up_link_active_status="'+data.up_link_active_status+'" data-up_link_type="' + data.up_link_type_id + '" data-up_link_capacity="' + data.up_link_capacity_id + '" data-up_link_transmission_speed="' + data.up_link_transmission_speed_id + '">'
                                            + '<i class="nav-icon i-Pen-3"></i> </button>';                        // Gabungkan tombol aksi dalam satu kolom
                        return editButton;
                    }
                },
            ]
        })
    })
</script>
<script>
    // Menangkap klik tombol edit
    $('#zero_configuration_table_upLink').on('click', 'button#btn-edit', function () {
        const id = $(this).data('up_link_id'); 
        const upLinkActiveStatus = $(this).data('up_link_active_status'); 
        const upLinkType = $(this).data('up_link_type'); 
        const upLinkCapacity = $(this).data('up_link_capacity'); 
        const upLinkTransmissionSpeed = $(this).data('up_link_transmission_speed'); 
        const editForm = $('#editForm'); // Dapatkan elemen form
    
        $('#up_link_id').val(id);
        $('#id_up_link_type').val(upLinkType);
        $('#id_up_link_capacity').val(upLinkCapacity);
        $('#id_up_link_transmission_speed').val(upLinkTransmissionSpeed);

        if (upLinkActiveStatus === true) {
            $('#up_link_status_select').val('true');
        } else {
            $('#up_link_status_select').val('false');
        }
        editForm.attr('action', '/admin/master/up-link/' + id);
    });
    </script>
@endsection