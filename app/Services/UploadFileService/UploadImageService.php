<?php


namespace App\Services\UploadFileService;


use App\Services\UploadFileService\FileCheckService\FileCheckService;
use App\Services\UploadFileService\ImageService\ImageService;

class UploadImageService extends UploadFileService
{
    static $mimetypes=[
        'jpg',
        'gif',
        'png',

    ];
    protected $uploadDir='images';

    /**
     * @var int
     *
     * code 404: file not found
     * code 405: max upload
     * code 415: mimetype is not valid
     * code 500: There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server`
     */
    protected $imageService;
    public function __construct(FileCheckService $checkService,ImageService $imageService)
    {
        $this->imageService = $imageService;
        parent::__construct($checkService);
    }
    public function resize(int $width,int $height):self {
        if (!$this->hasError())
            $this->imageService->resize($this->getFileAddress(),$width,$height);
        return $this;
    }
    public function crop(int $width, int $height, int $x=0,int $y=0):self{
        if (!$this->hasError())
            $this->imageService->crop($this->getFileAddress(), $width,  $height,  $x, $y);
        return $this;

    }
    public function waterMark($ImageAddress):self{
        if (!$this->hasError() && file_exists($ImageAddress))
            $this->imageService->waterMark($this->getFileAddress(),$ImageAddress);
        return $this;

    }

}