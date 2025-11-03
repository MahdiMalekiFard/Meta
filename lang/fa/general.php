<?php

declare(strict_types=1);

return [
    'show'   => 'نمایش',
    'create' => 'ایجاد',
    'edit'   => 'ویرایش',
    'delete' => 'حذف',
    'back'   => 'بازگشت',
    'submit' => 'ثبت',
    'cancel' => 'لغو',
    
    'please_select_an_option'=>'لطفا گزینه مربوطه را انتخاب کنید',
    'yes'=>'بله',
    'no'=>'خیر',
    
    'model_has_stored_successfully'    => ':model با موفقیت ثبت شد',
    'model_has_updated_successfully'   => ':model با موفقیت به روز رسانی شد',
    'model_has_deleted_successfully'   => ':model با موفقیت حذف شد',
    'model_has_toggled_successfully'   => ':model با موفقیت تغییر وضعیت یافت',
    'model_has_upload_successfully'    => ':model  با موفقیت آپلود شد',
    'model_has_Failed_to_upload'       => ':model  بارگذاری نشد',
    'model_has_retrieved_successfully' => ':model  با موفقیت بازیابی شده است',
    'model_has_Failed_to_store'        => ':model  ذخیره نشد',
    
    'store_success' => 'ثبت :model با موفقیت انجام شد',
    'store_failed'  => 'ثبت :model با خطا مواجه شد، لطفا مشکل پیش آمده را گزارش نمایید',
    
    'update_success' => 'به روز رسانی :model با موفقیت انجام شد',
    'update_failed'  => 'به روز رسانی :model با خطا مواجه شد، لطفا مشکل پیش آمده را گزارش نمایید',
    
    'delete_success' => 'حذف :model با موفقیت انجام شد',
    'delete_failed'  => 'حذف :model با خطا مواجه شد، لطفا مشکل پیش آمده را گزارش نمایید',
    'delete_can_not' => 'شما دسترسی لازم برای حذف :model را ندارید',
    
    'toggle_success' => 'تغییر وضعیت :model با موفقیت انجام شد',
    'toggle_failed'  => 'تغییر وضعیت :model با خطا مواجه شد، لطفا مشکل پیش آمده را گزارش نمایید',
    'toggle_can_not' => 'شما دسترسی لازم برای حذف :model را ندارید',
    
    'menu' => [
        'index' => ':modelان',
    ],
    
    'page' => [
        'index'  => [
            'page_title' => ':model ها',
            'title'      => 'تمام :model ها',
            'desc'       => 'تمام :modelهایی که در سامانه امکان اسفاده دارند',
            'create'     => ':model جدید',
        ],
        'create' => [
            'page_title' => 'ایجاد :model',
            'title'      => 'ثبت :model جدید',
            'desc'       => 'لطفا برای ثبت مورد جدید حتما تایید مسئول تولید محتوا را داشته باشید',
        ],
        'edit'   => [
            'page_title' => 'ویرایش :model',
            'title'      => 'به روز رسانی :model :name',
            'desc'       => 'لطفا برای ویرایش این مورد حتما تایید مسئول تولید محتوا را داشته باشید',
        ],
        'show'   => [
            'page_title' => 'جزئیات :model',
            'title'      => 'جزئیات مربوط به :model :name',
            'desc'       => 'تمام جزئیات مربوط به :model :name',
        ],
    ],
];
