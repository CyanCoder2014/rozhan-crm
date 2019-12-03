<?php


namespace App\Repositories;


use App\Contact;
use App\Discount;
use App\DiscountContact;
use App\DiscountOrder;
use App\DiscountReference;
use App\Notifications\TemplateNotification;
use App\Order;
use App\Product;
use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class DiscountRepository
{

    public function add($data)
    {
        $newDiscount = new Discount([
           'title'=>$data['title'],
           'quantity'=>$data['quantity'],
           'type'=>$data['type'],
           'amount'=>$data['amount'],
           'amount_type'=>$data['amount_type'],
           'code'=>$data['code'],
           'start_at'=>to_georgian_date($data['start_at']),
           'expired_at'=>to_georgian_date($data['expired_at']).' 23:59:59',
        ]);
        $newDiscountReferences =[];
        foreach ($data['services']??[] as $service)
        {
            $newDiscountReferences[]=new DiscountReference([
                'reference_id' => $service,
                'reference_type' => Service::class
            ]);
        }
        foreach ($data['products']??[] as $product)
        {

            $newDiscountReferences[]=new DiscountReference([
                'reference_id' => $product,
                'reference_type' => Product::class
            ]);
        }

        $newDiscountContacts =[];
        foreach ($data['contacts']??[] as $contact)
        {
            $newDiscountContacts[]=new DiscountContact([
                'contact_id' => $contact,
            ]);
        }
        $newDiscount->save();
        $newDiscount->discountContacts = $newDiscount->discountContacts()->saveMany($newDiscountContacts);
        $newDiscount->discountReferences = $newDiscount->discountReferences()->saveMany($newDiscountReferences);
        return ['data'=>$newDiscount,'message' =>'','status' => 200];

    }
    public function edit($data,Discount $discount)
    {
        $discount->fill([
            'title'=>$data['title'],
            'quantity'=>$data['quantity'],
            'type'=>$data['type'],
            'amount'=>$data['amount'],
            'amount_type'=>$data['amount_type'],
            'code'=>$data['code'],
            'start_at'=>to_georgian_date($data['start_at']),
            'expired_at'=>to_georgian_date($data['expired_at']).' 23:59:59',
        ]);
        $oldDiscountReferences = $discount->discountReferences;
        $newDiscountReferences =[];
        foreach ($data['services']??[] as $service)
        {
            if ($oldDiscountReferences->count() > 0)
                $discountReference = $oldDiscountReferences->shift();
            else
                $discountReference = new DiscountReference();
            $discountReference->fill([
                'reference_id' => $service,
                'reference_type' => Service::class
            ]);
            $newDiscountReferences[]=$discountReference;

        }
        foreach ($data['products']??[] as $product)
        {
            if ($oldDiscountReferences->count() > 0)
                $discountReference = $oldDiscountReferences->shift();
            else
                $discountReference = new DiscountReference();
            $discountReference->fill([
                'reference_id' => $product,
                'reference_type' => Product::class
            ]);
            $newDiscountReferences[]=$discountReference;
        }
        $oldDiscountContacts = $discount->discountContacts;
        $newDiscountContacts =[];
        foreach ($data['contacts']??[] as $contact)
        {
            if ($oldDiscountContacts->count() > 0)
                $discountContact = $oldDiscountContacts->shift();
            else
                $discountContact = new DiscountContact();
            $discountContact->fill([
                'contact_id' => $contact,
            ]);
            $newDiscountContacts[]=$discountContact;

        }
        $discount->save();
        $discount->discountContacts()->saveMany($newDiscountContacts);
        $discount->discountReferences()->saveMany($newDiscountReferences);
        DiscountContact::whereIn('id',$oldDiscountContacts->pluck('id'))->delete();
        DiscountReference::whereIn('id',$oldDiscountReferences->pluck('id'))->delete();
        return ['data'=>$discount,'message' =>'','status' => 200];

    }
    public function delete(Discount $discount)
    {
        $discount->delete();
        return ['data'=>$discount,'message' =>'','status' => 200];

    }
    public function notify(Discount $discount)
    {
        if ($discount->type = Discount::contacts_only_type)
            $contacts = $discount->contacts;
        else
            $contacts = Contact::all();
        switch ($discount->amount_type)
        {
            case Discount::percent_amount_type:
                Notification::send($contacts,new TemplateNotification('Discount',['sms','db'],$discount->amount,$discount->code,to_jalali_date($discount->expired_at)));
                break;
            case Discount::score_amount_type:
                Notification::send($contacts,new TemplateNotification('Discount',['sms','db'],$discount->amount,$discount->code,to_jalali_date($discount->expired_at)));
                break;
            case Discount::money_amount_type:
                Notification::send($contacts,new TemplateNotification('Credit',['sms','db'],$discount->amount,to_jalali_date($discount->expired_at),$discount->code));
                break;
        }


    }


    public function Apply(Discount $discount,Order $order)
    {
        switch ($discount->amount_type){
            case Discount::percent_amount_type:
                $this->ApplyPercentType($discount,$order);
                break;
            case Discount::money_amount_type:
                $this->ApplyMoneyType($discount,$order);
                break;
            case Discount::score_amount_type:
                $this->ApplyScoreType($discount,$order);
                break;
        }
        $response['data']=DiscountOrder::create([
            'discount_id' => $discount->id,
            'order_id' =>$order->id
        ]);
        return $response;



    }

    protected function ApplyPercentType(Discount $discount,Order $order)
    {
        $discountAmount = 0;
        $Dproducts = $discount->products;
        $Dservices = $discount->services;
        if ($Dproducts->count()> 0)
            $OrderProducts =$order->OrderProducts()->whereIn('product_id',$Dproducts->pluck('id'))->get();
        else
            $OrderProducts =$order->OrderProducts;
        foreach ($OrderProducts as $OrderProduct)
        {
            $OrderProduct->discount = $discount->amount*$OrderProduct->price/100;
            $discountAmount+= $OrderProduct->discount;
            $OrderProduct->save();
        }
        if ($Dservices->count()> 0)
            $OrderServices =$order->OrderServices()->whereIn('service_id',$Dservices->pluck('id'))->get();
        else
            $OrderServices =$order->OrderServices;
        foreach ($OrderServices as $OrderService)
        {
            $OrderService->discount = $discount->amount*$OrderService->price/100;
            $discountAmount+= $OrderService->discount;
            $OrderService->save();
        }
        if (ctype_digit($order->general_discount))
            $order->general_discount+=$discountAmount;
        else
             $order->general_discount=$discountAmount;
        $order->final_price-=$order->general_discount;
        $order->save();

    }

    protected function ApplyMoneyType(Discount $discount,Order $order)
    {

    }
    protected function ApplyScoreType(Discount $discount,Order $order)
    {

    }
}