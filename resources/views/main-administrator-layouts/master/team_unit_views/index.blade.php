@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tabel Unit Kerja</h1>
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
                <table id="zero_configuration_table_teamUnit" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Unit Kerja</th>
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
                    <input type="hidden" id="team_unit_id" name="team_unit_id">
                    <div class="form-group">
                        <label for="team_unit_status_select">Status</label>
                        <select class="form-control" id="team_unit_status_select" name="team_unit_active_status">
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
<script>
    $(document).ready(function () {
        $('#zero_configuration_table_teamUnit').DataTable({
            processing:true,
            serverSide: true,
            ajax: '/admin/master/teamunitjson',
            columns: [
                { data: 'id', name: 'id', visible: false },
                { data: 'team_unit_name', name: 'team_unit_name' },
                {
                    data: 'team_unit_active_status', 
                    name: 'team_unit_active_status',
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
                        var editButton = '<button type="button" id="btn-edit" class="btn btn-warning btn-sm rounded" data-toggle="modal" data-target="#exampleModalCenter" data-team_unit_id="' + data.id + '" data-team_unit_active_status="'+data.team_unit_active_status+'" data-team_unit_name="' + data.team_unit_name + '">'
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
    $('#zero_configuration_table_teamUnit').on('click', 'button#btn-edit', function () {
        const teamUnitId = $(this).data('team_unit_id'); 
        const teamUnitName = $(this).data('team_unit_name'); 
        const teamUnitStatus = $(this).data('team_unit_active_status'); 
        const editForm = $('#editForm'); // Dapatkan elemen form

        $('#team_unit_id').val(teamUnitId); 
        $('#team_unit_name_placeholder').text(teamUnitName); 
    
        if (teamUnitStatus === true) {
            $('#team_unit_status_select').val('true');
        } else {
            $('#team_unit_status_select').val('false');
        }
        editForm.attr('action', '/admin/master/unit-kerja/' + teamUnitId);
    });
    </script>
    

@endsection