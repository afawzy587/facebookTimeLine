<?php

namespace App\Traits;

trait ImageUploadTrait
{

  public function uploadImage($uploadedFile, $folder = 'global'):string
  {
     $imageName = uniqid($folder.'_', true).'.'.$uploadedFile->extension();
     $path = 'uploads/'.$folder;
     $uploadedFile->move(public_path($path), $imageName);
     return $path.'/'.$imageName;
  }

}
