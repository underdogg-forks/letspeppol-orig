<?php

namespace App\Services\LetsPeppol;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * Base API client for LetsPeppol services
 */
abstract class BaseClient
{
    protected string $baseUrl;
    protected ?string $token = null;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Set the JWT authentication token
     */
    public function setToken(string $token): static
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get the JWT authentication token
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Create a new HTTP client with configured headers
     */
    protected function http(): PendingRequest
    {
        $http = Http::baseUrl($this->baseUrl)
            ->accept('application/json')
            ->timeout(30);

        if ($this->token) {
            $http->withToken($this->token);
        }

        return $http;
    }

    /**
     * Handle API response and throw exceptions for errors
     */
    protected function handleResponse($response)
    {
        if ($response->successful()) {
            return $response->json();
        }

        throw new \RuntimeException(
            "API request failed: {$response->status()} - {$response->body()}",
            $response->status()
        );
    }
}
