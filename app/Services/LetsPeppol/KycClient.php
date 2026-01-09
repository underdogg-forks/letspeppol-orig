<?php

namespace App\Services\LetsPeppol;

/**
 * KYC API Client for LetsPeppol authentication and registration
 */
class KycClient extends BaseClient
{
    public function __construct(?string $baseUrl = null)
    {
        parent::__construct($baseUrl ?? config('services.letspeppol.kyc_url', 'https://kyc.letspeppol.org'));
    }

    /**
     * Authenticate and get JWT token
     * 
     * @param string $email User email
     * @param string $password User password
     * @return string JWT token
     */
    public function authenticate(string $email, string $password): string
    {
        $credentials = base64_encode("{$email}:{$password}");
        
        $response = $this->http()
            ->withHeaders(['Authorization' => "Basic {$credentials}"])
            ->post('/api/jwt/auth');

        if ($response->successful()) {
            $token = $response->body();
            $this->setToken($token);
            return $token;
        }

        throw new \RuntimeException(
            "Authentication failed: {$response->status()} - {$response->body()}",
            $response->status()
        );
    }

    /**
     * Get company information by Peppol ID (Registration step 1)
     */
    public function getCompany(string $peppolId): array
    {
        $response = $this->http()->get("/api/register/company/{$peppolId}");
        return $this->handleResponse($response);
    }

    /**
     * Confirm company and send verification email (Registration step 2)
     */
    public function confirmCompany(array $data, ?string $language = null): array
    {
        $http = $this->http();
        
        if ($language) {
            $http->withHeaders(['Accept-Language' => $language]);
        }

        $response = $http->post('/api/register/confirm-company', $data);
        return $this->handleResponse($response);
    }

    /**
     * Verify email token (Registration step 3)
     */
    public function verifyToken(string $token): array
    {
        $response = $this->http()->post('/api/register/verify', ['token' => $token]);
        return $this->handleResponse($response);
    }

    /**
     * Prepare document for signing (Registration step 4)
     */
    public function prepareSigning(array $data): array
    {
        $response = $this->http()->post('/api/identity/sign/prepare', $data);
        return $this->handleResponse($response);
    }

    /**
     * Get contract PDF (Registration step 5)
     */
    public function getContract(int $directorId, string $token): string
    {
        $response = $this->http()->get("/api/identity/contract/{$directorId}", [
            'token' => $token
        ]);

        if ($response->successful()) {
            return $response->body();
        }

        throw new \RuntimeException(
            "Failed to get contract: {$response->status()} - {$response->body()}",
            $response->status()
        );
    }

    /**
     * Finalize document signing (Registration step 6)
     */
    public function finalizeSigning(array $data): array
    {
        $response = $this->http()->post('/api/identity/sign/finalize', $data);
        
        if ($response->successful()) {
            return [
                'pdf' => $response->body(),
                'status' => $response->header('Registration-Status'),
                'provider' => $response->header('Registration-Provider'),
            ];
        }

        throw new \RuntimeException(
            "Failed to finalize signing: {$response->status()} - {$response->body()}",
            $response->status()
        );
    }

    /**
     * Get account information (requires JWT token)
     */
    public function getAccountInfo(): array
    {
        $response = $this->http()->get('/sapi/company');
        return $this->handleResponse($response);
    }

    /**
     * Search companies
     */
    public function searchCompanies(?string $vatNumber = null, ?string $peppolId = null, ?string $companyName = null): array
    {
        $params = array_filter([
            'vatNumber' => $vatNumber,
            'peppolId' => $peppolId,
            'companyName' => $companyName,
        ]);

        $response = $this->http()->get('/sapi/company/search', $params);
        return $this->handleResponse($response);
    }

    /**
     * Register on Peppol Directory
     */
    public function registerPeppol(): array
    {
        $response = $this->http()->post('/sapi/company/peppol/register');
        
        if ($response->successful()) {
            if ($response->status() === 200) {
                $newToken = $response->body();
                $this->setToken($newToken);
                return ['token' => $newToken, 'status' => 'updated'];
            }
            return ['status' => 'already_registered'];
        }

        throw new \RuntimeException(
            "Peppol registration failed: {$response->status()} - {$response->body()}",
            $response->status()
        );
    }

    /**
     * Unregister from Peppol Directory
     */
    public function unregisterPeppol(): array
    {
        $response = $this->http()->post('/sapi/company/peppol/unregister');
        
        if ($response->successful()) {
            if ($response->status() === 200) {
                $newToken = $response->body();
                $this->setToken($newToken);
                return ['token' => $newToken, 'status' => 'updated'];
            }
            return ['status' => 'already_unregistered'];
        }

        throw new \RuntimeException(
            "Peppol unregistration failed: {$response->status()} - {$response->body()}",
            $response->status()
        );
    }

    /**
     * Download signed contract
     */
    public function getSignedContract(): string
    {
        $response = $this->http()->get('/sapi/company/signed-contract');

        if ($response->successful()) {
            return $response->body();
        }

        throw new \RuntimeException(
            "Failed to get signed contract: {$response->status()} - {$response->body()}",
            $response->status()
        );
    }

    /**
     * Request password reset
     */
    public function forgotPassword(string $email, ?string $language = null): void
    {
        $http = $this->http();
        
        if ($language) {
            $http->withHeaders(['Accept-Language' => $language]);
        }

        $response = $http->post('/api/password/forgot', ['email' => $email]);
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Password reset request failed: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    /**
     * Reset password with token
     */
    public function resetPassword(string $token, string $newPassword): void
    {
        $response = $this->http()->post('/api/password/reset', [
            'token' => $token,
            'newPassword' => $newPassword,
        ]);
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Password reset failed: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    /**
     * Change password (requires authentication)
     */
    public function changePassword(string $oldPassword, string $newPassword): void
    {
        $response = $this->http()->post('/sapi/password/change', [
            'oldPassword' => $oldPassword,
            'newPassword' => $newPassword,
        ]);
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Password change failed: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }
}
