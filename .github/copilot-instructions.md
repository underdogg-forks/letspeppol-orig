# GitHub Copilot Workspace Instructions

## Repository Context

This repository contains the **original API documentation and specifications** for LetsPeppol, an open-source Peppol e-invoicing platform. This is a documentation-focused repository, not a code implementation.

## Purpose

- Maintain OpenAPI 3.0 specifications for three LetsPeppol API modules
- Provide comprehensive API documentation
- Generate and maintain Postman collections
- Serve as the authoritative reference for API integration

## Key Files and Directories

### `/specs` - OpenAPI Specifications
- `letspeppol-kyc-openapi.yaml` - Authentication & Registration API (17 endpoints)
- `letspeppol-proxy-openapi.yaml` - Document Transmission API (12 endpoints)
- `letspeppol-app-openapi.yaml` - Document Management API (27 endpoints)

### `/docs/api` - Documentation
- `API-OVERVIEW.md` - Minimal API overview
- `LETSPEPPOL-QUICKSTART.md` - Quick start guide with examples
- `LETSPEPPOL.md` - Complete API reference
- `IMPLEMENTATION-SUMMARY.md` - Technical implementation details

### `/postman-collections` - Postman Collections
- Auto-generated from OpenAPI specs
- Three collections (KYC, Proxy, App)
- Import-ready for Postman testing

## Conventions

### OpenAPI Specifications
- **Format:** OpenAPI 3.0.3 in YAML
- **Style:** 2-space indentation
- **Required fields:** All endpoints must have:
  - Summary and description
  - Request/response schemas
  - Authentication requirements
  - Examples

### Documentation
- **Format:** GitHub Flavored Markdown
- **Style:** Clear, concise, professional
- **Code examples:** Always include authentication details
- **Links:** Use relative paths between documents

### File Naming
- OpenAPI specs: `letspeppol-{module}-openapi.yaml`
- Documentation: `UPPERCASE-WITH-DASHES.md` for main docs
- Postman: `LetsPeppol-{Module}-API.postman_collection.json`

## Workflow for Updates

### Updating API Specifications

1. Edit YAML files in `/specs`
2. Validate syntax with `yamllint`
3. Regenerate Postman collections:
   ```bash
   openapi2postmanv2 -s specs/letspeppol-kyc-openapi.yaml -o postman-collections/LetsPeppol-KYC-API.postman_collection.json -p
   openapi2postmanv2 -s specs/letspeppol-proxy-openapi.yaml -o postman-collections/LetsPeppol-Proxy-API.postman_collection.json -p
   openapi2postmanv2 -s specs/letspeppol-app-openapi.yaml -o postman-collections/LetsPeppol-App-API.postman_collection.json -p
   ```
4. Update relevant documentation in `/docs/api`
5. Test collections in Postman

### Updating Documentation

- Keep **minimal and focused** - this is reference documentation
- Synchronize with OpenAPI specs
- Include working code examples
- Update cross-references when adding new docs
- Maintain consistency across all documents

## API Module Overview

### KYC API (Authentication)
- Base URL: `https://kyc.letspeppol.org`
- Purpose: User authentication, registration, identity verification
- Auth: Basic Auth → JWT token

### Proxy API (Transmission)
- Base URL: `https://proxy.letspeppol.org`
- Purpose: Send/receive Peppol documents, registry management
- Auth: Bearer token (JWT)

### App API (Management)
- Base URL: `https://app.letspeppol.org`
- Purpose: Document CRUD, partners, products, company info
- Auth: Bearer token (JWT)

## Code Assistance Guidelines

### When Editing OpenAPI Specs
- Maintain consistent schema definitions
- Use `$ref` for reusable components
- Include realistic examples
- Document all parameters and responses
- Follow OpenAPI 3.0.3 specification

### When Writing Documentation
- Start with authentication flow
- Show complete HTTP requests/responses
- Include error handling
- Reference related endpoints
- Link to OpenAPI specs

### When Creating Examples
- Use realistic but anonymized data
- Show complete workflows (auth → use)
- Include error scenarios
- Demonstrate common use cases
- Keep examples concise

## Quality Checks

Before committing:
- [ ] YAML files are valid (use `yamllint`)
- [ ] Postman collections regenerated if specs changed
- [ ] Documentation reflects spec changes
- [ ] Code examples are tested
- [ ] Links between documents work
- [ ] Commit message follows convention

## Common Tasks

### Add New Endpoint
1. Add to appropriate OpenAPI spec
2. Include complete schema and examples
3. Regenerate Postman collection
4. Update API documentation
5. Add to quickstart if commonly used

### Update Existing Endpoint
1. Modify OpenAPI spec
2. Regenerate Postman collection
3. Update related documentation
4. Update examples if needed

### Add Documentation
1. Create markdown file in `/docs/api`
2. Follow existing structure and style
3. Add links from README or other docs
4. Include code examples
5. Keep it minimal and focused

## Related Resources

- **LetsPeppol Platform:** https://github.com/letspeppol/letspeppol
- **OpenAPI Spec:** https://swagger.io/specification/
- **Peppol Network:** https://peppol.org
- **Postman Collections:** https://learning.postman.com/docs/collections/collections-overview/

## Notes for Copilot

- This is a **documentation repository**, not a code implementation
- Focus on clarity and accuracy in specifications
- Maintain consistency across all three API modules
- Keep documentation professional and minimal
- Test suggestions with actual Postman collections
- Reference the OpenAPI specs when suggesting documentation changes
- Follow the conventions in `.junie/guidelines.md`

## Project Goals

1. **Accuracy:** Specifications must match the actual API behavior
2. **Completeness:** All endpoints documented with examples
3. **Usability:** Easy to understand and implement
4. **Maintainability:** Clear structure, easy to update
5. **Professional:** High-quality reference documentation

## Anti-Patterns to Avoid

- ❌ Don't add code implementations (this is specs only)
- ❌ Don't make documentation overly verbose
- ❌ Don't forget to regenerate Postman collections
- ❌ Don't break links between documents
- ❌ Don't use absolute GitHub URLs (use relative paths)
- ❌ Don't include sensitive data in examples
- ❌ Don't deviate from OpenAPI 3.0.3 spec

## Support

For issues or questions:
1. Check `.junie/guidelines.md` for detailed guidelines
2. Review existing documentation structure
3. Validate OpenAPI specs with online tools
4. Test with Postman before committing
