<?php


namespace App\Services\UserGiftService;


use App\Order;
use App\Product;
use App\ScoreGifts;
use App\Service;
use App\Services\UserGiftService\UserGiftRepository\UserGiftRepository;
use App\Services\UserScoreService\UserScoreService;
use App\User;
use Illuminate\Validation\ValidationException;

class UserGiftService
{
    protected $userScoreService;
    protected $repository;
    public function __construct(UserScoreService $userScoreService,UserGiftRepository $repository)
    {
        $this->userScoreService = $userScoreService;
        $this->repository = $repository;
    }

    public function setGift(ScoreGifts $gift,User $user,User $created_by)
    {
        $this->repository->add($gift->id,$user->id,$created_by->id);

    }
    public function deleteGift($user_gift_id)
    {
        $this->repository->delete($user_gift_id);

    }
    public function UserGetGift(ScoreGifts $gift,User $user)
    {
        if ($this->userScoreService->getScore($user) < $gift->score)
            throw ValidationException::withMessages(['user_score' => 'کاربر امتیاز لازم برای گرفتن هدیه را ندارد']);
        $this->setGift($gift,$user,$user);
        $this->userScoreService->addScore(-$gift->score,$gift,$user,'دریافت هدیه');

    }
    public function useGift(Order $order)
    {
        $scoreGift = $this->repository->availableUserGift($order->user_id);
        $userGifts = $scoreGift->pluck('scoreGift')->groupBy('reference_type');
//        dd($userGifts);
        if ($userGifts->count() == 0 )
            return $order;
        if (isset($userGifts[Product::class]))
            $productGifts = $order->OrderProducts()->whereIn('product_id',$userGifts[Product::class]->pluck('reference_id'))->get();
        else
            $productGifts = [];
        if (isset($userGifts[Service::class]))
            $ServiceGifts = $order->OrderServices()->whereIn('service_id',$userGifts[Service::class]->pluck('reference_id'))->get();
        else
            $ServiceGifts = [];

//        dd($userGifts[Service::class]->pluck('reference_id'),$ServiceGifts);

//            ->join('user_gifts','user_gifts.user_id','=','order_product.user_id')
//            ->whereNull('used_order_id')
//            ->join('score_gifts','user_gifts.score_gift_id','=','score_gifts.id')
//            ->where('score_gifts.refrence_type',Product::class)
        $discount= 0;
        foreach ($productGifts as $OrderProduct)
        {
            $OrderProduct->discount = $OrderProduct->price;
            $discount += $OrderProduct->price;
            $userGift = $userGifts[Product::class]->firstWhere('reference_id',$OrderProduct->product_id);
            $userScoreGift = $scoreGift->firstWhere('score_gift_id',$userGift->id);
            $userScoreGift->used_order_id = $order->id;
            $OrderProduct->save();
            $userScoreGift->save();
        }
        foreach ($ServiceGifts as $orderService)
        {
            $orderService->discount = $orderService->price;
            $discount += $orderService->price;
            $userGift = $userGifts[Service::class]->firstWhere('reference_id',$orderService->service_id);
            $userScoreGift = $scoreGift->firstWhere('score_gift_id',$userGift->id);
            $userScoreGift->used_order_id = $order->id;
            $orderService->save();
            $userScoreGift->save();
        }
        if (is_int($order->general_discount))
            $order->general_discount += $discount;
        else
            $order->general_discount = $discount;
        $order->final_price -=  $discount;
//        dd($order);
        $order->save();
        return $order;
//        if (isset($userGifts[Product::class]))
//        foreach ($order->OrderProducts as $orderProduct)
//        {
//            $
//        }
    }

}