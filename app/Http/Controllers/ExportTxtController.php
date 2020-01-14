<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportTxtController extends Controller
{
    public static function txt()
    {
        return view('export-txt');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public static function exportTXT()
    {
        set_time_limit(0);
        // read excel
        $oldFile = request()->old_file;
        if (!request()->old_file) {
            return redirect()->back()->with(['msg' => 'Please upload file first nhé anh giaiii']);
        }
        $spreadsheet = IOFactory::load(resource_path('uploads/fileUploads/' . $oldFile));
        $rows = $spreadsheet->getActiveSheet()->toArray();
        //delete row not a number phone
        unset($rows[0]);
        $vinaFile = resource_path('uploads/txt/') . 'vina.txt';
        $vtFile = resource_path('uploads/txt/') . 'vt.txt';
        $otherFile = resource_path('uploads/txt/') . 'other.txt';
        foreach ($rows as $index => $row) {
            $isFilter = false;
            foreach (PhpSpreadSheetController::VINA as $vina) {
                if (strpos($row[0], $vina)) {
                    file_put_contents(
                        $vinaFile,
                        $row[0] . "\n",
                        FILE_APPEND | LOCK_EX
                    );
                    unset($rows[$index]);
                    $isFilter = true;
                    break;
                }
            }
            if (!$isFilter) {
                foreach (PhpSpreadSheetController::VIETEL as $vt) {
                    if (strpos($row[0], $vt)) {
                        file_put_contents(
                            $vtFile,
                            $row[0] . "\n",
                            FILE_APPEND | LOCK_EX
                        );
                        unset($rows[$index]);
                        break;
                    }
                }
            }
        }
        foreach ($rows as $row) {
            file_put_contents(
                $otherFile,
                $row[0] . "\n",
                FILE_APPEND | LOCK_EX
            );
        }
        return redirect(route('txt'))
            ->with(['msg' => "Filter & Export Success.\r\n Result that other is: " . count(file($otherFile))
                . "\r\n Vina is: ". count(file($vinaFile))
                . "\r\n VT is: " . count(file($vtFile)),
                'file' => 'Just file upload is: ' . $oldFile
            ]);
    }
}
