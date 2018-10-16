@extends('admin.layouts.master')
@section('content')

<section class="content-header">
	<h1>
		Giờ Làm
		<small>Danh sách giờ làm</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Giờ Làm</li>
	</ol>
</section>
<!-- Main content -->

@yield('action-content')

<!-- /.content -->
{{-- <script type="text/javascript" src="{{ asset('') }}"></script> --}}
@endsection
