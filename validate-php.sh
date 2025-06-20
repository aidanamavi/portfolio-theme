#!/bin/bash

# Simple PHP syntax validation script
echo "Validating PHP syntax..."

errors=0
for file in *.php php/*.php pages/*.php templates/*.php; do
    if [ -f "$file" ]; then
        echo -n "Checking $file... "
        if php -l "$file" > /dev/null 2>&1; then
            echo "✓"
        else
            echo "✗"
            php -l "$file"
            errors=$((errors + 1))
        fi
    fi
done

if [ $errors -eq 0 ]; then
    echo "All PHP files have valid syntax! ✓"
    exit 0
else
    echo "$errors PHP files have syntax errors! ✗"
    exit 1
fi