@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')

@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tabel Topologi Jaringan</h1>
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
                            <th>id unit kerja</th>
                            <th>Nama Pengunggah</th>
                            <th>NIP</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Upload</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>    
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>registration id</th>
                            <th>id unit kerja</th>
                            <th>Nama Pengunggah</th>
                            <th>NIP</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Upload</th>
                            <th></th>
                        </tr>
                    </tfoot>
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
                <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
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
{{-- modal new --}}
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-2">Tambah Data Topologi Jaringan <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('staff.pendataan.topologi-jaringan') }}" enctype="multipart/form-data" id="item-form">
                    @csrf
                        <div class="form-row ">
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label for="nama_pengunggah" class="ul-form__label">Nama Pengunggah</label>
                                    <input type="text" class="form-control" id="nama_pengunggah" name="nama_pengunggah" required readonly value="{{ auth()->user()->user_full_name }}">                              
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" readonly required name="id_user">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="user_nip" class="ul-form__label">NIP</label>
                                    <input type="text" class="form-control" id="user_nip" name="user_nip" required readonly value="{{ auth()->user()->user_nip }}">                              
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="unit_kerja" class="ul-form__label">Unit Kerja</label>
                                    <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" readonly value="{{ auth()->user()->team_unit->team_unit_name }}">                              
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="hidden" class="form-control" value="{{ Auth::user()->id_team_unit }}" readonly required name="id_team_unit">
                                </div>      
                                      
                            </div>
                            <div class="col-md-6">     
                                
                                <div class="form-group col-md-12">
                                    <label for="network_topology_description" class="ul-form__label">Keterangan</label>
                                    <textarea class="form-control" id="network_topology_description" rows="5" name="network_topology_description"></textarea>
                                    <p id="charCount">0/150 karakter</p>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" id="file" name="file" required>
                                            <label class="custom-file-label" for="file">Choose file (.pdf, .png, .jpg), max:5mb</label>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="mc-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn  btn-primary m-1 footer-delete-right" id="submitButton">Save</button>
                                    <button type="button" class="btn btn-outline-secondary m-1 footer-delete-right">Cancel</button>
                                </div>
                            </div>
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
        $('#zero_configuration_topologi_jaringan').DataTable({
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
            ajax: '/staff/pendataan/networktopologijson',
            columns: [
                { data: 'id', name: 'network_topologies.id', visible:false },
                { data: 'network_topology_registration_id', name: 'network_topology_registration_id', visible:false},
                { data: 'id_team_unit', name: 'id_team_unit',  visible:false },
                { data: 'user_full_name', name: 'users.user_full_name'},
                { data: 'user_nip', name: 'users.user_nip'},
                { data: 'network_topology_description', name:'network_topology_description'},
                {
                    data: 'created_at', 
                    name:'created_at',
                    searchable: false,
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            // Ubah data tanggal menjadi format yang diinginkan (misalnya dd-mm-yyyy)
                            var formattedDate = new Date(data).toLocaleDateString('id-ID'); // Sesuaikan dengan format yang diinginkan
                            return formattedDate;
                        }
                    }
                },
                {
                    data: null,
                    name: 'actions',
                    searchable: false,
                    render: function (data) {
                        // Tombol detail view dan dwonload dengan modal
                        const detailButton = '<button type="button" id="btn-detail" class="btn btn-primary rounded" ' 
                                              +  'data-toggle="modal" data-target=".bd-example-modal-lg" ' 
                                              +  'onclick="changePDFSrc(\'' + '<?php echo asset("storage/files/' + data.network_topology_file_name + '") ?>' + '\');">' 
                                              +  '<i class="nav-icon bi bi-eye"></i></button>';
                        
                        const downloadButton = '<a href="<?php echo asset("storage/files/' + data.network_topology_file_name + '") ?>" ' 
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
    var textarea = document.getElementById('network_topology_description');
    var charCount = document.getElementById('charCount');

    textarea.addEventListener('input', function() {
        var charLength = this.value.length; 
        charCount.textContent = charLength + '/150 karakter'; 
        if (charLength > 150) {
            this.value = this.value.substring(0, 150); 
        }
    });
</script>


{{-- <script>
    function updateDateTime() {
        var updatedAtInput = document.getElementById("created_at");
        var currentDate = new Date();
        // Mendapatkan tahun, bulan, tanggal, jam, menit, dan detik saat ini
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); 
        var day = currentDate.getDate().toString().padStart(2, '0'); 
        var hours = currentDate.getHours().toString().padStart(2, '0'); 
        var minutes = currentDate.getMinutes().toString().padStart(2, '0'); 
        var seconds = currentDate.getSeconds().toString().padStart(2, '0'); 
        // Format tanggal dan waktu dalam formatn (yyyy-mm-dd HH:mm:ss)
        var formattedDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
        updatedAtInput.value = formattedDateTime;
    }
    // Memanggil fungsi updateDateTime() setiap detik (1000 milidetik)
    setInterval(updateDateTime, 1000);
    // Memanggil updateDateTime() saat halaman dimuat untuk menginisialisasi nilai
    updateDateTime();
</script> --}}

<script>
    // Mendapatkan elemen input file dan label
    var fileInput = document.getElementById("file");
    var fileLabel = document.querySelector(".custom-file-label");
    var maxFileNameLength = 30; // Set the maximum length you desire

    // Menambahkan event listener pada input file
    fileInput.addEventListener("change", function() {
        // Menampilkan nama file yang dipilih pada label
        if (this.files.length > 0) {
            var fileName = this.files[0].name;
            if (fileName.length > maxFileNameLength) {
                var extension = fileName.substr(fileName.lastIndexOf('.'));
                var firstPart = fileName.substr(0, 10); // Keep the first 5 characters
                var lastPart = fileName.substr(fileName.length - (maxFileNameLength - 10) ); // Keep the last characters before extension
                var shortenedName = "[" + firstPart + "]......" + lastPart;
                fileLabel.textContent = shortenedName;
            } else {
                fileLabel.textContent = fileName;
            }
        } else {
            fileLabel.textContent = "Choose file (.pdf, .png, .jpg)";
        }
    });
</script>

<script>
    // Menangkap acara klik pada tombol uploadButton
    $('#zero_configuration_topologi_jaringan').on('click', '#btn-detail', function () {
        const NetworkTopologyId = $(this).data('network-topology-id');
        // Menetapkan wifi_mapping_registration_id ke input
        $('#registration_id').text(NetworkTopologyId);
    });
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