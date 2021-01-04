<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctorlogin;
use App\Models\Report;
use App\Models\Doctorhistory;
use App\Models\Doctorproject;
use App\Models\Paymenthistory;
use Carbon\Carbon;

class CreditCardController extends Controller
{

    public function dpayment(Request $responsedata, $user_id)
    {
        try {
            $options = new \Iyzipay\Options();
            $options->setApiKey("sandbox-...");
            $options->setSecretKey("sandbox-...");
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");

            $request = new \Iyzipay\Request\CreateThreedsPaymentRequest();
            $request->setLocale(\Iyzipay\Model\Locale::TR);
            $request->setConversationId("$responsedata->conversationId");
            $request->setPaymentId("$responsedata->paymentId");
            $request->setConversationData("$responsedata->conversationData");
            $threedsPayment = \Iyzipay\Model\ThreedsPayment::create($request, $options);

            if ($threedsPayment->getStatus() == "success") {
                $id = DB::table('doctorlogins')->where('user_id', $user_id)->first()->id;
                $doctorfind = Doctorlogin::find($id);
                $doctorfind->is_money = 1;
                $doctorfind->save();

                //----------------------------------------------------------------------------
                $doctor_name = DB::table('doctorlogins')->where('user_id', $user_id)->first()->name;
                $doctor_last = DB::table('doctorlogins')->where('user_id', $user_id)->first()->last;
                $doctor_email = DB::table('doctorlogins')->where('user_id', $user_id)->first()->email;
                $doctor_phone = DB::table('doctorlogins')->where('user_id', $user_id)->first()->phone;
                $doctor_price = 479;
                //----------------------------------------------------------------------------

                $doctorhistory = new Doctorhistory;
                $doctorhistory->user_id = $user_id;
                $doctorhistory->order_id = rand();
                $doctorhistory->doctor_name = $doctor_name;
                $doctorhistory->doctor_last = $doctor_last;
                $doctorhistory->doctor_email = $doctor_email;
                $doctorhistory->doctor_phone = $doctor_phone;
                $doctorhistory->doctor_price = $doctor_price;
                $doctorhistory->save();

                return redirect()->to('/dr/islem-gecmisi')->send();
            }
        } catch (\Throwable $th) {
            $reportsave = new Report;
            $reportsave->error = $th->getMessage();
            $reportsave->save();
            return redirect()->with('error_web', 'işlem sırasında bir hata oluştu');
        }
    }


    // -------------------------------------------------------------------------------------------


    public function doctorbuy(Request $dataresponse, $doctor_user_id, $my_user_id)
    {

        $dataresponse->validate([
            'name' => 'required',
            'expiry' => 'required',
            'number' => 'required|max:19',
            'doctor_date' => 'required',
            'doctor_time' => 'required',
            'cvc' => 'required',
            'doctor_message' => 'required',
        ]);




        try {
            $cardname = DB::table('userinvoices')->orderBy('id', 'desc')->where('user_id',  $my_user_id)->first()->name;
            $cardlast = DB::table('userinvoices')->orderBy('id', 'desc')->where('user_id',  $my_user_id)->first()->last;
            $cardemail = DB::table('userinvoices')->orderBy('id', 'desc')->where('user_id',  $my_user_id)->first()->email;
            $cardphone = DB::table('userinvoices')->orderBy('id', 'desc')->where('user_id',  $my_user_id)->first()->phone;
            $cardaddress = DB::table('userinvoices')->orderBy('id', 'desc')->where('user_id',  $my_user_id)->first()->address;
            $cardcity = DB::table('userinvoices')->orderBy('id', 'desc')->where('user_id',  $my_user_id)->first()->city;
            $cardcountry = DB::table('userinvoices')->orderBy('id', 'desc')->where('user_id',  $my_user_id)->first()->Country;
            $cardzip = DB::table('userinvoices')->orderBy('id', 'desc')->where('user_id',  $my_user_id)->first()->zip;

            $randone = rand();
            $randtwo = rand();

            $month = substr($dataresponse->expiry, 0, 2);
            $year =  substr($dataresponse->expiry, -5);
            $cardnumber = str_replace(" ", "", $dataresponse->number);
            $cvc = $dataresponse->cvc;


            $doctordate = str_replace('-', ':', $dataresponse->doctor_date);


            $doctorprice = DB::table('doctorprojects')->where('user_id', $doctor_user_id)->first()->appointment_price;

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
            $request->setCallbackUrl(route('threedoctorbuy', [$doctor_user_id, $my_user_id, $doctordate, $dataresponse->doctor_time, $dataresponse->doctor_message]));

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
            dd($th->getMessage());
        }
    }

    public function threedoctorbuy(Request $responsedata, $doctor_user_id, $my_user_id, $doctor_date, $doctor_time, $doctor_message)
    {


        try {
            $options = new \Iyzipay\Options();
            $options->setApiKey("sandbox-...");
            $options->setSecretKey("sandbox-...");
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");

            $request = new \Iyzipay\Request\CreateThreedsPaymentRequest();
            $request->setLocale(\Iyzipay\Model\Locale::TR);
            $request->setConversationId("$responsedata->conversationId");
            $request->setPaymentId("$responsedata->paymentId");
            $request->setConversationData("$responsedata->conversationData");
            $threedsPayment = \Iyzipay\Model\ThreedsPayment::create($request, $options);

            if ($threedsPayment->getStatus() == "success") {


                $new_doctor_date = str_replace(':', '-', $doctor_date);

                //------------------ START | appointment_price -----------------------------------------
                //$doctor_appointment_price = DB::table('doctorprojects')->where('user_id', $doctor_user_id)->first()->appointment_price;
                //------------------ END | appointment_price -----------------------------------------

                //------------------ START | USER INVOİCE -----------------------------------------
                $invoicename = DB::table('userinvoices')->where('user_id', $my_user_id)->first()->name;
                $invoicelast = DB::table('userinvoices')->where('user_id', $my_user_id)->first()->last;
                $invoiceemail = DB::table('userinvoices')->where('user_id', $my_user_id)->first()->email;
                $invoicephone = DB::table('userinvoices')->where('user_id', $my_user_id)->first()->phone;
                //------------------ END | USER INVOİCE -----------------------------------------

                // Paymenthistory -> save  | --------------------------------
                $paymenthistorysave = new Paymenthistory;
                $paymenthistorysave->user_id = $my_user_id;
                $paymenthistorysave->doctor_id = $doctor_user_id;
                $paymenthistorysave->order_id = rand();
                $paymenthistorysave->name = $invoicename;
                $paymenthistorysave->last = $invoicelast;
                $paymenthistorysave->email = $invoiceemail;
                $paymenthistorysave->phone = $invoicephone;
                $paymenthistorysave->appointment_price = $threedsPayment->getPrice();
                $paymenthistorysave->doctor_message = $doctor_message;
                $paymenthistorysave->doctor_date = Carbon::parse("$new_doctor_date")->format('Y-m-d');
                $paymenthistorysave->doctor_time = "$doctor_time";
                $paymenthistorysave->save();
                // Paymenthistory -> save  | --------------------------------



                return redirect()->to('/admin/islem-gecmisi')->send();
            }
            else {
                return redirect()->to('/doktorlar')->with('error-card', $threedsPayment->getErrorMessage());
            }
        } catch (\Throwable $th) {
            $reportsave = new Report;
            $reportsave->error = $th->getMessage();
            $reportsave->save();
            return redirect()->to('/doktorlar')->with('error_web', 'işlem sırasında bir hata oluştu');
        }
    }


}
