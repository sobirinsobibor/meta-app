@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Halaman Profile</h1>
    <ul>
        <li><a href="">Starter</a></li>
        <li>Blank Page</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>


<!-- Content-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    User Profile
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <th>Nama Pengguna</th>
                            <td>:</td>
                            <td>{{ $user->user_full_name }}</td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td>:</td>
                            <td>{{ $user->user_nip}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td>{{ $user->user_email}}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>:</td>
                            <td>{{ $user->user_phone}}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>:</td>
                            <td>{{ $user->role->role_name }}</td>
                        </tr>
                        <tr>
                            <th>Unit Kerja</th>
                            <td>:</td>
                            <td>{{ $user->team_unit->team_unit_name }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>{{ ( $user->user_active_status ) ? 'Aktif' : 'Tidak Aktif';}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content-->
@endsection

@section('page-js')


@endsection