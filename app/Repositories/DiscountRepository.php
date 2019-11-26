<?php


namespace App\Repositories;


use App\Discount;
use App\DiscountContact;
use App\DiscountReference;
use App\Notifications\DiscountNotification;
use App\Product;
use App\Service;
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
        Notification::send($discount->contacts,new DiscountNotification($discount));

    }
}