<?php

namespace App\Http\Controllers\API\Client\v1;

use App\Http\Requests\Client\ClientOrderServiceFeedbackRequset;
use App\OrderService;
use App\Repositories\OrderServiceFeedbackRepostory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientOrderServiceFeedbackController extends Controller
{
    /**
     * @var OrderServiceFeedbackRepostory
     */
    protected $repostory;
    public function __construct(OrderServiceFeedbackRepostory $repostory)
    {
        $this->repostory = $repostory;
    }

    public function store(ClientOrderServiceFeedbackRequset $requset)
    {
        $orderService = OrderService::with('order')->find($requset->order_service_id);
        $response =$this->repostory->add($orderService,auth()->user(),$requset->rate,$requset->comment);
        return $this->response($response['data']??null,$response['message']??null,$response['status']??null);
    }
}
