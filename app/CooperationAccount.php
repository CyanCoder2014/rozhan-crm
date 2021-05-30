<?php

namespace App;

use App\Payment\Account;
use App\Payment\BuyFactor;
use App\Payment\CompanyPayment;
use App\Payment\CustomerPayment;
use Illuminate\Database\Eloquent\Model;

class CooperationAccount extends Model
{
    protected $fillable = [
        'name', 'status', 'expired_at', 'created_by',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'co_account_id', 'id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'co_account_id', 'id');
    }

    public function contactGroups()
    {
        return $this->hasMany(ContactGroup::class, 'co_account_id', 'id');
    }

    public function contactReviews()
    {
        return $this->hasMany(ContactReview::class, 'co_account_id', 'id');
    }

    public function cTags()
    {
        return $this->hasMany(CTag::class, 'co_account_id', 'id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'co_account_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorites::class, 'co_account_id', 'id');
    }

    public function field()
    {
        return $this->hasMany(Field::class, 'co_account_id', 'id');
    }

    public function messageTemplates()
    {
        return $this->hasMany(MessageTemplate::class, 'co_account_id', 'id');
    }

    public function networks()
    {
        return $this->hasMany(Network::class, 'co_account_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'co_account_id', 'id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'co_account_id', 'id');
    }

    public function orderServices()
    {
        return $this->hasMany(OrderService::class, 'co_account_id', 'id');
    }

    public function orderServiceFeedbacks()
    {
        return $this->hasMany(OrderServiceFeedback::class, 'co_account_id', 'id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'co_account_id', 'id');
    }

    public function packageServices()
    {
        return $this->hasMany(PackageService::class, 'co_account_id', 'id');
    }

    public function persons()
    {
        return $this->hasMany(Person::class, 'co_account_id', 'id');
    }

    public function personServices()
    {
        return $this->hasMany(PersonService::class, 'co_account_id', 'id');
    }

    public function personTimings()
    {
        return $this->hasMany(PersonTiming::class, 'co_account_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'co_account_id', 'id');
    }

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class, 'co_account_id', 'id');
    }

    public function productDiscounts()
    {
        return $this->hasMany(ProductDiscount::class, 'co_account_id', 'id');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'co_account_id', 'id');
    }

    public function scoreGifts()
    {
        return $this->hasMany(ScoreGifts::class, 'co_account_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'co_account_id', 'id');
    }

    public function serviceCategories()
    {
        return $this->hasMany(ServiceCategory::class, 'co_account_id', 'id');
    }

    public function serviceDiscounts()
    {
        return $this->hasMany(ServiceDiscount::class, 'co_account_id', 'id');
    }

    public function specialDates()
    {
        return $this->hasMany(SpecialDate::class, 'co_account_id', 'id');
    }

    public function userGifts()
    {
        return $this->hasMany(UserGift::class, 'co_account_id', 'id');
    }

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'co_account_id', 'id');
    }

    public function userScores()
    {
        return $this->hasMany(UserScore::class, 'co_account_id', 'id');
    }

    public function vacationDates()
    {
        return $this->hasMany(VacationDate::class, 'co_account_id', 'id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'co_account_id', 'id');
    }

    public function buyFactors()
    {
        return $this->hasMany(BuyFactor::class, 'co_account_id', 'id');
    }

    public function companyPayments()
    {
        return $this->hasMany(CompanyPayment::class, 'co_account_id', 'id');
    }

    public function customerPayments()
    {
        return $this->hasMany(CustomerPayment::class, 'co_account_id', 'id');
    }
}
