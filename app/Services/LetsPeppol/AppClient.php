<?php

namespace App\Services\LetsPeppol;

/**
 * App API Client for LetsPeppol application management
 */
class AppClient extends BaseClient
{
    public function __construct(?string $baseUrl = null)
    {
        parent::__construct($baseUrl ?? config('services.letspeppol.app_url', 'https://app.letspeppol.org'));
    }

    // ==================== Documents ====================

    /**
     * Validate UBL XML
     */
    public function validateDocument(string $ublXml): array
    {
        $response = $this->http()
            ->withBody($ublXml, 'text/xml')
            ->post('/sapi/document/validate');
        return $this->handleResponse($response);
    }

    /**
     * List documents with filtering and pagination
     */
    public function listDocuments(array $filters = [], int $page = 0, int $size = 20, ?string $sort = null): array
    {
        $params = array_merge($filters, [
            'page' => $page,
            'size' => $size,
        ]);

        if ($sort) {
            $params['sort'] = $sort;
        }

        $response = $this->http()->get('/sapi/document', $params);
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
     * Create document from UBL XML
     */
    public function createDocument(string $ublXml, bool $draft = false, ?string $schedule = null): array
    {
        $params = ['draft' => $draft ? 'true' : 'false'];
        if ($schedule) {
            $params['schedule'] = $schedule;
        }

        $response = $this->http()
            ->withBody($ublXml, 'text/xml')
            ->post('/sapi/document', $params);
        return $this->handleResponse($response);
    }

    /**
     * Update document
     */
    public function updateDocument(string $id, string $ublXml, bool $draft = false, ?string $schedule = null): array
    {
        $params = ['draft' => $draft ? 'true' : 'false'];
        if ($schedule) {
            $params['schedule'] = $schedule;
        }

        $response = $this->http()
            ->withBody($ublXml, 'text/xml')
            ->put("/sapi/document/{$id}", $params);
        return $this->handleResponse($response);
    }

    /**
     * Send document
     */
    public function sendDocument(string $id, ?string $schedule = null): array
    {
        $params = [];
        if ($schedule) {
            $params['schedule'] = $schedule;
        }

        $response = $this->http()->put("/sapi/document/{$id}/send", $params);
        return $this->handleResponse($response);
    }

    /**
     * Mark document as read
     */
    public function markDocumentRead(string $id): array
    {
        $response = $this->http()->put("/sapi/document/{$id}/read");
        return $this->handleResponse($response);
    }

    /**
     * Mark document as paid
     */
    public function markDocumentPaid(string $id): array
    {
        $response = $this->http()->put("/sapi/document/{$id}/paid");
        return $this->handleResponse($response);
    }

    /**
     * Delete document
     */
    public function deleteDocument(string $id): void
    {
        $response = $this->http()->delete("/sapi/document/{$id}");
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Failed to delete document: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    // ==================== Company ====================

    /**
     * Get company information
     */
    public function getCompany(): array
    {
        $response = $this->http()->get('/sapi/company');
        return $this->handleResponse($response);
    }

    /**
     * Update company information
     */
    public function updateCompany(array $companyData): array
    {
        $response = $this->http()->put('/sapi/company', $companyData);
        return $this->handleResponse($response);
    }

    // ==================== Partners ====================

    /**
     * List partners
     */
    public function listPartners(): array
    {
        $response = $this->http()->get('/sapi/partner');
        return $this->handleResponse($response);
    }

    /**
     * Search partners by Peppol ID
     */
    public function searchPartners(string $peppolId): array
    {
        $response = $this->http()->get('/sapi/partner/search', ['peppolId' => $peppolId]);
        return $this->handleResponse($response);
    }

    /**
     * Create partner
     */
    public function createPartner(array $partnerData): array
    {
        $response = $this->http()->post('/sapi/partner', $partnerData);
        return $this->handleResponse($response);
    }

    /**
     * Update partner
     */
    public function updatePartner(int $id, array $partnerData): array
    {
        $response = $this->http()->put("/sapi/partner/{$id}", $partnerData);
        return $this->handleResponse($response);
    }

    /**
     * Delete partner
     */
    public function deletePartner(int $id): void
    {
        $response = $this->http()->delete("/sapi/partner/{$id}");
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Failed to delete partner: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    // ==================== Products ====================

    /**
     * List products
     */
    public function listProducts(): array
    {
        $response = $this->http()->get('/sapi/product');
        return $this->handleResponse($response);
    }

    /**
     * Create product
     */
    public function createProduct(array $productData): array
    {
        $response = $this->http()->post('/sapi/product', $productData);
        return $this->handleResponse($response);
    }

    /**
     * Update product
     */
    public function updateProduct(int $id, array $productData): array
    {
        $response = $this->http()->put("/sapi/product/{$id}", $productData);
        return $this->handleResponse($response);
    }

    /**
     * Delete product
     */
    public function deleteProduct(int $id): void
    {
        $response = $this->http()->delete("/sapi/product/{$id}");
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Failed to delete product: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    // ==================== Product Categories ====================

    /**
     * List root categories
     */
    public function listRootCategories(bool $deep = false): array
    {
        $response = $this->http()->get('/sapi/product-category', ['deep' => $deep ? 'true' : 'false']);
        return $this->handleResponse($response);
    }

    /**
     * List all categories flat
     */
    public function listAllCategoriesFlat(): array
    {
        $response = $this->http()->get('/sapi/product-category/all');
        return $this->handleResponse($response);
    }

    /**
     * Get category by ID
     */
    public function getCategory(int $id, bool $deep = false): array
    {
        $response = $this->http()->get("/sapi/product-category/{$id}", ['deep' => $deep ? 'true' : 'false']);
        return $this->handleResponse($response);
    }

    /**
     * Create category
     */
    public function createCategory(array $categoryData): array
    {
        $response = $this->http()->post('/sapi/product-category', $categoryData);
        return $this->handleResponse($response);
    }

    /**
     * Update category
     */
    public function updateCategory(int $id, array $categoryData): array
    {
        $response = $this->http()->put("/sapi/product-category/{$id}", $categoryData);
        return $this->handleResponse($response);
    }

    /**
     * Delete category
     */
    public function deleteCategory(int $id): void
    {
        $response = $this->http()->delete("/sapi/product-category/{$id}");
        
        if (!$response->successful()) {
            throw new \RuntimeException(
                "Failed to delete category: {$response->status()} - {$response->body()}",
                $response->status()
            );
        }
    }

    // ==================== Statistics ====================

    /**
     * Get donation statistics
     */
    public function getDonationStats(): array
    {
        $response = $this->http()->get('/api/stats/donation');
        return $this->handleResponse($response);
    }

    /**
     * Get account totals
     */
    public function getAccountTotals(): array
    {
        $response = $this->http()->get('/sapi/stats/account');
        return $this->handleResponse($response);
    }

    // ==================== Peppol Directory ====================

    /**
     * Search Peppol Directory
     */
    public function searchPeppolDirectory(?string $name = null, ?string $participant = null): array
    {
        $params = array_filter([
            'name' => $name,
            'participant' => $participant,
        ]);

        $response = $this->http()->get('/api/peppol-directory', $params);
        return $this->handleResponse($response);
    }
}
