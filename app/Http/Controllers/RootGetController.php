<?php

namespace App\Http\Controllers;

use App\Models\Doctorlogin;
use App\Models\Doctorproject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Doctorschool;
use App\Models\Doctordisease;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Doctortime;
use App\Models\Sitemessage;
use Carbon\Carbon;

class RootGetController extends Controller
{
    public function welcome()
    {
        $mysupport = DB::table('sitesupports')->orderBy('id', 'desc')->get();
        $doctorlogin = DB::table('doctorlogins')->orderBy('id', 'desc')->get();
        $doctorcount = count(DB::table('doctorlogins')->get());
        $projectcount = count(DB::table('doctorprojects')->get());
        $usercount = count(DB::table('users')->get());
        $total = 0;
        foreach(DB::table('doctorhistories')->get() as $totalcount){
            $total = $total + $totalcount->doctor_price;
        }
        $supportcount = count(DB::table('sitesupports')->get());
        $paymentcount = count(DB::table('paymenthistories')->get());


        return view(
            'root.index',
            [
                'mysupport' => $mysupport,
                'doctorlogin' => $doctorlogin,
                'doctorcount' => $doctorcount,
                'projectcount' => $projectcount,
                'supportcount' => $supportcount,
                'total' => $total,
                'usercount' => $usercount,
                'paymentcount' => $paymentcount

            ]
        );
    }

    public function doctoractive($id)
    {
        try {

            if (DB::table('doctorlogins')->where('id', $id)->first()->is_active == 0) {

                $doctoremail = DB::table('doctorlogins')->where('id', $id)->first()->email;
                $doctorname = DB::table('doctorlogins')->where('id', $id)->first()->name;


                Mail::send('root.mailsend', compact('doctorname'), function ($message)  use ($doctoremail, $doctorname) {
                    $message->to($doctoremail, $doctorname)
                        ->subject("Aramıza hoşgeldin, " . $doctorname);
                    $message->from('birhan_goktas55@hotmail.com', $doctorname);
                });

                $doctorupdate = Doctorlogin::find($id);
                $doctorupdate->is_active = 1;
                $doctorupdate->save();

                return back()->with('success', true);
            } else {
                return response()->json(['error', true]);
            }
        } catch (\Throwable $th) {
            return back()->with('error', true);
        }
    }

    public function doctorlist()
    {
        $doctorlist = DB::table('doctorprojects')->orderBy('id', 'desc')->get();
        return view('root.doctor.doctorlist', ['doctorlist' => $doctorlist]);
    }

    public function projectactive($id)
    {
        try {
            $projectupdate = Doctorproject::find($id);
            $projectupdate->is_active = 1;
            $projectupdate->save();
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function doctorhome($name_url,$job_url,$user_id){
        if(count(DB::table('doctorprojects')->where([['name_url',$name_url],['project_url',$job_url],['user_id',$user_id]])->get()) == 1){
            $doctorproject = DB::table('doctorprojects')->where([['name_url',$name_url],['project_url',$job_url],['user_id',$user_id]])->get();
            $doctordisease = DB::table('doctordiseases')->where('user_id',$user_id)->get();
            $doctorschool = DB::table('doctorschools')->where('user_id',$user_id)->get();
            $doctortime = DB::table('doctortimes')->orderBy('doctor_time', 'asc')->where('user_id', $user_id)->pluck('doctor_time')->toArray();
            $houradd = DB::table('doctordates')->orderBy('doctor_time', 'asc')->whereNotIn('doctor_time', $doctortime)->get();

            return view('root.doctor.doctorhome', [
                'doctorproject' => $doctorproject,
                'doctortime' => $doctortime,
                'doctorschool' => $doctorschool,
                'doctordisease' => $doctordisease,
                'houradd' => $houradd
            ]);
        }
        else {
            return back();
        }
    }


    public function rootdoctorupdate(Request $request,$user_id){
        $id = DB::table('doctorprojects')->where('user_id', $user_id)->first()->id;
        $doctorupdate = Doctorproject::find($id);

        $doctorupdate->name = $request->input('name');
        $doctorupdate->last = $request->input('last');
        $doctorupdate->email = $request->input('email');
        $doctorupdate->phone = $request->input('phone');
        $doctorupdate->profession = $request->input('profession');
        $doctorupdate->appointment_price = $request->input('appointment_price');
        $doctorupdate->my_about = $request->input('my_about');

        $doctordate = $request->input('doctor_date');
        $doctorstartdate = substr($doctordate, 0, 10);
        $doctorenddate = substr($doctordate, -10);

        $doctorupdate->doctor_startdate = $doctorstartdate;
        $doctorupdate->doctor_enddate = $doctorenddate;

        //--------------------------------------------------------------------


        //Project URL
        function remove_accent($str)
        {
            $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
            $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
            return str_replace($a, $b, $str);
        }

        function post_slug($str)
        {
            return strtolower(preg_replace(
                array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
                array('', '-', ''),
                remove_accent($str)
            ));
        }

        $doctorupdate->project_url = post_slug($request->input('profession'));
        $doctorupdate->name_url = post_slug($request->input('name') . ' ' . $request->input('last'));




        $requestlogo = $request->file('projectlogo');
        $deleteprojectlogo = DB::table('doctorprojects')->where('id', $id)->first()->projectlogo;
        if (isset($requestlogo)) {
            if ($requestlogo->getClientOriginalExtension() == "png" || $requestlogo->getClientOriginalExtension() == "jpg" || $requestlogo->getClientOriginalExtension() == "JPG" || $requestlogo->getClientOriginalExtension() == "jpeg") {
                File::Delete("projectlogo/" . $deleteprojectlogo);

                $projectlogoimages = $request->file('projectlogo');
                $new_name_projectlogo = rand() . '.' . $projectlogoimages->getClientOriginalExtension();
                $projectlogoimages->move(public_path('projectlogo'), $new_name_projectlogo);
                $doctorupdate->projectlogo = $new_name_projectlogo;
            }
        }

        //-------------------------------------------------------------------------


        $requestimages = $request->file('projectimages');
        $deleteprojectlogo = DB::table('doctorprojects')->where('id', $id)->first()->projectimages;
        if (isset($requestimages)) {
            if ($requestimages->getClientOriginalExtension() == "png" || $requestimages->getClientOriginalExtension() == "jpg" || $requestimages->getClientOriginalExtension() == "JPG" || $requestimages->getClientOriginalExtension() == "jpeg") {
                File::Delete("projectimages/" . $deleteprojectlogo);

                $projectimages = $request->file('projectimages');
                $new_name_projectimage = rand() . '.' . $projectlogoimages->getClientOriginalExtension();
                $projectlogoimages->move(public_path('projectimages'), $new_name_projectimage);
                $doctorupdate->projectimages = $new_name_projectimage;
            }
        }
        // -----------------------------------------------------------------

        DB::table('doctordiseases')->where('user_id', $user_id)->delete();

        foreach ($request->input('diseases') as $diseaseskey) {
            $diseasessave = new Doctordisease;
            $diseasessave->user_id = $user_id;
            $diseasessave->order_id = rand();
            $diseasessave->diseases =  $diseaseskey;
            $diseasessave->save();
        }

        // -----------------------------------------------------------------

        DB::table('doctorschools')->where('user_id', $user_id)->delete();

        foreach ($request->input('schools') as $schoolskey) {
            $schoolsave = new Doctorschool;
            $schoolsave->user_id = $user_id;
            $schoolsave->order_id = rand();
            $schoolsave->schools =  $schoolskey;
            $schoolsave->save();
        }

        // -----------------------------------------------------------------
        $time_add = $request->input('time_add');
        if(isset($time_add)){
            foreach ($request->input('time_add') as $doctortimekey) {
                $doctortimesave = new Doctortime;
                $doctortimesave->user_id = $user_id;
                $doctortimesave->order_id = rand();
                $doctortimesave->doctor_time =  Carbon::parse($doctortimekey);
                $doctortimesave->save();
            }
        }

        $time_delete = $request->input('time_delete');
        if(isset($time_delete)){
            foreach ($request->input('time_delete') as $doctortimekey) {
                DB::table('doctortimes')->where('user_id',$user_id)->where('doctor_time',$doctortimekey)->delete();
            }
        }

        $doctorupdate->save();
        return back()->with('success',true);
    }

    public function supports(){
        return view('root.support');
    }

    public function supportsave(Request $request){

        $sitemessage = new Sitemessage;
        $sitemessage->user_id = $request->input('user_id');
        $sitemessage->title = $request->input('title');
        $sitemessage->message = $request->input('comment');
        $sitemessage->save();
        return back()->with('success',true);
    }


    public function supporthome(){
        $supporthome = DB::table('sitemessages')->orderBy('id','desc')->get();
        return view('root.supporthome',['supporthome' => $supporthome]);
    }
}
