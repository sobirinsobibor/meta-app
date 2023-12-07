@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')

@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tambah Pelepasan Perangkat</h1>
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
<section class="basic-action-bar">
    <div class="">
        <!-- begin::main-row -->
        <div class="row">
            <!-- start default action bar -->
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <!--begin::form-->
                    <form action="{{ route('staff.layanan.pelepasan-perangkat') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-row ">
                                <div class="col-md-6">
                                    <div class="form-group col-md-12">
                                        <label for="nama_pengunggah" class="ul-form__label">Nama Pengunggah</label>
                                        <input type="text" class="form-control" id="nama_pengunggah" autofocus required name="nama_pengunggah" value="{{ auth()->user()->user_full_name }}" readonly>                              
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="user_nip" class="ul-form__label">NIP</label>
                                        <input type="number" class="form-control" id="user_nip" required name="user_nip" value="{{ auth()->user()->user_nip }}" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="team_unit_name" class="ul-form__label">Unit kerja</label>
                                        <input type="text" class="form-control" id="team_unit_name" value="{{ Auth::user()->team_unit->team_unit_name }}" readonly required>
                                    </div>
                                    <div class="col-md-12 form-group ">
                                        <label for="device_registration_id" class="ul-form__label">Pilih Server</label>
                                        <select class="form-control" id="device_registration_id" required name="device_registration_id">
                                            <option value="">--pilih opsi--</option>
                                            @foreach($serverDevices as $serverDevice)
                                                <option value="{{ $serverDevice->device_registration_id }}">{{ $serverDevice->device_name }} - {{ $serverDevice->device_type_name }} - {{ $serverDevice->device_brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                </div>
                                
                                <div class="col-md-6">
                                    

                                    <div class="form-group col-md-12">
                                        <label for="device_dismantle_reason" class="ul-form__label">Alasan Dismantle:</label>
                                        <textarea class="form-control" id="device_dismantle_reason" rows="4"  name="device_dismantle_reason"></textarea>
                                        <p id="charCount">0/250 karakter</p>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="team_unit_name" class="ul-form__label">Rencana Dismantle</label>
                                        <input type="date" class="form-control" id="device_dismantle_booking_date" required name="device_dismantle_booking_date">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="file" class="ul-form__label">Upload file:</label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input form-control" id="file" name="file" required>
                                                <label class="custom-file-label" for="file">Choose file (.pdf, .png, .jpg)</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <input type="hidden" class="form-control" value="{{ Auth::user()->id_team_unit }}" readonly required name="id_team_unit">
                                        <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" readonly required name="id_user">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="mc-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn  btn-primary m-1 footer-delete-right">Submit</button>
                                        <button type="button" class="btn btn-outline-secondary m-1 footer-delete-right">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end::form -->
                </div>
            </div>
            <!-- end default action bar -->
        </div>
    </div>    
</section>
<!-- Content-->
@endsection

@section('page-js')

<script>
    var textarea = document.getElementById('device_dismantle_reason');
    var charCount = document.getElementById('charCount');

    textarea.addEventListener('input', function() {
        var charLength = this.value.length; 
        charCount.textContent = charLength + '/250 karakter'; 
        if (charLength > 250) {
            this.value = this.value.substring(0, 249); 
        }
    });
</script>

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
@endsection

