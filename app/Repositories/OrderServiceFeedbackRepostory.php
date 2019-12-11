<?php


namespace App\Repositories;


use App\Order;
use App\OrderService;
use App\OrderServiceFeedback;
use App\User;

class OrderServiceFeedbackRepostory
{
    public function add(OrderService $orderService,User $user,int $rate,string $comment)
    {
        if ($orderService->order->user_id != $user->id)
            return $this->error('پیدا نشد',404);
        if ($orderService->order->state != Order::complete_state)
            return $this->error('سفارش شما به پایان نرسیده',400);
        if ($orderService->feedback)
            return $this->error('شما قبل از این برای این سرویس نظر ثبت کرده اید',400);
        return $this->successful(OrderServiceFeedback::create([
            'user_id' => $user->id,
            'order_service_id' => $orderService->id,
            'comment' => $comment,
            'rate' => $rate,
            'state' => OrderServiceFeedback::created_state,
            'created_by' => auth()->id(),
        ]));


    }
    public function acceptState(OrderServiceFeedback $feedback)
    {

        return $this->successful($feedback->update([
            'state' => OrderServiceFeedback::accepted_state,
            'updated_by' => auth()->id(),
        ]));


    }

    protected function error(string $message,int $status)
    {
        return compact('message','status');
    }
    protected function successful($data,string $message=null,int $status=200)
    {
        return compact('data','message','status');
    }
}