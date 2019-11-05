<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderServiceFeedbackRequest;
use App\OrderServiceFeedback;
use Illuminate\Http\Request;

class OrderServiceFeedbackController extends Controller
{
    /**
     * Display a listing of the OrderServiceFeedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created OrderServiceFeedback in storage.
     *
     * @bodyParam order_service_id ['exists:order_services,id'] required
     * @bodyParam rate ['between:0,10','integer'] required
     * @bodyParam comment ['string']
     * @param  \App\Http\Requests\OrderServiceFeedbackRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderServiceFeedbackRequest $request)
    {
        $feedback = new OrderServiceFeedback($request->all());
        $feedback->state = 0;
        $feedback->user_id = auth()->id();
        $feedback->save();
        $feedback->person->updateRate()->save();

        return $this->response($feedback);
    }

    /**
     * Display the specified OrderServiceFeedback.
     *
     * @param  \App\OrderServiceFeedback  $orderServiceFeedback
     * @return \Illuminate\Http\Response
     */
    public function show(OrderServiceFeedback $orderServiceFeedback)
    {
        //
    }


    /**
     * Update the specified OrderServiceFeedback in storage.
     *
     * @param  \App\Http\Requests\OrderServiceFeedbackRequest  $request
     * @param  \App\OrderServiceFeedback  $orderServiceFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(OrderServiceFeedbackRequest $request, OrderServiceFeedback $orderServiceFeedback)
    {
        //
    }

    /**
     * Remove the specified OrderServiceFeedback from storage.
     *
     * @param  \App\OrderServiceFeedback  $orderServiceFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderServiceFeedback $orderServiceFeedback)
    {
        //
    }
}
