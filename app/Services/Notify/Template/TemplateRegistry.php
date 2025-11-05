<?php

namespace App\Services\Notify\Template;

use InvalidArgumentException;

class TemplateRegistry
{
    public function __construct(private array $config)
    {
    }
    
    public function get(string $key): array
    {
        $tpl = $this->config[$key] ?? null;
        if (!$tpl) {
            throw new InvalidArgumentException("Template '$key' not found.");
        }
        return $tpl;
    }
    
    /**
     * Validate data against tokens/fields definition
     * If mismatch → exception
     */
    public function validatePayload(string $key, array $payload): array
    {
        $tpl = $this->get($key);
        $specs = $tpl['tokens'] ?? $tpl['fields'] ?? [];
        
        foreach ($specs as $spec) {
            $name = $spec['name'];
            $required = $spec['required'] ?? false;
            $type = $spec['type'] ?? 'string';
            $max = $spec['max'] ?? null;
            
            if ($required && !array_key_exists($name, $payload)) {
                throw new InvalidArgumentException("Missing required field '$name' for template '$key'.");
            }
            
            if (array_key_exists($name, $payload)) {
                $val = $payload[$name];
                if ($type === 'email' && !filter_var($val, FILTER_VALIDATE_EMAIL)) {
                    throw new InvalidArgumentException("Field '$name' must be a valid email for template '$key'.");
                }
                if ($type === 'string' && !is_scalar($val)) {
                    throw new InvalidArgumentException("Field '$name' must be string-like for template '$key'.");
                }
                if ($max && is_scalar($val) && mb_strlen((string)$val) > $max) {
                    throw new InvalidArgumentException("Field '$name' exceeds max length $max for template '$key'.");
                }
            }
        }
        
        return $payload;
    }
    
    public function providerTemplateName(string $key, string $provider): ?string
    {
        $tpl = $this->get($key);
        return $tpl['provider_template'][$provider] ?? null;
    }
    
    public function channel(string $key): string
    {
        $tpl = $this->get($key);
        return $tpl['channel'] ?? 'sms';
    }
    
    public function mailableInfo(string $key): array
    {
        $tpl = $this->get($key);
        return [
            'mailable' => $tpl['mailable'] ?? null,
            'subject'  => $tpl['subject'] ?? null,
        ];
    }
}
