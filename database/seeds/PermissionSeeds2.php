<?php

use Illuminate\Database\Seeder;

class PermissionSeeds2 extends Seeder
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
                'name' =>'specialdate.index',
                'display_name' =>'لیست مناسبت های خاص',
                'description' =>'',
            ],
            [
                'name' =>'specialdate.store',
                'display_name' =>'ذخیره مناسبت خاص',
                'description' =>'',
            ],
            [
                'name' =>'specialdate.edit',
                'display_name' =>'ویرایش مناسبت خاص',
                'description' =>'',
            ],
            [
                'name' =>'specialdate.destroy',
                'display_name' =>'حذف مناسبت خاص',
                'description' =>'',
            ],
            [
                'name' =>'specialdate.show',
                'display_name' =>'نمایش مناسبت خاص',
                'description' =>'',
            ],
            [
                'name' =>'order.completed',
                'display_name' =>'تکمیل سفارش',
                'description' =>'',
            ],
            [
                'name' =>'order.cancel',
                'display_name' =>'کنسل کردن سفارش',
                'description' =>'',
            ],
            [
                'name' =>'order.payed',
                'display_name' =>'پرداخت سفارش',
                'description' =>'',
            ],
//            [
//                'name' =>'discount.notify',
//                'display_name' =>'ا',
//                'description' =>'',
//            ],
//            [
//                'name' =>'contacts.notify',
//                'display_name' =>'اعلان به مخاطبین',
//                'description' =>'',
//            ],
            [
                'name' =>'contact.groups.index',
                'display_name' =>'لیست گروه های مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'contact.groups.store',
                'display_name' =>'ذخیره گروه مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'contact.groups.edit',
                'display_name' =>'ویرایش گروه مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'contact.groups.destroy',
                'display_name' =>'حذف گروه مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'contact.groups.show',
                'display_name' =>'نمایش گروه مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'contact.tags.index',
                'display_name' =>'لیست تگ های مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'contact.tags.store',
                'display_name' =>'ذخیره تگ مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'contact.tags.edit',
                'display_name' =>'ویرایش تگ مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'contact.tags.destroy',
                'display_name' =>'حذف تگ مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'contact.tags.show',
                'display_name' =>'نمایش تگ مشتریان',
                'description' =>'',
            ],
            [
                'name' =>'vacation.index',
                'display_name' =>'لیست روزهای تعطیل',
                'description' =>'',
            ],
            [
                'name' =>'vacation.store',
                'display_name' =>'ذخیره روز تعطیل',
                'description' =>'',
            ],
            [
                'name' =>'vacation.edit',
                'display_name' =>'ویرایش روز تعطیل',
                'description' =>'',
            ],
            [
                'name' =>'vacation.destroy',
                'display_name' =>'حذف روز تعطیل',
                'description' =>'',
            ],
            [
                'name' =>'vacation.show',
                'display_name' =>'نمایش روز تعطیل',
                'description' =>'',
            ],
            [
                'name' =>'scoregifts.index',
                'display_name' =>'لیست هدایای امتیازی',
                'description' =>'',
            ],
            [
                'name' =>'scoregifts.store',
                'display_name' =>'ذخیره هدیه امتیازی',
                'description' =>'',
            ],
            [
                'name' =>'scoregifts.edit',
                'display_name' =>'ویرایش هدیه امتیازی',
                'description' =>'',
            ],
            [
                'name' =>'scoregifts.destroy',
                'display_name' =>'حذف هدیه امتیازی',
                'description' =>'',
            ],
            [
                'name' =>'scoregifts.show',
                'display_name' =>'نمایش هدیه امتیازی',
                'description' =>'',
            ],
            [
                'name' =>'usergift.index',
                'display_name' =>'لیست هدایای کاربران',
                'description' =>'',
            ],
            [
                'name' =>'usergift.store',
                'display_name' =>'تخصیص هدیه به کاربر',
                'description' =>'',
            ],
            [
                'name' =>'usergift.destroy',
                'display_name' =>'حذف هدیه کاربر',
                'description' =>'',
            ],
            [
                'name' =>'usergift.show',
                'display_name' =>'نمایش هدیه کاربر',
                'description' =>'',
            ],
            [
                'name' =>'Report.product',
                'display_name' =>'گزارش محصولات',
                'description' =>'',
            ],
            [
                'name' =>'Report.income',
                'display_name' =>'گزارش درامد',
                'description' =>'',
            ],
            [
                'name' =>'Reminder.send',
                'display_name' =>'ایجاد یادآوری',
                'description' =>'',
            ],
            [
                'name' =>'contact.info',
                'display_name' =>'نمایش اطلاعات کاربر با شماره تلفن',
                'description' =>'',
            ],
            [
                'name' =>'discount.reminder',
                'display_name' =>'یاداور تخیف ها',
                'description' =>'',
            ],
            [
                'name' =>'contact.reviews.index',
                'display_name' =>'لیست ارزیابی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'contact.reviews.store',
                'display_name' =>'ذخیره ارزیابی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'contact.reviews.edit',
                'display_name' =>'ویرایش ارزیابی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'contact.reviews.destroy',
                'display_name' =>'حذف ارزیابی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'contact.reviews.show',
                'display_name' =>'نمایش ارزیابی مشتری',
                'description' =>'',
            ],
            [
                'name' =>'product.discount.index',
                'display_name' =>'لیست تخفیف های محصولات',
                'description' =>'',
            ],
            [
                'name' =>'product.discount.store',
                'display_name' =>'ذخیره تخفیف محصول',
                'description' =>'',
            ],
            [
                'name' =>'product.discount.edit',
                'display_name' =>'ویرایش تخفیف محصول',
                'description' =>'',
            ],
            [
                'name' =>'product.discount.destroy',
                'display_name' =>'حذف تخفیف محصول',
                'description' =>'',
            ],
            [
                'name' =>'product.discount.show',
                'display_name' =>'نمایش تخفیف محصول',
                'description' =>'',
            ],
            [
                'name' =>'service.discount.index',
                'display_name' =>'لیست تخفیف سرویس ها',
                'description' =>'',
            ],
            [
                'name' =>'service.discount.store',
                'display_name' =>'ذخیره تخفیف سرویس',
                'description' =>'',
            ],
            [
                'name' =>'service.discount.edit',
                'display_name' =>'ویرایش تخفیف سرویس',
                'description' =>'',
            ],
            [
                'name' =>'service.discount.destroy',
                'display_name' =>'حذف تخفیف سرویس',
                'description' =>'',
            ],
            [
                'name' =>'service.discount.show',
                'display_name' =>'نمایش تخفیف سرویس',
                'description' =>'',
            ]
        ]);
    }
}
