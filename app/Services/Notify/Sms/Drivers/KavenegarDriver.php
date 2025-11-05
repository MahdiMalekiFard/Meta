<?php

namespace App\Services\Notify\Sms\Drivers;

use App\Services\Notify\Contracts\SmsDriverInterface;
use Illuminate\Support\Facades\Log;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;

class KavenegarDriver implements SmsDriverInterface
{
    public KavenegarApi $kavenegar;
    
    public function __construct(private ?string $sender = null)
    {
        $this->sender = $this->sender ?: config('notify.sms.drivers.kavenegar.sender', '');
        $this->kavenegar = new KavenegarApi(config('notify.sms.drivers.kavenegar.apiKey', ''));
    }
    
    public function name(): string
    {
        return 'kavenegar';
    }
    
    /**
     * The order of the entries is exactly this:
     * [ token, token2, token3, token10, token20 ]
     */
    public function sendTemplate(string $to, string $providerTemplate, array $tokens): bool
    {
        $t1  = $tokens[0] ?? null;   // token
        $t2  = $tokens[1] ?? null;   // token2
        $t3  = $tokens[2] ?? null;   // token3
        
        $t10 = $tokens[3] ?? null;   // token10
        $t20 = $tokens[4] ?? null;   // token20
        
        try {
            $this->kavenegar->VerifyLookup($to, $t1, $t2, $t3, $providerTemplate, null, $t10, $t20);
            return true;
        } catch (ApiException $e) {
            Log::error('Kavenegar API error: ' . $e->errorMessage(), compact('to', 'providerTemplate', 'tokens'));
            return false;
        } catch (HttpException $e) {
            Log::error('Kavenegar HTTP error: ' . $e->errorMessage(), compact('to', 'providerTemplate', 'tokens'));
            return false;
        }
    }
    
    public function sendText(string $to, string $message): bool
    {
        try {
            $this->kavenegar->Send($this->sender, $to, $message);
            return true;
        } catch (ApiException $e) {
            Log::error('Kavenegar API error: ' . $e->errorMessage(), compact('to'));
            return false;
        } catch (HttpException $e) {
            Log::error('Kavenegar HTTP error: ' . $e->errorMessage(), compact('to'));
            return false;
        }
    }
}
