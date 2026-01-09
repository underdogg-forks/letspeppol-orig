<?php

namespace App\Services\LetsPeppol;

/**
 * Unified LetsPeppol API Client
 * 
 * Provides access to all LetsPeppol API modules:
 * - KYC: Authentication and registration
 * - Proxy: Document transmission and registry
 * - App: Document management and business logic
 */
class LetsPeppolClient
{
    protected KycClient $kycClient;
    protected ProxyClient $proxyClient;
    protected AppClient $appClient;

    public function __construct(
        ?string $kycUrl = null,
        ?string $proxyUrl = null,
        ?string $appUrl = null
    ) {
        $this->kycClient = new KycClient($kycUrl);
        $this->proxyClient = new ProxyClient($proxyUrl);
        $this->appClient = new AppClient($appUrl);
    }

    /**
     * Get KYC client
     */
    public function kyc(): KycClient
    {
        return $this->kycClient;
    }

    /**
     * Get Proxy client
     */
    public function proxy(): ProxyClient
    {
        return $this->proxyClient;
    }

    /**
     * Get App client
     */
    public function app(): AppClient
    {
        return $this->appClient;
    }

    /**
     * Set JWT token for all clients
     */
    public function setToken(string $token): static
    {
        $this->kycClient->setToken($token);
        $this->proxyClient->setToken($token);
        $this->appClient->setToken($token);
        return $this;
    }

    /**
     * Authenticate and set token for all clients
     */
    public function authenticate(string $email, string $password): string
    {
        $token = $this->kycClient->authenticate($email, $password);
        $this->setToken($token);
        return $token;
    }

    /**
     * Create a new instance with a specific token
     */
    public static function withToken(string $token): static
    {
        $client = new static();
        $client->setToken($token);
        return $client;
    }
}
