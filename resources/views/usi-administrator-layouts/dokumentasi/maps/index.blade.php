@extends('layouts.compact-vertical-sidebar.master')

@section('page-css')


@endsection
@section('main-content')
<div class="breadcrumb">
    <h1>Halaman Maps</h1>
    <ul>
        <li><a href="">Starter</a></li>
        <li>Blank Page</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>


<!-- Content-->

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15830.900509546871!2d112.74068165541993!3d-7.272087199999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd38ea51a2f%3A0x2640d21feb8c9fd8!2sUniversitas%20Airlangga%20-%20Kampus%20Dharmawangsa%20(B)!5e0!3m2!1sid!2sid!4v1701655611185!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

<!-- Content-->
@endsection

@section('page-js')


@endsection