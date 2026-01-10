# LetsPeppol API Documentation Repository Guidelines

## Repository Purpose

This repository contains the **original documentation and specifications** for the LetsPeppol e-invoicing API platform. It serves as the authoritative source for:
- OpenAPI 3.0 specifications
- API documentation
- Postman collections
- Integration guides

## Project Structure

```
letspeppol-orig/
├── specs/                              # OpenAPI 3.0 YAML specifications
│   ├── letspeppol-kyc-openapi.yaml
│   ├── letspeppol-proxy-openapi.yaml
│   └── letspeppol-app-openapi.yaml
├── postman-collections/                # Postman collection JSON files
│   ├── LetsPeppol-KYC-API.postman_collection.json
│   ├── LetsPeppol-Proxy-API.postman_collection.json
│   ├── LetsPeppol-App-API.postman_collection.json
│   └── README.md
├── docs/
│   ├── api/                            # API documentation
│   │   ├── API-OVERVIEW.md             # Minimal API overview
│   │   ├── LETSPEPPOL-QUICKSTART.md   # Quick start guide
│   │   ├── LETSPEPPOL.md              # Complete API reference
│   │   └── IMPLEMENTATION-SUMMARY.md  # Implementation details
│   └── swagger/                        # Swagger/OpenAPI HTML documentation
│       ├── letspeppol-kyc-api.html
│       ├── letspeppol-proxy-api.html
│       ├── letspeppol-app-api.html
│       └── README.md
├── .junie/                             # Project guidelines
│   └── guidelines.md                   # This file
├── .github/                            # GitHub configuration
│   └── copilot-instructions.md        # Copilot workspace instructions
└── README.md                           # Main documentation entry point
```

## Documentation Standards

### OpenAPI Specifications
- **Format:** OpenAPI 3.0.3 in YAML
- **Location:** `/specs` directory
- **Naming:** `letspeppol-{module}-openapi.yaml`
- **Content:** Must include:
  - Complete endpoint definitions
  - Request/response schemas
  - Authentication requirements
  - Examples for all endpoints
  - Tags and descriptions

### Markdown Documentation
- **Format:** GitHub Flavored Markdown
- **Location:** `/docs/api` directory
- **Style:**
  - Use clear, concise language
  - Include code examples
  - Use proper heading hierarchy
  - Add links to related documentation
  - Include authentication details

### Swagger Documentation
- **Format:** HTML (Redoc-generated)
- **Location:** `/docs/swagger` directory
- **Generation:** Generated from OpenAPI specs using `redoc-cli`
- **Naming:** `letspeppol-{module}-api.html`
- **Features:**
  - Interactive API documentation
  - Beautiful, professional UI
  - Self-contained, works offline
  - Full-text search capability

### Postman Collections
- **Format:** Postman Collection v2.1 JSON
- **Location:** `/postman-collections` directory
- **Generation:** Auto-generated from OpenAPI specs using `openapi-to-postmanv2`
- **Naming:** `LetsPeppol-{Module}-API.postman_collection.json`

## Maintenance Guidelines

### Updating API Specifications

1. **Edit OpenAPI specs** in `/specs` directory
2. **Validate YAML** syntax: `yamllint specs/*.yaml`
3. **Regenerate Postman collections:**
   ```bash
   openapi2postmanv2 -s specs/letspeppol-kyc-openapi.yaml -o postman-collections/LetsPeppol-KYC-API.postman_collection.json -p
   openapi2postmanv2 -s specs/letspeppol-proxy-openapi.yaml -o postman-collections/LetsPeppol-Proxy-API.postman_collection.json -p
   openapi2postmanv2 -s specs/letspeppol-app-openapi.yaml -o postman-collections/LetsPeppol-App-API.postman_collection.json -p
   ```
4. **Regenerate Swagger documentation:**
   ```bash
   redoc-cli bundle specs/letspeppol-kyc-openapi.yaml -o docs/swagger/letspeppol-kyc-api.html --title "LetsPeppol KYC API Documentation"
   redoc-cli bundle specs/letspeppol-proxy-openapi.yaml -o docs/swagger/letspeppol-proxy-api.html --title "LetsPeppol Proxy API Documentation"
   redoc-cli bundle specs/letspeppol-app-openapi.yaml -o docs/swagger/letspeppol-app-api.html --title "LetsPeppol App API Documentation"
   ```
5. **Update documentation** in `/docs/api` if endpoints change
6. **Test with Postman** to ensure collections work correctly

### Documentation Updates

- Keep documentation **minimal and focused**
- Update `README.md` for major changes
- Keep `API-OVERVIEW.md` synchronized with specs
- Update quickstart guide for workflow changes
- Maintain links between documents

## Version Control

### What to Commit
- ✅ OpenAPI YAML specifications
- ✅ Markdown documentation
- ✅ Generated Postman collections
- ✅ README and guidelines

### What NOT to Commit
- ❌ Node modules
- ❌ Build artifacts
- ❌ IDE-specific files
- ❌ Local environment files
- ❌ Temporary test files

### Commit Message Format
```
<type>: <short description>

<detailed description if needed>

Examples:
- docs: Update API overview with new endpoints
- spec: Add validation endpoint to App API
- postman: Regenerate collections from updated specs
- chore: Update repository guidelines
```

## Quality Standards

### API Specifications
- Must be valid OpenAPI 3.0.3
- All endpoints must have descriptions
- Include request/response examples
- Document all parameters and schemas
- Specify authentication requirements

### Documentation
- Clear and concise writing
- Working code examples
- Proper formatting and structure
- Cross-references between documents
- Updated table of contents when needed

### Testing
- Test all Postman collections after regeneration
- Verify API endpoints match specifications
- Validate documentation code examples
- Check internal and external links

## Conventions

### Naming
- **Files:** Use kebab-case (e.g., `api-overview.md`)
- **Directories:** Use kebab-case (e.g., `postman-collections`)
- **OpenAPI files:** `letspeppol-{module}-openapi.yaml`
- **Postman files:** `LetsPeppol-{Module}-API.postman_collection.json`

### Formatting
- **Markdown:** Use 2-space indentation for lists
- **YAML:** Use 2-space indentation
- **JSON:** Use 2-space indentation (auto-formatted by converter)
- **Line length:** Aim for 80-120 characters

### URLs
- Always use HTTPS
- Production URLs as defaults in specs
- Document staging/test environments separately

## Tools

### Required
- `yamllint` - YAML validation
- `openapi-to-postmanv2` - Postman collection generation
- Any text editor with YAML support

### Recommended
- Postman - API testing
- VS Code with OpenAPI extensions
- Online OpenAPI validators

## Contributing

This repository contains **original specifications only**. 

For changes to the LetsPeppol platform itself, please visit:
- Main repository: https://github.com/letspeppol/letspeppol
- Website: https://letspeppol.org

## Support

For questions about the specifications or documentation:
1. Check existing documentation in `/docs/api`
2. Review OpenAPI specs in `/specs`
3. Test with Postman collections
4. Create an issue in this repository

## License

MIT License - See LICENSE file for details.
