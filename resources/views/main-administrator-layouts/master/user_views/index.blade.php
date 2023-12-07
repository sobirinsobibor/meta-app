@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tabel User</h1>
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

<!-- Content-->
<div class="col-md-12 mb-4">
    <div class="card text-left">
        <div class="card-body">

            <div class="table-responsive">
                <table id="zero_configuration_table_user" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Role</th>
                            <th>Unit Kerja</th>
                            <th>Status</th>
                            <th></th>
                           
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Role</th>
                            <th>Unit Kerja</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </tfoot>

                </table>
            </div>

        </div>
    </div>
</div>
{{-- modal --}}
 <!-- Modal -->
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data <span id='user_full_name_placeholder'></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" >
                    @method('put')
                    @csrf
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="form-group">
                        <label for="user_status_select">Status</label>
                        <select class="form-control" id="user_status_select" name="user_active_status">
                            <option value="true">Aktif</option>
                            <option value="false">Tidak Aktif</option>
                        </select>
                    </div>
                    <!-- Field lainnya di sini -->
                    <div class="modal-footer">
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
        $('#zero_configuration_table_user').DataTable({
            processing:true,
            serverSide: true,
            ajax: '/admin/master/userjson',
            columns: [
                { data: 'id', name: 'id', visible:false },
                { data: 'user_nip', name: 'user_nip' },
                { data: 'user_full_name', name: 'user_full_name' },
                { data: 'user_email', name: 'user_email' },
                { data: 'user_phone', name: 'user_phone' },
                { data: 'role_name', name: 'roles.role_name' },
                { data: 'team_unit_name', name: 'team_units.team_unit_name' },
                {
                    data: 'user_active_status', 
                    name: 'user_active_status',
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
                        var editButton = '<button type="button" id="btn-edit" class="btn btn-warning btn-sm rounded" data-toggle="modal" data-target="#exampleModalCenter" data-id="'+data.id+'" data-user_nip="' + data.user_nip + '" data-user_full_name="'+data.user_full_name+'" data-user_active_status="' + data.user_active_status + '">'
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
$('#zero_configuration_table_user').on('click', 'button#btn-edit', function () {
    const userNip = $(this).data('user_nip'); 
    const userId = $(this).data('id'); 
    const userFullName = $(this).data('user_full_name'); 
    const userActiveStatus = $(this).data('user_active_status'); 
    const editForm = $('#editForm'); // Dapatkan elemen form

    $('#user_id').val(userId); 
    $('#user_full_name_placeholder').text(userFullName); 

    if (userActiveStatus === true) {
        $('#user_status_select').val('true');
    } else {
        $('#user_status_select').val('false');
    }
    editForm.attr('action', '/admin/master/user/' + userId);
});
</script>

@endsection