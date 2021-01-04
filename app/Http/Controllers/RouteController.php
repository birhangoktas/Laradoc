<?php

namespace App\Http\Controllers;

use App\Models\Doctorcomment;
use App\Models\Doctorlogin;
use App\Models\Report;
use App\Models\User;
use App\Models\Userinvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RouteController extends Controller
{

    // Public -> Get
    public function welcome()
    {
        $doctors = DB::table('doctorprojects')->orderBy('id','desc')->take(8)->get();
        return view('public.index',['doctors' => $doctors]);
    }

    public function userregister()
    {
        if (isset($_GET['code'])) {
            if (count(DB::table('users')->where('verification_code', $_GET['code'])->get()) == 1) {
                $verifymail = DB::table('users')->where('verification_code', $_GET['code'])->first()->verification_code;
                if ($verifymail == $_GET['code']) {
                    $id = DB::table('users')->where('verification_code', $_GET['code'])->first()->id;
                    $userwhere = User::find($id);
                    $userwhere->is_verify = 1;
                    $userwhere->save();
                    return redirect('/giris-yap');
                }
            }
        }


        return view('public.userregister');
    }

    public function loginview()
    {
        return view('public.userlogin');
    }

    public function doctorlist()
    {
        $doctorlist = DB::table('doctorprojects')->get();
        return view('public.doctorlist', ['doctorlist' => $doctorlist]);
    }

    public function doctorregister()
    {
        return view('public.doctorregister');
    }

    public function doctorlogin()
    {
        return view('doctorlogin');
    }

    // Public -> Post

    public function doctorregistersave(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'last' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'tc' => 'required|max:255',
            'title' => 'required|max:255',
            'password' => 'required|max:5000',
            'profil' => 'required|mimes:jpeg,JPG,png',
        ]);


        try {

            $doctorsave = new Doctorlogin;
            $doctorsave->user_id = rand();
            $doctorsave->name = $request->input('name');
            $doctorsave->last = $request->input('last');
            $doctorsave->email = $request->input('email');
            $doctorsave->phone = $request->input('phone');
            $doctorsave->tc = $request->input('tc');
            $doctorsave->title = $request->input('title');
            $fileprofil = $request->file('profil');
            $new_name = rand() . '.' . $fileprofil->getClientOriginalExtension();
            $fileprofil->move(public_path('profil'), $new_name);
            $doctorsave->profil = $new_name;
            $doctorsave->password = Hash::make($request->input('password'));
            $doctorsave->save();

            return back()->with('success_web', true);
        } catch (\Throwable $th) {
            $report = new Report;
            $report->error = $th->getMessage();
            $report->save();
            return back()->with('error_web', true);
        }
    }

    public function doctorloginsave(Request $request)
    {

        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);


        try {

            if (auth()->guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password])) {

                return redirect('/dr');
            } else {
                return back()->with('error_password', true);
            }
        } catch (\Throwable $th) {
            $report = new Report;
            $report->error = $th->getMessage();
            $report->save();
            return back()->with('error_web', true);
        }
    }

    public function doctorexamined($namelast, $projecturl,$user_id)
    {
        if(count(DB::table('doctorprojects')->where([['name_url', $namelast], ['project_url', $projecturl],['user_id',$user_id]])->get()) == 1){
            $data = DB::table('doctorprojects')->where([['name_url', $namelast], ['project_url', $projecturl],['user_id',$user_id]])->get();
            $userid = DB::table('doctorprojects')->where([['name_url', $namelast], ['project_url', $projecturl],['user_id',$user_id]])->first()->user_id;
            $schooldata = DB::table('doctorschools')->where('user_id', $userid)->get();
            $diseasedata = DB::table('doctordiseases')->where('user_id', $userid)->get();
            $timedata = DB::table('doctortimes')->orderBy('doctor_time','desc')->where('user_id', $userid)->get();
    
    
            if (Auth()->user() == null) {
                $userinvoices = [];
                $userpayment = [];
            } else {
                $userinvoices = DB::table('userinvoices')->where('user_id', Auth()->user()->user_id)->get();
                $userpayment = DB::table('paymenthistories')->where([['user_id', Auth()->user()->user_id], ['doctor_id', $userid]])->get();
            }
            $doctorcomment = DB::table('doctorcomments')->where('doctor_id', $userid)->get();
            //$userinvoices = DB::table('userinvoices')->where('user_id',Auth()->user()->user_id)->get();
    
            return view(
                'public.doctorhome',
                [
                    'data' => $data,
                    'schooldata' => $schooldata,
                    'diseasedata' => $diseasedata,
                    'timedata' => $timedata,
                    'userinvoices' => $userinvoices,
                    'userpayment' => $userpayment,
                    'doctorcomment' => $doctorcomment
    
                ]
            );
        }
        else {
            return back();
        }
       
    }

    public function usersave(Request $request)
    {


        $request->validate([
            'name' => 'required|max:255',
            'last' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'phone' => 'required|max:12|unique:users',
            'password' => 'required|max:255',
        ]);


        $database = new User;
        $database->user_id = rand();
        $database->name = $request->input('name');
        $database->last = $request->input('last');
        $database->verification_code = $request->_token;
        $database->email = $request->input('email');
        $database->phone = $request->input('phone');
        $database->password =  Hash::make($request->input('password'));
        $database->save();


        $value = $request->_token;
        $to_name = $request->input('name') . " " . $request->input('last');
        $to_email =  $request->input('email');
        $data = array('name' => "Yout name", "body" => "Aramıza hoş geldin");

        Mail::send('public.mailsend', compact('value'), function ($message)  use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject("Aramıza hoşgeldin, " . $to_name);
            $message->from('birhan_goktas55@hotmail.com', $to_name);
        });
        return back()->with('success_web', "Başarılı");
    }

    public function userlogin(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $usersecurity = DB::table('users')->where('email', $request->email)->first()->is_verify; // {id : '3'}
                if ($usersecurity == 1) {
                    return redirect("/admin");
                } else {
                    return back()->with('mail-check', 'Lütfen e-posta adresinizi doğrulayın.');
                }
            } else {
                return back()->with('error-password', 'Bilgiler uyuşmuyor.');
            }
        } catch (\Throwable $th) {

            $report_id = new Report;
            $report_id->error =  $th->getMessage();
            $report_id->save();
            return back();
        }
    }


    public function userinvoicesave(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'last' => 'required|max:255',
            'email' => 'required|max:255|email|unique:userinvoices',
            'phone' => 'required|max:12|unique:userinvoices',
            'address' => 'required|max:255',
            'zip' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
        ]);



        $userinvoice = new Userinvoice;
        $userinvoice->user_id = Auth()->user()->user_id;
        $userinvoice->name = $request->input('name');
        $userinvoice->last = $request->input('last');
        $userinvoice->email = $request->input('email');
        $userinvoice->phone = $request->input('phone');
        $userinvoice->address = $request->input('address');
        $userinvoice->zip = $request->input('zip');
        $userinvoice->city = $request->input('city');
        $userinvoice->country = $request->input('country');
        $userinvoice->save();

        return back()->with('success_invoice', true);
    }

    public function doctorcommentsave(Request $request, $doctor_id, $my_id)
    {
        if (count(DB::table('doctorcomments')->where([['user_id', $my_id], ['doctor_id', $doctor_id]])->get()) >= 1) {
            return back()->with('non_comment', true);
        } else {

            $request->validate([
                'namelast' => 'required|max:255',
                'puan' => 'required|max:5|min:1',
                'comment' => 'required|max:1500',
            ]);


            $commentsave = new Doctorcomment;
            $commentsave->user_id = $my_id;
            $commentsave->doctor_id = $doctor_id;
            $commentsave->order_id = rand();
            $commentsave->namelast = $request->input('namelast');
            $commentsave->puan = $request->input('puan');
            $commentsave->comment = $request->input('comment');
            $commentsave->save();

            return back()->with('success_comment', true);
        }
    }

    public function hoursetting($date)
    {
        try {
            $mentorarray = DB::table('paymenthistories')->where('user_id', Auth()->user()->user_id)->where('doctor_date', Carbon::parse("$date")->format('Y-m-d'))->pluck('doctor_time')->toArray();
            $mentortitle = DB::table('doctortimes')->orderBy('doctor_time','desc')->whereNotIn('doctor_time', $mentorarray)->get();
            return view('public.doctortime', ['doctortitle' => $mentortitle]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function rootloginview(){
        return view('rootlogin');
    }
    
    public function rootlogin(Request $request)
    {
        try {
            if (Auth::guard('root')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect("/root");
            } else {
                return back()->with('error-password', 'Bilgiler uyuşmuyor.');
            }
        } catch (\Throwable $th) {

            $report_id = new Report;
            $report_id->error =  $th->getMessage();
            $report_id->save();
            return back();
        }
    }
}
