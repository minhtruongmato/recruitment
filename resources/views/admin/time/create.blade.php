@extends('admin.time.base')
@section('action-content')

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-slug">Thêm Mới Giờ Làm</h3>
					@if(Session::has('error'))
						<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
					@endif
				</div>
				<div class="box-body">
					<form action="{{ route('time.store') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="title">Giờ Làm</label>
								<div class="col-md-9">
									<input type="text" name="title" value="{{ old('title') }}" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title">

									@if ($errors->has('title'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('title') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="slug">Slug</label>
								<div class="col-md-9">
									<input type="text" name="slug" value="{{ old('slug') }}" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" id="slug" readonly>
								</div>
							</div>

							<div class="form-group">
                                <div class="col-md-1 col-md-offset-11">
                                    <button type="submit" class="btn btn-primary">
                                        OK
                                    </button>
                                </div>
                            </div>
					</form>
				</div>
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	<!-- END ACCORDION & CAROUSEL-->
</section>

@endsection