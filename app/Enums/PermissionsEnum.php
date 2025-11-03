<?php

declare(strict_types=1);

namespace App\Enums;

enum PermissionsEnum: string
{
    use EnumToArray;

    case ADMIN        = 'admin';
    
    case USER_ALL     = 'user.all';
    case USER_INDEX   = 'user.index';
    case USER_SHOW    = 'user.show';
    case USER_STORE   = 'user.store';
    case USER_UPDATE  = 'user.update';
    case USER_TOGGLE  = 'user.toggle';
    case USER_DELETE  = 'user.delete';
    case USER_RESTORE = 'user.restore';
    
    
    case CATEGORY_ALL     = 'category.all';
    case CATEGORY_INDEX   = 'category.index';
    case CATEGORY_SHOW    = 'category.show';
    case CATEGORY_STORE   = 'category.store';
    case CATEGORY_UPDATE  = 'category.update';
    case CATEGORY_TOGGLE  = 'category.toggle';
    case CATEGORY_DELETE  = 'category.delete';
    case CATEGORY_RESTORE = 'category.restore';
    
    
    case BLOG_ALL     = 'blog.all';
    case BLOG_INDEX   = 'blog.index';
    case BLOG_SHOW    = 'blog.show';
    case BLOG_STORE   = 'blog.store';
    case BLOG_UPDATE  = 'blog.update';
    case BLOG_TOGGLE  = 'blog.toggle';
    case BLOG_DELETE  = 'blog.delete';
    case BLOG_RESTORE = 'blog.restore';
    
    
    case COMMENT_ALL     = 'comment.all';
    case COMMENT_INDEX   = 'comment.index';
    case COMMENT_SHOW    = 'comment.show';
    case COMMENT_STORE   = 'comment.store';
    case COMMENT_UPDATE  = 'comment.update';
    case COMMENT_TOGGLE  = 'comment.toggle';
    case COMMENT_DELETE  = 'comment.delete';
    case COMMENT_RESTORE = 'comment.restore';
    
    
    case LIKE_ALL     = 'like.all';
    case LIKE_INDEX   = 'like.index';
    case LIKE_SHOW    = 'like.show';
    case LIKE_STORE   = 'like.store';
    case LIKE_UPDATE  = 'like.update';
    case LIKE_TOGGLE  = 'like.toggle';
    case LIKE_DELETE  = 'like.delete';
    case LIKE_RESTORE = 'like.restore';
    
    
    case OPINION_ALL     = 'opinion.all';
    case OPINION_INDEX   = 'opinion.index';
    case OPINION_SHOW    = 'opinion.show';
    case OPINION_STORE   = 'opinion.store';
    case OPINION_UPDATE  = 'opinion.update';
    case OPINION_TOGGLE  = 'opinion.toggle';
    case OPINION_DELETE  = 'opinion.delete';
    case OPINION_RESTORE = 'opinion.restore';
    
    case TICKET_ALL     = 'ticket.all';
    case TICKET_INDEX   = 'ticket.index';
    case TICKET_SHOW    = 'ticket.show';
    case TICKET_STORE   = 'ticket.store';
    case TICKET_UPDATE  = 'ticket.update';
    case TICKET_TOGGLE  = 'ticket.toggle';
    case TICKET_DELETE  = 'ticket.delete';
    case TICKET_RESTORE = 'ticket.restore';
    
    case MESSAGE_ALL     = 'message.all';
    case MESSAGE_INDEX   = 'message.index';
    case MESSAGE_SHOW    = 'message.show';
    case MESSAGE_STORE   = 'message.store';
    case MESSAGE_UPDATE  = 'message.update';
    case MESSAGE_TOGGLE  = 'message.toggle';
    case MESSAGE_DELETE  = 'message.delete';
    case MESSAGE_RESTORE = 'message.restore';
    
    case ESTATE_ALL     = 'estate.all';
    case ESTATE_INDEX   = 'estate.index';
    case ESTATE_SHOW    = 'estate.show';
    case ESTATE_STORE   = 'estate.store';
    case ESTATE_UPDATE  = 'estate.update';
    case ESTATE_TOGGLE  = 'estate.toggle';
    case ESTATE_DELETE  = 'estate.delete';
    case ESTATE_RESTORE = 'estate.restore';
    
    
    case ACTIVATION_CODE_ALL     = 'activation_code.all';
    case ACTIVATION_CODE_INDEX   = 'activation_code.index';
    case ACTIVATION_CODE_SHOW    = 'activation_code.show';
    case ACTIVATION_CODE_STORE   = 'activation_code.store';
    case ACTIVATION_CODE_UPDATE  = 'activation_code.update';
    case ACTIVATION_CODE_TOGGLE  = 'activation_code.toggle';
    case ACTIVATION_CODE_DELETE  = 'activation_code.delete';
    case ACTIVATION_CODE_RESTORE = 'activation_code.restore';
    
    case AGENT_ALL     = 'agent.all';
    case AGENT_INDEX   = 'agent.index';
    case AGENT_SHOW    = 'agent.show';
    case AGENT_STORE   = 'agent.store';
    case AGENT_UPDATE  = 'agent.update';
    case AGENT_TOGGLE  = 'agent.toggle';
    case AGENT_DELETE  = 'agent.delete';
    case AGENT_RESTORE = 'agent.restore';
    
    case AREA_ALL     = 'area.all';
    case AREA_INDEX   = 'area.index';
    case AREA_SHOW    = 'area.show';
    case AREA_STORE   = 'area.store';
    case AREA_UPDATE  = 'area.update';
    case AREA_TOGGLE  = 'area.toggle';
    case AREA_DELETE  = 'area.delete';
    case AREA_RESTORE = 'area.restore';
    
    
    case BANNER_ALL     = 'banner.all';
    case BANNER_INDEX   = 'banner.index';
    case BANNER_SHOW    = 'banner.show';
    case BANNER_STORE   = 'banner.store';
    case BANNER_UPDATE  = 'banner.update';
    case BANNER_TOGGLE  = 'banner.toggle';
    case BANNER_DELETE  = 'banner.delete';
    case BANNER_RESTORE = 'banner.restore';
    
    case CITY_ALL     = 'city.all';
    case CITY_INDEX   = 'city.index';
    case CITY_SHOW    = 'city.show';
    case CITY_STORE   = 'city.store';
    case CITY_UPDATE  = 'city.update';
    case CITY_TOGGLE  = 'city.toggle';
    case CITY_DELETE  = 'city.delete';
    case CITY_RESTORE = 'city.restore';
    
    case COUNTRY_ALL     = 'country.all';
    case COUNTRY_INDEX   = 'country.index';
    case COUNTRY_SHOW    = 'country.show';
    case COUNTRY_STORE   = 'country.store';
    case COUNTRY_UPDATE  = 'country.update';
    case COUNTRY_TOGGLE  = 'country.toggle';
    case COUNTRY_DELETE  = 'country.delete';
    case COUNTRY_RESTORE = 'country.restore';
    
    case ESTATE_TYPE_ALL     = 'estate_type.all';
    case ESTATE_TYPE_INDEX   = 'estate_type.index';
    case ESTATE_TYPE_SHOW    = 'estate_type.show';
    case ESTATE_TYPE_STORE   = 'estate_type.store';
    case ESTATE_TYPE_UPDATE  = 'estate_type.update';
    case ESTATE_TYPE_TOGGLE  = 'estate_type.toggle';
    case ESTATE_TYPE_DELETE  = 'estate_type.delete';
    case ESTATE_TYPE_RESTORE = 'estate_type.restore';
    
    
    case FAQ_ALL     = 'faq.all';
    case FAQ_INDEX   = 'faq.index';
    case FAQ_SHOW    = 'faq.show';
    case FAQ_STORE   = 'faq.store';
    case FAQ_UPDATE  = 'faq.update';
    case FAQ_TOGGLE  = 'faq.toggle';
    case FAQ_DELETE  = 'faq.delete';
    case FAQ_RESTORE = 'faq.restore';
    
    case LOCALITY_ALL     = 'locality.all';
    case LOCALITY_INDEX   = 'locality.index';
    case LOCALITY_SHOW    = 'locality.show';
    case LOCALITY_STORE   = 'locality.store';
    case LOCALITY_UPDATE  = 'locality.update';
    case LOCALITY_TOGGLE  = 'locality.toggle';
    case LOCALITY_DELETE  = 'locality.delete';
    case LOCALITY_RESTORE = 'locality.restore';
    
    case NOTICE_ALL     = 'notice.all';
    case NOTICE_INDEX   = 'notice.index';
    case NOTICE_SHOW    = 'notice.show';
    case NOTICE_STORE   = 'notice.store';
    case NOTICE_UPDATE  = 'notice.update';
    case NOTICE_TOGGLE  = 'notice.toggle';
    case NOTICE_DELETE  = 'notice.delete';
    case NOTICE_RESTORE = 'notice.restore';
    
    case PROFILE_ALL     = 'profile.all';
    case PROFILE_INDEX   = 'profile.index';
    case PROFILE_SHOW    = 'profile.show';
    case PROFILE_STORE   = 'profile.store';
    case PROFILE_UPDATE  = 'profile.update';
    case PROFILE_TOGGLE  = 'profile.toggle';
    case PROFILE_DELETE  = 'profile.delete';
    case PROFILE_RESTORE = 'profile.restore';
    
    case PROPERTY_ALL     = 'property.all';
    case PROPERTY_INDEX   = 'property.index';
    case PROPERTY_SHOW    = 'property.show';
    case PROPERTY_STORE   = 'property.store';
    case PROPERTY_UPDATE  = 'property.update';
    case PROPERTY_TOGGLE  = 'property.toggle';
    case PROPERTY_DELETE  = 'property.delete';
    case PROPERTY_RESTORE = 'property.restore';
    
    case PROVINCE_ALL     = 'province.all';
    case PROVINCE_INDEX   = 'province.index';
    case PROVINCE_SHOW    = 'province.show';
    case PROVINCE_STORE   = 'province.store';
    case PROVINCE_UPDATE  = 'province.update';
    case PROVINCE_TOGGLE  = 'province.toggle';
    case PROVINCE_DELETE  = 'province.delete';
    case PROVINCE_RESTORE = 'province.restore';
    
    
    case REPORT_ALL     = 'report.all';
    case REPORT_INDEX   = 'report.index';
    case REPORT_SHOW    = 'report.show';
    case REPORT_STORE   = 'report.store';
    case REPORT_UPDATE  = 'report.update';
    case REPORT_TOGGLE  = 'report.toggle';
    case REPORT_DELETE  = 'report.delete';
    case REPORT_RESTORE = 'report.restore';
    
    case REPORT_REASON_ALL     = 'report_reason.all';
    case REPORT_REASON_INDEX   = 'report_reason.index';
    case REPORT_REASON_SHOW    = 'report_reason.show';
    case REPORT_REASON_STORE   = 'report_reason.store';
    case REPORT_REASON_UPDATE  = 'report_reason.update';
    case REPORT_REASON_TOGGLE  = 'report_reason.toggle';
    case REPORT_REASON_DELETE  = 'report_reason.delete';
    case REPORT_REASON_RESTORE = 'report_reason.restore';
    
    
    case SERVICE_ALL     = 'service.all';
    case SERVICE_INDEX   = 'service.index';
    case SERVICE_SHOW    = 'service.show';
    case SERVICE_STORE   = 'service.store';
    case SERVICE_UPDATE  = 'service.update';
    case SERVICE_TOGGLE  = 'service.toggle';
    case SERVICE_DELETE  = 'service.delete';
    case SERVICE_RESTORE = 'service.restore';
    
    case SETTING_ALL     = 'setting.all';
    case SETTING_INDEX   = 'setting.index';
    case SETTING_SHOW    = 'setting.show';
    case SETTING_STORE   = 'setting.store';
    case SETTING_UPDATE  = 'setting.update';
    case SETTING_TOGGLE  = 'setting.toggle';
    case SETTING_DELETE  = 'setting.delete';
    case SETTING_RESTORE = 'setting.restore';
    
    case SUBSCRIPTION_ALL     = 'subscription.all';
    case SUBSCRIPTION_INDEX   = 'subscription.index';
    case SUBSCRIPTION_SHOW    = 'subscription.show';
    case SUBSCRIPTION_STORE   = 'subscription.store';
    case SUBSCRIPTION_UPDATE  = 'subscription.update';
    case SUBSCRIPTION_TOGGLE  = 'subscription.toggle';
    case SUBSCRIPTION_DELETE  = 'subscription.delete';
    case SUBSCRIPTION_RESTORE = 'subscription.restore';
    
    case TICKET_MESSAGE_ALL     = 'ticket_message.all';
    case TICKET_MESSAGE_INDEX   = 'ticket_message.index';
    case TICKET_MESSAGE_SHOW    = 'ticket_message.show';
    case TICKET_MESSAGE_STORE   = 'ticket_message.store';
    case TICKET_MESSAGE_UPDATE  = 'ticket_message.update';
    case TICKET_MESSAGE_TOGGLE  = 'ticket_message.toggle';
    case TICKET_MESSAGE_DELETE  = 'ticket_message.delete';
    case TICKET_MESSAGE_RESTORE = 'ticket_message.restore';
    
    case TRANSLATION_ALL     = 'translation.all';
    case TRANSLATION_INDEX   = 'translation.index';
    case TRANSLATION_SHOW    = 'translation.show';
    case TRANSLATION_STORE   = 'translation.store';
    case TRANSLATION_UPDATE  = 'translation.update';
    case TRANSLATION_TOGGLE  = 'translation.toggle';
    case TRANSLATION_DELETE  = 'translation.delete';
    case TRANSLATION_RESTORE = 'translation.restore';
    
    
    case USER_REQUEST_ALL     = 'user_request.all';
    case USER_REQUEST_INDEX   = 'user_request.index';
    case USER_REQUEST_SHOW    = 'user_request.show';
    case USER_REQUEST_STORE   = 'user_request.store';
    case USER_REQUEST_UPDATE  = 'user_request.update';
    case USER_REQUEST_TOGGLE  = 'user_request.toggle';
    case USER_REQUEST_DELETE  = 'user_request.delete';
    case USER_REQUEST_RESTORE = 'user_request.restore';
    
    case SERVER_ALL     = 'server.all';
    case SERVER_INDEX   = 'server.index';
    case SERVER_SHOW    = 'server.show';
    case SERVER_STORE   = 'server.store';
    case SERVER_UPDATE  = 'server.update';
    case SERVER_TOGGLE  = 'server.toggle';
    case SERVER_DELETE  = 'server.delete';
    case SERVER_RESTORE = 'server.restore';
    
    
    // custom permissions
    case RECEIVE_ORDER_SMS               = 'receive_order_sms';
    case RECEIVE_NEW_USER_REGISTERED_SMS = 'receive_new_user_registered_sms';
    case BACKEND_DEV_TOOLS               = 'backend_dev_tools';

    public function title()
    {
        return array_merge(
            $this->generateDefaultGroupTitle('user'),
            $this->generateDefaultGroupTitle('opinion'),
            [
                'RECEIVE_ORDER_SMS'               => trans('permissions.receive_order_sms'),
                'RECEIVE_NEW_USER_REGISTERED_SMS' => trans('permissions.receive_new_user_registered_sms'),
                'ADMIN'                           => trans('permissions.admin'),
            ]
        )[$this->value] ?? $this->name;
    }

    private function generateDefaultGroupTitle($TYPE): array
    {
        return [
            "{$TYPE}.all"     => trans("permissions.{$TYPE}.all"),
            "{$TYPE}.index"   => trans("permissions.{$TYPE}.index"),
            "{$TYPE}.show"    => trans("permissions.{$TYPE}.show"),
            "{$TYPE}.store"   => trans("permissions.{$TYPE}.store"),
            "{$TYPE}.update"  => trans("permissions.{$TYPE}.update"),
            "{$TYPE}.toggle"  => trans("permissions.{$TYPE}.toggle"),
            "{$TYPE}.delete"  => trans("permissions.{$TYPE}.delete"),
            "{$TYPE}.restore" => trans("permissions.{$TYPE}.restore"),
        ];
    }
}
