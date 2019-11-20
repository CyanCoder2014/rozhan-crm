<?php

use Illuminate\Database\Seeder;

class PermissionSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Permission::insert([
            [
                'name' =>'companies.index',
                'display_name' =>'لیست کمپانی ها',
                'description' =>'',
            ],
            [
                'name' =>'companies.store',
                'display_name' =>'ذخیره کمپانی',
                'description' =>'',
            ],
            [
                'name' =>'companies.edit',
                'display_name' =>'ویرایش کمپانی',
                'description' =>'',
            ],
            [
                'name' =>'companies.destroy',
                'display_name' =>'حذف کمپانی',
                'description' =>'',
            ],
            [
                'name' =>'companies.show',
                'display_name' =>'نمایش کمپانی',
                'description' =>'',
            ],
            [
                'name' =>'contacts.index',
                'display_name' =>'لیست مخاطب ها',
                'description' =>'',
            ],
            [
                'name' =>'contacts.store',
                'display_name' =>'ذخیره مخاطب',
                'description' =>'',
            ],
            [
                'name' =>'contacts.edit',
                'display_name' =>'ویرایش مخاطب',
                'description' =>'',
            ],
            [
                'name' =>'contacts.destroy',
                'display_name' =>'حذف مخاطب',
                'description' =>'',
            ],
            [
                'name' =>'contacts.show',
                'display_name' =>'نمایش مخاطب',
                'description' =>'',
            ],
            [
                'name' =>'contacts.notify',
                'display_name' =>'اعلان به مخاطبین',
                'description' =>'',
            ],
            [
                'name' =>'product.categories.index',
                'display_name' =>'لیست دسته بندی محصولات ها',
                'description' =>'',
            ],
            [
                'name' =>'product.categories.store',
                'display_name' =>'ذخیره دسته بندی محصولات',
                'description' =>'',
            ],
            [
                'name' =>'product.categories.edit',
                'display_name' =>'ویرایش دسته بندی محصولات',
                'description' =>'',
            ],
            [
                'name' =>'product.categories.destroy',
                'display_name' =>'حذف دسته بندی محصولات',
                'description' =>'',
            ],
            [
                'name' =>'product.categories.show',
                'display_name' =>'نمایش دسته بندی محصولات',
                'description' =>'',
            ],
            [
                'name' =>'products.index',
                'display_name' =>'لیست محصولات',
                'description' =>'',
            ],
            [
                'name' =>'products.store',
                'display_name' =>'ذخیره محصول',
                'description' =>'',
            ],
            [
                'name' =>'products.edit',
                'display_name' =>'ویرایش محصول',
                'description' =>'',
            ],
            [
                'name' =>'products.destroy',
                'display_name' =>'حذف محصول',
                'description' =>'',
            ],
            [
                'name' =>'products.show',
                'display_name' =>'نمایش محصول',
                'description' =>'',
            ],
            [
                'name' =>'service.categories.index',
                'display_name' =>'لیست دسته بندی سرویس ها',
                'description' =>'',
            ],
            [
                'name' =>'service.categories.store',
                'display_name' =>'ذخیره دسته بندی سرویس',
                'description' =>'',
            ],
            [
                'name' =>'service.categories.edit',
                'display_name' =>'ویرایش دسته بندی سرویس',
                'description' =>'',
            ],
            [
                'name' =>'service.categories.destroy',
                'display_name' =>'حذف دسته بندی سرویس',
                'description' =>'',
            ],
            [
                'name' =>'service.categories.show',
                'display_name' =>'نمایش دسته بندی سرویس',
                'description' =>'',
            ],
            [
                'name' =>'services.index',
                'display_name' =>'لیست سرویس ها',
                'description' =>'',
            ],
            [
                'name' =>'services.store',
                'display_name' =>'ذخیره سرویس',
                'description' =>'',
            ],
            [
                'name' =>'services.edit',
                'display_name' =>'ویرایش سرویس',
                'description' =>'',
            ],
            [
                'name' =>'services.destroy',
                'display_name' =>'حذف سرویس',
                'description' =>'',
            ],
            [
                'name' =>'services.show',
                'display_name' =>'نمایش سرویس',
                'description' =>'',
            ],
            [
                'name' =>'persons.index',
                'display_name' =>'لیست پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.store',
                'display_name' =>'ذخیره پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.edit',
                'display_name' =>'ویرایش پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.destroy',
                'display_name' =>'حذف پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.show',
                'display_name' =>'نمایش پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.timing.index',
                'display_name' =>'لیست برنامه زمانی پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.timing.store',
                'display_name' =>'ذخیره برنامه زمانی پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.timing.edit',
                'display_name' =>'ویرایش برنامه زمانی پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.timing.destroy',
                'display_name' =>'حذف برنامه زمانی پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.timing.show',
                'display_name' =>'نمایش برنامه زمانی پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'workCalendar',
                'display_name' =>'برنامه کاری پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.service.index',
                'display_name' =>'لیست خدمات پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.service.store',
                'display_name' =>'ذخیره خدمات پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.service.edit',
                'display_name' =>'ویرایش خدمات پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.service.destroy',
                'display_name' =>'حذف خدمات پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'persons.service.show',
                'display_name' =>'نمایش خدمات پرسنل',
                'description' =>'',
            ],
            [
                'name' =>'orders.index',
                'display_name' =>'لیست سفارش ها',
                'description' =>'',
            ],
            [
                'name' =>'orders.store',
                'display_name' =>'ذخیره سفارش',
                'description' =>'',
            ],
            [
                'name' =>'orders.quickstore',
                'display_name' =>'ذخیره سریع سفارش',
                'description' =>'',
            ],
            [
                'name' =>'orders.edit',
                'display_name' =>'ویرایش سفارش',
                'description' =>'',
            ],
            [
                'name' =>'orders.destroy',
                'display_name' =>'حذف سفارش',
                'description' =>'',
            ],
            [
                'name' =>'orders.show',
                'display_name' =>'نمایش سفارش',
                'description' =>'',
            ],
            [
                'name' =>'company.payment.index',
                'display_name' =>'لیست مرکز هزینه',
                'description' =>'',
            ],
            [
                'name' =>'company.payment.store',
                'display_name' =>'ذخیره هزینه',
                'description' =>'',
            ],
            [
                'name' =>'company.payment.edit',
                'display_name' =>'ویرایش هزینه',
                'description' =>'',
            ],
            [
                'name' =>'company.payment.destroy',
                'display_name' =>'حذف هزینه',
                'description' =>'',
            ],
            [
                'name' =>'company.payment.show',
                'display_name' =>'نمایش هزینه',
                'description' =>'',
            ],
            [
                'name' =>'customer.payment.index',
                'display_name' =>'لیست پرداختی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'customer.payment.store',
                'display_name' =>'ذخیره پرداختی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'customer.payment.edit',
                'display_name' =>'ویرایش پرداختی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'customer.payment.destroy',
                'display_name' =>'حذف پرداختی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'customer.payment.show',
                'display_name' =>'نمایش پرداختی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'buyfactor.index',
                'display_name' =>'لیست فاکتورهای خرید',
                'description' =>'',
            ],
            [
                'name' =>'buyfactor.store',
                'display_name' =>'ذخیره فاکتور خرید',
                'description' =>'',
            ],
            [
                'name' =>'buyfactor.edit',
                'display_name' =>'ویرایش فاکتور خرید',
                'description' =>'',
            ],
            [
                'name' =>'buyfactor.destroy',
                'display_name' =>'حذف فاکتور خرید',
                'description' =>'',
            ],
            [
                'name' =>'buyfactor.show',
                'display_name' =>'نمایش فاکتور خرید',
                'description' =>'',
            ],
            [
                'name' =>'account.index',
                'display_name' =>'لیست حساب ها',
                'description' =>'',
            ],
            [
                'name' =>'account.store',
                'display_name' =>'ذخیره حساب',
                'description' =>'',
            ],
            [
                'name' =>'account.edit',
                'display_name' =>'ویرایش حساب',
                'description' =>'',
            ],
            [
                'name' =>'account.destroy',
                'display_name' =>'حذف حساب',
                'description' =>'',
            ],
            [
                'name' =>'account.show',
                'display_name' =>'نمایش حساب',
                'description' =>'',
            ],
            [
                'name' =>'discount.index',
                'display_name' =>'لیست تخفیف ها',
                'description' =>'',
            ],
            [
                'name' =>'discount.store',
                'display_name' =>'ذخیره تخفیف',
                'description' =>'',
            ],
            [
                'name' =>'discount.edit',
                'display_name' =>'ویرایش تخفیف',
                'description' =>'',
            ],
            [
                'name' =>'discount.destroy',
                'display_name' =>'حذف تخفیف',
                'description' =>'',
            ],
            [
                'name' =>'discount.show',
                'display_name' =>'نمایش تخفیف',
                'description' =>'',
            ],
            [
                'name' =>'discount.notify',
                'display_name' =>'اعلان تخفیف به مخاطبین',
                'description' =>'',
            ],
            [
                'name' =>'report',
                'display_name' =>'مجموعه گزارشات 1',
                'description' =>'',
            ],
            [
                'name' =>'baseReport',
                'display_name' =>'مجموعه گزارشات 2',
                'description' =>'',
            ],
            [
                'name' =>'UserReport',
                'display_name' =>'مجموعه گزارشات 3',
                'description' =>'',
            ],
        ]);
    }
}
