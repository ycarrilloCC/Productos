<?php

namespace App\Http\Controllers;

use App\Models\Comissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Response;
use File;
use ZipArchive;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index()
    {
        return view('main.index');
    }
}
