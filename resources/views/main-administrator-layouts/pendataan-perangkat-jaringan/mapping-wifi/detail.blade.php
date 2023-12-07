@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


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
                                @else
                                <button class="btn btn-primary rounded" onclick="changePDFSrc()">
                                    <i class="nav-icon bi bi-eye"></i>
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

<!-- Content-->
@endsection

@section('page-js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script>

    $(document).ready(function () {
        $('#zero_configuration_wifi_mapping_detail').DataTable({
            order: [[2, 'desc']] // Mengurutkan berdasarkan kolom ke-5 (created_at) secara descending (terbaru dulu)
        })
    })
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