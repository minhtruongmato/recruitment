@extends('admin.layouts.master')
@section('content')

<section class="content-header">
	<h1>
		Nơi Làm Việc
		<small>Danh sách nơi làm việc</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Nơi làm việc</li>
	</ol>
</section>
<!-- Main content -->

@yield('action-content')

<!-- /.content -->
{{-- <script type="text/javascript" src="{{ asset('') }}"></script> --}}
@endsection
