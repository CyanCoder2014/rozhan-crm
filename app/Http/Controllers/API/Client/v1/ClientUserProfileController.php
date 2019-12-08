<?php

namespace App\Http\Controllers\API\Client\v1;

use App\Http\Requests\Client\ClientProfileRequset;
use App\Services\UploadFileService\UploadImageService;
use App\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientUserProfileController extends Controller
{
    protected $imageService;
    public function __construct(UploadImageService $imageService)
    {
        $this->imageService =$imageService;
    }
    public function index()
    {
        if (isset(auth()->user()->contact->id))
            $userProfile = UserProfile::where('contact_id',auth()->user()->contact->id)->first()??new UserProfile();
        else
            $userProfile = new UserProfile();
        return $this->response($userProfile);
    }

    public function update(ClientProfileRequset $requset)
    {
        if (!auth()->user()->contact)
            return $this->response(null,'برای تکمیل پروفایل شما نیاز دارید تا اطلاعات تماس خود را وارد کرده باشید',403);
        if (isset(auth()->user()->contact->id))
            $userProfile = UserProfile::where('contact_id',auth()->user()->contact->id)->first();
        if (!$userProfile)
        {
            $userProfile = new UserProfile();
            $userProfile->contact_id = auth()->user()->contact->id;
        }
        $parameters = \request()->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();
        $userProfile->fill($requset->all());
        $userProfile->save();
        return $this->response($userProfile);
    }
}
