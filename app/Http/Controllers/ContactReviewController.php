<?php

namespace App\Http\Controllers;

use App\ContactReview;
use App\Http\Requests\ContactReviewRequest;
use App\Repositories\ContactReviewRepository;
use Illuminate\Http\Request;

class ContactReviewController extends Controller
{
    protected $repository;
    public function __construct(ContactReviewRepository $repository )
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contact)
    {
        return ContactReview::with('person')->where('contact_id',$contact)->paginate();
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
    public function store(ContactReviewRequest $request,$contact)
    {
        return $this->response($this->repository->add($request->all()));
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
    public function update(ContactReviewRequest $request,$contact, $id)
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
    public function destroy($id,$contact)
    {
        $contactReview = ContactReview::findOrFail($id);

        return $this->response($this->repository->delete($contactReview));
    }
}
