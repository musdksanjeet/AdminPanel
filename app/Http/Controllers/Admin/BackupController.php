<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Session;

class BackupController extends Controller
{
    public function index()
    {
        Session::put('page','backup');
        $title = "Backup and Export";
        return view('admin.backup')->with(compact('title'));
    }

   public function dbExport()
   {
        Artisan::call('backup:run');

        $path = storage_path('app/laravel-backup/*');
        $latest_filename = '';
        $latest_ctime = 0;

        $files = glob($path);
        
        foreach ($files as $file) {
            if (is_file($file) && filectime($file) > $latest_ctime) {
                $latest_ctime = filectime($file);
                $latest_filename = $file;
            }
        }

        // Check if a file was found
        if (!empty($latest_filename) && file_exists($latest_filename)) {
            return response()->download($latest_filename);
        } else {
            return response()->json(['message' => 'No backup file found.'], 404);
        }
   }


}
