<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;

use App\Model\EmployeeAttendance;
use App\Model\WebAttendance;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Model\Department;

use App\Model\Employee;
use App\Model\IpSetting;
use App\Model\WhiteListedIp;
use Excel;
use File;
use Carbon\Carbon;
use DateTime;

class ManualAttendanceController extends Controller
{

    public function manualAttendance()
  {
        $departmentList = Department::get();
        return view('admin.attendance.manualAttendance.index',['departmentList'=>$departmentList]);
    }



    public function filterData(Request $request)
  {
        $data           = dateConvertFormtoDB($request->get('date'));
        $department     = $request->get('department_id');
        $departmentList = Department::get();

        $attendanceData = Employee::select('employee.finger_id','employee.department_id',
                            DB::raw('CONCAT(COALESCE(employee.first_name,\'\'),\' \',COALESCE(employee.last_name,\'\')) as fullName'),

                            DB::raw('(SELECT DATE_FORMAT(MIN(view_employee_in_out_data.in_time), \'%h:%i %p\')  FROM view_employee_in_out_data
                                                             WHERE view_employee_in_out_data.date = "'.$data.'" AND view_employee_in_out_data.finger_print_id = employee.finger_id ) AS inTime'),

                            DB::raw('(SELECT DATE_FORMAT(MAX(view_employee_in_out_data.out_time), \'%h:%i %p\') FROM view_employee_in_out_data
                                                             WHERE view_employee_in_out_data.date =  "'.$data.'" AND view_employee_in_out_data.finger_print_id = employee.finger_id ) AS outTime'))
                            ->where('employee.department_id',$department)
                            ->where('employee.status',1)
                            ->get();

        return view('admin.attendance.manualAttendance.index',['departmentList'=>$departmentList,'attendanceData'=>$attendanceData]);
    }



    public function store(Request $request)
  {
        try{
            DB::beginTransaction();
                $data           = dateConvertFormtoDB($request->get('date'));
                $department     = $request->get('department_id');

                $result = json_decode(DB::table(DB::raw("(SELECT employee_attendance.*,employee.`department_id`,  DATE_FORMAT(`employee_attendance`.`in_out_time`,'%Y-%m-%d') AS `date` FROM `employee_attendance`
                    INNER JOIN `employee` ON `employee`.`finger_id` = employee_attendance.`finger_print_id`
                    WHERE department_id = $department) as employeeAttendance"))
                    ->select('employeeAttendance.employee_attendance_id')
                    ->where('employeeAttendance.date',$data)
                    ->get()->toJson(),true);

                DB::table('employee_attendance')->whereIn('employee_attendance_id',array_values($result))->delete();

                foreach ($request->finger_print_id as  $key => $finger_print_id)
                {
                    if(isset($request->inTime[$key]) && isset($request->outTime[$key])){
                        $InData = [
                            'finger_print_id'       => $finger_print_id,
                            'in_out_time'           => dateConvertFormtoDB($request->date). ' ' .date("H:i:s", strtotime($request->inTime[$key])),
                            'created_at'            => Carbon::now(),
                            'updated_at'            => Carbon::now(),
                        ];
                        EmployeeAttendance::insert($InData);

                        $outData = [
                            'finger_print_id'       => $finger_print_id,
                            'in_out_time'           =>dateConvertFormtoDB($request->date). ' ' .date("H:i:s", strtotime($request->outTime[$key])),
                            'created_at'            => Carbon::now(),
                            'updated_at'            => Carbon::now(),
                        ];
                        EmployeeAttendance::insert($outData);
                    } else if(isset($request->inTime[$key])){
                        $InData = [
                            'finger_print_id'       => $finger_print_id,
                            'in_out_time'           => dateConvertFormtoDB($request->date). ' ' .date("H:i:s", strtotime($request->inTime[$key])),
                            'created_at'            => Carbon::now(),
                            'updated_at'            => Carbon::now(),
                        ];
                        EmployeeAttendance::insert($InData);
                    }
                }
            DB::commit();
            $bug = 0;
        }
        catch(\Exception $e){
            DB::rollback();
            $bug = $e->errorInfo[1];
        }

        if($bug == 0){
            return redirect('manualAttendance')->with('success', 'Attendance successfully saved.');
        }else {
            return redirect('manualAttendance')->with('error', 'Something Error Found !, Please try again.');
        }
    }

    // ip attendance 

    public function ipAttendance(Request $request)
    {

      try{
        DB::beginTransaction();
         $finger_id = $request->finger_id;
         $ip_check_status = $request->ip_check_status;
         $user_ip = \Request::ip();
         $pre_d = EmployeeAttendance::where('finger_print_id', '=', $finger_id)->whereDate('in_out_time', '=', date('Y-m-d'))->where('is_active',1)->first();
         // return $pre_d;
         // if($ip_check_status == 0) 
         if($pre_d == null)
         {
              $att = new EmployeeAttendance;
              $att->finger_print_id = $finger_id;
              $att->in_out_time = date("Y-m-d H:i:s");
              $att->is_active = 1;
              $att->save();  

              $view_employee_in_out_data = DB::table('view_employee_in_out_data')->where('finger_print_id',$finger_id)->whereDate('in_time', '=', date('Y-m-d'))->first();
              $check_white_listed = WhiteListedIp::where('white_listed_ip','=',$user_ip)->count();
              if ($check_white_listed < 1)  {
                 return redirect()->back()->with('error', 'Invalid Ip Address.');
              }
              if($view_employee_in_out_data == null) {
                $data = array();
                $data['employee_attendance_id'] = $att->employee_attendance_id;
                $data['finger_print_id'] = $finger_id;
                $data['in_time'] = $att->in_out_time;
                $data['out_time'] = null;
                $data['date'] = date('Y-m-d');
                $data['working_time'] = '00:00:00';
                $data['basic_time'] = '00:00:00';
                $data['over_time'] = '00:00:00';
                $current_time = new DateTime();
                $work_time =  new DateTime('09:30:00 AM');
                if($current_time > $work_time){
                    $interval = $current_time->diff($work_time);
                    $late = $interval->format('%h').':'.$interval->format('%i').':'.$interval->format('%s');
                    $data['late_time'] = $late;
                  }else{
                    $data['late_time'] = "00:00:00";
                  }
                WebAttendance::create($data);
                DB::commit();
              }
                // $data['late_time'] = ;
              return redirect()->back()->with('success', 'Attendanced updated.');
         }else{
          $check_white_listed = WhiteListedIp::where('white_listed_ip','=',$user_ip)->count();
           
           if ($check_white_listed > 0) 
           {
              EmployeeAttendance::where('finger_print_id', '=', $finger_id)->whereDate('in_out_time', '=', date('Y-m-d'))->where('is_active',1)->update(['is_active' => 0]);

              $att = new EmployeeAttendance;
              $att->finger_print_id = $finger_id;
              $att->in_out_time = date("Y-m-d H:i:s");
              $att->is_active = 0;
              $att->save();

              $view_employee_in_out_data = DB::table('view_employee_in_out_data')->where('finger_print_id',$finger_id)->whereDate('in_time', '=', date('Y-m-d'))->where('out_time','=',null)->first();

              if($view_employee_in_out_data != null) {
                $current_time = new DateTime();
                $in_time =  new DateTime($view_employee_in_out_data->in_time);
                $work_hours = $current_time->diff($in_time);
                $total_work_hours = $work_hours->format("%H:%I:%S");

                
                $finish_time =  new DateTime('05:00:00 PM');
                if($current_time > $finish_time){
                    $interval = $current_time->diff($finish_time);
                    $over_time = $interval->format("%H:%I:%S");
                  }else{
                    $over_time = "00:00:00";
                  }

                $basic_time  = $finish_time->diff($in_time);
                $basic_time = $basic_time->format("%H:%I:%S");
                // dd($data['basic_time']);
                WebAttendance::where('employee_attendance_id',$view_employee_in_out_data->employee_attendance_id)->update(['out_time' => $current_time,'working_time'=>$total_work_hours,'basic_time' => $basic_time, 'over_time' => $over_time]);
                 DB::commit();
              }
              return redirect()->back()->with('success', 'Attendanced updated.');
           }else{
            return redirect()->back()->with('error', 'Invalid Ip Address.');
           }

         }
       }catch(\Exception $e){
         DB::rollback();
           dd($e,'hi');
           return $e;
       }
    }

    // get to attendance ip setting page 

    public function setupDashboardAttendance()
    {
        $ip_setting = IpSetting::orderBy('updated_at','desc')->first();
        $white_listed_ip = WhiteListedIp::all();


        return view('admin.attendance.setting.dashboard_attendance',[
          'ip_setting'      => $ip_setting,
          'white_listed_ip' => $white_listed_ip
        ]);
    }

    // post new attendance 

    public function postDashboardAttendance(Request $request)
    {

    try
    {
        
        DB::beginTransaction();

        $setting = IpSetting::orderBy('id','desc')->first();

          $setting->status = $request->status;
          $setting->ip_status = $request->ip_status;
          $setting->update();

        if ($request->ip)
        {

            WhiteListedIp::orderBy('id','desc')->delete();
            foreach ($request->ip as $value) {
                
                if ($value != '') {
                
                $white_listed_ip = new WhiteListedIp;

                $white_listed_ip->white_listed_ip = $value;

                $white_listed_ip->save();
                }

            }
        }

        DB::commit();

        return redirect()->back()->with('success','Employee Attendance Setting Updated');


    }
    catch(\Exception $e)
    { 
       DB::rollBack();
       return redirect()->back()->with('error',$e->getMessage());
    }
      
    }
    
    public function uploadFile(Request $request)
    {
      if($request->all()) {
        //dd($request->all());
        try{
          DB::beginTransaction();
          $file = $request->file('upload_file');
             //validate the xls file
          $this->validate($request, array(
           'upload_file'      => 'required'
          ));

          if($request->file('upload_file')){
            $extension = File::extension($file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
              $path = $file->getRealPath();
              $data = Excel::load($path)->get();
             // dd($data['items']);
              if(!empty($data) && $data->count()){
                 foreach ($data as $key => $value) {
                  //dd($value->emp_id);
                    if($value->emp_id) {
                      $att = new EmployeeAttendance;
                      $att->finger_print_id = $value->emp_id;
                      $att->in_out_time = dateConvertFormtoDB($value->date). ' ' .date("H:i:s", strtotime($value->in));
                      $att->is_active = 0;
                      $att->save();
                      
                      $data = array();
                      $data['employee_attendance_id'] = $att->employee_attendance_id;
                      $data['finger_print_id'] =  $value->emp_id;
                      $data['in_time'] = $att->in_out_time;
                      $data['out_time'] = dateConvertFormtoDB($value->date). ' ' .date("H:i:s", strtotime($value->out));
                      $data['date'] = dateConvertFormtoDB($value->date);

                      $in_time = new DateTime(date("H:i:s", strtotime($value->in)));
                      $out_time = new DateTime(date("H:i:s", strtotime($value->out)));
                      $interval = $in_time->diff($out_time);
                      $data['working_time'] = $interval->format('%h').':'.$interval->format('%i').':'.$interval->format('%s');
                      $data['late_time'] = date("H:i:s", strtotime($value->late));
                      $data['basic_time'] = date("H:i:s", strtotime($value->basic));
                      $data['over_time'] = date("H:i:s", strtotime($value->over));

                      WebAttendance::create($data);

                      $att = new EmployeeAttendance;
                      $att->finger_print_id = $value->emp_id;
                      $att->in_out_time = dateConvertFormtoDB($value->date). ' ' .date("H:i:s", strtotime($value->out));
                      $att->is_active = 0;
                      $att->save();

                      DB::commit();
                    }
                 }
                 return redirect()->back()->with('success', 'Your uploaded attendance data has successfully imported.');
              }else {
                return redirect()->back()->with('error', 'Your uploaded attendance data file are empty.');
              }
            }else {
                return redirect()->back()->with('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
          }else{
            return redirect()->back()->with('error', 'Sometheing is wrong, your upload file are not found. Please try again!');
          }
        }catch(\Exception $e){
          //dd($e);
          DB::rollBack();
          return redirect()->back()->with('error',$e->getMessage());
        }
      }
      return view('admin.attendance.manualAttendance.upload_file_form');
    }


  public function checkUploadedFileProperties($extension, $fileSize)
  {
    $valid_extension = array("csv", "xlsx",'xls'); //Only want csv and excel files
    $maxFileSize = 2097152; // Uploaded file size limit is 2mb
    if (in_array(strtolower($extension), $valid_extension)) {
      if ($fileSize <= $maxFileSize) {
      } else {
        throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
      }
    } else {
      throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
    }
  }


}
