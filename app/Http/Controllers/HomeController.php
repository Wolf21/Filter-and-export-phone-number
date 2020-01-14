<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class HomeController extends Controller
{
    public static function index()
    {
//        phpinfo();
        return view('index');
    }

    public static function laravelExcel()
    {
        return view('convert');
    }

    public static function phpSpreadSheet()
    {
        return view('phpSpreadSheet');
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function upload(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        Storage::disk('uploads')->put($fileName, File::get($file));
        return redirect()->back()->with(['msg' => 'Upload "' . $fileName .  '" success', 'fileName' => $fileName]);
    }

    public static function printFileUploads() {
        $path = resource_path('uploads/fileUploads');
        $dir = array_diff(scandir($path), array('.', '..'));
        foreach ($dir as $file) {
            file_put_contents(
                resource_path('uploads/file.txt'),
                $file . "\n",
                FILE_APPEND | LOCK_EX
            );
        }
        return redirect()->back()->with(['msg' => 'Print Success']);
    }
}
