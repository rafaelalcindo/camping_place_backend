<?php

namespace App\traits;

trait GlobalTratis
{
    public function moveUpload($request, $filedName, $folderName): string
    {
        if ($request->hasFile($filedName)) {
            $image = $request->file($filedName);
            $nameFile = md5(uniqid(microtime(), true)) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/' . $folderName);

            $image->move($destinationPath, $nameFile);

            return $nameFile;
        }

        return '';
    }

    public function moveUploadFileDirectly($file, $folderName)
    {
        $nameFile = md5(uniqid(microtime(), true)) . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('/storage/' . $folderName);

        $file->move($destinationPath, $nameFile);

        return $nameFile;
    }
}
