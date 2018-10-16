<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class CandidateRequest extends FormRequest
{
    private $action;

    function __construct(Route $route) {
        $this->action = $route;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'image' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'marital' => 'required',
            'time_id' => 'required',
            'experience' => 'required',
            'educations_id' => 'required',
            'position' => 'required',
            'wages_id' => 'required',
            'location' => 'required',
            'language' => 'required',
            'career' => 'required',
            'field' => 'required',
            'skill' => 'required',
            'work_experience' => 'required'
        ];
        $action = $this->action->getActionMethod();
        if($action == 'update'){
            unset($rules['image']);
        }
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'image.required' => 'Hình Ảnh không được trống',
            'title.required' => 'Tên Hồ sơ không được trống',
            'slug.required'  => 'Slug không được trống',
            'name.required' => 'Tên ứng viên không được trống',
            'gender.required' => 'Giới tính không được trống',
            'email.required' => 'E-Mail không được trống',
            'email.email' => 'Định dạng E-Mail không đúng',
            'address.required' => 'Địa Chỉ không được trống',
            'phone.required' => 'Số Điện Thoại không được trống',
            'birthday.required' => 'Ngày sinh không được trống',
            'marital.required' => 'Tình trạng hôn nhân không được trống',
            'time_id.required' => 'Thời gian làm việc không được trống',
            'experience.required' => 'Kinh Nghiệm không được trống',
            'educations_id.required' => 'Trình độ học vấn không được trống',
            'position.required' => 'Vị trí mong muốn không được trống',
            'wages_id.required' => 'Mức lương mong muốn không được trống',
            'location.required' => 'Nơi làm việc mong muốn không được trống',
            'language.required' => 'Ngoại ngữ không được trống',
            'career.required' => 'Công việc mong muốn không được trống',
            'field.required' => 'Lĩnh Vực mong muốn không được trống',
            'skill.required' => 'Kỹ năng không được trống',
            'work_experience.required' => 'Kinh nghiệm làm việc không được trống'
        ];

        $action = $this->action->getActionMethod();
        if($action == 'update'){
            unset($messages['image.required']);
        }
        return $messages;
    }
}
