@extends('admin.master')
@section('content')
@section('title')
@lang('leave.requested_application')
@endsection
  
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
			   <ol class="breadcrumb">
					<li class="active breadcrumbColor"><a href="#"><i class="fa fa-home"></i> @lang('dashboard.dashboard')</a></li>
					<li>@yield('title')</li>
				</ol>
			</div>	
		</div>
					
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-success">
					<div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> @yield('title')</div>
					<div class="panel-wrapper collapse in" aria-expanded="true">
						<div class="panel-body">
							@if(session()->has('success'))
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="glyphicon glyphicon-remove"></i>&nbsp;<strong>{{ session()->get('error') }}</strong>
                                </div>
                            @endif
                         <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover ">
                                <thead class="tr_header">
                                     <tr>
                                        <th>@lang('common.serial')</th>
                                        <th>@lang('common.employee_name')</th>
                                        <th>@lang('leave.leave_type')</th>
                                        <th style="width:180px;">@lang('leave.request_duration')</th>
                                        <th>@lang('leave.request_date')</th>
                                        <th>@lang('leave.number_of_day')</th>
                                        <th style="width: 300px;word-wrap: break-word;">@lang('leave.purpose')</th>
                                        <th>@lang('common.status')</th>
                                        <th>Attachment</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($results) > 0)
                                    {!! $sl = null !!}
                                        @foreach($results AS $value)
                                            <tr>
                                                <td>{!! ++$sl !!}</td>
                                                <td>
                                                    @if(isset($value->employee->first_name)) {!! $value->employee->first_name !!} @endif
                                                    @if(isset($value->employee->last_name)) {!! $value->employee->last_name !!} @endif
                                                </td>
                                                <td>@if(isset($value->leaveType->leave_type_name)) {!! $value->leaveType->leave_type_name !!} @endif</td>
                                                <td style="width:180px;">
                                                @if($value->leave_type_id == 23 and $value-> optional_leave_date_name_list != null)
                                                    @foreach($value-> optional_leave_date_name_list as $l_k => $val)
                                                        {!! $val !!}
                                                    @endforeach
                                                    
                                                @else
                                                    {!! dateConvertDBtoForm($value->application_from_date) !!} <b>to</b> {!! dateConvertDBtoForm($value->application_to_date) !!}
                                                @endif
                                                </td>
                                                <td>{!! dateConvertDBtoForm($value->application_date) !!}</td>
                                                <td>{!! $value->number_of_day !!}</td>
                                                <td>{!! $value->purpose !!}</td>
                                                @if($value->status == 1)
                                                    <td  style="width: 100px;">
                                                        <span class="label label-warning">@lang('common.pending')</span>
                                                    </td>
                                                @elseif($value->status == 2)
                                                    <td  style="width: 100px;">
                                                        <span class="label label-success">@lang('common.approved')</span>
                                                    </td>
                                                @else
                                                    <td  style="width: 100px;">
                                                        <span class="label label-danger">@lang('common.rejected')</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if ($value->attachment != '' && file_exists('uploads/leaveApplication/' . $value->attachment))
                                                    <a class="btn btn-success" style="color: white"
                                                        target="_blank" href="{!! asset('uploads/leaveApplication/' . $value->attachment) !!}">
                                                        Attachment</a>
                                                    @else
                                                        <a href="javascript:void(0)"> Empty </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- @if($value->status == 1) -->
                                                        <a href="{!! route('requestedApplication.viewDetails',$value->leave_application_id ) !!}" title="View leave details!" class="btn btn-success btn-md btnColor">
                                                            <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                    <!-- @endif -->
                                                </td>
                                            </tr>
                                        @endforeach
                                 @else
                                    <tr>
                                        <td colspan="9">@lang('leave.you_have_no_leave_application') !</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                         </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
