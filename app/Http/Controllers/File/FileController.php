<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function index()
    {
        $file="./download/info.pdf";
        return Response::download($file);
    }

    function getFile($filename)
    {
        // $file=Storage::disk('public')->get($filename);
  
        // return (new Response($file, 200))->header('Content-Type', 'image/jpeg');
        

              $file= public_path(). "/download/info.pdf";

              $headers = array(
                        'Content-Type: application/pdf',
                      );
          
              return Response::download($file, 'filename.pdf', $headers);
    }
}
