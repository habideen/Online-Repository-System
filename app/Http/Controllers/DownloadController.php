<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(Request $request, $material_id, $file)
    {
        $isPresent = Material::select(
            'title',
            'link'
        )
            ->where('id', $material_id)
            ->where('link', $file)
            ->first();

        if (!$isPresent) {
            return redirect()->back()->with([
                'fail' => 'File does not exist'
            ]);
        }

        return Storage::download(
            'materials/' . $file,
            $isPresent->title . '.' . pathinfo($isPresent->link, PATHINFO_EXTENSION)
        );
    } //download
}
