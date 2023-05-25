<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Exports\CustomerExport;
use App\Exports\DistributorExport;
use App\Exports\HargaExport;
use App\Exports\SatuanExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function satuanExport()
    {
        return Excel::download(new SatuanExport, 'satuanexport.xlsx');
    }

    public function barangExport()
    {
        return Excel::download(new BarangExport, 'barangexport.xlsx');
    }

    public function hargaExport()
    {
        return Excel::download(new HargaExport, 'hargaexport.xlsx');
    }
    public function customerExport()
    {
        return Excel::download(new CustomerExport, 'customerexport.xlsx');
    }
    public function distributorExport()
    {
        return Excel::download(new DistributorExport, 'distributorexport.xlsx');
    }

 
}
