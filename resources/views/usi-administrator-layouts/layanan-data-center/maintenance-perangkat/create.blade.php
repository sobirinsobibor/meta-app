@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')

@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tambah Pemeliharaan Perangkat</h1>
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
                    <form action="{{ route('staff.layanan.pemeliharaan-perangkat') }}" method="post">
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
                                        <select class="form-control" id="device_registration_id"  name="device_registration_id">
                                            <option value="">--pilih opsi--</option>
                                            @foreach($serverDevices as $serverDevice)
                                                <option value="{{ $serverDevice->device_registration_id }}">{{ $serverDevice->device_name }} - {{ $serverDevice->device_type_name }} - {{ $serverDevice->device_brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="col-md-12 form-group " >
                                        <label for="id_maintenance_service" class="ul-form__label">Pilih Layanan Maintenance</label>
                                        <select class="form-control" id="id_maintenance_service"  name="id_maintenance_service">
                                            <option value="">--pilih opsi--</option>
                                            @foreach($maintenanceServices as $maintenanceService)
                                                <option value="{{ $maintenanceService->id }}">{{ $maintenanceService->maintenance_service_name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group" id="id_part_container"  style="display: none;" >
                                        <label for="maintainable_part" class="ul-form__label">Pilih Part</label>
                                        <select class="form-control" id="maintainable_part"  name="maintainable_part">
                                            <option value="">--pilih opsi--</option>
                                            <option value="hdd">Hdd</option>
                                            <option value="memory">Memory</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="device_maintenance_note" class="ul-form__label">Catatan:</label>
                                        <textarea class="form-control" id="device_maintenance_note" rows="4"  name="device_maintenance_note"></textarea>
                                        <p id="charCount">0/250 karakter</p>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="device_maintenance_booking_date" class="ul-form__label">Rencana Maintenance</label>
                                        <input type="date" class="form-control" id="device_maintenance_booking_date" required name="device_maintenance_booking_date">
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
    var textarea = document.getElementById('device_maintenance_note');
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
    document.getElementById('id_maintenance_service').addEventListener('change', function () {
        const selectedMaintenanceService = this.value;
        const idPartContainer = document.getElementById('id_part_container');
        const maintainablePartSelect = document.getElementById('maintainable_part');
        
        if (selectedMaintenanceService === '2') {
            idPartContainer.style.display = 'block';
            maintainablePartSelect.setAttribute('required', 'required'); // Menambahkan atribut 'required'
        } else {
            idPartContainer.style.display = 'none';
            maintainablePartSelect.removeAttribute('required');
            maintainablePartSelect.value = '';
        }
    });
</script>
 
@endsection

