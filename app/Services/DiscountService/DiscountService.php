<?php


namespace App\Services\DiscountService;


use App\DiscountContact;
use App\Order;
use App\ProductDiscount;
use App\ServiceDiscount;

class DiscountService
{

    public function serviceDiscountService(Order $order)
    {
        if($order->OrderProducts->count() > 0)
        {
            $productDiscounts = ProductDiscount::where('product_id',$order->OrderProducts->pluck('product_id')->toArray())->get();
            $insertDiscountContact=[];
            foreach ($productDiscounts as $productDiscount)
                $insertDiscountContact[]=[
                    'contact_id' => $order->contact->id,
                    'discount_id' => $productDiscount->discount_id,
                ];
            return DiscountContact::insert($insertDiscountContact);


        }
        return [];
    }
    public function productDiscountService(Order $order)
    {
        if($order->OrderServices->count() > 0)
        {
            $serviceDiscounts = ServiceDiscount::where('service_id',$order->OrderServices->pluck('service_id')->toArray())->get();
            $insertDiscountContact=[];
            foreach ($serviceDiscounts as $serviceDiscount)
                $insertDiscountContact[]=[
                    'contact_id' => $order->contact->id,
                    'discount_id' => $serviceDiscount->discount_id,
                ];
            return DiscountContact::insert($insertDiscountContact);

        }
        return [];
    }

}