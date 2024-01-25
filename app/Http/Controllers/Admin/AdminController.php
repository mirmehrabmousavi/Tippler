<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Mag;
use App\Models\Page;
use App\Models\Tag;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $allPages = Page::count();
        $allMags = Mag::count();
        $allCats = Category::count();
        $allTags = Tag::count();
        $allGalleries = Gallery::count();
        $allFaqs = Faq::count();
        $allUsers = User::count();

        $year = verta()->year;
        $farvardin = Verta::parse($year . ' فروردین 1')->formatGregorian('Y-m-d H:i:s');
        $ordibehesht = Verta::parse($year . ' اردیبهشت 1')->formatGregorian('Y-m-d H:i:s');
        $khordad = Verta::parse($year . ' خرداد 1')->formatGregorian('Y-m-d H:i:s');
        $tir = Verta::parse($year . ' تیر 1')->formatGregorian('Y-m-d H:i:s');
        $mordad = Verta::parse($year . ' مرداد 1')->formatGregorian('Y-m-d H:i:s');
        $shahrivar = Verta::parse($year . ' شهریور 1')->formatGregorian('Y-m-d H:i:s');
        $mehr = Verta::parse($year . ' مهر 1')->formatGregorian('Y-m-d H:i:s');
        $aban = Verta::parse($year . ' آبان 1')->formatGregorian('Y-m-d H:i:s');
        $azar = Verta::parse($year . ' آذر 1')->formatGregorian('Y-m-d H:i:s');
        $dey = Verta::parse($year . ' دی 1')->formatGregorian('Y-m-d H:i:s');
        $bahman = Verta::parse($year . ' بهمن 1')->formatGregorian('Y-m-d H:i:s');
        $esfand = Verta::parse($year . ' اسفند 1')->formatGregorian('Y-m-d H:i:s');

        $farvardinUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$farvardin, $ordibehesht])->count();
        $ordibeheshtUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$ordibehesht, $khordad])->count();
        $khordadUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$khordad, $tir])->count();
        $tirUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$tir, $mordad])->count();
        $mordadUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$mordad, $shahrivar])->count();
        $shahrivarUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$shahrivar, $mehr])->count();
        $mehrUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$mehr, $aban])->count();
        $abanUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$aban, $azar])->count();
        $azarUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$azar, $dey])->count();
        $deyUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$dey, $bahman])->count();
        $bahmanUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$bahman, $esfand])->count();
        $esfandUser = User::where('manager', 0)->where('admin', 0)->whereBetween('created_at', [$esfand, $farvardin])->count();

        $farvardinManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$farvardin, $ordibehesht])->count();
        $ordibeheshtManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$ordibehesht, $khordad])->count();
        $khordadManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$khordad, $tir])->count();
        $tirManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$tir, $mordad])->count();
        $mordadManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$mordad, $shahrivar])->count();
        $shahrivarManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$shahrivar, $mehr])->count();
        $mehrManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$mehr, $aban])->count();
        $abanManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$aban, $azar])->count();
        $azarManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$azar, $dey])->count();
        $deyManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$dey, $bahman])->count();
        $bahmanManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$bahman, $esfand])->count();
        $esfandManager = User::where('manager', 1)->where('admin', 0)->whereBetween('created_at', [$esfand, $farvardin])->count();

        $farvardinAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$farvardin, $ordibehesht])->count();
        $ordibeheshtAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$ordibehesht, $khordad])->count();
        $khordadAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$khordad, $tir])->count();
        $tirAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$tir, $mordad])->count();
        $mordadAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$mordad, $shahrivar])->count();
        $shahrivarAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$shahrivar, $mehr])->count();
        $mehrAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$mehr, $aban])->count();
        $abanAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$aban, $azar])->count();
        $azarAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$azar, $dey])->count();
        $deyAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$dey, $bahman])->count();
        $bahmanAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$bahman, $esfand])->count();
        $esfandAdmin = User::where('manager', 0)->where('admin', 1)->whereBetween('created_at', [$esfand, $farvardin])->count();

        return view('admin.dashboard', compact(
            'allPages',
            'allMags',
            'allCats',
            'allTags',
            'allGalleries',
            'allFaqs',
            'allUsers',
            //User
            'farvardinUser',
            'ordibeheshtUser',
            'khordadUser',
            'tirUser',
            'mordadUser',
            'shahrivarUser',
            'mehrUser',
            'abanUser',
            'azarUser',
            'deyUser',
            'bahmanUser',
            'esfandUser',
            //Manager
            'farvardinManager',
            'ordibeheshtManager',
            'khordadManager',
            'tirManager',
            'mordadManager',
            'shahrivarManager',
            'mehrManager',
            'abanManager',
            'azarManager',
            'deyManager',
            'bahmanManager',
            'esfandManager',
            //Admin
            'farvardinAdmin',
            'ordibeheshtAdmin',
            'khordadAdmin',
            'tirAdmin',
            'mordadAdmin',
            'shahrivarAdmin',
            'mehrAdmin',
            'abanAdmin',
            'azarAdmin',
            'deyAdmin',
            'bahmanAdmin',
            'esfandAdmin',
        ));
    }
}
