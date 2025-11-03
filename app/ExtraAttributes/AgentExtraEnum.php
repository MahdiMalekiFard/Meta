<?php

namespace App\ExtraAttributes;

enum AgentExtraEnum: string
{
case EMAIL = 'email';
case PHONE = 'phone';
case ADDRESS = 'address';
case WEBSITE = 'website';
case FACEBOOK = 'facebook';
case TWITTER = 'twitter';
}
