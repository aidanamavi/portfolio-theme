module.exports = {
  env: {
    browser: true,
    es6: true,
    jquery: true
  },
  extends: [
    'eslint:recommended'
  ],
  globals: {
    Atomics: 'readonly',
    SharedArrayBuffer: 'readonly',
    jQuery: 'readonly',
    $: 'readonly',
    _paq: 'readonly',
    userId: 'readonly',
    nonce: 'readonly',
    siteTitle: 'readonly',
    showcaseAnimationIn: 'readonly',
    showcaseAnimationOut: 'readonly',
    wp: 'readonly'
  },
  parserOptions: {
    ecmaVersion: 2018,
    sourceType: 'script'
  },
  rules: {
    'indent': 'off', // Disable strict indentation for now
    'linebreak-style': 'off', // Disable line ending enforcement
    'quotes': ['warn', 'single'],
    'semi': ['error', 'always'],
    'no-unused-vars': ['warn'],
    'no-console': 'off', // Allow console.log in theme
    'no-debugger': ['error']
  },
  ignorePatterns: [
    'js/*.min.js',
    'tests/',
    'vendor/',
    'node_modules/'
  ]
};