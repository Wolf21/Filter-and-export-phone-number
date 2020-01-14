<?php


namespace App\Http\Controllers;


use App\Exports\MobiExport;
use App\Exports\VietelExport;
use App\Exports\VinaExport;
use App\Imports\PhonesImport;
use App\Mobis;
use App\Phones;
use App\Vietels;
use App\Vinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class LaravelExcelController
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function truncate() {
//        Phones::truncate();
        Vietels::truncate();
        Vinas::truncate();
        Mobis::truncate();
        return redirect(url('/'))->with(['msg' => 'Truncate success']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function convert(Request $request)
    {
//        set_time_limit(0);
//        Excel::import(new PhonesImport(), resource_path('uploads/phone.xlsx')); // import excel to db

//        Phones::where('phone', 'PHONES')->delete(); //clear row not number phone
        /**
         * filter number phone follow network
         */
//        $vina = self::getVina();
//        self::convertVina($vina);
//        Vinas::insert($vina);

        $vietel = self::getVietel();
        self::convertVt($vietel);
        Vietels::insert($vietel);
//
//        $mobi = self::getMobi();
//        self::convertMobi();
//        Mobis::insert($mobi);
        /**
         * export to excel
         */
        Excel::store(new VinaExport, 'vina.xlsx', 'uploads');
        Excel::store(new VietelExport, 'vt.xlsx', 'uploads');
        Excel::store(new MobiExport, 'mobi.xlsx', 'uploads');
        return redirect(route('laravelExcel'))->with(['msg' => 'Convert success']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function check(Request $request)
    {
        if ($request->vina <= Vinas::count() && $request->vt <= Vietels::count() && $request->mobi <= Mobis::count()) {
            return redirect(route('laravelExcel'))
                ->with(['msg' => 'Check success. VN is '  . Vinas::count()
                    . ', VT is ' . Vietels::count()
                    . ', Mobi is ' . Mobis::count()
                ]);
        } else {
            return redirect(route('laravelExcel'))
                ->with(['err-msg' => 'Check Fail. VN is '. Vinas::count() . ' not ' . $request->vina
                    . ', VT is ' . Vietels::count() . ' not ' . $request->vt
                    . ', Mobi is ' . Mobis::count() . ' not ' . $request->mobi
                ]);
        }
    }

    /**
     * @return mixed
     */
    public static function getVietel() {
        return Phones::where('phone', 'like', '+8486%')
            ->orWhere('phone', 'like', '+8496%')
            ->orWhere('phone', 'like', '+8497%')
            ->orWhere('phone', 'like', '+8498%')
            ->orWhere('phone', 'like', '+8432%')
            ->orWhere('phone', 'like', '+8433%')
            ->orWhere('phone', 'like', '+8434%')
            ->orWhere('phone', 'like', '+8435%')
            ->orWhere('phone', 'like', '+8436%')
            ->orWhere('phone', 'like', '+8437%')
            ->orWhere('phone', 'like', '+8438%')
            ->orWhere('phone', 'like', '+8439%')
            ->get()->toArray();
    }

    /**
     * @return mixed
     */
    public static function getVina() {
        return Phones::where('phone', 'like', '+8488%')
            ->orWhere('phone', 'like', '+8481%')
            ->orWhere('phone', 'like', '+8482%')
            ->orWhere('phone', 'like', '+8483%')
            ->orWhere('phone', 'like', '+8484%')
            ->orWhere('phone', 'like', '+8485%')
            ->orWhere('phone', 'like', '+8491%')
            ->orWhere('phone', 'like', '+8494%')
            ->get()->toArray();
    }

    /**
     * @return mixed
     */
    public static function getMobi() {
        return Phones::all()->toArray();
    }

    /**
     * @param $vina
     */
    public static function convertVina($vina) {
        //vina
        foreach ($vina as $index => $each) {
            foreach ($each as $key => $value) {
                if ($key == 'phone') {
                    $vina[$index][$key] = "'" . $value;
                    Phones::where('phone', $value)->delete();
                }
            }
        }
    }

    /**
     * @param $vietel
     */
    public static function convertVt($vietel) {
        //vt
        foreach ($vietel as $index => $each) {
            foreach ($each as $key => $value) {
                if ($key == 'phone') {
                    $vietel[$index][$key] = "'" . $value;
                    Phones::where('phone', $value)->delete();
                }
            }
        }
    }

    /**
     * @param $mobi
     */
    public static function convertMobi($mobi) {
        //mobi
        foreach ($mobi as $index => $each) {
            foreach ($each as $key => $value) {
                if ($key == 'phone') {
                    $mobi[$index][$key] = "'" . $value;
                    Phones::where('phone', $value)->delete();
                }
            }
        }
    }

}
