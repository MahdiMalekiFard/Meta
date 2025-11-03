<?php

namespace App\Pipelines\Order;

use App\Repositories\Server\ServerRepositoryInterface;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class GenerateServer implements OrderContract
{
    public function __construct(private readonly ServerRepositoryInterface $serverRepository)
    {
    }
    
    /**
     * @throws Throwable
     */
    public function handle(OrderDTO $DTO, Closure $next)
    {
        $order = $DTO->getOrder();
        $domainName = $DTO->getFromPayload('domain_name');
        throw_if(is_null($domainName), BadRequestException::class, 'domain_name is required');

//        if (config('app.env') == 'local') {
        $http = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post(config('config.DEV_OPS_URL') . '/project', [
            'customer_name'        => $domainName,
            'domain_name'          => $domainName . '.weton.biz',
            'project_description'  => $domainName,
            "brand_pusher_key"     => "anything",
            "brand_pusher_cluster" => "ap2",
            "brand_name"           => "Weton",
            "brand_name_english"   => "Weton",
            "default_language"     => "fa",
        ]);
        
        if ($http->json()['success'] !== 'true') {
            abort(Response::HTTP_BAD_REQUEST, 'این دامنه از قبل ثبت شده');
        }
//        }
        
        $bigMonth = $DTO->getPurchasedServices()->max('month');
        $this->serverRepository->store([
            'user_id'                => $DTO->getUser()->id,
            'order_id'               => $order->id,
            'website_url'            => null,
            'domain_name'            => $domainName,
            'ip_address'             => null,
            'has_ssl'                => true,
            'has_backup'             => true,
            'backup_frequency'       => 7 * 24, //1 week
            'has_application'        => false,
            'has_website'            => false,
            'source_code_updated_at' => now(),
            'application_updated_at' => null,
            'database_password'      => null,
            'ssh_password'           => null,
            'expired_at'             => now()->addMonths($bigMonth),
        ]);
        return $next($DTO);
    }
}