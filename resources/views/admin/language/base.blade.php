@extends('admin.layouts.master')
@section('content')

<section class="content-header">
	<h1>
		Ngoại Ngữ
		<small>Danh sách ngoại ngữ</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Ngoại Ngữ</li>
	</ol>
</section>
<!-- Main content -->

@yield('action-content')

<!-- /.content -->
{{-- <script type="text/javascript" src="{{ asset('') }}"></script> --}}
@endsection
