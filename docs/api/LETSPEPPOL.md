# LetsPeppol API Documentation and Client

This repository contains OpenAPI specifications and a PHP client for integrating with the LetsPeppol e-invoicing platform.

## Overview

LetsPeppol provides a free, open-source platform for Peppol e-invoicing with three main API modules:

1. **KYC API** - Authentication, registration, and identity verification
2. **Proxy API** - Document transmission and registry management
3. **App API** - Document management, partners, products, and business logic

## OpenAPI Specifications

The OpenAPI 3.0 specifications are available in the `storage/api-specs/` directory:

- `letspeppol-kyc-openapi.yaml` - KYC API specification
- `letspeppol-proxy-openapi.yaml` - Proxy API specification
- `letspeppol-app-openapi.yaml` - App API specification

### Importing to Postman

1. Open Postman
2. Click "Import" button
3. Select the YAML files from `storage/api-specs/`
4. The collections will be created with all endpoints and schemas

## PHP API Client

A comprehensive PHP client is provided in `app/Services/LetsPeppol/`.

### Installation

The client is already integrated into this Laravel application. No additional installation is required.

### Configuration

Add the following to your `.env` file:

```env
LETSPEPPOL_KYC_URL=https://kyc.letspeppol.org
LETSPEPPOL_PROXY_URL=https://proxy.letspeppol.org
LETSPEPPOL_APP_URL=https://app.letspeppol.org
```

### Basic Usage

#### Using the Unified Client

```php
use App\Services\LetsPeppol\LetsPeppolClient;

// Create a new client instance
$client = new LetsPeppolClient();

// Authenticate and get JWT token
$token = $client->authenticate('user@example.com', 'password123');

// The token is automatically set for all API modules
// Now you can use any API method

// Get company information
$company = $client->app()->getCompany();

// List documents
$documents = $client->app()->listDocuments([
    'type' => 'INVOICE',
    'direction' => 'INCOMING'
]);

// Get new documents from proxy
$newDocs = $client->proxy()->getAllNewDocuments();
```

#### Using Individual Clients

```php
use App\Services\LetsPeppol\KycClient;
use App\Services\LetsPeppol\ProxyClient;
use App\Services\LetsPeppol\AppClient;

// KYC Client
$kycClient = new KycClient();
$token = $kycClient->authenticate('user@example.com', 'password123');

// Proxy Client
$proxyClient = new ProxyClient();
$proxyClient->setToken($token);
$documents = $proxyClient->getAllNewDocuments();

// App Client
$appClient = new AppClient();
$appClient->setToken($token);
$company = $appClient->getCompany();
```

## API Examples

### Authentication (KYC)

```php
$client = new LetsPeppolClient();

// Authenticate
$token = $client->authenticate('user@example.com', 'password');

// Get account information
$account = $client->kyc()->getAccountInfo();
```

### Registration Flow (KYC)

```php
// Step 1: Get company information
$company = $client->kyc()->getCompany('0208:BE0123456789');

// Step 2: Confirm company and send verification email
$result = $client->kyc()->confirmCompany([
    'peppolId' => '0208:BE0123456789',
    'email' => 'admin@company.com',
    'name' => 'John Doe',
    'password' => 'securePassword123'
], 'en');

// Step 3: Verify email token
$verification = $client->kyc()->verifyToken($tokenFromEmail);

// Step 4: Prepare signing (requires Web eID)
$prepare = $client->kyc()->prepareSigning([
    'token' => $tokenFromEmail,
    'directorId' => $directorId,
    'certificate' => $base64Certificate
]);

// Step 5: Get contract PDF
$contractPdf = $client->kyc()->getContract($directorId, $tokenFromEmail);

// Step 6: Finalize signing
$result = $client->kyc()->finalizeSigning([
    'token' => $tokenFromEmail,
    'directorId' => $directorId,
    'signature' => $base64Signature
]);
```

### Document Management (App)

```php
// Validate UBL XML
$validation = $client->app()->validateDocument($ublXmlString);

// Create a document
$document = $client->app()->createDocument($ublXmlString, false);

// List documents with filters
$documents = $client->app()->listDocuments([
    'type' => 'INVOICE',
    'direction' => 'OUTGOING',
    'draft' => false
], 0, 20);

// Get specific document
$document = $client->app()->getDocument($documentId);

// Send a draft document
$sent = $client->app()->sendDocument($documentId);

// Mark as read
$client->app()->markDocumentRead($documentId);

// Mark as paid
$client->app()->markDocumentPaid($documentId);

// Delete document
$client->app()->deleteDocument($documentId);
```

### Document Transmission (Proxy)

```php
// Get new received documents
$newDocs = $client->proxy()->getAllNewDocuments(100);

// Create document to send
$document = $client->proxy()->createDocument([
    'ownerPeppolId' => '0208:BE0123456789',
    'counterPartyPeppolId' => '0208:BE0987654321',
    'ubl' => $ublXmlString,
    'direction' => 'OUTGOING',
    'documentType' => 'INVOICE'
]);

// Get status updates
$updates = $client->proxy()->getStatusUpdates([
    $docId1,
    $docId2,
    $docId3
]);

// Mark as downloaded
$client->proxy()->markDownloaded($documentId);

// Mark multiple as downloaded
$client->proxy()->markDownloadedBatch([
    $docId1,
    $docId2
]);
```

### Partner Management (App)

```php
// List partners
$partners = $client->app()->listPartners();

// Search partners
$results = $client->app()->searchPartners('0208:BE0987654321');

// Create partner
$partner = $client->app()->createPartner([
    'peppolId' => '0208:BE0987654321',
    'name' => 'Partner Company',
    'vatNumber' => 'BE0987654321',
    'email' => 'contact@partner.com'
]);

// Update partner
$updated = $client->app()->updatePartner($partnerId, [
    'name' => 'Updated Partner Name'
]);

// Delete partner
$client->app()->deletePartner($partnerId);
```

### Product Management (App)

```php
// List products
$products = $client->app()->listProducts();

// Create product
$product = $client->app()->createProduct([
    'name' => 'Product Name',
    'description' => 'Product Description',
    'price' => 99.99,
    'unit' => 'piece',
    'sku' => 'PROD-001'
]);

// Update product
$updated = $client->app()->updateProduct($productId, [
    'price' => 89.99
]);

// Delete product
$client->app()->deleteProduct($productId);
```

### Registry Management (Proxy)

```php
// Get registry information
$registry = $client->proxy()->getRegistry();

// Register on Access Point
$result = $client->proxy()->registerOnAccessPoint([
    'registrationData' => [
        // Access Point specific data
    ]
]);

// Unregister from Access Point
$result = $client->proxy()->unregisterFromAccessPoint();

// Delete registry entry
$client->proxy()->deleteRegistry();
```

### Peppol Directory (App)

```php
// Search by company name
$results = $client->app()->searchPeppolDirectory('Company Name', null);

// Search by participant ID
$results = $client->app()->searchPeppolDirectory(null, '0208:BE0123456789');
```

### Statistics (App)

```php
// Get donation statistics
$donations = $client->app()->getDonationStats();

// Get account totals
$totals = $client->app()->getAccountTotals();
```

## Error Handling

All API methods throw `\RuntimeException` on failure:

```php
try {
    $company = $client->app()->getCompany();
} catch (\RuntimeException $e) {
    $statusCode = $e->getCode();
    $message = $e->getMessage();
    
    // Handle error
    if ($statusCode === 401) {
        // Token expired or invalid
    } elseif ($statusCode === 404) {
        // Resource not found
    }
}
```

## Advanced Usage

### Custom Base URLs

```php
$client = new LetsPeppolClient(
    'https://custom-kyc.example.com',
    'https://custom-proxy.example.com',
    'https://custom-app.example.com'
);
```

### Token Management

```php
// Create client with existing token
$client = LetsPeppolClient::withToken($existingToken);

// Get current token
$token = $client->kyc()->getToken();

// Update token for all clients
$client->setToken($newToken);
```

## API Modules Reference

### KYC Client Methods

- `authenticate(email, password)` - Get JWT token
- `getCompany(peppolId)` - Get company by Peppol ID
- `confirmCompany(data, language)` - Send verification email
- `verifyToken(token)` - Verify email token
- `prepareSigning(data)` - Prepare document signing
- `getContract(directorId, token)` - Get contract PDF
- `finalizeSigning(data)` - Finalize signing
- `getAccountInfo()` - Get account information
- `searchCompanies(vatNumber, peppolId, companyName)` - Search companies
- `registerPeppol()` - Register on Peppol Directory
- `unregisterPeppol()` - Unregister from Peppol Directory
- `getSignedContract()` - Download signed contract
- `forgotPassword(email, language)` - Request password reset
- `resetPassword(token, newPassword)` - Reset password
- `changePassword(oldPassword, newPassword)` - Change password

### Proxy Client Methods

- `getAllNewDocuments(size)` - Get new documents
- `getStatusUpdates(documentIds)` - Get status updates
- `getDocument(id)` - Get document by ID
- `createDocument(documentData, noArchive)` - Create document
- `updateDocument(id, documentData, noArchive)` - Update document
- `rescheduleDocument(id, documentData)` - Reschedule sending
- `markDownloaded(id, noArchive)` - Mark as downloaded
- `markDownloadedBatch(documentIds, noArchive)` - Mark multiple as downloaded
- `deleteDocument(id, noArchive)` - Cancel document
- `getRegistry()` - Get registry info
- `registerOnAccessPoint(registrationData)` - Register on AP
- `unregisterFromAccessPoint()` - Unregister from AP
- `deleteRegistry()` - Delete registry entry
- `healthCheck()` - Health check
- `topUpBalance(amount)` - Top up balance (testing)

### App Client Methods

**Documents:**
- `validateDocument(ublXml)` - Validate UBL XML
- `listDocuments(filters, page, size, sort)` - List documents
- `getDocument(id)` - Get document
- `createDocument(ublXml, draft, schedule)` - Create document
- `updateDocument(id, ublXml, draft, schedule)` - Update document
- `sendDocument(id, schedule)` - Send document
- `markDocumentRead(id)` - Mark as read
- `markDocumentPaid(id)` - Mark as paid
- `deleteDocument(id)` - Delete document

**Company:**
- `getCompany()` - Get company info
- `updateCompany(companyData)` - Update company info

**Partners:**
- `listPartners()` - List partners
- `searchPartners(peppolId)` - Search partners
- `createPartner(partnerData)` - Create partner
- `updatePartner(id, partnerData)` - Update partner
- `deletePartner(id)` - Delete partner

**Products:**
- `listProducts()` - List products
- `createProduct(productData)` - Create product
- `updateProduct(id, productData)` - Update product
- `deleteProduct(id)` - Delete product

**Product Categories:**
- `listRootCategories(deep)` - List root categories
- `listAllCategoriesFlat()` - List all categories flat
- `getCategory(id, deep)` - Get category
- `createCategory(categoryData)` - Create category
- `updateCategory(id, categoryData)` - Update category
- `deleteCategory(id)` - Delete category

**Statistics:**
- `getDonationStats()` - Get donation stats
- `getAccountTotals()` - Get account totals

**Peppol Directory:**
- `searchPeppolDirectory(name, participant)` - Search directory

## Resources

- [LetsPeppol Official Website](https://letspeppol.org)
- [LetsPeppol GitHub Repository](https://github.com/letspeppol/letspeppol)
- [Peppol Network Information](https://peppol.org)

## License

This API client is open-source and follows the MIT license.
