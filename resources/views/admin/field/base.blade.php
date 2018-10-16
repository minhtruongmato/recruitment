@extends('admin.layouts.master')
@section('content')

<section class="content-header">
	<h1>
		Lĩnh Vực
		<small>Danh sách lĩnh vực</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Lĩnh vực</li>
	</ol>
</section>
<!-- Main content -->

@yield('action-content')

<!-- /.content -->
{{-- <script type="text/javascript" src="{{ asset('') }}"></script> --}}
@endsection
