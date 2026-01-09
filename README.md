# LetsPeppol API Documentation

> Original documentation and OpenAPI specifications for the LetsPeppol e-invoicing platform

---

## Overview

This repository contains the official OpenAPI 3.0 specifications and documentation for [LetsPeppol](https://letspeppol.org) - a free, open-source platform for Peppol e-invoicing.

**What's included:**
- OpenAPI 3.0 specifications for all three API modules (Postman-ready)
- Complete API documentation
- Postman collections for easy testing
- Minimal markdown guides for quick integration

---

## API Modules

LetsPeppol consists of three main API modules:

### 1. KYC API - Authentication & Registration
- User authentication (JWT tokens)
- Company registration with email verification
- Belgian eID identity verification
- Password management

### 2. Proxy API - Document Transmission
- Send and receive Peppol documents
- Registry management (Access Point registration)
- Document status tracking
- Health monitoring

### 3. App API - Document Management
- Document CRUD operations
- Partner and product management
- Company information management
- Peppol Directory search
- Statistics and analytics

---

## Quick Start

### 1. Import OpenAPI Specs to Postman

All API specifications are available in the `/specs` directory:
- `letspeppol-kyc-openapi.yaml` - Authentication API
- `letspeppol-proxy-openapi.yaml` - Transmission API
- `letspeppol-app-openapi.yaml` - Management API

**To import:**
1. Open Postman
2. Click "Import"
3. Select all YAML files from the `/specs` directory
4. Collections will be created with all endpoints ready to test

### 2. API Endpoints

**Base URLs:**
- KYC API: `https://kyc.letspeppol.org`
- Proxy API: `https://proxy.letspeppol.org`
- App API: `https://app.letspeppol.org`

### 3. Authentication

```http
POST https://kyc.letspeppol.org/api/jwt/auth
Authorization: Basic base64(email:password)

Response: JWT token (use as Bearer token for other endpoints)
```

---

## Documentation

### 📚 Complete Documentation
- **[API Quick Start Guide](docs/api/LETSPEPPOL-QUICKSTART.md)** - Get started in 5 minutes
- **[Complete API Reference](docs/api/LETSPEPPOL.md)** - All endpoints and examples
- **[Implementation Summary](docs/api/IMPLEMENTATION-SUMMARY.md)** - Technical overview

### 📦 OpenAPI Specifications
- **[KYC API Spec](specs/letspeppol-kyc-openapi.yaml)** - 17 endpoints for authentication
- **[Proxy API Spec](specs/letspeppol-proxy-openapi.yaml)** - 12 endpoints for transmission
- **[App API Spec](specs/letspeppol-app-openapi.yaml)** - 27 endpoints for management

### 🚀 Postman Collections
Import the OpenAPI specs directly to Postman for interactive testing.

---

## Common Use Cases

### Authentication
```http
POST /api/jwt/auth
Authorization: Basic base64(email:password)
```

### List Documents
```http
GET /sapi/document?type=INVOICE&direction=INCOMING&page=0&size=20
Authorization: Bearer {jwt_token}
```

### Send Document
```http
POST /sapi/document
Authorization: Bearer {jwt_token}
Content-Type: application/xml

{UBL XML content}
```

### Receive New Documents
```http
GET /sapi/document?size=100
Authorization: Bearer {jwt_token}
```

---

## Resources

- **Website:** [https://letspeppol.org](https://letspeppol.org)
- **GitHub:** [https://github.com/letspeppol/letspeppol](https://github.com/letspeppol/letspeppol)
- **Peppol Network:** [https://peppol.org](https://peppol.org)

---

## License

This documentation is open-sourced software licensed under the MIT license.

---

## Contributing

This repository contains the original API specifications. For issues or contributions to the LetsPeppol platform itself, please visit the [main repository](https://github.com/letspeppol/letspeppol).
