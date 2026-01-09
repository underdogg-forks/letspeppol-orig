# LetsPeppol API Quick Start Guide

## Overview

LetsPeppol is a free e-invoicing platform based on the Peppol network. This guide helps you get started with the API integration.

## What's Included

- **OpenAPI Specifications** (Postman-ready) in `storage/api-specs/`
  - `letspeppol-kyc-openapi.yaml` - Authentication & Registration
  - `letspeppol-proxy-openapi.yaml` - Document Transmission
  - `letspeppol-app-openapi.yaml` - Document Management

- **PHP API Client** in `app/Services/LetsPeppol/`
  - `LetsPeppolClient` - Unified client
  - `KycClient` - Authentication API
  - `ProxyClient` - Transmission API
  - `AppClient` - Management API

## Quick Setup

### 1. Import OpenAPI Specs to Postman

1. Open Postman
2. Click "Import"
3. Select all YAML files from `storage/api-specs/`

### 2. Configure Environment Variables

Add to your `.env`:

```env
LETSPEPPOL_KYC_URL=https://kyc.letspeppol.org
LETSPEPPOL_PROXY_URL=https://proxy.letspeppol.org
LETSPEPPOL_APP_URL=https://app.letspeppol.org
```

### 3. Use the API Client

```php
use App\Services\LetsPeppol\LetsPeppolClient;

// Create client and authenticate
$client = new LetsPeppolClient();
$token = $client->authenticate('user@example.com', 'password');

// Get company info
$company = $client->app()->getCompany();

// List invoices
$invoices = $client->app()->listDocuments([
    'type' => 'INVOICE',
    'direction' => 'INCOMING'
]);

// Get new received documents
$newDocs = $client->proxy()->getAllNewDocuments();
```

## Common Use Cases

### Authentication

```php
$client = new LetsPeppolClient();
$token = $client->authenticate('email@example.com', 'password');
```

### List Documents

```php
$documents = $client->app()->listDocuments([
    'type' => 'INVOICE',        // or 'CREDIT_NOTE'
    'direction' => 'INCOMING',  // or 'OUTGOING'
    'paid' => false,
    'read' => false
], 0, 20); // page 0, size 20
```

### Create and Send Invoice

```php
// Validate UBL XML first
$validation = $client->app()->validateDocument($ublXml);

if ($validation['valid']) {
    // Create as draft
    $document = $client->app()->createDocument($ublXml, true);
    
    // Send when ready
    $sent = $client->app()->sendDocument($document['id']);
}
```

### Receive Documents

```php
// Get new documents from proxy
$newDocs = $client->proxy()->getAllNewDocuments();

foreach ($newDocs as $doc) {
    // Process document
    processDocument($doc);
    
    // Mark as downloaded
    $client->proxy()->markDownloaded($doc['id']);
}
```

### Manage Partners

```php
// Search for a partner
$partners = $client->app()->searchPartners('0208:BE0987654321');

// Add new partner
$partner = $client->app()->createPartner([
    'peppolId' => '0208:BE0987654321',
    'name' => 'Partner Company',
    'email' => 'contact@partner.com'
]);
```

## API Endpoints Overview

### KYC API (Authentication)
- POST `/api/jwt/auth` - Authenticate
- GET `/api/register/company/{peppolId}` - Get company
- POST `/api/register/confirm-company` - Register
- GET `/sapi/company` - Get account info

### Proxy API (Transmission)
- GET `/sapi/document` - Get new documents
- POST `/sapi/document` - Create document
- GET `/sapi/document/{id}` - Get document
- PUT `/sapi/document/{id}/downloaded` - Mark downloaded
- GET `/sapi/registry` - Get registry info

### App API (Management)
- GET `/sapi/document` - List documents
- POST `/sapi/document` - Create document
- PUT `/sapi/document/{id}/send` - Send document
- GET `/sapi/company` - Get company
- GET `/sapi/partner` - List partners
- GET `/sapi/product` - List products

## Error Handling

```php
try {
    $company = $client->app()->getCompany();
} catch (\RuntimeException $e) {
    $statusCode = $e->getCode();
    $message = $e->getMessage();
    
    if ($statusCode === 401) {
        // Token expired - re-authenticate
    } elseif ($statusCode === 404) {
        // Resource not found
    }
}
```

## Full Documentation

See `docs/api/LETSPEPPOL.md` for complete documentation with all methods and examples.

## Resources

- [LetsPeppol.org](https://letspeppol.org)
- [GitHub Repository](https://github.com/letspeppol/letspeppol)
- OpenAPI Specs: `storage/api-specs/`
