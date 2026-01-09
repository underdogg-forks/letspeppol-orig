<?php

namespace App\Services\LetsPeppol;

/**
 * Proxy API Client for LetsPeppol document management
 */
class ProxyClient extends BaseClient
{
    public function __construct(?string $baseUrl = null)
    {
        parent::__construct($baseUrl ?? config('services.letspeppol.proxy_url', 'https://proxy.letspeppol.org'));
    }

    /**
     * Get all new documents
     */
    public function getAllNewDocuments(int $size = 100): array
    {
        $response = $this->http()->get('/sapi/document', ['size' => $size]);
        return $this->handleResponse($response);
    }

    /**
     * Get status updates for specific documents
     */
    public function getStatusUpdates(array $documentIds): array
    {
        $response = $this->http()->post('/sapi/document/status', $documentIds);
        return $this->handleResponse($response);
    }

    /**
     * Get document by ID
     */
    public function getDocument(string $id): array
    {
        $response = $this->http()->get("/sapi/document/{$id}");
        return $this->handleResponse($response);
    }

    /**
     * Create document to send
     */
    public function createDocument(array $documentData, bool $noArchive = false): array
    {
        $response = $this->http()->post('/sapi/document', $documentData, [
            'noArchive' => $noArchive ? 'true' : 'false'
        ]);
        return $this->handleResponse($response);
    }

    /**
     * Update document
     */
    public function updateDocument(string $id, array $documentData, bool $noArchive = false): array
    {
        $response = $this->http()->put("/sapi/document/{$id}", $documentData, [
            'noArchive' => $noArchive ? 'true' : 'false'
        ]);
        return $this->handleResponse($response);
    }

    /**
     * Reschedule document sending
     */
    public function rescheduleDocument(string $id, array $documentData): array
    {
        $response = $this->http()->put("/sapi/document/{$id}/send", $documentData);
        return $this->handleResponse($response);
    }

    /**
     * Mark document as downloaded
     */
    public function markDownloaded(string $id, bool $noArchive = false): void
    {
        $response = $this->http()->put("/sapi/document/{$id}/downloaded", [], [
            'noArchive' => $noArchive ? 'true' : 'false'
        ]);
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Failed to mark document as downloaded: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    /**
     * Mark multiple documents as downloaded
     */
    public function markDownloadedBatch(array $documentIds, bool $noArchive = false): void
    {
        $response = $this->http()->put('/sapi/document/downloaded', $documentIds, [
            'noArchive' => $noArchive ? 'true' : 'false'
        ]);
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Failed to mark documents as downloaded: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    /**
     * Cancel/delete document
     */
    public function deleteDocument(string $id, bool $noArchive = false): void
    {
        $response = $this->http()->delete("/sapi/document/{$id}", [
            'noArchive' => $noArchive ? 'true' : 'false'
        ]);
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Failed to delete document: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    /**
     * Get registry information
     */
    public function getRegistry(): array
    {
        $response = $this->http()->get('/sapi/registry');
        return $this->handleResponse($response);
    }

    /**
     * Register on Access Point
     */
    public function registerOnAccessPoint(array $registrationData): array
    {
        $response = $this->http()->post('/sapi/registry', $registrationData);
        return $this->handleResponse($response);
    }

    /**
     * Unregister from Access Point
     */
    public function unregisterFromAccessPoint(): array
    {
        $response = $this->http()->put('/sapi/registry/unregister');
        return $this->handleResponse($response);
    }

    /**
     * Remove from registry
     */
    public function deleteRegistry(): void
    {
        $response = $this->http()->delete('/sapi/registry');
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Failed to delete registry: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    /**
     * Health check
     */
    public function healthCheck(): string
    {
        $response = $this->http()->get('/api/monitor');
        
        if ($response->successful()) {
            return $response->body();
        }

        throw new \RuntimeException(
            "Health check failed: {$response->status()} - {$response->body()}",
            $response->status()
        );
    }

    /**
     * Top up balance (for testing/monitoring)
     */
    public function topUpBalance(int $amount): string
    {
        $response = $this->http()->get("/api/monitor/{$amount}");
        
        if ($response->successful()) {
            return $response->body();
        }

        throw new \RuntimeException(
            "Top up failed: {$response->status()} - {$response->body()}",
            $response->status()
        );
    }
}
