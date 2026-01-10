# LetsPeppol API Overview

## Introduction

LetsPeppol is a free, open-source platform for Peppol e-invoicing. This document provides a minimal overview of the three API modules.

## API Modules

### 1. KYC API - Authentication & Registration

**Base URL:** `https://kyc.letspeppol.org`

**Key Endpoints:**
- `POST /api/jwt/auth` - Authenticate and get JWT token
- `GET /api/register/company/{peppolId}` - Get company information
- `POST /api/register/confirm-company` - Register company
- `GET /sapi/company` - Get account information

**Authentication:** Basic Auth for `/api/jwt/auth`, Bearer token for `/sapi/*` endpoints

---

### 2. Proxy API - Document Transmission

**Base URL:** `https://proxy.letspeppol.org`

**Key Endpoints:**
- `GET /sapi/document` - Get new received documents
- `POST /sapi/document` - Send document
- `PUT /sapi/document/{id}/downloaded` - Mark document as downloaded
- `GET /sapi/registry` - Get registry information

**Authentication:** Bearer token (JWT from KYC API)

---

### 3. App API - Document Management

**Base URL:** `https://app.letspeppol.org`

**Key Endpoints:**
- `GET /sapi/document` - List documents with filters
- `POST /sapi/document` - Create new document
- `PUT /sapi/document/{id}/send` - Send document
- `GET /sapi/company` - Get company information
- `GET /sapi/partner` - List partners
- `GET /sapi/product` - List products

**Authentication:** Bearer token (JWT from KYC API)

---

## Quick Start Workflow

### 1. Authenticate
```http
POST https://kyc.letspeppol.org/api/jwt/auth
Authorization: Basic base64(email:password)

Response: JWT token
```

### 2. Get Company Info
```http
GET https://app.letspeppol.org/sapi/company
Authorization: Bearer {jwt_token}
```

### 3. List Documents
```http
GET https://app.letspeppol.org/sapi/document?type=INVOICE&direction=INCOMING
Authorization: Bearer {jwt_token}
```

### 4. Send Document
```http
POST https://app.letspeppol.org/sapi/document
Authorization: Bearer {jwt_token}
Content-Type: application/xml

{UBL XML content}
```

---

## Document Types

- `INVOICE` - Standard invoice
- `CREDIT_NOTE` - Credit note

## Document Directions

- `INCOMING` - Received documents
- `OUTGOING` - Sent documents

---

## Error Handling

All APIs return standard HTTP status codes:
- `200` - Success
- `400` - Bad request
- `401` - Unauthorized (invalid or expired token)
- `404` - Resource not found
- `500` - Server error

---

## Resources

- **Full Documentation:** See [LETSPEPPOL.md](LETSPEPPOL.md) for complete API reference
- **Quick Start:** See [LETSPEPPOL-QUICKSTART.md](LETSPEPPOL-QUICKSTART.md) for examples
- **OpenAPI Specs:** See `/specs` directory for detailed specifications
- **Postman Collections:** See `/postman-collections` directory for ready-to-use collections
