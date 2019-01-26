<?php

namespace App\Http\Controllers\Front;

use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getFile($filename)
    {
        return response()->download(storage_path($filename), null, [], null);
    }
}
