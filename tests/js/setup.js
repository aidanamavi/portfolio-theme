// Jest setup file for Portfolio Theme
global.$ = global.jQuery = require('jquery')

// Mock global variables that are set by WordPress
global.userId = '1'
global.nonce = 'test_nonce'
global.siteTitle = 'Test Site'
global.showcaseAnimationIn = 'animate__fadeIn'
global.showcaseAnimationOut = 'animate__fadeOut'

// Mock _paq for Matomo tracking
global._paq = {
  push: jest.fn()
}

// Mock window.history
Object.defineProperty(window, 'history', {
  value: {
    pushState: jest.fn(),
    replaceState: jest.fn(),
    state: null
  },
  writable: true
})

// Mock document.referrer
Object.defineProperty(document, 'referrer', {
  value: 'https://example.com',
  writable: true
})