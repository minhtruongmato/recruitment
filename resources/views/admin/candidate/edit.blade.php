@extends('admin.candidate.base')
@section('action-content')

<!-- Main content -->

<section class="content">

	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-slug">Thêm Mới Ứng Viên</h3>
					@if(Session::has('error'))
						<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
					@endif
				</div>
				<div class="box-body">

					<form action="{{ route('candidate.update', ['id' => $detail['id']]) }}" method="post" enctype="multipart/form-data">
						{{ method_field('PUT') }}
						{{ csrf_field() }}
							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="image">Ảnh đại diện đang dùng</label>
								<div class="col-md-9">
									<img src="{{ asset('storage/app/candidates/' . $detail['slug'] .'/'. $detail['image']) }}" width="150px" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="image">Ảnh đại diện </label>
								<div class="col-md-9">
									<span id="message_error_image"></span>
									<img id="image" width="150px" style="display: none" />
									<input type="file" name="image" value="{{ old('image') }}" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" id="imageUpload">

									@if ($errors->has('image'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('image') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="title">Tên Hồ sơ (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<input type="text" name="title" value="{{ $detail['title'] }}" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title">

									@if ($errors->has('title'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('title') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="name">Tên ứng viên (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<input type="text" name="name" value="{{ $detail['name'] }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name">

									@if ($errors->has('name'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="slug">Slug (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<input type="text" name="slug" value="{{ $detail['slug'] }}" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" id="slug" readonly>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="gender">Giới tính (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
										<option value="">Chọn giới tính</option>
										<option value="0" {{ $detail['gender'] == 0 ? 'selected' : '' }}>Nữ</option>
										<option value="1" {{ $detail['gender'] == 1 ? 'selected' : '' }}>Nam</option>
										<option value="2" {{ $detail['gender'] == 2 ? 'selected' : '' }}>Không xác định</option>
									</select>
									@if ($errors->has('gender'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('gender') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="email">E-Mail (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<input type="text" name="email" value="{{ $detail['email'] }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">

									@if ($errors->has('email'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="address">Địa Chỉ (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<input type="text" name="address" value="{{ $detail['address'] }}" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">

									@if ($errors->has('address'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('address') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="phone">Số Điện Thoại (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<input type="text" name="phone" value="{{ $detail['phone'] }}" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}">

									@if ($errors->has('phone'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('phone') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="birthday">Ngày sinh (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<input type="text" name="birthday" value="{{ $detail['birthday'] }}" class="form-control datepicker {{ $errors->has('birthday') ? ' is-invalid' : '' }}">

									@if ($errors->has('birthday'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('birthday') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="marital">Tình trạng hôn nhân (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="marital" value="{{ old('marital') }}" class="form-control{{ $errors->has('marital') ? ' is-invalid' : '' }}">
										<option value="">Chọn tình trạng hôn nhân</option>
										<option value="0" {{ $detail['marital'] == 0 ? 'selected' : '' }}>Độc thân</option>
										<option value="1" {{ $detail['marital'] == 1 ? 'selected' : '' }}>Đã kết hôn</option>
									</select>
									@if ($errors->has('marital'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('marital') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="time_id">Thời gian làm việc (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="time_id" value="{{ old('time_id') }}" class="form-control{{ $errors->has('time_id') ? ' is-invalid' : '' }}">
										<option value="">Chọn thời gian làm việc</option>
										@if ($time)
											@foreach ($time as $key => $value)
												<option value="{{ $value->id }}" {{ $detail['time']['id'] == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
											@endforeach
										@endif
									</select>
									@if ($errors->has('time_id'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('time_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="experience">Kinh Nghiệm (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<input type="text" name="experience" value="{{ $detail['experience'] }}" class="form-control{{ $errors->has('experience') ? ' is-invalid' : '' }}">

									@if ($errors->has('experience'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('experience') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="educations_id">Trình độ học vấn (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="educations_id" value="{{ old('educations_id') }}" class="form-control{{ $errors->has('educations_id') ? ' is-invalid' : '' }}">
										<option value="">Chọn trình độ học vấn</option>
										@foreach ($education as $key => $value)
											<option value="{{ $value->id }}" {{ $detail['education']['id'] == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
										@endforeach
									</select>
									@if ($errors->has('educations_id'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('educations_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="position">Vị trí mong muốn (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="position[]" class="form-control position {{ $errors->has('position') ? ' is-invalid' : '' }}" multiple="multiple" data-placeholder="Chọn tối đa 3 vị trí">
										@if ($position)
											@foreach ($position as $key => $value)
												<option value="{{ $value->id }}" {{ in_array($value->id, $detail['position_id']) ? 'selected' : '' }}>{{ $value->title }}</option>
											@endforeach
										@endif
									</select>
									@if ($errors->has('position'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('position') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="wages_id">Mức lương mong muốn (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="wages_id" value="{{ old('wages_id') }}" class="form-control{{ $errors->has('wages_id') ? ' is-invalid' : '' }}">
										<option value="">Chọn mức lương học vấn</option>
										@foreach ($wage as $key => $value)
											<option value="{{ $value->id }}"  {{ $detail['wage']['id'] == $value->id ? 'selected' : '' }}>{{ $value->title }}</option>
										@endforeach
									</select>
									@if ($errors->has('wages_id'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('wages_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="location">Nơi làm việc mong muốn (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="location[]" class="form-control location {{ $errors->has('location') ? ' is-invalid' : '' }}" multiple="multiple" data-placeholder="Chọn tối đa 3 nơi làm việc">
										@if ($location)
											@foreach ($location as $key => $value)
												<option value="{{ $value->id }}" {{ in_array($value->id, $detail['location_id']) ? 'selected' : '' }}>{{ $value->title }}</option>
											@endforeach
										@endif
									</select>
									@if ($errors->has('location'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('location') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="language">Ngoại ngữ (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="language[]" value="{{ old('language') }}" class="form-control language {{ $errors->has('language') ? ' is-invalid' : '' }}" multiple="multiple" data-placeholder="Chọn tối đa 3 ngoại ngữ ">
										<option value="0" {{ $detail['language_id'] == null ? 'selected' : '' }}>Không</option>
										@foreach ($language as $key => $value)
											<option value="{{ $value->id }}" {{ (in_array($value->id, $detail['language_id'])) ? 'selected' : '' }}>{{ $value->title }}</option>
										@endforeach
									</select>
									@if ($errors->has('language'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('language') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group row col-md-offset-2" id="level">
								@foreach ($detail['language'] as $key => $value)
									<div class="col-md-3" id="level-{{ $value['id'] }}">
										<label for="language">Trình Độ {{$value['title']}}</label>
										<div>
											<select name="level[]" class="form-control">
												<option value="0" {{ ($value['pivot']['level'] == 0) ? 'selected' : '' }}>Yếu</option>
												<option value="1" {{ ($value['pivot']['level'] == 1) ? 'selected' : '' }}>Trung bình</option>
												<option value="2" {{ ($value['pivot']['level'] == 2) ? 'selected' : '' }}>Khá</option>
												<option value="3" {{ ($value['pivot']['level'] == 3) ? 'selected' : '' }}>Giỏi</option>
											</select>
										</div>
									</div>
								@endforeach
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="career">Công việc mong muốn (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="career[]" class="form-control career {{ $errors->has('career') ? ' is-invalid' : '' }}" multiple="multiple" data-placeholder="Chọn tối đa 3 công việc">
										@if ($career)
											@foreach ($career as $key => $value)
												<option value="{{ $value->id }}" {{ in_array($value->id, $detail['career_id']) ? 'selected' : '' }}>{{ $value->title }}</option>
											@endforeach
										@endif
									</select>
									@if ($errors->has('career'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('career') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="field">Lĩnh Vực mong muốn (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<select name="field[]" class="form-control field {{ $errors->has('field') ? ' is-invalid' : '' }}" multiple="multiple" data-placeholder="Chọn tối đa 3 lĩnh vực">
										@if ($field)
											@foreach ($field as $key => $value)
												<option value="{{ $value->id }}" {{ in_array($value->id, $detail['field_id']) ? 'selected' : '' }}>{{ $value->title }}</option>
											@endforeach
										@endif
									</select>
									@if ($errors->has('field'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('field') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="skill">Kỹ năng (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<textarea name="skill" rows="5" class="form-control {{ $errors->has('skill') ? ' is-invalid' : '' }}">{!! $detail['skill'] !!}</textarea>
									@if ($errors->has('skill'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('skill') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="work_experience">Kinh nghiệm làm việc (<span class="required">*</span>)</label>
								<div class="col-md-9">
									<textarea name="work_experience" rows="5" class="form-control {{ $errors->has('work_experience') ? ' is-invalid' : '' }}">{!! $detail['work_experience'] !!}</textarea>
									@if ($errors->has('work_experience'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('work_experience') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label text-md-right" for="content">Mong muốn của bản thân</label>
								<div class="col-md-9">
									<textarea name="content" rows="5" class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}">{!! $detail['content'] !!}</textarea>
									@if ($errors->has('content'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('content') }}</strong>
										</span>
									@endif
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
<script type="text/javascript">
	document.getElementById("imageUpload").onchange = function () {
	    var reader = new FileReader();
	    var sizeInKb = 0;
	    $('#image').show();
	    reader.onload = function (e) {
	    	var stringLength = e.target.result.length - 'data:image/png;base64,'.length;
	    	var sizeInBytes = 4 * Math.ceil((stringLength / 3))*0.5624896334383812;
			sizeInKb=sizeInBytes/1000;
			if (sizeInKb > 1536) {
		    	$('#message_error_image').text('Ảnh không được vựt quá 1.5 Mb');
		    	$('#image').hide();
		    }else{
		    	$('#message_error_image').text('')
		    	document.getElementById("image").src = e.target.result;
		    }
	    };
	    reader.readAsDataURL(this.files[0]);
	};
	$('.language').on('select2:close', function (e) {
		if (e.params.originalSelect2Event) {
			var data = e.params.originalSelect2Event.data;
			if(data.selected && data.id != 0){
				var level = `
						<div class="col-md-3" id="level-${data.id}">
							<label for="language">Trình Độ ${data.text}</label>
							<div>
								<select name="level[]" class="form-control">
									<option value="0">Yếu</option>
									<option value="1">Trung bình</option>
									<option value="2">Khá</option>
									<option value="3">Giỏi</option>
								</select>
							</div>
						</div>
						`;
				$('#level').append(level)
			}else{
				$('#level-' + data.id).remove();
			}
		}
	});
	
</script>
@endsection