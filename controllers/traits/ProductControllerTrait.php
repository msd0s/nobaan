<?php
namespace controllers\traits;

trait ProductControllerTrait
{
    private function getImageDetails($image)
    {
        $imageData = [
            'imageName' => $image['name'],
            'imageType' => $image['type'],
            'imageTempPath' => $image['tmp_name']
        ];
        return $imageData;
    }

    private function checkImageTypeIsValid($imageType)
    {
        if (!in_array($imageType, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'])) {
            return false;
        }
        return true;
    }

    private function saveProductImage($imageName,$imageTempPath)
    {
        $customImageName = rand(1000,9999).$imageName;
        // define route for store image
        $image_path = 'uploads/products/' . $customImageName;

        // move temp picture file to uploads folder
        move_uploaded_file($imageTempPath, $image_path);
        return $customImageName;
    }
}