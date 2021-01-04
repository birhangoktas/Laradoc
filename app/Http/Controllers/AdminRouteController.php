<?php

namespace App\Http\Controllers;

use App\Models\Doctorproject;
use App\Models\Paymenthistory;
use App\Models\Sitesupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\File;

class AdminRouteController extends Controller
{
    public function welcome(){
        return view('admin.dash');
    }

    public function adminhistoryview(){
        $adminhistory = DB::table('paymenthistories')->where('user_id',Auth()->user()->user_id)->get();
        return view('admin.adminhistory',['adminhistory' => $adminhistory]);
    }


    public function doctoraddmoney($order_id){
        if(count(DB::table('paymenthistories')->where('order_id',$order_id)->get()) == 1){
            $user_id_security = DB::table('paymenthistories')->where('order_id',$order_id)->first()->user_id;
            if($user_id_security == Auth()->user()->user_id){

                if(DB::table('paymenthistories')->where('order_id',$order_id)->first()->is_money == 0 ){

                //-------------------------------------------------------------------
                $doctor_user_id  = DB::table('paymenthistories')->where('order_id',$order_id)->first()->doctor_id;
                $doctor_id = DB::table('doctorprojects')->where('user_id',$doctor_user_id)->first()->id;
                $doctoraddmoney = Doctorproject::find($doctor_id);
                $gross = ($doctoraddmoney->appointment_price - ($doctoraddmoney->appointment_price * 4 / 100));
                $doctoraddmoney->safe_price = $doctoraddmoney->safe_price + $gross;
                $doctoraddmoney->save();
                //-------------------------------------------------------------------
                $history_id = DB::table('paymenthistories')->where('order_id',$order_id)->first()->id;
                $ismoneytrue = Paymenthistory::find($history_id);
                $ismoneytrue->is_money = 1;
                $ismoneytrue->save();

                return back()->with('success_doctor',true);

                }

                else {
                    return back()->with('active_money',true);

                }


            }
            else {
                return back();
            }
        }
        else {
            return back();
        }

    }


    public function feedback(){
        return view('admin.support');
    }

    public function feedbacksave(Request $request){

        $request->validate([
            'subject' => 'required|max:255',
            'title' => 'required|max:255',
            'comment' => 'required|max:255',
        ]);


        $feedbacksave = new Sitesupport;
        $feedbacksave->user_id = Auth()->user()->user_id;
        $feedbacksave->subject = $request->input('subject');
        $feedbacksave->title = $request->input('title');
        $feedbacksave->comment = $request->input('comment');
        $feedbacksave->save();
        return redirect('/admin/destek-talebim');
    }

    public function adminsetting(){
        return view('admin.setting');
    }

    public function passwordupdate(Request $request){
        $password = Auth()->user()->password;
        $password_id = Auth()->user()->id;
        if ($request == "") {
            return;
        } else {
            if ($request->input('newpassword1') == $request->input('newpassword2')) {
                if (Hash::check($request->input('oldpassword'), $password)) {
                    echo $password_id;
                    $newpassword = User::find($password_id);
                    $newpassword->password = Hash::make($request->input('newpassword1'));
                    $newpassword->save();
                    return back()->with('company-success','Başarılı');
                } else {
                    return back()->with('company-error','hatalı');
                }
            } else {
                return back()->with('company-twopassword','hatalı');
            }
        }
    }

    public function profilupdate(Request $request){
      
        $request->validate([
            'profil' => 'required|mimes:jpeg,JPG,png',
        ]);


        $profildelete = DB::table('users')->where('user_id',Auth()->user()->user_id)->first()->profil;
        File::Delete("userprofil/" . $profildelete);

        $id = DB::table('users')->where('user_id',Auth()->user()->user_id)->first()->id;
        $userupdate = User::find($id);

        $images = $request->file('profil');
        $new_name = rand() . '.' . $images->getClientOriginalExtension();
        $images->move(public_path('userprofil'), $new_name);
        $userupdate->profil = $new_name;
        $userupdate->save();

        return back()->with('success',true);

    }


    public function myfeedback(){
        $mysupport = DB::table('sitesupports')->orderBy('id','desc')->where('user_id',Auth()->user()->user_id)->get();
        return view('admin.mysupport',['mysupport' => $mysupport]);
    }
}
