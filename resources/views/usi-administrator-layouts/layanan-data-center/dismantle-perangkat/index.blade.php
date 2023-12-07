@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tabel Pelepasan Perangkat</h1>
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
                <table id="zero_configuration_device_maintenance" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>registration id</th>
                            <th>Nama Pengunggah</th>
                            <th>NIP</th>
                            <th>Tanggal Upload</th>
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
        $('#zero_configuration_device_maintenance').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    text:'+ Add New',
                    attr:{
                        id:'btn-add-new',
                        class:'btn btn-primary',
                    }
                }
            ],
            processing:true,
            serverSide: true,
            ajax: '/staff/layanan/devicedismantlejson',
            columns: [
                { data: 'id', name: 'device_dismantles.id', visible:false },
                { data: 'device_dismantle_registration_id', name: 'device_dismantle_registration_id',  visible:false },
                { data: 'user_full_name', name: 'users.user_full_name'},
                { data: 'user_nip', name: 'users.user_nip'},
                {
                    data: 'created_at', 
                    name: 'created_at',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            // Ubah data tanggal menjadi format yang diinginkan (misalnya dd-mm-yyyy)
                            var formattedDate = new Date(data).toLocaleDateString('id-ID'); // Sesuaikan dengan format yang diinginkan
                            return formattedDate;
                        }
                    }
                },
                {
                    data: 'device_dismantle_acceptance_status', 
                    name: 'device_dismantle_acceptance_status',
                    render: function (data) {
                        var buttonClass = '';
                        var iconClass = '';
                        var status = '';
                        switch (data) {
                            case '0':
                                buttonClass = 'btn-danger';
                                iconClass = 'i-Close';
                                status = 'Ditolak';
                                break;
                            case '1':
                                buttonClass = 'btn-success';
                                iconClass = 'i-Yes';
                                status = 'Disetujui'
                                break;
                            case '2':
                                buttonClass = 'btn-warning';
                                iconClass = 'bi bi-hourglass-split';
                                // status = 'pending'; 
                                break;
                            default:
                                buttonClass = 'btn-secondary';
                                iconClass = 'i-Yes'; 
                        }

                        return '<button type="button" class="btn btn-sm rounded ' + buttonClass + '">'
                                + '<i class="nav-icon ' + iconClass + '">' + status + '</i> </button>';
                    }
                },
                {
                    data: null,
                    name: 'actions',
                    searchable: false,
                    render: function (data) {
                        // Tombol aksi Edit dengan modal
                        const detailUrl = "{{ route('staff.layanan.pelepasan-perangkat.show', ':device_dismantle_registration_id') }}".replace(':device_dismantle_registration_id', data.device_dismantle_registration_id);

                        const detailButton = '<a href="'+detailUrl+'">'
                                            + '<button type="button" id="btn-edit" class="btn btn-primary rounded" >'
                                            + '<i class="nav-icon bi bi-eye"></i></button></a>';  
                                          
                            return '<div class="btn-group ">' + detailButton + '</div>';
                    }
                },
            ]
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#btn-add-new').click(function() {
            window.location.href = '/staff/layanan/pelepasan-perangkat/create';
        });
    });
</script>


@endsection