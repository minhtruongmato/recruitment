@extends('admin.career.base')
@section('action-content')

<!-- /.box-header -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh Sách Ngành Nghề</h3>
            @if(Session::has('error'))
                <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>
            @endif
            @if(Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>
            @endif
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6"><a class="btn btn-primary" href="{{ route('career.create') }}">Thêm mới ngành nghề</a></div>
                <div class="col-sm-6">
                    <form method="get" action="{{ route('career.index') }}">
                        <div class="row">
                            <div class="col-xs-9 clearable">
                                <input type="text" name="keyword" value="{{ $keyword }}" class="form-control search" placeholder="Tìm kiếm... " style="border-radius: 4px">
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
                    <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th>STT</th>
                                <th>Tên ngành nghề</th>
                                <th>Slug</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        @if ($result && count($result))
                        <tbody>
                            @foreach ($result as $key => $value)
                            <tr role="row" class="odd row-{{$value->id}}" >
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->slug }}</td>
                                <td>
                                    <a href="{{ route('career.edit', ['id' => $value->id]) }}" style="margin: 0px 10px; color: #f0ad4e" title="Chỉnh Sửa">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <a href="javascript:void(0)" style="margin: 0px 10px; color: #d9534f" class="btn-remove" data-id="{{ $value->id }}" data-url="{{ route('career.remove', ['id' => $value->id]) }}" title="Xóa">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên ngành nghề</th>
                                <th>Slug</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                        @else
                            Chưa tồn tại ngành nghề
                        @endif
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Hiển thị  ngành nghề</div>
                </div>
                <div class="col-sm-7">
                    <div class="paging_simple_numbers" id="example2_paginate">
                        {{ $result->links() }}
                    </div>
                </div>
            </div>
        </div>
            <!-- /.box-body -->
    </div>
</section>
@endsection