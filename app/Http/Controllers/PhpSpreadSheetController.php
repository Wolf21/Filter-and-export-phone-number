<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PhpSpreadSheetController extends Controller
{
    const VINA = [
        '8488',
        '8481',
        '8482',
        '8483',
        '8484',
        '8485',
        '8491',
        '8494',
    ];
    const VIETEL = [
        '8486',
        '8496',
        '8497',
        '8498',
        '8432',
        '8433',
        '8434',
        '8435',
        '8436',
        '8437',
        '8438',
        '8439',
    ];

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public static function filter()
    {
        set_time_limit(0);
        // read excel
        $oldFile = request()->old_file;
        if (!request()->old_file) {
            return redirect()->back()->with(['msg' => 'Please upload file first nhé anh giaiii']);
        }
        $spreadsheet = IOFactory::load(resource_path('uploads/fileUploads' . $oldFile));
        $rows = $spreadsheet->getActiveSheet()->toArray();
        //delete row not a number phone
        unset($rows[0]);
        $vinaNet = [];
        $vtNet = [];
        //filter follow network
        foreach ($rows as $index => $row) {
            $rows[$index][0] = "'" . $row[0];
            $isFilter = false;
            foreach (self::VINA as $vina) {
                if (strpos($row[0], $vina)) {
                    array_push($vinaNet, "'" . $row[0]);
                    unset($rows[$index]);
                    $isFilter = true;
                    break;
                }
            }
            if (!$isFilter) {
                foreach (self::VIETEL as $vt) {
                    if (strpos($row[0], $vt)) {
                        array_push($vtNet, "'" . $row[0]);
                        unset($rows[$index]);
                        break;
                    }
                }
            }
        }
        self::export($vinaNet, $vtNet, $rows, $oldFile);
        return redirect(route('phpSpreadSheet'))
            ->with(['msg' => 'Filter & Export Success. Result that Total is: '
                . (count($rows) + count($vinaNet) + count($vtNet)) .
                '. Vina is: '. count($vinaNet)
                . '. VT is: ' . count($vtNet)]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function count() {
        $vinaPath = resource_path('uploads/vina');
        $vtPath = resource_path('uploads/vt');
        $otherPath = resource_path('uploads/other');

        $countVina = self::countFromExcel($vinaPath);
        $countVt = self::countFromExcel($vtPath);
        $countOther = self::countFromExcel($otherPath);

        return redirect()->back()
            ->with(['msg' => 'Total Vina is: ' . $countVina
                    . '. Total Vt is: ' . $countVt
                    . '. Other is: ' . $countOther]);

    }

    /**
     * @param $path
     * @param int $count
     * @return int|string
     */
    public static function countFromExcel($path, $count = 0) {
        try {
            $dir = array_diff(scandir($path), array('.', '..'));
            foreach ($dir as $file) {
                $spreadsheet = IOFactory::load($path . '/' . $file);
                $count += $spreadsheet->getActiveSheet()->getHighestRow();
            }
            return $count;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *
     * @param $vina
     * @param $vt
     * @param $others
     * @param $oldFile
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public static function export($vina, $vt, $others, $oldFile)
    {
        $arr = [];
        self::exportExcel($vina, $oldFile);
        self::exportExcel($vt, $oldFile, 'vt');
        foreach ($others as $other) {
           array_push($arr, $other[0]);
        }
        self::exportExcel($arr, $oldFile, 'other');
    }

    /**
     *
     * @param $value
     * @param $fileName
     * @param string $type
     * @return string
     */
    public static function exportExcel($value, $fileName, $type = 'vina')
    {
        $newFileName = substr($fileName, 0, strpos($fileName, '(') +1) . count($value) . ').xlsx';
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            foreach ($value as $index => $phone) {
                $sheet->setCellValue('A' . ($index + 1), $phone);
            }
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save(resource_path('uploads/' . $type . '/' . $newFileName));
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
