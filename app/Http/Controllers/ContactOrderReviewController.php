<?php

namespace App\Http\Controllers;

use App\ContactReview;
use App\Http\Requests\ContactReviewRequest;
use App\Repositories\ContactReviewRepository;
use App\Services\UploadFileService\UploadImageService;
use Illuminate\Http\Request;

class ContactOrderReviewController extends Controller
{
    protected $repository;
    protected $imageService;

    public function __construct(ContactReviewRepository $repository ,UploadImageService $imageService)
    {
        $this->repository = $repository;
        $this->imageService =$imageService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contact,$contactOrder)
    {
        return ContactReview::with('person')->where('order_id',$contactOrder)->orderBy('id', 'desc')->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($contact,$contactOrder, ContactReviewRequest $request)
    {
        $parameters = $request->all();
        if($request->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(400,400)->getFileAddress();


        return $this->response($this->repository->add($parameters));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactReview  $contactReview
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contactReview = ContactReview::findOrFail($id);

        $contactReview->person;
        $contactReview->contact;
        return $this->response($contactReview);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactReview  $contactReview
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactReview  $contactReview
     * @return \Illuminate\Http\Response
     */
    public function update($contact,$contactOrder, $id, ContactReviewRequest $request)
    {
        $contactReview = ContactReview::findOrFail($id);

        return $this->response($this->repository->edit($request->all(),$contactReview));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactReview  $contactReview
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact,$contactOrder,$id)
    {
        $contactReview = ContactReview::findOrFail($id);

        return $this->response($contactReview->delete());
    }
}
