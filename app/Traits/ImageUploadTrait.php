<?php 

namespace App\Traits;

trait ImageUploadTrait
{
  public function uploadImage($image, $path, $model, $columnName)
  {
    $fullPath = public_path($path);
    
    if (!file_exists($fullPath)) {
        mkdir($fullPath, 0755, true);
    }
    
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move($fullPath, $imageName);
    
    $model->$columnName = $imageName;
    $model->save();
  }
}