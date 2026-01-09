# LetsPeppol API Swagger Documentation

This directory contains interactive Swagger/OpenAPI documentation for all three LetsPeppol API modules.

## HTML Documentation

- **[letspeppol-kyc-api.html](letspeppol-kyc-api.html)** - KYC API Documentation (Authentication & Registration)
- **[letspeppol-proxy-api.html](letspeppol-proxy-api.html)** - Proxy API Documentation (Document Transmission)
- **[letspeppol-app-api.html](letspeppol-app-api.html)** - App API Documentation (Document Management)

## How to View

### Option 1: Open Locally
Simply open any HTML file in your web browser:
- Double-click the HTML file in your file explorer
- Or right-click → Open with → Your preferred browser

### Option 2: Serve via HTTP Server
For better experience with a local server:

```bash
# Using Python
python3 -m http.server 8000

# Using Node.js
npx http-server

# Using PHP
php -S localhost:8000
```

Then navigate to `http://localhost:8000/docs/swagger/`

### Option 3: GitHub Pages
These HTML files can be hosted on GitHub Pages for online access.

## Features

- 🎨 **Beautiful UI** - Professional Redoc interface
- 📱 **Responsive** - Works on desktop, tablet, and mobile
- 🔍 **Search** - Full-text search across all endpoints
- 📋 **Code Examples** - Request/response examples in multiple languages
- 🎯 **Interactive** - Test endpoints directly from the documentation
- 📦 **Self-contained** - No external dependencies, works offline

## Regenerating Documentation

If the OpenAPI specs are updated, regenerate the documentation:

```bash
# Install redoc-cli (if not already installed)
npm install -g redoc-cli

# Generate documentation
redoc-cli bundle specs/letspeppol-kyc-openapi.yaml -o docs/swagger/letspeppol-kyc-api.html --title "LetsPeppol KYC API Documentation"
redoc-cli bundle specs/letspeppol-proxy-openapi.yaml -o docs/swagger/letspeppol-proxy-api.html --title "LetsPeppol Proxy API Documentation"
redoc-cli bundle specs/letspeppol-app-openapi.yaml -o docs/swagger/letspeppol-app-api.html --title "LetsPeppol App API Documentation"
```

## Source Specifications

The documentation is generated from the OpenAPI 3.0 specifications in the `/specs` directory:
- `specs/letspeppol-kyc-openapi.yaml`
- `specs/letspeppol-proxy-openapi.yaml`
- `specs/letspeppol-app-openapi.yaml`
