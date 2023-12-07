@extends('layouts.master')
@section('page-css')
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs justify-content-start mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab"
                        aria-controls="invoice" aria-selected="true">Invoice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit"
                        aria-selected="false">Edit</a>
                </li>

            </ul>
            @if(session('message'))
                <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
                    {{ session('message')['text'] }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                        <div class="d-sm-flex mb-5" data-view="print">
                            <span class="m-auto"></span>
                            <button class="btn btn-primary mb-sm-0 mb-3 print-invoice">Print Invoice</button>
                        </div>
                        <!---===== Print Area =======-->
                        <div id="print-area">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="font-weight-bold">Nomor Registrasi</h4>
                                    <p>{{ $device_installation->device_installation_registration_id }}</p>
                                   
                                    <button class="btn btn-info"  id="viewDocButton" onclick="changePDFSrc('{{ asset('storage/files/' . $device_installation->device_installation_file_name) }}'); scrollIntoPDFViewer()">View Document</button>
                                </div>
                                <div class="col-md-6 text-sm-right">
                                    <p><strong>Status: </strong> 
                                        @if ($device_installation->device_installation_acceptance_status == 0)
                                            Ditolak
                                        @elseif ($device_installation->device_installation_acceptance_status == 1)
                                            Disetujui
                                        @elseif ($device_installation->device_installation_acceptance_status == 2)
                                            Menunggu
                                        @else
                                            Status tidak valid
                                        @endif
                                    </p>
                                    <p><strong>Tanggal Pengajuan: </strong>{{ date('d-m-Y', strtotime($device_installation->created_at)) }}</p>
                                    <p><strong>Tanggal Rencana Pemasangan: </strong>
                                        {{ $device_installation->device_installation_bookiing_date ? date('d-m-Y', strtotime($device_installation->device_installation_bookiing_date)) : 'Menunggu persetujuan dari DSI' }}
                                    </p>

                                </div>
                            </div>
                            <div class="mt-3 mb-4 border-top"></div>
                            <div class="row mb-5">
                                <div class="col-md-6 mb-3 mb-sm-0">
                                    <h5 class="font-weight-bold">Dikeluarkan Oleh:</h5>
                                    <p>{{ $device_installation->team_unit->team_unit_name }}</p>
                                    <span style="white-space: pre-line">
                                        {{ $device_installation->user->user_full_name }}
                                        {{ $device_installation->user->user_nip }}

                                        {{ $device_installation->user->user_email }}
                                    </span>
                                </div>
                                <div class="col-md-6 text-sm-right">
                                    <h5 class="font-weight-bold">Catatan Dari DSI</h5>
                                    <p>{{ $device_installation->device_installation_message_from_dsi }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover mb-4">
                                        <thead class="bg-gray-300">
                                            <tr>
                                                <th scope="col">Penamaan Perangkat</th>
                                                <th scope="col">Deskripsi Perangkat</th>
                                                <th scope="col">Tahun Pembelian Perangkat</th>
                                                <th scope="col">jenis Perangkat</th>
                                                <th scope="col">Merk Perangkat</th>
                                                <th scope="col">Kategori Perangkat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $server_device->device_name }}</td>
                                                <td>{{ $server_device->device_description }}</td>
                                                <td>{{ $server_device->device_purchase_year }}</td>
                                                <td>{{ $server_device->device_type_name }}</td>
                                                <td>{{ $server_device->device_brand_name }}</td>
                                                <td>{{ $detail_identity_server->device_category_name }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-hover mb-4">
                                        <tr class="bg-gray-300">
                                            <th scope="col" colspan="2">Hardsisk</th>
                                            <th scope="col" colspan="2">Memory</th>
                                            <th scope="col" colspan="2">Processor</th>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Keping</td>
                                            <td>{{ $server_hard_disks->hard_disk_amount_of_piece }}</td>
                                            <td>Jumlah Keping</td>
                                            <td>{{ $server_memories->memory_amount_of_piece }}</td>
                                            <td>Jumlah Processor</td>
                                            <td>{{ $server_processors->processor_amount_of_piece }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kapasitas Tiap Keping</td>
                                            <td>{{ $server_hard_disks->hard_disk_capacity_of_piece }} GB</td>
                                            <td>Kapasitas Tiap Keping</td>
                                            <td>{{ $server_memories->memory_capacity_of_piece }} GB</td>
                                            <td>Jumlah Inti Processor</td>
                                            <td>{{ $server_processors->processor_amount_of_core }}</td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!--==== / Print Area =====-->
                    </div>
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                        <!--==== Edit Area =====-->
                        <div class="row">
                            @if( $device_installation->device_installation_acceptance_status == 1 )
                                <div class="col-md-5">
                                    <label for="device_installation_message_from_dsi" class="ul-form__label">Leave a Message:</label>
                                    <textarea class="form-control" id="device_installation_message_from_dsi" rows="10" required name="device_installation_message_from_dsi"{{ $device_installation->device_installation_acceptance_status != 2 ? 'readonly' : '' }}>{{ $device_installation->device_installation_message_from_dsi }}</textarea>
                                    <p id="charCount">0/500 karakter</p>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class=" d-block text-12 text-muted">Satus Pengajuan</label>
                                    <label class="radio radio-reverse radio-{{ $device_installation->device_installation_acceptance_status == 0 ? 'danger' : 'success' }}">
                                        <input type="radio" name="device_maintenance_acceptance_status" value="0" checked >
                                        <span>{{ $device_installation->device_installation_acceptance_status == 0 ? 'Ditolak' : 'Disetujui' }}</span>
                                        <span class="checkmark"></span>
                                    </label>
                                    <div class="form-group mb-4 ">
                                        <label >Diputuskan Tanggal</label>
                                        <input  class="form-control"  readonly value="{{ $device_installation->updated_at }}">
                                    </div>
                                    <div class="form-group mb-4 ">
                                        <label >Tanggal Rencana Co-Location</label>
                                        <input type="date" readonly class="form-control"  value="{{ $device_installation->device_installation_booking_date }}" >
                                    </div>
                                </div>
                                @php
                                    $isHasServerIp = App\Models\IPServer::where('device_registration_id', '=',  $device_installation->device_registration_id)->exists();
                                @endphp
                                @if($isHasServerIp) {{-- kalo sudah punya --}}
                                <div class=" col-md-3 mt-3">
                                    <input type="hidden" name="device_registration_id" required readonly value="{{ $device_installation->device_registration_id }}">
                                    <div class="form-group mb-4 ">
                                        <label >IP Server</label>
                                        <input type="text"  class="form-control" readonly value="{{ $server_device->ip_server_name }}" >
                                    </div>
                                    <div class="form-group mb-4 ">
                                        <label >IP Manajemen Server</label>
                                        <input type="text"  class="form-control" readonly value="{{ $server_device->ip_server_manage_name }}">
                                    </div>
                                </div>
                                @else
                                <form action="{{ route('admin.layanan.ip-server') }}" method="post" class="col-md-3">
                                    @csrf
                                    <div class=" mt-3">
                                        <input type="hidden" name="device_registration_id" required readonly value="{{ $device_installation->device_registration_id }}">
                                        <div class="form-group mb-4 ">
                                            <label for="ip_server_name">IP Server</label>
                                            <input type="text" id="ip_server_name" class="form-control"  name="ip_server_name"  >
                                        </div>
                                        <div class="form-group mb-4 ">
                                            <label for="ip_server_manage_name">IP Manajemen Server</label>
                                            <input type="text" id="ip_server_manage_name" class="form-control" name="ip_server_manage_name">
                                        </div>
                                        <div class="form-group mb-4 ">
                                            <button type="submit" class="btn btn-primary" >Submit</button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            @elseif($device_installation->device_installation_acceptance_status == 2)
                            <form method="post" class="col-md-12" action=" {{ route('admin.layanan.instalasi-perangkat.update',  ['instalasi_perangkat' => $device_installation->device_installation_registration_id]) }}">
                                @csrf
                                @method('put')       
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="device_installation_message_from_dsi" class="ul-form__label">Leave a Message:</label>
                                        <textarea class="form-control" id="device_installation_message_from_dsi" rows="10" required name="device_installation_message_from_dsi"{{ $device_installation->device_installation_acceptance_status != 2 ? 'readonly' : '' }}>{{ $device_installation->device_installation_message_from_dsi }}</textarea>
                                        <p id="charCount">0/500 karakter</p>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <label class=" d-block text-12 text-muted">Status Pengajuan</label>
                                        <div class=" pr-0 mb-4">
                                            <label class="radio radio-danger">
                                                <input id="reject_option" type="radio" name="device_installation_acceptance_status" value="0" {{$device_installation->device_installation_acceptance_status == 0 ? 'checked' : '' }} >
                                                <span>Ditolak</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio radio-reverse radio-success">
                                                <input type="radio" name="device_installation_acceptance_status" value="1" {{$device_installation->device_installation_acceptance_status == 1 ? 'checked' : '' }}>
                                                <span>Disetujui</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio radio-reverse radio-warning">
                                                <input type="radio" name="device_installation_acceptance_status" value="2" {{$device_installation->device_installation_acceptance_status == 2 ? 'checked' : '' }}>
                                                <span>Pending</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div class="form-group mb-4  ">
                                            <label for="updated_at">Diputuskan Tanggal</label>
                                            <input id="updated_at" class="form-control" name="updated_at" readonly>
                                        </div>
                                        <div class="form-group mb-4 ">
                                            <label for="device_installation_booking_date">Tanggal Rencana Co-Location</label>
                                            <input type="date" id="device_installation_booking_date" class="form-control" name="device_installation_booking_date"  required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <button type="submit" class="btn btn-primary" >Submit</button>
                                        </div>        
                                    </div>
                                </div>     
                            </form>
                            @elseif($device_installation->device_installation_acceptance_status == 0)
                            <div class="col-md-5">
                                <label for="device_installation_message_from_dsi" class="ul-form__label">Leave a Message:</label>
                                <textarea class="form-control" id="device_installation_message_from_dsi" rows="10" required name="device_installation_message_from_dsi"{{ $device_installation->device_installation_acceptance_status != 2 ? 'readonly' : '' }}>{{ $device_installation->device_installation_message_from_dsi }}</textarea>
                                <p id="charCount">0/500 karakter</p>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class=" d-block text-12 text-muted">Satus Pengajuan</label>
                                <label class="radio radio-reverse radio-{{ $device_installation->device_installation_acceptance_status == 0 ? 'danger' : 'success' }}">
                                    <input type="radio" name="device_maintenance_acceptance_status" value="0" checked >
                                    <span>{{ $device_installation->device_installation_acceptance_status == 0 ? 'Ditolak' : 'Disetujui' }}</span>
                                    <span class="checkmark"></span>
                                </label>
                                <div class="form-group mb-4 ">
                                    <label >Diputuskan Tanggal</label>
                                    <input  class="form-control"  readonly value="{{ $device_installation->updated_at }}">
                                </div>
                            </div>
                            @endif    
                        </div>
                        <!--==== / Edit Area =====-->
                    </div>
                </div>
            </div>
            {{-- <div id="pspdfkit" style="height: 100vh"></div> --}}
            <div id="pdfViewerContainer" class="col-md-12 mb-4 mt-3" style="display: none;">
                <iframe id="pdfViewer" style="height: 100vh; width: 100%" allowfullscreen webkitallowfullscreen></iframe>
            </div>

        </div>
    </div>

@endsection

@section('page-js')

<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/js/invoice.script.js')}}"></script>

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
@if( $device_installation->device_installation_acceptance_status == 2 )
<script>
    function updateDateTime() {
        var updatedAtInput = document.getElementById("updated_at");
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
</script>
@endif

@if( $device_installation->device_installation_acceptance_status == 2 )
<script>
    // Membuat referensi ke elemen radio button "Ditolak" dan elemen input tanggal
    var rejectOptionRadio = document.getElementById('reject_option');
    var bookingDateInput = document.getElementById('device_installation_booking_date');

    // Fungsi untuk mengatur atribut disabled dan required
    function setBookingDateAttributes() {
        if (rejectOptionRadio.checked) {
            bookingDateInput.disabled = true;
            bookingDateInput.removeAttribute('required');
        } else {
            bookingDateInput.disabled = false;
            bookingDateInput.setAttribute('required', 'required');
        }
    }

    // Memanggil fungsi setBookingDateAttributes() saat halaman dimuat
    setBookingDateAttributes();

    // Mendengarkan perubahan pada radio button "Ditolak"
    rejectOptionRadio.addEventListener('change', setBookingDateAttributes);

    // Mendengarkan perubahan pada radio button selain "Ditolak"
    var otherOptionRadios = document.querySelectorAll('input[name="device_installation_acceptance_status"]:not(#reject_option)');
    otherOptionRadios.forEach(function (radio) {
        radio.addEventListener('change', function () {
            setBookingDateAttributes();
        });
    });

</script>
@endif
<script>
    var textarea = document.getElementById('device_installation_message_from_dsi');
    var charCount = document.getElementById('charCount');

    function handleInputAndFocus() {
        var charLength = textarea.value.length; 
        charCount.textContent = charLength + '/500 karakter'; 
        if (charLength > 500) {
            textarea.value = textarea.value.substring(0, 499); 
        }
    }

    textarea.addEventListener('input', handleInputAndFocus);
    textarea.addEventListener('focus', handleInputAndFocus);
</script>
@endsection
