@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Compact Sidebar</h1>
    <ul>
        <li><a href="">Starter</a></li>
        <li>Blank Page</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>


<!-- Content-->
<div class="col-md-12 mb-4">
    <div class="card text-left">

        <div class="card-body">
            <div class="table-responsive">
                <table id="zero_configuration_wifi_mapping_detail" class="display table table-striped table-bordered" style="width:100%">
                   
                    <thead>
                        <tr>
                            <th>Nama File</th>
                            <th>Ekstensi File</th>
                            <th>Created at</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                        <tr>
                            <td>{{ $file->file_name }}</td>
                            <td>.{{ $file->file_extension }}</td>
                            <td>{{ $file->created_at }}</td>
                            <td>
                                @if ($file->file_name)
                                <button class="btn btn-primary rounded" onclick="changePDFSrc('{{ asset('storage/files/' . $file->file_name) }}'); scrollIntoPDFViewer()">
                                    <i class="nav-icon bi bi-eye"></i>
                                </button>
                                <a href="{{ asset('storage/files/' . $file->file_name) }}" class="btn btn-success rounded" download="">
                                    <i class="nav-icon bi bi-download"></i> 
                                </a>
                                @else
                                <button class="btn btn-primary rounded" onclick="changePDFSrc()">
                                    <i class="nav-icon bi bi-eye"></i>
                                </button>
                                <button class="btn btn-success rounded" disabled>
                                    <i class="nav-icon bi bi-download"></i> Download
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>    
                    <tfoot>
                        <tr>
                            <th>Nama File</th>
                            <th>Ekstensi File</th>
                            <th>Created at</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- <div id="pspdfkit" style="height: 100vh"></div> --}}
<div id="pdfViewerContainer" class="col-md-12 mb-4" style="display: none;">
    <iframe id="pdfViewer" style="height: 100vh; width: 100%" allowfullscreen webkitallowfullscreen></iframe>
</div>

{{-- modal --}}
{{-- modal upload file --}}
<div class="modal fade" id="exampleModalCenter_file_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-2">Ungggah File Mapping Wifi <span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="dropzone" id="fileUpload" action="{{ route('staff.file') }}" enctype="multipart/form-data">
                    @csrf
                   
                    <input type="hidden" name="registration_id" id="registration_id" readonly value="{{ $registration_id }}">
                    <input type="hidden" name="id_team_unit" id="id_team_unit" readonly value="{{ $id_team_unit }}">
                </form>
            </div>
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="refreshPage()">Close</button>
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
        $('#zero_configuration_wifi_mapping_detail').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    text:'+ Add New File',
                    attr:{
                        id:'btn-upload',
                        class:'btn btn-primary',
                        'data-toggle':"modal",
                        'data-target':"#exampleModalCenter_file_upload"
                    }
                }
            ],
            order: [[2, 'desc']] // Mengurutkan berdasarkan kolom ke-5 (created_at) secara descending (terbaru dulu)
        })
    })
</script>

<script>
    Dropzone.autoDiscover = false;

    const myDropzone = new Dropzone("#fileUpload", {
        
        url: "{{ route('staff.file') }}",
        // addRemoveLinks: true, // Tambahkan link untuk menghapus file yang diunggah
        paramName: "file", // Nama parameter yang akan dikirim ke server
        maxFilesize: 5, // Batasan ukuran file (dalam MB)
        acceptedFiles: ".jpg, .png, .pdf", // Jenis file yang diterima
        dictDefaultMessage: "Tarik file atau klik di sini untuk mengunggah <br> Maksimal ukuran file 5mb <br> ekstensi file : .pdf, .png, .jpg", // Pesan default
        init: function() {
            this.on("success", function(file, response) {
                // Tindakan yang akan diambil setelah file berhasil diunggah
                console.log(response);
            });
        },
        sending: function(file, xhr, formData) {
            // Ambil nilai mapping_wifi_registration_id dari input tersembunyi
            var wifiMappingId = document.getElementById('registration_id').value;
            formData.append('registration_id', wifiMappingId);
        }
        
    });
    
</script>


<script>
    function refreshPage() {
        // Merefresh halaman saat fungsi ini dipanggil
        location.reload();
    }
</script>


<script>
    function changePDFSrc(url) {
        const pdfViewerContainer = document.getElementById('pdfViewerContainer');
        const pdfViewer = document.getElementById('pdfViewer');

        if (url) {
            // Jika ada URL file, tampilkan div dan atur src iframe
            pdfViewerContainer.style.display = 'block';
            pdfViewer.src = url;
        } else {
            // Jika tidak ada URL file, sembunyikan div
            pdfViewerContainer.style.display = 'none';
        }
    }
</script>

<script>
    function scrollIntoPDFViewer() {
        var pdfViewerContainer = document.getElementById('pdfViewerContainer');
        pdfViewerContainer.style.display = 'block';
        pdfViewerContainer.scrollIntoView({
            behavior: 'smooth' // Untuk efek gulingan yang halus
        });
    }
</script>

@endsection