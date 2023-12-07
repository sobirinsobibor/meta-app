@extends('layouts.master')
@section('page-css')
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">

  <style>
    @media print {
        #viewDocButton {
            display: none;
        }
    }
  </style>

@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            {{-- <ul class="nav nav-tabs justify-content-start mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab"
                        aria-controls="invoice" aria-selected="true">Invoice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit"
                        aria-selected="false">Edit</a>
                </li>

            </ul> --}}
            <div class="card">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                        <div class="d-sm-flex mb-5" data-view="print">
                            <span class="m-auto"></span>
                            <button class="btn btn-primary mb-sm-0 mb-3 print-invoice">Cetak Pengajuan</button>
                        </div>
                        <!---===== Print Area =======-->
                        <div id="print-area">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="font-weight-bold">Nomor Registrasi</h4>
                                    <p>{{ $device_maintenance->device_maintenance_registration_id }}</p>
                                </div>
                                <div class="col-md-6 text-sm-right">
                                    <p><strong>Status: </strong> 
                                        @if ($device_maintenance->device_maintenance_acceptance_status == 0)
                                            Ditolak
                                        @elseif ($device_maintenance->device_maintenance_acceptance_status == 1)
                                            Disetujui
                                        @elseif ($device_maintenance->device_maintenance_acceptance_status == 2)
                                            Menunggu
                                        @else
                                            Status tidak valid
                                        @endif
                                    </p>
                                    <p><strong>Tanggal Pengajuan: </strong>{{ date('d-m-Y', strtotime($device_maintenance->created_at)) }}</p>
                                    <p><strong>Tanggal Rencana Pemeliharaan: </strong>{{ date('d-m-Y', strtotime($device_maintenance->device_maintenance_booking_date)) }}</p>
                                </div>
                            </div>
                            <div class="mt-3 mb-4 border-top"></div>
                            <div class="row mb-5">
                                <div class="col-md-6 mb-3 mb-sm-0">
                                    <h5 class="font-weight-bold">Dikeluarkan Oleh:</h5>
                                    <p>{{ $device_maintenance->team_unit->team_unit_name }}</p>
                                    <span style="white-space: pre-line">
                                        {{ $device_maintenance->user->user_full_name }}
                                        {{ $device_maintenance->user->user_nip }}

                                        {{ $device_maintenance->user->user_email }}
                                    </span>
                                </div>
                                <div class="col-md-6 text-sm-right">
                                    <h5 class="font-weight-bold">Layanan Pemeliharaan</h5>
                                    <p>{{ $device_maintenance->maintenance_service->maintenance_service_name }} {{ ($device_maintenance->maintainable_part) }}</p>

                                    <h5 class="font-weight-bold">Catatan</h5>
                                    <p>{{ $device_maintenance->device_maintenance_note }}</p>
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
                    {{-- <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                        <!--==== Edit Area =====-->
                        <div class="d-flex mb-5">
                            <span class="m-auto"></span>
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <form >
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="font-weight-bold">Order Info</h4>
                                    <div class="col-sm-4 form-group mb-3 pl-0">
                                        <label for="orderNo">Order Number</label>
                                        <input type="text" class="form-control"
                                            id="orderNo" placeholder="Enter order number">
                                    </div>
                                </div>
                                <div class="col-md-3 offset-md-3 text-right">
                                    <label class="d-block text-12 text-muted">Order Status</label>
                                    <div class="col-md-6 offset-md-6 pr-0 mb-4">
                                        <label class="radio radio-reverse radio-danger">
                                            <input type="radio" name="orderStatus" value="Pending">
                                            <span>Pending</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-reverse radio-warning">
                                            <input type="radio" name="orderStatus" value="Processing">
                                            <span>Processing</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-reverse radio-success">
                                            <input type="radio" name="orderStatus" value="Delivered">
                                            <span>Delivered</span>
                                            <span class="checkmark"></span>
                                        </label>

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="order-datepicker">Order Date</label>
                                            <input id="order-datepicker" class="form-control text-right"
                                                placeholder="yyyy-mm-dd" name="dp">


                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 mb-4 border-top"></div>
                            <div class="row mb-5">
                                <div class="col-md-6" >
                                    <h5 class="font-weight-bold">Bill From</h5>
                                    <div class="col-md-10 form-group mb-3 pl-0">
                                        <input type="text" class="form-control" id="billFrom"
                                            placeholder="Bill From">
                                    </div>
                                    <div class="col-md-10 form-group mb-3 pl-0">
                                        <textarea class="form-control"
                                            placeholder="Bill From Address"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 text-right" >
                                    <h5 class="font-weight-bold">Bill To</h5>
                                    <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                        <input type="text" class="form-control text-right"
                                            id="billFrom2" placeholder="Bill From">
                                    </div>
                                    <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                        <textarea class="form-control text-right"
                                            placeholder="Bill From Address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover mb-3">
                                        <thead class="bg-gray-300">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Cost</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <input value="Product 1" type="text" class="form-control"
                                                        placeholder="Item Name">
                                                </td>
                                                <td>
                                                    <input value="300" type="number" class="form-control"
                                                        placeholder="Unit Price">
                                                </td>
                                                <td>
                                                    <input value="2" type="number" class="form-control"
                                                        placeholder="Unit">
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>
                                                    <input value="Product 1" type="text" class="form-control"
                                                        placeholder="Item Name">
                                                </td>
                                                <td>
                                                    <input value="300" type="number" class="form-control"
                                                        placeholder="Unit Price">
                                                </td>
                                                <td>
                                                    <input value="2" type="number" class="form-control"
                                                        placeholder="Unit">
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary float-right mb-4">Add Item</button>
                                </div>

                                <div class="col-md-12">

                                    <div class="invoice-summary invoice-summary-input">
                                        <p>Sub total: <span>$1200</span></p>
                                        <p class="d-flex align-items-center">Vat(%):<span>
                                                <input type="text" class="form-control small-input" value="10">$120</span>
                                        </p>
                                        <h5 class="font-weight-bold d-flex align-items-center">Grand Total:
                                            <span>
                                                <input type="text" class="form-control small-input" value="$">
                                                $1320
                                            </span>
                                        </h5>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!--==== / Edit Area =====-->
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-js')

<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>
<script src="{{asset('assets/js/invoice.script.js')}}"></script>

@endsection