@extends('admin.master')
@section('content')
@section('title')
@lang('Holiday Calendar List')
@endsection

	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			   <ol class="breadcrumb">
					<li class="active breadcrumbColor"><a href="{{url('dashboard')}}"><i class="fa fa-home"></i> @lang('dashboard.dashboard')</a></li>
					<li>@yield('title')</li>
				</ol>
			</div>	
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<a href="{{ route('holidayCalendar.create') }}"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Holiday Calendar</a>
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
								<table id="myTable" class="table table-bordered">
									<thead class="tr_header">
										<tr>
											<th>@lang('common.serial')</th>
											<th>Holiday Type</th>
											<th>Year</th>
											<th>Calendar</th>
											<!-- <th>Status</th> -->
											<th style="text-align: center;">@lang('common.action')</th>
										</tr>
									</thead>
									<tbody>
										{!! $sl = null !!}
										@foreach($results AS $value)
											<tr class="{!! $value->id !!} @if(date("Y-m-d") <= $value->year) {{ "success" }} @endif
													">
												<td style="width: 100px;">{!! ++$sl !!}</td>
												<td>@if(isset($value->leave_type_name)){!!  $value->leave_type_name  !!}@endif</td>
												<td>{{ $value->year }}</td>
                                                
												<td> <a href="{{ asset('/uploads/calendarImg/'.$value->image) }}" target="_blank"><img src="{{ asset('/uploads/calendarImg/'.$value->image) }}" alt="calendar"></a></td>
												<td style="width: 100px;">
													<a href="{!! route('holidayCalendar.edit',$value->id ) !!}"  class="btn btn-success btn-xs btnColor">
														<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
													</a>
													<a href="{!!route('holidayCalendar.delete',$value->id  )!!}" data-token="{!! csrf_token() !!}" data-id="{!! $value->id !!}" class="delete btn btn-danger btn-xs deleteBtn btnColor"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</td>
											</tr>
										@endforeach
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
