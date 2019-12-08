<?php


namespace App\Services\UploadFileService;


use App\Services\UploadFileService\FileCheckService\FileCheckService;

class UploadFileService
{


    static $mimetypes=[
        'jpg',
        'gif',
        'png',
        'zip',
        'txt',
        'xls',
        'doc'
    ];
    static $setting=[
        'upload_max_filesize' => '21000000', // bytes

    ];
    /**
     * @var string
     */
    protected $BaseDir='../../../';
    protected $uploadDir='files';

    /**
     * @var FileCheckService
     */
    protected $checkService;
    /**
     * @var string
     */
    protected $FileAddress;
    /**
     * @var string
     */
    protected $errorMessage;
    /**
     * @var int
     *
     * code 404: file not found
     * code 405: max upload
     * code 415: mimetype is not valid
     * code 500: There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server`
     */
    protected $errorCode;
    public function __construct(FileCheckService $checkService)
    {
        $this->checkService = $checkService;
        $this->BaseDir = public_path();

    }
    
    public function upload($filename,string $uploadDir=null,array $mimeTypes=null,array $setting=null): UploadFileService{
        if (!isset($_FILES[$filename]))
        {
            $this->setErrorCode(404);
            $this->setErrorMessage('file not found');
            return $this;
        }
        if ($mimeTypes== null)
            $mimeTypes = static::$mimetypes;
        if ($uploadDir== null)
            $uploadDir = $this->uploadDir;
        if ($setting== null)
            $setting = static::$setting;
        else
            $setting = array_merge(static::$setting,$setting);
        $fileTmpPath = $_FILES[$filename]['tmp_name'];
        $fileName = $_FILES[$filename]['name'];
        $fileSize = $_FILES[$filename]['size'];
        $fileType = $_FILES[$filename]['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        if ($setting['upload_max_filesize'] < $fileSize) {
            $this->setErrorCode(405);
            $this->setErrorMessage('max upload size');
            return $this;
        }
        if (!in_array($fileExtension, $mimeTypes)) {
            $this->setErrorCode(415);
            $this->setErrorMessage('mimetype is not valid');
            return $this;
        }
        if (!is_dir($this->BaseDir.'/' .$uploadDir)) {
//            dd($this->BaseDir .$uploadDir);
            // dir doesn't exist, make it
            mkdir($this->BaseDir.'/' .$uploadDir );
        }
        $dest_path = $this->BaseDir .'/'.$uploadDir.'/' . $newFileName;

        if(move_uploaded_file($fileTmpPath, $dest_path)){
            $this->FileAddress = $uploadDir . '/' . $newFileName;
            return $this;
        }
        else
        {
            $this->setErrorCode(500);
            $this->setErrorMessage('There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server');
            return $this;
        }
    }

    /**
     * @param string $errorMessage
     */
    protected function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @param int $errorCode
     */
    protected function setErrorCode(int $errorCode): void
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }
    /**
     * @return bool
     */
    public function hasError(): bool
    {
        if (isset($this->errorCode))
            return true;
        return false;
    }

    /**
     * @return string
     */
    public function getBaseDir(): string
    {
        return $this->BaseDir;
    }

    /**
     * @param string $BaseDir
     */
    public function setBaseDir(string $BaseDir): void
    {
        $this->BaseDir = $BaseDir;
    }

    /**
     * @return string
     */
    public function getFileAddress(): string
    {
        return $this->FileAddress;
    }

}