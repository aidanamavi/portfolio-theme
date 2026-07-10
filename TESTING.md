# Unit Testing for Portfolio Theme

This document outlines the unit testing setup and usage for the Portfolio Theme.

## Overview

The Portfolio Theme now includes comprehensive unit testing for both PHP and JavaScript components to ensure code quality and reliability in CI/CD pipelines.

## Testing Framework

### PHP Testing
- **Framework**: PHPUnit 9.x with Brain Monkey for WordPress function mocking
- **Coverage**: Custom PHP functions, AJAX handlers, and validation logic
- **Configuration**: `phpunit.xml`

### JavaScript Testing
- **Framework**: Jest with jsdom environment
- **Coverage**: Frontend interactions, DOM manipulation, and utility functions
- **Configuration**: `package.json` (jest section)

## Installation

### Install PHP Dependencies
```bash
composer install
```

### Install JavaScript Dependencies
```bash
npm install
```

## Running Tests

### PHP Tests
```bash
# Run all PHP tests
composer test

# Run with coverage report
composer run test:coverage
```

### JavaScript Tests
```bash
# Run all JavaScript tests
npm test

# Run in watch mode for development
npm run test:watch

# Run with coverage report
npm run test:coverage
```

### Linting
```bash
# Lint JavaScript files
npm run lint:js

# Auto-fix JavaScript linting issues
npm run lint:fix
```

## Test Structure

### PHP Tests (`tests/php/`)
- `CustomTheCategoryTest.php` - Tests for category link generation
- `CustomRemoveUrlProtocolTest.php` - Tests for URL protocol removal
- `AjaxValidationTest.php` - Tests for AJAX validation functions

### JavaScript Tests (`tests/js/`)
- `base.test.js` - Tests for core JavaScript utility functions
- `interactions.test.js` - Tests for jQuery interactions and animations
- `setup.js` - Test environment setup and mocking

## Test Coverage

### PHP Components Tested
- `custom_the_category()` function
- `remove_url_protocol()` function
- AJAX validation functions
- POST data validation patterns

### JavaScript Components Tested
- `updateCategory()` function
- `updateTitle()` function
- Navigation hover/focus effects
- Page visibility management
- AJAX URL generation
- Data attribute parsing

## CI/CD Integration

The theme includes GitHub Actions workflow (`.github/workflows/tests.yml`) that:

1. **Runs PHP tests** across multiple PHP versions (7.4, 8.0, 8.1, 8.2)
2. **Runs JavaScript tests** across multiple Node.js versions (16.x, 18.x, 20.x)
3. **Performs code linting** for JavaScript
4. **Generates coverage reports**
5. **Validates dependencies** (composer.json, package.json)

## Development Guidelines

### Adding New PHP Tests
1. Create test file in `tests/php/` with `Test.php` suffix
2. Extend `PHPUnit\Framework\TestCase`
3. Use Brain Monkey for WordPress function mocking
4. Follow the existing test patterns

### Adding New JavaScript Tests
1. Create test file in `tests/js/` with `.test.js` suffix
2. Use Jest testing framework
3. Mock DOM elements and global variables as needed
4. Follow the existing test patterns

### Test Naming Conventions
- Test methods should start with `test_` (PHP) or be inside `test()` calls (JavaScript)
- Use descriptive names that explain what is being tested
- Group related tests using `describe()` blocks (JavaScript)

## Best Practices

1. **Keep tests focused** - Each test should verify one specific behavior
2. **Use mocking appropriately** - Mock external dependencies and WordPress functions
3. **Test edge cases** - Include tests for invalid inputs and boundary conditions
4. **Maintain test isolation** - Each test should be independent and repeatable
5. **Update tests with code changes** - Keep tests in sync with code modifications

## File Exclusions

The following files are excluded from testing and coverage:
- Minified JavaScript files (`*.min.js`)
- Third-party libraries (`jquery.min.js`)
- Build artifacts and dependencies (`vendor/`, `node_modules/`)
- Main WordPress files (limited testing due to WordPress dependency)