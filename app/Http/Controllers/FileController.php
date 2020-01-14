<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FileController extends Controller
{
    public static function split() {
        $file = resource_path('uploads/txt/vina.txt');
        $quantity = request()->quantity;
        if (!$quantity) {
            return redirect()->back()->with(['msg' => 'Please enter the quantity nhé bro']);
        }
        $path = resource_path('uploads/fileSplit');
        $dir = array_diff(scandir($path), array('.', '..'));
        if (is_dir($path)) {
            foreach ($dir as $txtFile) {
                unlink($path . '/' . $txtFile);
            }
        } else {
            mkdir($path);
        }
        $quantityFile = ceil(count(file($file))/$quantity);
        $i = 1;
        $fileRead = fopen($file,"r");
        $count = 0;
        while ($i<=$quantityFile) {
            $fileWrite = fopen($path . '/' . 'file_' . $i . '.txt',"w");
            $j = 1;
            while($j <= $quantity) {
                $value = str_replace('+84', '0', fgets($fileRead));
                fwrite($fileWrite, $value);
                $j++;
            }
            fclose($fileWrite);
            $count += count(file($path . '/' . 'file_' . $i . '.txt'));
            $i++;
        }
        fclose($fileRead);
        return redirect()->back()->with(['message' => 'Split from 1 to ' . $quantityFile . 'file success !']);
    }
}
