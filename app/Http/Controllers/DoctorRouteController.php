<?php

namespace App\Http\Controllers;

use App\Models\Doctordisease;
use App\Models\Doctorhistory;
use App\Models\Doctorlogin;
use App\Models\Doctorproject;
use App\Models\Doctorschool;
use App\Models\Doctortime;
use App\Models\Invoice;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class DoctorRouteController extends Controller
{
    public function welcome()
    {
        if (count(DB::table('invoices')->where('user_id', Auth::guard('doctor')->user()->user_id)->get()) == 1) {
            $invociecount = 1;
        } else {
            $invociecount = 0;
        }
        return view('doctor.invoice', ['invociecount' => $invociecount]);
    }

    public function invoicesave(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'last' => 'required|max:255',
            'email' => 'required|max:255|email|unique:invoices',
            'phone' => 'required|max:12|unique:invoices',
            'address' => 'required|max:255',
            'zip' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
        ]);


        try {
            $invoicesave = new Invoice;
            $invoicesave->user_id = Auth::guard('doctor')->user()->user_id;
            $invoicesave->name = $request->input('name');
            $invoicesave->last = $request->input('last');
            $invoicesave->email = $request->input('email');
            $invoicesave->phone = $request->input('phone');
            $invoicesave->address = $request->input('address');
            $invoicesave->country = $request->input('country');
            $invoicesave->city = $request->input('city');
            $invoicesave->zip = $request->input('zip');
            $invoicesave->save();
            return back()->with('success_web', true);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }


    public function drcheckout(Request $dataresponse)
    {


        try {
            $cardname = DB::table('invoices')->orderBy('id', 'desc')->where('user_id',  Auth::guard('doctor')->user()->user_id)->first()->name;
            $cardlast = DB::table('invoices')->orderBy('id', 'desc')->where('user_id',  Auth::guard('doctor')->user()->user_id)->first()->last;
            $cardemail = DB::table('invoices')->orderBy('id', 'desc')->where('user_id',  Auth::guard('doctor')->user()->user_id)->first()->email;
            $cardphone = DB::table('invoices')->orderBy('id', 'desc')->where('user_id',  Auth::guard('doctor')->user()->user_id)->first()->phone;
            $cardaddress = DB::table('invoices')->orderBy('id', 'desc')->where('user_id',  Auth::guard('doctor')->user()->user_id)->first()->address;
            $cardcity = DB::table('invoices')->orderBy('id', 'desc')->where('user_id',  Auth::guard('doctor')->user()->user_id)->first()->city;
            $cardcountry = DB::table('invoices')->orderBy('id', 'desc')->where('user_id',  Auth::guard('doctor')->user()->user_id)->first()->Country;
            $cardzip = DB::table('invoices')->orderBy('id', 'desc')->where('user_id',  Auth::guard('doctor')->user()->user_id)->first()->zip;

            $randone = rand();
            $randtwo = rand();

            $month = substr($dataresponse->expiry, 0, 2);
            $year =  substr($dataresponse->expiry, -5);
            $cardnumber = str_replace(" ", "", $dataresponse->number);
            $cvc = $dataresponse->cvc;


            $doctordate = str_replace('-', ':', $dataresponse->doctor_date);


            $doctorprice = 479;

            $options = new \Iyzipay\Options();
            $options->setApiKey("sandbox-...");
            $options->setSecretKey("sandbox-...");
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");

            $request = new \Iyzipay\Request\CreatePaymentRequest();
            $request->setLocale(\Iyzipay\Model\Locale::TR);
            $request->setConversationId("123456789");
            $request->setPrice("$doctorprice");
            $request->setPaidPrice("$doctorprice");
            $request->setCurrency(\Iyzipay\Model\Currency::TL);
            $request->setInstallment(1);
            $request->setBasketId("B$randone");
            $request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
            $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
            $request->setCallbackUrl("http://localhost:8000/dr/dpayment/" . Auth::guard('doctor')->user()->user_id);

            $paymentCard = new \Iyzipay\Model\PaymentCard();
            $paymentCard->setCardHolderName("$cardname $cardlast");
            $paymentCard->setCardNumber("$cardnumber");
            $paymentCard->setExpireMonth("$month");
            $paymentCard->setExpireYear("$year");
            $paymentCard->setCvc("$cvc");
            $paymentCard->setRegisterCard(0);
            $request->setPaymentCard($paymentCard);

            $buyer = new \Iyzipay\Model\Buyer();
            $buyer->setId("BY$randtwo");
            $buyer->setName("$cardname");
            $buyer->setSurname("$cardlast");
            $buyer->setGsmNumber("$cardphone");
            $buyer->setEmail("$cardemail");
            $buyer->setIdentityNumber("74300864791");
            $buyer->setLastLoginDate("2015-10-05 12:43:35");
            $buyer->setRegistrationDate("2013-04-21 15:12:09");
            $buyer->setRegistrationAddress("$cardaddress");
            $buyer->setIp("85.34.78.112");
            $buyer->setCity("$cardcity");
            $buyer->setCountry("$cardcountry");
            $buyer->setZipCode("$cardzip");
            $request->setBuyer($buyer);

            $shippingAddress = new \Iyzipay\Model\Address();
            $shippingAddress->setContactName("$cardname $cardlast");
            $shippingAddress->setCity("$cardcity");
            $shippingAddress->setCountry("$cardcountry");
            $shippingAddress->setAddress("$cardaddress");
            $shippingAddress->setZipCode("$cardzip");
            $request->setShippingAddress($shippingAddress);
            $billingAddress = new \Iyzipay\Model\Address();
            $billingAddress->setContactName("$cardname $cardlast");
            $billingAddress->setCity("$cardcity");
            $billingAddress->setCountry("$cardcountry");
            $billingAddress->setAddress("$cardaddress");
            $billingAddress->setZipCode("$cardzip");
            $request->setBillingAddress($billingAddress);

            $basketItems = [];
            $itemrand = rand();
            $product = new \Iyzipay\Model\BasketItem();
            $product->setId("$itemrand");
            $product->setName('name');
            $product->setCategory1("XXXX");
            $product->setCategory2("YYYY");
            $product->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
            $product->setPrice($doctorprice);
            $basketItems[] = $product;
            $request->setBasketItems($basketItems);

            $payment = \Iyzipay\Model\ThreedsInitialize::create($request, $options);
            print_r($payment->getHtmlContent());
        } catch (\Throwable $th) {
            $report_id = new Report;
            $report_id->error =  $th->getMessage();
            $report_id->save();
            return back()->with('error_web', true);
        }
    }


    public function doctorhistory()
    {
        $doctorhistory = DB::table('doctorhistories')->orderBy('id', 'desc')->where('user_id', Auth::guard('doctor')->user()->user_id)->get();
        return view('doctor.doctorhistory', ['doctorhistory' => $doctorhistory]);
    }

    public function doctorproject()
    {
        $doctordate = DB::table('doctordates')->get(); // Tüm zaman aralığı
        // Doktorluk proje ilanımız
        $doctorproject = DB::table('doctorprojects')->where('user_id', Auth::guard('doctor')->user()->user_id)->get();
        //Bizim seçtiğimiz zaman aralıkları
        $doctortime = DB::table('doctortimes')->orderBy('doctor_time', 'asc')->where('user_id', Auth::guard('doctor')->user()->user_id)->pluck('doctor_time')->toArray();
        //Bizim seçmediğimiz zaman aralığı
        $houradd = DB::table('doctordates')->orderBy('doctor_time', 'asc')->whereNotIn('doctor_time', $doctortime)->get();
        $doctorschool = DB::table('doctorschools')->where('user_id', Auth::guard('doctor')->user()->user_id)->get();
        $doctordisease = DB::table('doctordiseases')->where('user_id', Auth::guard('doctor')->user()->user_id)->get();
        return view('doctor.project.project', [

            'doctordate' => $doctordate,
            'doctorproject' => $doctorproject,
            'doctortime' => $doctortime,
            'doctorschool' => $doctorschool,
            'doctordisease' => $doctordisease,
            'houradd' => $houradd
        ]);
    }

    public function doctorcreatesave(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'last' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:12',
            'profession' => 'required|max:255',
            'my_about' => 'required|max:10055',
            'appointment_price' => 'required',
            'doctor_date' => 'required',
            'projectlogo' => 'required|mimes:jpeg,JPG,png',
            'projectimages' => 'required|mimes:jpeg,JPG,png',
            'diseases' => 'required',
            'schools' => 'required',
            'doctor_time' => 'required',

        ]);

        try {
            $rand = rand();
            $doctorproject = new Doctorproject;
            $doctorproject->user_id = Auth::guard('doctor')->user()->user_id;
            $doctorproject->order_id = rand();
            $doctorproject->name = $request->input('name');
            $doctorproject->last = $request->input('last');
            $doctorproject->email = $request->input('email');
            $doctorproject->phone = $request->input('phone');
            $doctorproject->profession = $request->input('profession');
            $doctorproject->appointment_price = $request->input('appointment_price');
            $doctorproject->my_about = $request->input('my_about');

            $doctordate = $request->input('doctor_date');
            $doctorstartdate = substr($doctordate, 0, 10);
            $doctorenddate = substr($doctordate, -10);

            $doctorproject->doctor_startdate = $doctorstartdate;
            $doctorproject->doctor_enddate = $doctorenddate;


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

            $doctorproject->project_url = post_slug($request->input('profession'));
            $doctorproject->name_url = post_slug($request->input('name') . ' ' . $request->input('last'));



            //---------------------------------------------------------------------------------
            // Doctor logo
            $projectlogo = $request->file('projectlogo');
            $new_project_logo = rand() . '.' . $projectlogo->getClientOriginalExtension();
            $projectlogo->move(public_path('projectlogo'), $new_project_logo);
            $doctorproject->projectlogo = $new_project_logo;
            //---------------------------------------------------------------------------------
            // Doctor images
            $projectimages = $request->file('projectimages');
            $new_project_images = rand() . '.' . $projectimages->getClientOriginalExtension();
            $projectimages->move(public_path('projectimages'), $new_project_logo);
            $doctorproject->projectimages = $new_project_images;
            //---------------------------------------------------------------------------------


            foreach ($request->input('diseases') as $diseaseskey) {
                $diseasessave = new Doctordisease;
                $diseasessave->user_id = Auth::guard('doctor')->user()->user_id;
                $diseasessave->order_id = rand();
                $diseasessave->diseases =  $diseaseskey;
                $diseasessave->save();
            }

            foreach ($request->input('schools') as $schoolskey) {
                $schoolsave = new Doctorschool;
                $schoolsave->user_id = Auth::guard('doctor')->user()->user_id;
                $schoolsave->order_id = rand();
                $schoolsave->schools =  $schoolskey;
                $schoolsave->save();
            }


            foreach ($request->input('doctor_time') as $doctortimekey) {
                $doctortimesave = new Doctortime;
                $doctortimesave->user_id = Auth::guard('doctor')->user()->user_id;
                $doctortimesave->order_id = rand();
                $doctortimesave->doctor_time =  Carbon::parse($doctortimekey);
                $doctortimesave->save();
            }





            $doctorproject->save();


            return back();
        } catch (\Throwable $th) {
            $report = new Report;
            $report->error = $th->getMessage();
            $report->save();
            return back()->with('error_web', true);
        }
    }

    public function myearning()
    {
        $userhistory = DB::table('paymenthistories')->where('doctor_id', Auth::guard('doctor')->user()->user_id)->get();
        return view('doctor.project.myearning', ['userhistory' => $userhistory]);
    }

    public function doctorupdate(Request $request, $user_id)
    {

        if (count(DB::table('doctorprojects')->where('user_id', $user_id)->get()) == 1) {
            $security_id = DB::table('doctorprojects')->where('user_id', $user_id)->first()->user_id;
            if ($security_id == $user_id) {
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

                DB::table('doctordiseases')->where('user_id', Auth::guard('doctor')->user()->user_id)->delete();

                foreach ($request->input('diseases') as $diseaseskey) {
                    $diseasessave = new Doctordisease;
                    $diseasessave->user_id = Auth::guard('doctor')->user()->user_id;
                    $diseasessave->order_id = rand();
                    $diseasessave->diseases =  $diseaseskey;
                    $diseasessave->save();
                }

                // -----------------------------------------------------------------

                DB::table('doctorschools')->where('user_id', Auth::guard('doctor')->user()->user_id)->delete();

                foreach ($request->input('schools') as $schoolskey) {
                    $schoolsave = new Doctorschool;
                    $schoolsave->user_id = Auth::guard('doctor')->user()->user_id;
                    $schoolsave->order_id = rand();
                    $schoolsave->schools =  $schoolskey;
                    $schoolsave->save();
                }

                // -----------------------------------------------------------------
                $time_add = $request->input('time_add');
                if(isset($time_add)){
                    foreach ($request->input('time_add') as $doctortimekey) {
                        $doctortimesave = new Doctortime;
                        $doctortimesave->user_id = Auth::guard('doctor')->user()->user_id;
                        $doctortimesave->order_id = rand();
                        $doctortimesave->doctor_time =  Carbon::parse($doctortimekey);
                        $doctortimesave->save();
                    }
                }

                $time_delete = $request->input('time_delete');
                if(isset($time_delete)){
                    foreach ($request->input('time_delete') as $doctortimekey) {
                        DB::table('doctortimes')->where('user_id',Auth::guard('doctor')->user()->user_id)->where('doctor_time',$doctortimekey)->delete();
                    }
                }

                $doctorupdate->save();

                return back()->with('success',true);

            } else {
                return back();
            }
        } else {
            return back();
        }




    }


    public function doctorsetting(){
        return view('doctor.settings');
    }

    public function doctorpasswordupdate(Request $request){
        $password = Auth::guard('doctor')->user()->password;
        $password_id = Auth::guard('doctor')->user()->id;
        if ($request == "") {
            return;
        } else {
            if ($request->input('newpassword1') == $request->input('newpassword2')) {
                if (Hash::check($request->input('oldpassword'), $password)) {
                    echo $password_id;
                    $newpassword = Doctorlogin::find($password_id);
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

    public function doctorprofilupdate(Request $request){
      
        $request->validate([
            'profil' => 'required|mimes:jpeg,JPG,png',
        ]);


        $profildelete = DB::table('doctorlogins')->where('user_id',Auth::guard('doctor')->user()->user_id)->first()->profil;
        File::Delete("profil/" . $profildelete);

        $id = DB::table('doctorlogins')->where('user_id',Auth::guard('doctor')->user()->user_id)->first()->id;
        $userupdate = Doctorlogin::find($id);

        $images = $request->file('profil');
        $new_name = rand() . '.' . $images->getClientOriginalExtension();
        $images->move(public_path('profil'), $new_name);
        $userupdate->profil = $new_name;
        $userupdate->save();

        return back()->with('success',true);

    }
}
