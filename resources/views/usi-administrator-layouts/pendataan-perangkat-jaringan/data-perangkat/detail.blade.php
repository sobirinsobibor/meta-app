@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Detail Perangkat</h1>
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
                @if ($device->id_device_type == 2)
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
                            <td>{{ $device->device_name }}</td>
                            <td>{{ $device->device_description }}</td>
                            <td>{{ $device->device_purchase_year }}</td>
                            <td>{{ $device->device_type->device_type_name }}</td>
                            <td>{{ $device->device_brand->device_brand_name }}</td>
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

        @else

        @endif

            </div>

        </div>
    </div>
</div>

<!-- Content-->
@endsection

@section('page-js')

 
@endsection

