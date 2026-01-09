# LetsPeppol Postman Collections

This directory contains Postman collections for all three LetsPeppol API modules.

## Collections

- **LetsPeppol-KYC-API.postman_collection.json** - Authentication & Registration API
- **LetsPeppol-Proxy-API.postman_collection.json** - Document Transmission API  
- **LetsPeppol-App-API.postman_collection.json** - Document Management API

## How to Import

1. Open Postman
2. Click "Import" button
3. Select all three JSON files from this directory
4. Collections will be created with all endpoints ready to test

## Authentication

Most endpoints require JWT authentication:

1. First, use the KYC API collection to authenticate:
   - Request: `POST /api/jwt/auth`
   - Use Basic Auth with your email and password
   - Copy the JWT token from the response

2. Set the token as a Bearer token for other requests:
   - In Postman, go to the request Authorization tab
   - Select "Bearer Token" type
   - Paste your JWT token

## Base URLs

- KYC API: `https://kyc.letspeppol.org`
- Proxy API: `https://proxy.letspeppol.org`
- App API: `https://app.letspeppol.org`

## Tips

- Create a Postman environment to store your JWT token
- Set up collection-level authorization to avoid setting auth for each request
- Use variables for common values like base URLs and document IDs
