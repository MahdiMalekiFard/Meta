<?php

namespace App\Providers;

use App\Services\Notify\Contracts\EmailDriverInterface;
use App\Services\Notify\Contracts\SmsDriverInterface;
use App\Services\Notify\Notifier;
use App\Services\Notify\Template\TemplateRegistry;
use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TemplateRegistry::class, function () {
            return new TemplateRegistry(config('notify_templates'));
        });
        
        // SMS driver bind
        $this->app->bind(SmsDriverInterface::class, function () {
            $cfg = config('notify.sms');
            $default = $cfg['default'];
            $driver = $cfg['drivers'][$default] ?? null;
            if (!$driver) {
                throw new \RuntimeException("SMS driver '$default' not configured.");
            }
            return app($driver['class']);
        });
        
        // Email driver bind
        $this->app->bind(EmailDriverInterface::class, function () {
            $cfg = config('notify.email');
            $default = $cfg['default'];
            $driver = $cfg['drivers'][$default] ?? null;
            if (!$driver) {
                throw new \RuntimeException("Email driver '$default' not configured.");
            }
            return app($driver['class']);
        });
        
        $this->app->singleton(Notifier::class);
    }
    
    public function boot(): void
    {
        //
    }
}
