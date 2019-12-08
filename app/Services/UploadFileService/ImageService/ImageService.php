<?php


namespace App\Services\UploadFileService\ImageService;


use Intervention\Image\Facades\Image;

class ImageService
{

    public function resize($address ,int $width, int $height){
        $img = Image::make($address); // public/foo.jpg
        $img->resize($width, $height);
        $img->save($address);
    }
    public function crop($address ,int $width, int $height, int $x=0,int $y=0){
        $img = Image::make($address); // public/foo.jpg
        $img->crop($width, $height,$x,$y);
        $img->save($address);
    }
    public function waterMark($address ,string $imageAddress){
        $img = Image::make($address); // public/foo.jpg
        $img->insert($imageAddress);
        $img->save($address);
    }

}