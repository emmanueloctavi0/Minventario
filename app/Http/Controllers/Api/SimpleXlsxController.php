<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Storage;
use App\SimpleXlsx;
use App\Article;

class SimpleXlsxController extends BaseController
{
    public function importExcel(Request $request)
    {   
        // return $this->sendResponse(getcwd().'/storage/app/excel/', 'Directorio actual');
        $doc     = $request->file('archivo');

        $docExtension = 'perfil.'.$doc->getClientOriginalExtension();

        $pathRoute = './storage/app/excel/';
        $filePath  = 'excel';
        $nameFile = 'file'. $request->user()->id . $docExtension;

        $path = Storage::putFileAs($filePath, $request->file('archivo'), $nameFile, 'public');

        $xlsx = new SimpleXLSX( './storage/app/excel/'.$nameFile);

        $i = 0;
        //Encontrar sheet 
        for ($i=1; $i < 10 && $xlsx->rows($i) == false; $i++);
        if($xlsx->rows($i) == false) {
            return $this->sendError('No hay contenido en el excel', $xlsx->rows($i), 204);
        }

        //Extraer datos del excel
        $rows = $xlsx->rows($i);

         //Eliminar excel
         Storage::delete($path);

        //Quitamos los headers del excel
        unset($rows[0]);

        $user_id = $request->user()->id;
        foreach ($rows as $value) {
            $article = new Article;    
            $article->name = $value[1];
            $article->description = $value[2];
            $article->amount = $value[3];
            $article->price = $value[4];
            $article->user_id = $user_id;
            $article->save();
        }

        return $this->sendResponse($rows,'Datos guardados exitosamente');
        
    }
}
