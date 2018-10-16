@extends('admin.candidate.base')
@section('action-content')

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh Sách Hồ Sơ Ứng Viên</h3>
                @if(Session::has('error'))
                <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>
            @endif
            @if(Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>
            @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6"><a class="btn btn-primary" href="{{ route('candidate.create') }}">Thêm mới hồ sơ ứng viên</a></div>
                <div class="col-sm-6">
                    <form method="get" action="{{ route('candidate.index') }}">
                        <div class="row">
                            <div class="col-xs-9 clearable">
                                <input type="text" name="keyword" value="{{ $keyword }}" class="form-control search" placeholder="Tìm kiếm tên hồ sơ hoặc tên ứng viên" style="border-radius: 4px">
                                <i class="clearable__clear">&times;</i>
                            </div>
                            <div class="col-xs-2">
                                <input type="submit" class="btn btn-info" value="Tìm Kiếm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th>STT</th>
                                <th>Tên hồ sơ</th>
                                <th>Tên ứng viên</th>
                                <th>Giới tính</th>
                                <th>Vị trí</th>
                                <th>Lương</th>
                                <th>Công việc</th>
                                <th>Lĩnh vực</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($result)
                            @foreach ($result as $key => $value)
                                <tr role="row" class="odd row-4" >
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        @switch($value->gender)
                                            @case(1)
                                                Nam
                                                @break
                                            @case(2)
                                                Không rõ
                                                @break
                                            @default
                                                 Nữ
                                        @endswitch
                                    </td>
                                    <td>
                                        @foreach ($value->position as $k => $val)
                                            <span style="background-color: #3c8dbc; border-radius: 2px; color: #fff">
                                                {{ $val->title }}
                                            </span><br />
                                        @endforeach
                                    </td>
                                    <td>{{ $value->wage->title }}</td>
                                    <td>
                                        @foreach ($value->career as $k => $val)
                                            <span style="background-color: #3c8dbc; border-radius: 2px; color: #fff">
                                                {{ $val->title }}
                                            </span><br />
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($value->field as $k => $val)
                                            <span style="background-color: #3c8dbc; border-radius: 2px; color: #fff">
                                                {{ $val->title }}
                                            </span><br />
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('candidate.show', ['id' => $value->id]) }}" style="margin: 0px 10px; color: #3c8dbc" title="Chi Tiết">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('candidate.edit', ['id' => $value->id]) }}" style="margin: 0px 10px; color: #f0ad4e" title="Chỉnh Sửa">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a href="javascript:void(0)" style="margin: 0px 10px; color: #d9534f" class="btn-remove" data-id="4" data-url="http://localhost/mobile/admin/product/remove/4" title="Xóa">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên hồ sơ</th>
                                    <th>Tên ứng viên</th>
                                    <th>Giới tính</th>
                                    <th>Vị trí</th>
                                    <th>Lương</th>
                                    <th>Công việc</th>
                                    <th>Lĩnh vực</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            @else
                                <tr role="row" class="odd row-4" >
                                    Chưa tồn tại hồ sơ ứng viên
                                <tr>
                            @endif
                    </table>
                </div>
            </div>
        <div class="row">
            <div class="col-sm-5">
                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Hiển thị  hồ sơ ứng viên</div>
            </div>
            <div class="col-sm-7">
                <div class="paging_simple_numbers" id="example2_paginate">
                    {{ $result->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection