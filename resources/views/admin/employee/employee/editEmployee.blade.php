@extends('admin.master')
@section('content')
@section('title')
    @lang('employee.edit_employee')
@endsection
<style>
    .appendBtnColor {
        color: #fff;
        font-weight: 700;
    }

</style>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <ol class="breadcrumb">
                <li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>
                        @lang('dashboard.dashboard')</a></li>
                <li>@yield('title')</li>

            </ol>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <a href="{{ route('employee.index') }}"
                class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i
                    class="fa fa-list-ul" aria-hidden="true"></i> @lang('employee.view_employee')</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> @yield('title')</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                @foreach ($errors->all() as $error)
                                    <strong>{!! $error !!}</strong><br>
                                @endforeach
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                                <i
                                    class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">×</button>
                                <i
                                    class="glyphicon glyphicon-remove"></i>&nbsp;<strong>{{ session()->get('error') }}</strong>
                            </div>
                        @endif
                        {{ Form::model($editModeData, ['route' => ['employee.update', $editModeData->employee_id], 'method' => 'PUT', 'files' => 'true', 'id' => 'employeeForm']) }}
                        <input class="form-control  delete_education_qualifications_cid"
                            id="delete_education_qualifications_cid" name="delete_education_qualifications_cid"
                            type="hidden" value="">
                        <input class="form-control  delete_experiences_cid" id="delete_experiences_cid"
                            name="delete_experiences_cid" type="hidden" value="">
                        <input class="form-control  delete_child_information_cid" id="delete_child_information_cid"
                            name="delete_child_information_cid" type="hidden" value="">
                        <div class="form-body">
                            <h3 class="box-title">@lang('employee.employee_account')</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.role')<span
                                                class="validateRq">*</span></label>
                                        <select name="role_id" class="form-control user_id required select2" required>
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            @foreach ($roleList as $value)
                                                <option value="{{ $value->role_id }}" @if ($employeeAccountEditModeData && $value->role_id == $employeeAccountEditModeData->role_id) {{ 'selected' }} @endif>
                                                    {{ $value->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.user_name')<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-user"></i></div>
                                        <input class="form-control required user_name" required id="user_name"
                                            placeholder="@lang('employee.user_name')" name="user_name" type="text"
                                            value="@if($employeeAccountEditModeData) {{ $employeeAccountEditModeData->user_name }} @endif">
                                    </div>
                                </div>
                            </div>
                            <h3 class="box-title">@lang('employee.personal_information')</h3>
                            <hr>
                            <h3 class="box-title">Bangla Entry</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput"> @lang('employee.first_name')(বাংলা)<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required bangla_first_name" required
                                            id="bangla_first_name" placeholder="@lang('employee.first_name')"
                                            name="bangla_first_name" type="text"
                                            value="{{ $editModeData->bangla_first_name }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.last_name')(বাংলা)<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required bangla_last_name" required
                                            id="bangla_last_name" placeholder="@lang('employee.last_name')"
                                            name="bangla_last_name" type="text"
                                            value="{{ $editModeData->bangla_last_name }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Father’s Name (বাংলা)<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required bangla_father_name" required
                                            id="bangla_father_name" placeholder="Father Name" name="bangla_father_name"
                                            type="text" value="{{ $editModeData->bangla_father_name }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Mother’s Name (বাংলা)<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required bangla_mother_name" required
                                            id="bangla_mother_name" placeholder="Mother Name" name="bangla_mother_name"
                                            type="text" value="{{ $editModeData->bangla_mother_name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Spouse Name (বাংলা)<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required bangla_spouse_name" required
                                            id="bangla_spouse_name" placeholder="Spouse Name" name="bangla_spouse_name"
                                            type="text" value="{{ $editModeData->bangla_spouse_name }}">
                                    </div>
                                </div>
                            </div>

                            <h3 class="box-title">English Entry</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.first_name')<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control required first_name" id="first_name"
                                            placeholder="@lang('employee.first_name')" name="first_name" type="text"
                                            value="{{ $editModeData->first_name }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.last_name')</label>
                                        <input class="form-control last_name" id="last_name"
                                            placeholder="@lang('employee.last_name')" name="last_name" type="text"
                                            value="{{ $editModeData->last_name }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.employee_id_number')<span
                                                class="validateRq">*</span></label>
                                        <input class="form-control number finger_id" id="finger_id"
                                            placeholder="@lang('employee.employee_id_number')" name="finger_id"
                                            type="text" value="{{ $editModeData->finger_id }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.reporting_superior')</label>
                                        <select name="supervisor_id"
                                            class="form-control supervisor_id required select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            @foreach ($supervisorList as $value)
                                                <option value="{{ $value->employee_id }}" @if ($value->employee_id == $editModeData->supervisor_id) {{ 'selected' }} @endif>
                                                    {{ $value->first_name }} {{ $value->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('branch.branch_name')<span
                                                class="validateRq">*</span></label>
                                        <select name="branch_id" class="form-control branch_id  select2"
                                            required>
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            @foreach ($branchList as $value)
                                                <option value="{{ $value->branch_id }}" @if($value->branch_id == $editModeData->branch_id) selected  @endif>
                                                    {{ $value->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('designation.designation_name')<span
                                                class="validateRq">*</span></label>
                                        <select name="designation_id" class="form-control department_id select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            @foreach ($designationList as $value)
                                                <option value="{{ $value->designation_id }}"
                                                    @if ($value->designation_id == $editModeData->designation_id) {{ 'selected' }} @endif>
                                                    {{ $value->designation_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Father’s Name</label>
                                        <input class="form-control father_name" id="father_name"
                                            placeholder="Father Name" name="father_name" type="text"
                                            value="{{ $editModeData->father_name }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Mother’s Name</label>
                                        <input class="form-control mother_name" id="mother_name"
                                            placeholder="Mother Name" name="mother_name" type="text"
                                            value="{{ $editModeData->mother_name }}">
                                    </div>
                                </div>
                                <!--  {{-- <div class="col-md-3">
										<div class="form-group">
											<label for="exampleInput">@lang('branch.branch_name')</label>
											<select name="branch_id" class="form-control branch_id select2" >
												<option value="">--- @lang('common.please_select') ---</option>
												@foreach ($branchList as $value)
													<option value="{{$value->branch_id}}" @if ($value->branch_id == $editModeData->branch_id) {{"selected"}} @endif>{{$value->branch_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="exampleInput">@lang('work_shift.work_shift_name')<span class="validateRq">*</span></label>
											<select name="work_shift_id" class="form-control work_shift_id select2">
												<option value="">--- @lang('common.please_select') ---</option>
												@foreach ($workShiftList as $value)
													<option value="{{$value->work_shift_id}}" @if ($value->work_shift_id == $editModeData->work_shift_id) {{"selected"}} @endif>{{$value->shift_name}}</option>
												@endforeach
											</select>
										</div>
									</div> --}} -->

                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.paygrade')<span class="validateRq">*</span></label>
                                        <select name="pay_grade_id" class="form-control pay_grade_id required select2"
                                            required id="pay_grade">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            @foreach ($payGradeList as $value)
                                                <option value="{{ $value->pay_grade_id }}" @if ($value->pay_grade_id == $editModeData->pay_grade_id) {{ 'selected' }} @endif>
                                                    {{ $value->pay_grade_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Basic Salary<span
                                                class="validateRq">*</span></label>
                                        <select name="present_increement_salary"
                                            class="form-control present_increement_salary required select2" required id="presentPayGradeSalary">
                                            <option value=''>--- @lang('common.please_select') ---</option>
                                            @foreach ($presentPayGradeSalary as $value)
                                                <option value="{{ $value->present_pay_grade_salary }}" @if($value->present_pay_grade_salary == $editModeData->present_increement_salary) selected  @endif>
                                                    {{ $value->present_pay_grade_salary }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.email')</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input class="form-control email" id="email"
                                            placeholder="@lang('employee.email')" name="email" type="email"
                                            value="{{ $editModeData->email }}">
                                    </div>
                                </div>
                                <!-- {{-- <div class="col-md-3">
										<div class="form-group">
											<label for="exampleInput">@lang('employee.hourly_paygrade')<span class="validateRq">*</span></label>
											<select name="hourly_salaries_id" class="form-control hourly_pay_grade_id required" >
												<option value="">--- @lang('common.please_select') ---</option>
												@foreach ($hourlyPayGradeList as $value)
													<option value="{{$value->hourly_salaries_id}}" @if ($value->hourly_salaries_id == $editModeData->hourly_salaries_id) {{"selected"}} @endif>{{$value->hourly_grade}}</option>
												@endforeach
											</select>
										</div>
									</div> --}} -->

                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.phone')<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input class="form-control number phone" id="phone"
                                            placeholder="@lang('employee.phone')" name="phone" type="number"
                                            value="{{ $editModeData->phone }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">GPF Number</label>
                                        <input class="form-control gpf_number" id="gpf_number" placeholder="GPF Number"
                                            name="gpf_number" type="text" value="{{ $editModeData->gpf_number }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Fixation Verification Number</label>
                                        <input class="form-control fixation_verification_number"
                                            id="fixation_verification_number" placeholder="Fixation Verification Number"
                                            name="fixation_verification_number" type="text"
                                            value="{{ $editModeData->fixation_verification_number }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput"> Freedom Fighter </label>
                                        <select name="freedom_fighter" class="form-control freedom_fighter select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            <option value="Yes" @if ('Yes' == $editModeData->freedom_fighter) {{ 'selected' }} @endif>Yes
                                            <option value="No" @if ('No' == $editModeData->freedom_fighter) {{ 'selected' }} @endif>No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">NID</label>
                                        <input class="form-control nid" id="nid" placeholder="NID" name="nid"
                                            type="number" value="{{ $editModeData->nid }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.gender')<span
                                                class="validateRq">*</span></label>
                                        <select name="gender" class="form-control gender select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            <option value="Male" @if ('Male' == $editModeData->gender) {{ 'selected' }} @endif>@lang('employee.male')
                                            </option>
                                            <option value="Female" @if ('Female' == $editModeData->gender) {{ 'selected' }} @endif>@lang('employee.female')
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.religion')</label>
                                        <input class="form-control religion" id="religion"
                                            placeholder="@lang('employee.religion')" name="religion" type="text"
                                            value="{{ $editModeData->religion }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.date_of_birth')<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control date_of_birth dateField" id="date_of_birth" readonly
                                            placeholder="@lang('employee.date_of_birth')" name="date_of_birth"
                                            type="text"
                                            value="{{ dateConvertDBtoForm($editModeData->date_of_birth) }}">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.date_of_joining')<span
                                            class="validateRq">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control date_of_joining dateField" id="date_of_joining"
                                            readonly placeholder="@lang('employee.date_of_joining')"
                                            name="date_of_joining" type="text"
                                            value="{{ dateConvertDBtoForm($editModeData->date_of_joining) }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.retirement_date')</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control  date_of_leaving dateField" id="date_of_leaving"
                                            readonly placeholder="@lang('employee.retirement_date')"
                                            name="date_of_leaving" type="text"
                                            value="{{ dateConvertDBtoForm($editModeData->date_of_leaving) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.marital_status')</label>
                                        <select name="marital_status" class="form-control status required select2">
                                            <option value="">--- Please select ---</option>
                                            <option value="Unmarried" @if ('Unmarried' == $editModeData->marital_status) {{ 'selected' }} @endif>
                                                @lang('employee.unmarried')</option>
                                            <option value="Married" @if ('Married' == $editModeData->marital_status) {{ 'selected' }} @endif>@lang('employee.married')
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Job Status</label>
                                        <select name="permanent_status" class="form-control status required select2">
                                            <option value="">--- @lang('common.please_select') ---</option>
                                            <option {{ $editModeData->permanent_status == 1 ? 'selected' : '' }}
                                                value="1">Permanent </option>
                                            <option {{ $editModeData->permanent_status == 0 ? 'selected' : '' }}
                                                value="0">Probation Period </option>
                                            <option {{ $editModeData->permanent_status == 2 ? 'selected' : '' }}
                                                value="2">Contractual </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="exampleInput">@lang('employee.photo')</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="  fa fa-picture-o"></i></span>
                                        <input class="form-control photo" id="photo"
                                            accept="image/png, image/jpeg, image/gif,image/jpg" name="photo"
                                            type="file">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Spouse Name</label>
                                        <input class="form-control spouse_name" id="spouse_name"
                                            placeholder="Spouse Name" name="spouse_name" type="text"
                                            value="{{ $editModeData->spouse_name }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Spouse NID</label>
                                        <input class="form-control spouse_nid" id="spouse_nid" placeholder="Spouse NID"
                                            name="spouse_nid" type="number" value="{{ $editModeData->spouse_nid }}">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Spouse Birth Certificate Number</label>
                                        <input class="form-control spouse_birth_certificate_no"
                                            id="spouse_birth_certificate_no"
                                            placeholder="Spouse Birth Certificate Number"
                                            name="spouse_birth_certificate_no" type="number"
                                            value="{{ $editModeData->spouse_birth_certificate_no }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="exampleInput">Spouse Date of Birth</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control  spouse_date_of_birth dateField" readonly
                                            id="spouse_date_of_birth" placeholder="Spouse Date of Birth"
                                            name="spouse_date_of_birth" type="text"
                                            value="{{ $editModeData->spouse_date_of_birth }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInput">Upload Spouse NID/Birth Certificate </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="  fa fa-picture-o"></i></span>
                                        <input class="form-control photo" id="photo"
                                            accept="image/png, image/jpeg, image/gif,image/jpg"
                                            name="spouse_nid_or_birth_certificate" type="file">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Status<span class="validateRq">*</span></label>
                                        <select name="status" class="form-control status select2">
                                            <option value="1" @if ('1' == $editModeData->status) {{ 'selected' }} @endif>@lang('common.active')</option>
                                            <option value="2" @if ('2' == $editModeData->status) {{ 'selected' }} @endif>@lang('common.inactive')
                                            </option>
                                            <option value="3" @if ('3' == $editModeData->status) {{ 'selected' }} @endif>@lang('common.terminated')
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Present Address</label>
                                        <textarea class="form-control present_address" id="present_address"
                                            placeholder="Present Address" cols="30" rows="2"
                                            name="present_address">{{ $editModeData->present_address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">Permanent Address</label>
                                        <textarea class="form-control permanent_address" id="permanent_address"
                                            placeholder="Permanent Address" cols="30" rows="2"
                                            name="permanent_address">{{ $editModeData->permanent_address }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">e-TIN Number</label>
                                        <input class="form-control etin_number" id="etin_number"
                                            placeholder="e-TIN Number" name="etin_number" type="text"
                                            value="{{ $editModeData->etin_number }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInput">@lang('employee.emergency_contact')</label>
                                        <textarea class="form-control emergency_contacts" id="emergency_contacts"
                                            placeholder="@lang('employee.emergency_contact')" cols="30" rows="2"
                                            name="emergency_contacts">{{ $editModeData->emergency_contacts }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <h3 class="box-title">@lang('employee.educational_qualification')</h3>
                            <hr>
                            <div class="education_qualification_append_div">
                                @if (isset($editModeData) && count($educationQualificationEditModeData) > 0)
                                    @foreach ($educationQualificationEditModeData as $educationQualificationValue)
                                        <div class="education_qualification_row_element">
                                            <input class="educationQualification_cid" id="educationQualification_cid"
                                                name="educationQualification_cid[]" type="hidden"
                                                value="{{ $educationQualificationValue->employee_education_qualification_id }}">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInput">@lang('employee.degree')<span
                                                                class="validateRq">*</span></label>
                                                        <input type="text" name="degree[]"
                                                            class="form-control degree required" id="degree"
                                                            placeholder="Example: B.Sc. Engr.(Bachelor of Science in Engineering)"
                                                            value="{{ $educationQualificationValue->degree }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInput">@lang('employee.institute')  /
                                                            @lang('employee.university')<span
                                                                class="validateRq">*</span></label>
                                                                <input type="text" name="institute[]" class="form-control institute"
                    id="institute" placeholder="@lang('employee.institute') / @lang('employee.university')" value="{{ $educationQualificationValue->institute }}">
                                                 <!--        <select name="institute[]" class="form-control institute">
                                                            <option value="">--- @lang('common.please_select') ---
                                                            </option>
                                                            <option value="Board" @if ($educationQualificationValue->institute == 'Board') {{ 'selected' }} @endif>
                                                                @lang('employee.board')</option>
                                                            <option value="University" @if ($educationQualificationValue->institute == 'University') {{ 'selected' }} @endif>
                                                                @lang('employee.university')</option>
                                                        </select> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInput">@lang('employee.board')<span
                                                                class="validateRq">*</span></label>
                                                        <input type="text" name="board_university[]"
                                                            class="form-control board_university" id="board_university"
                                                            placeholder="@lang('employee.board')"
                                                            value="{{ $educationQualificationValue->board_university }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="exampleInput">@lang('employee.passing_year')<span
                                                            class="validateRq">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-calendar-o"></i></span>
                                                        <input type="text" name="passing_year[]"
                                                            class="form-control yearPicker required" id="passing_year"
                                                            placeholder="@lang('employee.passing_year')"
                                                            value="{{ $educationQualificationValue->passing_year }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInput">@lang('employee.result') ( Class )</label>
                                                        <select name="result[]" class="form-control result">
                                                            <option value="">--- @lang('common.please_select') ---
                                                            </option>
                                                            <option value="First class" @if ($educationQualificationValue->result == 'First class') {{ 'selected' }} @endif>First
                                                                class</option>
                                                            <option value="Second class" @if ($educationQualificationValue->result == 'Second class') {{ 'selected' }} @endif>
                                                                Second class</option>
                                                            <option value="Third class" @if ($educationQualificationValue->result == 'Third class') {{ 'selected' }} @endif>Third
                                                                class</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInput">Result ( @lang('employee.gpa') /
                                                            @lang('employee.cgpa') )</label>
                                                        <input type="text" name="cgpa[]" class="form-control cgpa"
                                                            id="cgpa" placeholder="Example: 5.00,4.63"
                                                            value="{{ $educationQualificationValue->cgpa }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3"></div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="button"
                                                            class="form-control btn btn-danger deleteEducationQualification appendBtnColor"
                                                            style="margin-top: 17px" value="@lang('common.delete')">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-9"></div>
                                <div class="col-md-3">
                                    <div class="form-group"><input id="addEducationQualification" type="button"
                                            class="form-control btn btn-success appendBtnColor"
                                            value="@lang('employee.add_educational_qualification')"></div>
                                </div>
                            </div>
                        </div>

                        <h3 class="box-title">@lang('employee.professional_experience')</h3>

                        <hr>
                        <div class="experience_append_div">
                            @if (isset($editModeData) && count($experienceEditModeData) > 0)
                                @foreach ($experienceEditModeData as $experienceValue)
                                    <div class="experience_row_element">
                                        <input class="employee_experience_id" id="employee_experience_id"
                                            name="employeeExperience_cid[]" type="hidden"
                                            value="{{ $experienceValue->employee_experience_id }}">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">@lang('employee.organization_name')<span
                                                            class="validateRq">*</span></label>
                                                    <input type="text" name="organization_name[]"
                                                        class="form-control organization_name" id="organization_name"
                                                        placeholder="@lang('employee.organization_name')"
                                                        value="{{ $experienceValue->organization_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">@lang('employee.designation')<span
                                                            class="validateRq">*</span></label>
                                                    <input type="text" name="designation[]"
                                                        class="form-control designation" id="designation"
                                                        placeholder="@lang('employee.designation')"
                                                        value="{{ dateConvertDBtoForm($experienceValue->designation) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleInput">@lang('common.from_date')<span
                                                        class="validateRq">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span>
                                                    <input type="text" name="from_date[]"
                                                        class="form-control dateField" id="from_date"
                                                        placeholder="@lang('common.from_date')"
                                                        value="{{ dateConvertDBtoForm($experienceValue->from_date) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleInput">@lang('common.to_date')<span
                                                        class="validateRq">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span>
                                                    <input type="text" name="to_date[]" class="form-control dateField"
                                                        id="to_date" placeholder="@lang('common.to_date')"
                                                        value="{{ dateConvertDBtoForm($experienceValue->to_date) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">@lang('employee.responsibility')<span
                                                            class="validateRq">*</span></label>
                                                    <textarea name="responsibility[]"
                                                        class="form-control responsibility"
                                                        placeholder="@lang('employee.responsibility')" cols="30"
                                                        rows="2"
                                                        required>{{ $experienceValue->responsibility }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">@lang('employee.skill')<span
                                                            class="validateRq">*</span></label>
                                                    <textarea name="skill[]" class="form-control skill"
                                                        placeholder="@lang('employee.skill')" cols="30"
                                                        rows="2">{{ $experienceValue->skill }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="button"
                                                        class="form-control btn btn-danger deleteExperience appendBtnColor"
                                                        style="margin-top: 17px" value="@lang('common.delete')">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <div class="form-group"><input id="addExperience" type="button"
                                        class="form-control btn btn-success appendBtnColor"
                                        value="@lang('employee.add_professional_experience')"></div>
                            </div>
                        </div>

                        <!-- START Employee Child Information  -->
                        <h3 class="box-title">Employee Child Information</h3>
                        <hr>
                        <div class="child_information_append_div">

                            @if (isset($editModeData) && count($childEditModeData) > 0)
                                @foreach ($childEditModeData as $childValue)
                                    <!-- Start Child append div -->
                                    <div class="row_element3">
                                        <input name="childInformation_cid[]" type="hidden"
                                            value="{{ $childValue->employee_education_qualification_id }}">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">Child Name<span
                                                            class="validateRq">*</span></label>
                                                    <input type="text" name="child_name[]"
                                                        class="form-control child_name" id="child_name"
                                                        placeholder="Child Name"
                                                        value="{{ $childValue->child_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">Date Of Birth<span
                                                            class="validateRq">*</span></label>
                                                    <input type="text" name="child_date_of_birth[]"
                                                        class="form-control child_date_of_birth dateField"
                                                        id="child_date_of_birth" placeholder="Date Of Birth"
                                                        value="{{ $childValue->child_date_of_birth }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">NID (if any)</label>
                                                    <input type="number" name="child_nid_number[]"
                                                        class="form-control child_nid_number" id="child_nid_number"
                                                        placeholder="NID (if any)"
                                                        value="{{ $childValue->child_nid_number }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">Certificate Number</label>
                                                    <input type="number" name="birth_certificate_number[]"
                                                        class="form-control birth_certificate_number"
                                                        id="birth_certificate_number"
                                                        placeholder="Birth Certificate Number"
                                                        value="{{ $childValue->birth_certificate_number }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="button"
                                                        class="form-control btn btn-danger deleteChildInformation appendBtnColor"
                                                        style="margin-top: 17px" value="@lang('common.delete')">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- End Child append div-->
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input id="addChildInformation" type="button"
                                        class="form-control btn btn-success appendBtnColor"
                                        value="Add Child Information">
                                </div>
                            </div>
                        </div>
                        <!-- End Employee Child Information  -->

                        <!-- Start Employee Logistic Information  -->
                        <h3 class="box-title">Employee Logistic Information</h3>
                        <hr>
                        <div class="logistic_information_append_div">

                            @if (isset($editModeData) && count($logisticEditModeData) > 0)
                                @foreach ($logisticEditModeData as $logisticValue)
                                    <!-- Start Child append div -->
                                    <div class="row_element4">
                                        <input name="logisticInformation_cid[]" type="hidden"
                                            value="{{ $logisticValue->employee_logistic_id }}">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">Logistic Type</label>
                                                    <select name="logistic_type[]" id="" class="form-control">
                                                        <option>----please select----</option>
                                                        @foreach($logisticList as $key => $val)
                                                            <option {{ $logisticValue->logistic_type == $val->logistic_type ? 'selected' : '' }} value="{{ $val->logistic_type }}">{{ $val->logistic_type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">Logistic Name</label>
                                                    <input type="text" name="logistic_name[]"
                                                        class="form-control logistic_name" id="logistic_name"
                                                        placeholder="Logistic Name"
                                                        value="{{ $logisticValue->logistic_name }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">Logistic Quantity</label>
                                                    <input type="number" name="logistic_quantity[]"
                                                        class="form-control logistic_quantity" id="logistic_quantity"
                                                        placeholder="Logistic Quantity"
                                                        value="{{ $logisticValue->logistic_quantity }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="exampleInput">Logistic Date</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span>
                                                    <input class="form-control  logistic_date dateField" readonly
                                                        id="logistic_date" placeholder="Logistic Date"
                                                        name="logistic_date[]" type="text"
                                                        value="{{ $logisticValue->logistic_date }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInput">Logistic Reference No</label>
                                                    <input type="text" name="logistic_reference_no[]"
                                                        class="form-control logistic_reference_no"
                                                        id="logistic_reference_no" placeholder="Logistic Reference No"
                                                        value="{{ $logisticValue->logistic_reference_no }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="button"
                                                        class="form-control btn btn-danger deleteLogisticInformation appendBtnColor"
                                                        style="margin-top: 17px" value="@lang('common.delete')">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- End Logistic append div-->
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInput">Upload Logistic File</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="	fa fa-picture-o"></i></span>
                                <input class="form-control logistic_file" id="logistic_file"
                                    accept="image/png, image/jpeg, image/gif,image/jpg,.pdf" name="logistic_file"
                                    type="file">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input id="addLogisticInformation" type="button"
                                        class="form-control btn btn-success appendBtnColor"
                                        value="Add Logistic Information">
                                </div>
                            </div>
                        </div>
                        <!-- End Employee Logistic Information  -->

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-success btn_style"><i
                                            class="fa fa-pencil"></i> @lang('common.update')</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Start Logistic append div -->
<div class="row_element4" style="display: none;">
    <input name="logisticInformation_cid[]" type="hidden">
    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">@lang('logistic.logistic_type')</label>
                <select name="logistic_type[]" id="" class="form-control">
                <option>@lang('logistic.select_logistic')</option>
                    @foreach($logisticList as $key => $val)
                        <option value="{{ $val->logistic_type }}">{{ $val->logistic_type }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">Logistic Name</label>
                <input type="text" name="logistic_name[]" class="form-control logistic_name" id="logistic_name"
                    placeholder="Logistic Name">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">Logistic Quantity</label>
                <input type="number" name="logistic_quantity[]" class="form-control logistic_quantity"
                    id="logistic_quantity" placeholder="Logistic Quantity">
            </div>
        </div>

        <div class="col-md-3">
            <label for="exampleInput">Logistic Date</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input class="form-control  logistic_date dateField" readonly id="logistic_date"
                    placeholder="Logistic Date" name="logistic_date[]" type="text">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">Logistic Reference No</label>
                <input type="text" name="logistic_reference_no[]" class="form-control logistic_reference_no"
                    id="logistic_reference_no" placeholder="Logistic Reference No">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="button" class="form-control btn btn-danger deleteLogisticInformation appendBtnColor"
                    style="margin-top: 17px" value="@lang('common.delete')">
            </div>
        </div>
    </div>
    <hr>
</div>
<!-- End Logistic append div-->

<!-- Start Child append div -->
<div class="row_element3" style="display: none;">
    <input name="childInformation_cid[]" type="hidden">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">Child Name<span class="validateRq">*</span></label>
                <input type="text" name="child_name[]" class="form-control child_name" id="child_name"
                    placeholder="Child Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">Date Of Birth<span class="validateRq">*</span></label>
                <input type="text" name="child_date_of_birth[]" class="form-control child_date_of_birth dateField"
                    id="child_date_of_birth" placeholder="Date Of Birth">
            </div>
        </div>
<!--         <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">NID (if any)</label>
                <input type="number" name="child_nid_number[]" class="form-control child_nid_number"
                    id="child_nid_number" placeholder="NID (if any)">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">Birth Certificate Number</label>
                <input type="number" name="birth_certificate_number[]" class="form-control birth_certificate_number"
                    id="birth_certificate_number" placeholder="Birth Certificate Number">
            </div>
        </div> -->

        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">NID (if any)</label>
                <input type="number" name="child_nid_number[]" class="form-control child_nid_number"
                    id="child_nid_number" placeholder="NID (if any)">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">Birth Certificate Number</label>
                <input type="number" name="birth_certificate_number[]" class="form-control birth_certificate_number"
                    id="birth_certificate_number" placeholder="Birth Certificate Number">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="button" class="form-control btn btn-danger deleteChildInformation appendBtnColor"
                    style="margin-top: 17px" value="@lang('common.delete')">
            </div>
        </div>
    </div>
    <hr>
</div>
<!-- End Child append div-->


<div class="row_element1" style="display: none;">
    <input name="educationQualification_cid[]" type="hidden">
    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">@lang('employee.degree')<span class="validateRq">*</span></label>
                <input type="text" name="degree[]" class="form-control degree required" id="degree"
                    placeholder="Example: B.Sc. Engr.(Bachelor of Science in Engineering)">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">@lang('employee.institute') / @lang('employee.university')<span class="validateRq">*</span></label>
                <input type="text" name="institute[]" class="form-control institute"
                    id="institute" placeholder="@lang('employee.institute') / @lang('employee.university')">
<!--                 <select name="institute[]" class="form-control institute">
                    <option value="">--- @lang('common.please_select') ---</option>
                    <option value="Board">@lang('employee.board')</option>
                    <option value="University">@lang('employee.university')</option>
                </select> -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">@lang('employee.board')<span
                        class="validateRq">*</span></label>
                <input type="text" name="board_university[]" class="form-control board_university"
                    id="board_university" placeholder="@lang('employee.board') ">
            </div>
        </div>

        <div class="col-md-3">
            <label for="exampleInput">@lang('employee.passing_year')<span class="validateRq">*</span></label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <input type="text" name="passing_year[]" class="form-control yearPicker required" id="passing_year"
                    placeholder="@lang('employee.passing_year')">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">@lang('employee.result') (Class)</label>
                <select name="result[]" class="form-control result">
                    <option value="">--- @lang('common.please_select') ---</option>
                    <option value="First class">First class</option>
                    <option value="Second class">Second class</option>
                    <option value="Third class">Third class</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">Result ( @lang('employee.gpa') / @lang('employee.cgpa') )</label>
                <input type="text" name="cgpa[]" class="form-control cgpa" id="cgpa" placeholder="Example: 5.00,4.63">
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="button" class="form-control btn btn-danger deleteEducationQualification appendBtnColor"
                    style="margin-top: 17px" value="@lang('common.delete')">
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="row_element2" style="display: none;">
    <input name="employeeExperience_cid[]" type="hidden">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">@lang('employee.organization_name')<span
                        class="validateRq">*</span></label>
                <input type="text" name="organization_name[]" class="form-control organization_name"
                    id="organization_name" placeholder="@lang('employee.organization_name')">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">@lang('employee.designation')<span class="validateRq">*</span></label>
                <input type="text" name="designation[]" class="form-control designation" id="designation"
                    placeholder="@lang('employee.designation')">
            </div>
        </div>
        <div class="col-md-3">
            <label for="exampleInput">@lang('common.from_date')<span class="validateRq">*</span></label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" name="from_date[]" class="form-control dateField" id="from_date"
                    placeholder="@lang('common.from_date')">
            </div>
        </div>
        <div class="col-md-3">
            <label for="exampleInput">@lang('common.to_date')<span class="validateRq">*</span></label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" name="to_date[]" class="form-control dateField" id="to_date"
                    placeholder="@lang('common.to_date')">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">@lang('employee.responsibility')<span class="validateRq">*</span></label>
                <textarea name="responsibility[]" class="form-control responsibility"
                    placeholder="@lang('employee.responsibility')" cols="30" rows="2"></textarea>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInput">@lang('employee.skill')<span class="validateRq">*</span></label>
                <textarea name="skill[]" class="form-control skill" placeholder="@lang('employee.skill')" cols="30"
                    rows="2"></textarea>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="button" class="form-control btn btn-danger deleteExperience appendBtnColor"
                    style="margin-top: 17px" value="@lang('common.delete')">
            </div>
        </div>
    </div>
    <hr>
</div>

@endsection
@section('page_scripts')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script> -->
<script>
    $(document).ready(function() {

        // $('#date_of_joining').on('change',function() {
        //     var date_of_birth = $('#date_of_birth').val();
        //     // date_of_birth = moment(date_of_birth).format('L');
        //    date_of_birth = moment(date_of_birth, "DD/MM/YYYY", "Asia/Dhaka");
        //     var endjobYear = moment(date_of_birth).add(59,'years');
        //     // console.log(date_of_birth);
        //     var date_of_joining = $('#date_of_joining').val();
        //     var retirement_year = endjobYear.diff(date_of_joining,'years');
        //     var retirement_date = moment(date_of_joining).add(retirement_year,'years');
        //     retirement_date = moment(retirement_date).format('MM/DD/YYYY');
        //     // console.log(retirement_date + ' = ' + date_of_joining + ' = ' + endjobYear + ' = ' + date_of_birth);
        //     $('#date_of_leaving').val(retirement_date);
        // });

        $('#date_of_birth').on('change',function() {
            var date_of_birth = $('#date_of_birth').val();
            date_of_birth = moment(date_of_birth, "DD/MM/YYYY", "Asia/Dhaka");
            var endjobYear = moment(date_of_birth).add(59,'years');
            var date_of_joining = $('#date_of_joining').val();
            var retirement_year = endjobYear.diff(date_of_joining,'years');
            var retirement_date = moment(date_of_joining).add(retirement_year,'years');
            retirement_date = moment(retirement_date).format('MM/DD/YYYY');
            $('#date_of_leaving').val(retirement_date);
        });

        $('#pay_grade').on("change", function() {
            var pay_grade_id = $('#pay_grade').val();
            var _token =  "<?php echo(csrf_token()); ?>" ;
            $('#presentPayGradeSalary').empty();
                $.ajax({
                    url: '/employee/pay_grade_wise_salary/' + pay_grade_id,
                    type: 'get',
                    complete: function(){
                    },
                    success:function(response){
                      // console.log(response);
                        if(response.code == 200) {
                            var html = "";
                            
                            html += "";
                            for(var i = 0; i < response.data.length ; i++) {
                                html += "<option value="+response.data[i]['present_pay_grade_salary'] + ">";

                                // if(response.data[i]['present_pay_grade_salary'] == old('present_increemnet_salary')){
                                //         html += 'selected >'
                                html += response.data[i]['present_pay_grade_salary'] ;
                                // }
                                html += "</option>";
                          }
                          console.log(html);
                          $('#presentPayGradeSalary').append(html);
                        }
                    },
                    error: function(error) {
                     console.log(error);
                    }
            })
        });

        $('#addLogisticInformation').click(function() {
            $('.logistic_information_append_div').append(
                '<div class="logistic_information_row_element">' + $(
                    '.row_element4').html() + '</div>');
        });

        $('#addChildInformation').click(function() {
            $('.child_information_append_div').append('<div class="child_information_row_element">' + $(
                '.row_element3').html() + '</div>');
        });

        $('#addEducationQualification').click(function() {
            $('.education_qualification_append_div').append(
                '<div class="education_qualification_row_element">' + $('.row_element1').html() +
                '</div>');
        });

        $('#addExperience').click(function() {
            $('.experience_append_div').append('<div class="experience_row_element">' + $(
                '.row_element2').html() + '</div>');
        });

        $(document).on("click", ".deleteLogisticInformation", function() {
            // alert('ok');
            $(this).parents('.logistic_information_row_element').remove();
            var deletedID = $(this).parents('.logistic_information_row_element').find(
                '.logisticInformation_cid').val();
            if (deletedID) {
                var prevDelId = $('#delete_logistic_information_cid').val();
                if (prevDelId) {
                    $('#delete_logistic_information_cid').val(prevDelId + ',' + deletedID);
                } else {
                    $('#delete_logistic_information_cid').val(deletedID);
                }
            }
        });

        $(document).on("click", ".deleteChildInformation", function() {
            $(this).parents('.child_information_row_element').remove();
            var deletedID = $(this).parents('.child_information_row_element').find(
                '.childInformation_cid').val();
            if (deletedID) {
                var prevDelId = $('#delete_child_information_cid').val();
                if (prevDelId) {
                    $('#delete_child_information_cid').val(prevDelId + ',' + deletedID);
                } else {
                    $('#delete_child_information_cid').val(deletedID);
                }
            }
        });


        $(document).on("click", ".deleteEducationQualification", function() {
            $(this).parents('.education_qualification_row_element').remove();
            var deletedID = $(this).parents('.education_qualification_row_element').find(
                '.educationQualification_cid').val();
            if (deletedID) {
                var prevDelId = $('#delete_education_qualifications_cid').val();
                if (prevDelId) {
                    $('#delete_education_qualifications_cid').val(prevDelId + ',' + deletedID);
                } else {
                    $('#delete_education_qualifications_cid').val(deletedID);
                }
            }
        });

        $(document).on("click", ".deleteExperience", function() {
            $(this).parents('.experience_row_element').remove();
            var deletedID = $(this).parents('.experience_row_element').find('.employee_experience_id')
                .val();
            if (deletedID) {
                var prevDelId = $('#delete_experiences_cid').val();
                if (prevDelId) {
                    $('#delete_experiences_cid').val(prevDelId + ',' + deletedID);
                } else {
                    $('#delete_experiences_cid').val(deletedID);
                }
            }
        });

        $(document).on('change', '.pay_grade_id', function() {
            var data = $('.pay_grade_id').val();
            if (data) {
                $('.hourly_pay_grade_id').val('');
                $('.pay_grade_id').attr('required', false);
                $('.hourly_pay_grade_id').attr('required', false);
            } else {
                $('.pay_grade_id').attr('required', true);
                $('.hourly_pay_grade_id').attr('required', true);
            }
        });

        $(document).on('change', '.hourly_pay_grade_id', function() {
            var data = $('.hourly_pay_grade_id').val();
            if (data) {
                $('.pay_grade_id').val('');
                $('.pay_grade_id').attr('required', false);
                $('.hourly_pay_grade_id').attr('required', false);
            } else {
                $('.pay_grade_id').attr('required', true);
                $('.hourly_pay_grade_id').attr('required', true);
            }
        });

    });
</script>
@endsection
