<?php


namespace App\Services\UploadFileService;





use App\Services\UploadFileService\FileCheckService\FileCheckService;
use App\Services\UploadFileService\ImageService\ImageService;
use Illuminate\Support\ServiceProvider;

class UploadFileServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerUploadFileService();
        $this->registerUploadImageService();

    }

    protected function registerUploadFileService(): void
    {
        $this->app->singleton(UploadFileService::class, function () {
            return new UploadFileService(
                $this->app->make(FileCheckService::class));
        });
    }
    protected function registerUploadImageService(): void
    {
        $this->app->singleton(UploadImageService::class, function () {
            return new UploadImageService(
                $this->app->make(FileCheckService::class),
                $this->app->make(ImageService::class));
        });
    }




    public function provides()
    {
        return [
            UploadFileService::class,
            UploadImageService::class

        ];
    }
}