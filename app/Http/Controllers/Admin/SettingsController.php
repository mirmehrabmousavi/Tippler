<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Fab;
use App\Models\Link;
use App\Models\Settings;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /*$this->middleware('permission:settings-list|settings-create|settings-edit|settings-delete', ['only' => ['index','show']]);
        $this->middleware('permission:settings-create', ['only' => ['create','store']]);
        $this->middleware('permission:settings-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:settings-delete', ['only' => ['destroy']]);*/
    }

    public function index()
    {
        //Site Data
        $name = Settings::where('key' , 'name')->pluck('value')->first();
        $title = Settings::where('key' , 'title')->pluck('value')->first();
        $logo = Settings::where('key' , 'logo')->pluck('value')->first();
        $about = Settings::where('key' , 'about')->pluck('value')->first();
        $address = Settings::where('key' , 'address')->pluck('value')->first();
        $email = Settings::where('key' , 'email')->pluck('value')->first();
        $number = Settings::where('key' , 'number')->pluck('value')->first();
        $fanavari = Settings::where('key' , 'fanavari')->pluck('value')->first();
        $etemad = Settings::where('key' , 'etemad')->pluck('value')->first();
        $productId = Settings::where('key' , 'productId')->pluck('value')->first();
        $minifySource = Settings::where('key' , 'minifySource')->pluck('value')->first();
        $headerColor = Settings::where('key' , 'headerColor')->pluck('value')->first();
        $sideColor = Settings::where('key' , 'sideColor')->pluck('value')->first();
        $giftDis = Settings::where('key' , 'giftDis')->pluck('value')->first();
        $holidays = Settings::where('key' , 'holidays')->pluck('value')->first();
        //SEO
        $meta_title = Settings::where('key' , 'meta_title')->pluck('value')->first();
        $meta_keyword = Settings::where('key' , 'meta_keyword')->pluck('value')->first();
        $meta_desc = Settings::where('key' , 'meta_desc')->pluck('value')->first();
        //Links
        $links = Link::latest()->get();
        //Category
        $catHeader = Settings::where('key' , 'catHeader')->pluck('value')->first();
        //Payment
        $zarinpal = Settings::where('key' , 'zarinpal')->pluck('value')->first();
        $zibal = Settings::where('key' , 'zibal')->pluck('value')->first();
        $idpay = Settings::where('key' , 'idpay')->pluck('value')->first();
        $nextpay = Settings::where('key' , 'nextpay')->pluck('value')->first();
        $terminalBeh = Settings::where('key' , 'terminalBeh')->pluck('value')->first();
        $userBeh = Settings::where('key' , 'userBeh')->pluck('value')->first();
        $passwordBeh = Settings::where('key' , 'passwordBeh')->pluck('value')->first();
        $keySadad = Settings::where('key' , 'keySadad')->pluck('value')->first();
        $merchantSadad = Settings::where('key' , 'merchantSadad')->pluck('value')->first();
        $terminalSadad = Settings::where('key' , 'terminalSadad')->pluck('value')->first();
        $choicePay = Settings::where('key' , 'choicePay')->pluck('value')->first();
        $cardText = Settings::where('key' , 'cardText')->pluck('value')->first();
        $installment = Settings::where('key' , 'installment')->pluck('value')->first();
        $spot = Settings::where('key' , 'spot')->pluck('value')->first();
        $gateway = Settings::where('key' , 'gateway')->pluck('value')->first();
        $card = Settings::where('key' , 'card')->pluck('value')->first();
        $zarinpalStatus = Settings::where('key' , 'zarinpalStatus')->pluck('value')->first();
        $zibalStatus = Settings::where('key' , 'zibalStatus')->pluck('value')->first();
        $nextpayStatus = Settings::where('key' , 'nextpayStatus')->pluck('value')->first();
        $idpayStatus = Settings::where('key' , 'idpayStatus')->pluck('value')->first();
        $statusBeh = Settings::where('key' , 'statusBeh')->pluck('value')->first();
        $statusSadad = Settings::where('key' , 'statusSadad')->pluck('value')->first();
        //SMS
        $messageAuth = Settings::where('key' , 'messageAuth')->pluck('value')->first();
        $messageSuccess = Settings::where('key' , 'messageSuccess')->pluck('value')->first();
        $messageSuggest = Settings::where('key' , 'messageSuggest')->pluck('value')->first();
        $messageCancel = Settings::where('key' , 'messageCancel')->pluck('value')->first();
        $messageBack = Settings::where('key' , 'messageBack')->pluck('value')->first();
        $messageManager = Settings::where('key' , 'messageManager')->pluck('value')->first();
        $messageCounseling = Settings::where('key' , 'messageCounseling')->pluck('value')->first();
        $userSms = Settings::where('key' , 'userSms')->pluck('value')->first();
        $passSms = Settings::where('key' , 'passSms')->pluck('value')->first();
        $kaveKey = Settings::where('key' , 'kaveKey')->pluck('value')->first();
        $typeSms = Settings::where('key' , 'typeSms')->pluck('value')->first();
        $userFaraz = Settings::where('key' , 'userFaraz')->pluck('value')->first();
        $passFaraz = Settings::where('key' , 'passFaraz')->pluck('value')->first();
        $numberFaraz = Settings::where('key' , 'numberFaraz')->pluck('value')->first();
        //SocialMedia
        $socialMedias = Settings::where('social_media', 1)->latest()->get();
        //FAB FloatingActionButton
        $fabs = Fab::all();
        //Header ADs
        $heightHeader = Settings::where('key' , 'heightHeader')->pluck('value')->first();
        $imageHeader = Settings::where('key' , 'imageHeader')->pluck('value')->first();
        $linkHeader = Settings::where('key' , 'linkHeader')->pluck('value')->first();
        $adHeaderStatus = Settings::where('key' , 'adHeaderStatus')->pluck('value')->first();
        //PopUp ADs
        $imagePopUp = Settings::where('key' , 'imagePopUp')->pluck('value')->first();
        $titlePopUp = Settings::where('key' , 'titlePopUp')->pluck('value')->first();
        $addressPopUp = Settings::where('key' , 'addressPopUp')->pluck('value')->first();
        $popUpStatus = Settings::where('key' , 'popUpStatus')->pluck('value')->first();
        $descriptionPopUp = Settings::where('key' , 'descriptionPopUp')->pluck('value')->first();
        $buttonPopUp = Settings::where('key' , 'buttonPopUp')->pluck('value')->first();

        return view('admin.settings.index' , compact(
            //Site Data
            'name',
            'title',
            'logo',
            'about',
            'address',
            'email',
            'number',
            'fanavari',
            'etemad',
            'productId',
            'minifySource',
            'headerColor',
            'sideColor',
            'giftDis',
            'holidays',
            //SEO
            'meta_title',
            'meta_keyword',
            'meta_desc',
            //Links
            'links',
            //Category
            'catHeader',
            //Payment
            'zarinpal',
            'zibal',
            'idpay',
            'nextpay',
            'terminalBeh',
            'userBeh',
            'passwordBeh',
            'keySadad',
            'merchantSadad',
            'terminalSadad',
            'choicePay',
            'cardText',
            'installment',
            'spot',
            'gateway',
            'card',
            'zarinpalStatus',
            'zibalStatus',
            'nextpayStatus',
            'idpayStatus',
            'statusBeh',
            'statusSadad',
            //SMS
            'messageAuth',
            'messageSuccess',
            'messageSuggest',
            'messageCancel',
            'messageBack',
            'messageManager',
            'messageCounseling',
            'userSms',
            'passSms',
            'kaveKey',
            'typeSms',
            'userFaraz',
            'passFaraz',
            'numberFaraz',
            //SocialMedia
            'socialMedias',
            //FAB FloatingActionButton
            'fabs',
            //HeaderADs
            'heightHeader',
            'imageHeader',
            'linkHeader',
            'adHeaderStatus',
            //PopUp
            'imagePopUp',
            'titlePopUp',
            'addressPopUp',
            'popUpStatus',
            'descriptionPopUp',
            'buttonPopUp',
        ));
    }

    public function siteUpdate(Request $request)
    {
        $name = $request->name;
        $title = $request->title;
        $logo = $request->logo;
        $about = $request->about;
        $address = $request->address;
        $email = $request->email;
        $number = $request->number;
        $fanavari = $request->fanavari;
        $etemad = $request->etemad;
        $productId = $request->productId;
        $headerColor = $request->headerColor;
        $sideColor = $request->sideColor;
        $giftDis = $request->giftDis;
        $holidays = json_encode($request->holidays);
        if ($request->minifySource) {
            $minifySource = 1;
        }else{
            $minifySource = 0;
        }

        $array = [
            'name' => $name,
            'title' => $title,
            'logo' => $logo,
            'about' => $about,
            'address' => $address,
            'email' => $email,
            'number' => $number,
            'fanavari' => $fanavari,
            'etemad' => $etemad,
            'productId' => $productId,
            'holidays' => $holidays,
            'minifySource' => $minifySource,
            'headerColor' => $headerColor,
            'sideColor' => $sideColor,
            'giftDis' => $giftDis,
        ];

        foreach ($array as $key => $item){
            $setting = Settings::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update(['value' => $item]);
            }
        }

        return response()->json();
    }

    public function seoUpdate(Request $request)
    {
        $meta_title = $request->meta_title;
        $meta_keyword = $request->meta_keyword;
        $meta_desc = $request->meta_desc;
        $array = [
            'meta_title' =>$meta_title,
            'meta_keyword' =>$meta_keyword,
            'meta_desc' =>$meta_desc,
        ];
        foreach ($array as $key=>$item){
            $setting = Settings::where('key', $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return response()->json();
    }

    public function categoryUpdate(Request $request)
    {
        $array = [
            'catHeader' => $request->catHeader,
        ];
        foreach ($array as $key => $item){
            $setting = Settings::where('key', $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return response()->json();
    }

    public function paymentUpdate(Request $request)
    {
        $zarinpal = $request->zarinpal;
        $zibal = $request->zibal;
        $idpay = $request->idpay;
        $nextpay = $request->nextpay;
        $terminalBeh = $request->terminalBeh;
        $userBeh = $request->userBeh;
        $passwordBeh = $request->passwordBeh;
        $keySadad = $request->keySadad;
        $merchantSadad = $request->merchantSadad;
        $terminalSadad = $request->terminalSadad;
        $choicePay = $request->choicePay;
        $cardText = $request->cardText;
        if ($request->has('gateway')){
            $gateway = 1;
        }else{
            $gateway = 0;
        }
        if ($request->has('spot')){
            $spot = 1;
        }else{
            $spot = 0;
        }
        if ($request->has('installment')){
            $installment = 1;
        }else{
            $installment = 0;
        }
        if ($request->has('card')){
            $card = 1;
        }else{
            $card = 0;
        }
        if ($request->has('zarinpalStatus')){
            $zarinpalStatus = 1;
        }else{
            $zarinpalStatus = 0;
        }
        if ($request->has('zibalStatus')){
            $zibalStatus = 1;
        }else{
            $zibalStatus = 0;
        }
        if ($request->has('nextpayStatus')){
            $nextpayStatus = 1;
        }else{
            $nextpayStatus = 0;
        }
        if ($request->has('idpayStatus')){
            $idpayStatus = 1;
        }else{
            $idpayStatus = 0;
        }
        if ($request->has('statusBeh')){
            $statusBeh = 1;
        }else{
            $statusBeh = 0;
        }
        if ($request->has('statusSadad')){
            $statusSadad = 1;
        }else{
            $statusSadad = 0;
        }
        $array = [
            'zarinpal' =>$zarinpal,
            'zibal' =>$zibal,
            'idpay' =>$idpay,
            'nextpay' =>$nextpay,
            'terminalBeh' =>$terminalBeh,
            'userBeh' =>$userBeh,
            'passwordBeh' =>$passwordBeh,
            'keySadad' =>$keySadad,
            'merchantSadad' =>$merchantSadad,
            'terminalSadad' =>$terminalSadad,
            'choicePay' =>$choicePay,
            'spot' => $spot,
            'card' => $card,
            'zarinpalStatus' => $zarinpalStatus,
            'zibalStatus' => $zibalStatus,
            'nextpayStatus' => $nextpayStatus,
            'idpayStatus' => $idpayStatus,
            'statusBeh' => $statusBeh,
            'statusSadad' => $statusSadad,
            'installment' => $installment,
            'gateway' => $gateway,
            'cardText' => $cardText,
        ];
        foreach ($array as $key=>$item){
            $setting = Settings::where('key', $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect(route('admin.settings.index', ['tab=payment']))->with('success', 'با موفقیت بروزرسانی شد.');
    }

    public function smsUpdate(Request $request)
    {
        $messageAuth = $request->messageAuth;
        $messageSuccess = $request->messageSuccess;
        $messageSuggest = $request->messageSuggest;
        $messageCancel = $request->messageCancel;
        $messageBack = $request->messageBack;
        $messageManager = $request->messageManager;
        $messageCounseling = $request->messageCounseling;
        $userSms = $request->userSms;
        $passSms = $request->passSms;
        $kaveKey = $request->kaveKey;
        $typeSms = $request->typeSms;
        $userFaraz = $request->userFaraz;
        $passFaraz = $request->passFaraz;
        $numberFaraz = $request->numberFaraz;
        $array = [
            'messageAuth' => $messageAuth,
            'userFaraz' => $userFaraz,
            'passFaraz' => $passFaraz,
            'numberFaraz' => $numberFaraz,
            'messageSuccess' => $messageSuccess,
            'messageSuggest' => $messageSuggest,
            'messageCancel' => $messageCancel,
            'messageBack' => $messageBack,
            'messageManager' => $messageManager,
            'messageCounseling' => $messageCounseling,
            'userSms' => $userSms,
            'passSms' => $passSms,
            'kaveKey' => $kaveKey,
            'typeSms' => $typeSms,
        ];
        foreach ($array as $key=>$item){
            $setting = Settings::where('key', $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect(route('admin.settings.index', ['tab=sms']))->with('success', 'با موفقیت بروزرسانی شد.');
    }

    public function socialMediaStore(Request $request)
    {
        $request->validate([
           'key' => 'required',
           'value' => 'required',
        ]);
        Settings::create([
            'key' => $request->key,
            'value' => $request->value,
            'social_media' => 1,
        ]);
        return redirect(route('admin.settings.index', ['tab=social-media']))->with('success', 'با موفقیت ذخیره شد.');
    }

    public function socialMediaUpdate(Request $request, $id)
    {
        $settings = Settings::findOrFail($id);
        $settings->update([
            'key' => $request->key,
            'value' => $request->value,
            'social_media' => 1,
        ]);
        return redirect(route('admin.settings.index', ['tab=social-media']))->with('success', 'با موفقیت بروزرسانی شد.');
    }

    public function socialMediaDestroy($id)
    {
        $settings = Settings::findOrFail($id);
        $settings->delete();
        return redirect(route('admin.settings.index', ['tab=social-media']))->with('success', 'با موفقیت حذف  شد.');
    }

    public function fabStore(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'link' => 'required',
           'icon' => 'required',
           'type' => 'required',
        ]);
        Fab::create([
            'title' => $request->title,
            'link' => $request->link,
            'icon' => $request->icon,
            'type' => $request->type,
        ]);
        return redirect(route('admin.settings.index', ['tab=fab']))->with('success', 'با موفقیت ذخیره شد');
    }

    public function fabUpdate(Request $request, $id)
    {
       $fab = Fab::findOrFail($id);
       $fab->update([
            'title' => $request->title,
            'link' => $request->link,
            'icon' => $request->icon,
            'type' => $request->type,
        ]);
        return redirect(route('admin.settings.index', ['tab=fab']))->with('success', 'با موفقیت بروزرسانی شد');
    }

    public function fabDestroy($id)
    {
        $fab = Fab::findOrFail($id);
        $fab->delete();
        return redirect(route('admin.settings.index', ['tab=fab']))->with('success', 'با موفقیت حذف شد');
    }

    public function headerAdsUpdate(Request $request)
    {
        $heightHeader = $request->heightHeader;
        $imageHeader = $request->imageHeader;
        $linkHeader = $request->linkHeader;
        $adHeaderStatus = $request->adHeaderStatus;
        $array = [
            'heightHeader' => $heightHeader,
            'imageHeader' => $imageHeader,
            'linkHeader' => $linkHeader,
            'adHeaderStatus' => $adHeaderStatus,
        ];
        foreach ($array as $key => $item){
            $setting = Settings::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update(['value' => $item]);
            }
        }
        return response()->json();
    }

    public function popupUpdate(Request $request)
    {
        $imagePopUp = $request->imagePopUp;
        $titlePopUp = $request->titlePopUp;
        $addressPopUp = $request->addressPopUp;
        $popUpStatus = $request->popUpStatus;
        $descriptionPopUp = $request->descriptionPopUp;
        $buttonPopUp = $request->buttonPopUp;
        $array = [
            'imagePopUp' => $imagePopUp,
            'titlePopUp' => $titlePopUp,
            'addressPopUp' => $addressPopUp,
            'popUpStatus' => $popUpStatus,
            'descriptionPopUp' => $descriptionPopUp,
            'buttonPopUp' => $buttonPopUp,
        ];
        foreach ($array as $key => $item){
            $setting = Settings::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update(['value' => $item]);
            }
        }
        return response()->json();
    }
}
