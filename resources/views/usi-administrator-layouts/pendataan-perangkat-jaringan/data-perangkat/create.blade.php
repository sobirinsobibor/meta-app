@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')

@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Tambah Perangkat</h1>
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
                    <form action="{{ route('staff.pendataan.perangkat') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-row ">
                                <div class="col-md-6">
                                    <div class="form-group col-md-12">
                                        <label for="team_unit_name" class="ul-form__label">Unit kerja:</label>
                                        <input type="text" class="form-control" id="team_unit_name" value="{{ Auth::user()->team_unit->team_unit_name }}" readonly required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="device_name" class="ul-form__label">Penamaan Perangkat:</label>
                                        <input type="text" class="form-control" id="device_name" autofocus required name="device_name">                              
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="device_purchase_year" class="ul-form__label">Tahun Pembelian:</label>
                                        <input type="number" class="form-control" id="device_purchase_year" required name="device_purchase_year">
                                    </div>
                                    <div class="col-md-12 form-group ">
                                        <label for="id_device_type" class="ul-form__label">Jenis Perangkat</label>
                                        <select class="form-control" id="id_device_type" required name="id_device_type">
                                            <option value="">--pilih opsi--</option>
                                            @foreach($deviceTypes as $deviceType)
                                                <option value="{{ $deviceType->id }}">{{ $deviceType->device_type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group " >
                                        <label for="id_device_brand" class="ul-form__label">Merk Perangkat</label>
                                        <select class="form-control" id="id_device_brand" required name="id_device_brand">
                                            <option value="">--pilih opsi--</option>
                                            @foreach($deviceBrands as $deviceBrand)
                                                <option value="{{ $deviceBrand->id }}">{{ $deviceBrand->device_brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- kalo dia milih jeni perangkat == 2 (server) --}}
                                    <div class="if_server" style="display: none;">
                                        <div class="col-md-12 form-group " >
                                            <label for="id_device_category" class="ul-form__label">Kategori Server</label>
                                            <select class="form-control server_input_required" id="id_device_category"  name="id_device_category">
                                                <option value="">--pilih opsi--</option>
                                                @foreach($deviceCategories as $deviceCategory)
                                                    <option value="{{ $deviceCategory->id }}">{{ $deviceCategory->device_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group " >
                                            <label for="id_server_type" class="ul-form__label">Tipe Server</label>
                                            <select class="form-control server_input_required" id="id_server_type"  name="id_server_type">
                                                <option value="">--pilih opsi--</option>
                                                @foreach($serverTypes as $serverType)
                                                    <option value="{{ $serverType->id }}">{{ $serverType->server_type_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group " >
                                            <label for="id_server_function_select" class="ul-form__label">Fungsi Server</label>
                                            <select class="form-control server_input_required" id="id_server_function_select"  name="id_server_function" >
                                                <option value="">--pilih opsi--</option>
                                                @foreach($serverFunctions as $serverFunction)
                                                    <option value="{{ $serverFunction->server_function_name }}">{{ $serverFunction->server_function_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12" id="lainnya_input" style="display: none;">
                                            <input type="text" class="form-control" id="id_server_function_input"  placeholder="Tulis Fungsi">
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group col-md-12">
                                        <input type="hidden" class="form-control" value="{{ Auth::user()->id_team_unit }}" readonly required name="id_team_unit">
                                    </div>
                                    {{-- kalo dia milih jeni perangkat == 2 (server) --}}
                                    <div class="if_server" style="display: none;">
                                        <div class="col-md-12 form-group ">
                                            <label for="team_unit_name" class="ul-form__label">Hard Disk</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="hard_disk_amount_of_piece">Jumlah Keping</span>
                                                </div>
                                                <input type="number" class="form-control server_input_required" id="hard_disk_amount_of_piece" name="hard_disk_amount_of_piece" >
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="hard_disk_capacity_of_piece">Kapasitas per Keping</span>
                                                </div>
                                                <input type="number" class="form-control server_input_required" id="hard_disk_capacity_of_piece" name="hard_disk_capacity_of_piece" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">GB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group ">
                                            <label for="team_unit_name" class="ul-form__label">Memory</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id=memory_amount_of_piece">Jumlah Keping</span>
                                                </div>
                                                <input type="number" class="form-control server_input_required" id="memory_amount_of_piece" name="memory_amount_of_piece" >
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="memory_capacity_of_piece">Kapasitas per Keping</span>
                                                </div>
                                                <input type="number" class="form-control server_input_required" id="memory_capacity_of_piece" name="memory_capacity_of_piece" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">GB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group ">
                                            <label for="team_unit_name" class="ul-form__label">Processor</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id=processor_amount_of_piece">Jumlah Processor</span>
                                                </div>
                                                <input type="number" class="form-control server_input_required" id="processor_amount_of_piece" name="processor_amount_of_piece" >
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="processor_amount_of_core">Jumlah Inti Processor</span>
                                                </div>
                                                <input type="number" class="form-control server_input_required" id="processor_amount_of_core" name="processor_amount_of_core" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="device_description" class="ul-form__label">Deskripsi Perangkat:</label>
                                        <textarea class="form-control" id="device_description" rows="5" name="device_description" required></textarea>
                                        <p id="charCount">0/150 karakter</p>
                                    </div>

                                    <div class="col-md-12 form-group ">
                                        <label for="device_active_status" class="ul-form__label">Status Perangkat</label>
                                        <select class="form-control" id="device_active_status" required name="device_active_status">
                                            <option value="true">Aktif</option>
                                            <option value="false">Tidak Aktif</option>
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
</script>

<script>
    var idDeviceType = document.getElementById("id_device_type");
    var ifServerDivs = document.querySelectorAll(".if_server");

    idDeviceType.addEventListener("change", function () {
        var selectedValue = this.value;
        var requiredInputs = [];

        for (var i = 0; i < ifServerDivs.length; i++) {
            var ifServerDiv = ifServerDivs[i];
            if (selectedValue === "2") {
                ifServerDiv.style.display = "block";
                var inputs = ifServerDiv.querySelectorAll(".server_input_required");
                requiredInputs = requiredInputs.concat(Array.from(inputs));
            } else {
                ifServerDiv.style.display = "none";
            }
        }

        for (var i = 0; i < requiredInputs.length; i++) {
            if (selectedValue === "2") {
                requiredInputs[i].setAttribute("required", "required");
            } else {
                requiredInputs[i].removeAttribute("required");
            }
        }
    });
</script>
<script>
    // Dapatkan elemen select dan input
    var select = document.getElementById('id_server_function_select');
    var input = document.getElementById('lainnya_input');
    var inputField = document.getElementById('id_server_function_input')

    // Tambahkan event listener untuk memantau perubahan pada elemen select
    select.addEventListener('change', function() {
        // Periksa apakah opsi yang dipilih adalah "Lainnya"
        if (select.value === 'Lainnya') {
            // Sembunyikan nama atribut name pada elemen select
            select.removeAttribute('name');
            // Tampilkan input teks
            input.style.display = 'block';
            //set atr
            inputField.setAttribute('required', 'required');
            inputField.setAttribute('name', 'id_server_function');
        } else {
            // Setel kembali nama atribut name pada elemen select
            select.setAttribute('name', 'id_server_function');
            // Sembunyikan input teks jika opsi lain yang dipilih
            input.style.display = 'none';
            //unset atr
            inputField.removeAttribute('required');
        }
    });
</script>

@endsection

