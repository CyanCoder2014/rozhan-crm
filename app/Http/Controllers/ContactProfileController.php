<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ClientProfileRequset;
use App\Services\UploadFileService\UploadImageService;
use App\UserProfile;
use Illuminate\Http\Request;

class ContactProfileController extends Controller
{
    protected $imageService;
    public function __construct(UploadImageService $imageService)
    {
        $this->imageService =$imageService;
    }
    public function index($contact_id)
    {
        if (isset($contact_id))
            $userProfile = UserProfile::where('contact_id',$contact_id)->first()??new UserProfile();
        else
            $userProfile = new UserProfile();
        return $this->response($userProfile);
    }

    public function update($contact_id,ClientProfileRequset $requset)
    {
        if (isset($contact_id))
            $userProfile = UserProfile::where('contact_id',$contact_id)->first();
        if (!$userProfile)
        {
            $userProfile = new UserProfile();
            $userProfile->contact_id = $contact_id;
        }
        $parameters = \request()->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();
        $userProfile->fill($requset->all());
        $userProfile->save();
        return $this->response($userProfile);
    }
}
