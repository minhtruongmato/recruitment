@extends('admin.layouts.master')
@section('content')

<section class="content-header">
	<h1>
		Trình Độ Học Vấn
		<small>Danh sách Trình độ học vấn</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Trình Độ Học Vấn</li>
	</ol>
</section>
<!-- Main content -->

@yield('action-content')

<!-- /.content -->
{{-- <script type="text/javascript" src="{{ asset('') }}"></script> --}}
@endsection
