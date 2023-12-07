@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')

@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Edit Perangkat</h1>
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
                    <form action=" {{ route('staff.pendataan.perangkat.update',  ['perangkat' => $device->device_registration_id]) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="form-row ">
                                <div class="col-md-6">
                                    <div class="form-group col-md-12">
                                        <label for="device_name" class="ul-form__label">Nama Perangkat:</label>
                                        <input type="text" class="form-control" id="device_name" autofocus required name="device_name" value="{{ $device->device_name }}">                              
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="device_purchase_year" class="ul-form__label">Tahun Pembelian:</label>
                                        <input type="number" class="form-control" id="device_purchase_year" required name="device_purchase_year" value="{{ $device->device_purchase_year }}">
                                        @error('device_purchase_year')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="device_description" class="ul-form__label">Deskripsi Perangkat:</label>
                                        <textarea class="form-control" id="device_description" rows="5" name="device_description" >{{ $device->device_description }}</textarea>
                                        <p id="charCount">0/150 karakter</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12 form-group ">
                                        <label for="id_device_type" class="ul-form__label">Jenis Perangkat</label>
                                        <select class="form-control" id="id_device_type" required name="id_device_type">
                                            <option value="">--pilih opsi--</option>
                                            @foreach($deviceTypes as $deviceType)
                                                <option value="{{ $deviceType->id }}" {{ ($deviceType->id === $device->id_device_type) ? 'selected':'' }} >{{ $deviceType->device_type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group " >
                                        <label for="id_device_brand" class="ul-form__label">Merk Perangkat</label>
                                        <select class="form-control" id="id_device_brand" required name="id_device_brand">
                                            <option value="">--pilih opsi--</option>
                                            @foreach($deviceBrands as $deviceBrand)
                                                <option value="{{ $deviceBrand->id }}" {{ ($deviceBrand->id === $device->id_device_brand) ? 'selected':'' }}>{{ $deviceBrand->device_brand_name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="team_unit_name" class="ul-form__label">Unit kerja:</label>
                                        <input type="text" class="form-control" id="team_unit_name" value="{{ Auth::user()->team_unit->team_unit_name }}" readonly required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="hidden" class="form-control" value="{{ Auth::user()->id_team_unit }}" readonly required name="id_team_unit">
                                    </div>
                                    <div class="col-md-12 form-group ">
                                        <label for="device_active_status" class="ul-form__label">Status Perangkat</label>
                                        <select class="form-control" id="device_active_status" required name="device_active_status">
                                            <option value="true" {{ ($device->device_active_status === true) ? 'selected' : '' }}>Aktif</option>
                                            <option value="false" {{ ($device->device_active_status === false) ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
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
    var textarea = document.getElementById('device_description');
    var charCount = document.getElementById('charCount');

    textarea.addEventListener('input', function() {
        var charLength = this.value.length; 
        charCount.textContent = charLength + '/150 karakter'; 
        if (charLength > 150) {
            this.value = this.value.substring(0, 150); 
        }
    });

    textarea.addEventListener('focus', function() {
        var charLength = this.value.length; 
        charCount.textContent = charLength + '/150 karakter'; 
        if (charLength > 150) {
            this.value = this.value.substring(0, 150); 
        }
    });
</script>
 
@endsection

