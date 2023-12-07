@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tabel Mapping Wifi</h1>
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
                <table id="zero_configuration_topologi_jaringan" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>registration id</th>
                            <th>Nama Pengupload</th>
                            <th>NIP</th>
                            <th>Deskripsi</th>
                            <th>Unit Kerja</th>
                            <th>Tanggal Upload</th>
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
<!-- preview document Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="registration_id"></div>
                <div id="pdfViewerContainer" class="col-md-12 mb-4" style="display: none;">
                    <iframe id="pdfViewer" style="height: 65vh; width: 100%" allowfullscreen webkitallowfullscreen></iframe>
                </div>                
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
        $('#zero_configuration_topologi_jaringan').DataTable({
            processing:true,
            serverSide: true,
            ajax: '/admin/pendataan/mappingwifijson',
            columns: [
                { data: 'id', name: 'wifi_mappings.id', visible:false },
                { data: 'wifi_mapping_registration_id', name: 'wifi_mapping_registration_id',  visible:false },
                { data: 'user_full_name', name: 'users.user_full_name'},
                { data: 'user_nip', name: 'users.user_nip'},
                { data: 'wifi_mapping_description', name:'wifi_mapping_description'},
                { data: 'team_unit_name', name:'team_units.team_unit_name'},
                {
                    data: 'created_at', 
                    name:'created_at',
                    // render: function(data, type, full, meta) {
                    //     if (type === 'display') {
                    //         // Ubah data tanggal menjadi format yang diinginkan (misalnya dd-mm-yyyy)
                    //         var formattedDate = new Date(data).toLocaleDateString('id-ID'); // Sesuaikan dengan format yang diinginkan
                    //         return formattedDate;
                    //     }
                    // }
                },
                {
                    data: null,
                    name: 'actions',
                    searchable: false,
                    render: function (data) {
                         // Tombol detail view dan dwonload dengan modal
                         const detailButton = '<button type="button" id="btn-detail" class="btn btn-primary rounded" ' 
                                              +  'data-toggle="modal" data-target=".bd-example-modal-lg" ' 
                                              +  'onclick="changePDFSrc(\'' + '<?php echo asset("storage/files/' + data.wifi_mapping_file_name + '") ?>' + '\');">' 
                                              +  '<i class="nav-icon bi bi-eye"></i></button>';
                        
                        const downloadButton = '<a href="<?php echo asset("storage/files/' + data.wifi_mapping_file_name + '") ?>" ' 
                                               +     'class="btn btn-success rounded" download="">' 
                                               +     '<i class="nav-icon bi bi-download"></i>' 
                                               +     '</a>';
                                            
                        return '<div class="btn-group ">' + detailButton + downloadButton + '</div>';
                    }
                },
            ]
        })
    })
</script>

<script>
    function changePDFSrc(url) {
        const pdfViewerContainer = document.getElementById('pdfViewerContainer');
        const pdfViewer = document.getElementById('pdfViewer');

        if (url) {
            pdfViewerContainer.style.display = 'block';
            pdfViewer.src = url ;
        } else {
            pdfViewerContainer.style.display = 'none';
        }
    }
</script>

@endsection