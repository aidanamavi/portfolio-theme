// Jest setup file for Portfolio Theme JavaScript tests

// Mock jQuery if it's not available in the test environment
try {
  global.jQuery = global.$ = require('jquery');
} catch (e) {
  // If jQuery is not installed, create a simple mock
  global.jQuery = global.$ = function(selector) {
    return {
      data: function(key) {
        const element = document.querySelector(selector);
        return element ? element.getAttribute('data-' + key.replace(/([A-Z])/g, '-$1').toLowerCase()) : '';
      },
      attr: function(key) {
        const element = document.querySelector(selector);
        return element ? element.getAttribute(key) : '';
      },
      animate: function() { return this; },
      stop: function() { return this; },
      hover: function() { return this; },
      focusin: function() { return this; },
      focusout: function() { return this; },
      on: function() { return this; },
      children: function() { return this; },
      querySelectorAll: function(sel) {
        return document.querySelectorAll(sel);
      }
    };
  };
}

// Mock DOM elements that the theme expects
document.body.innerHTML = `
  <div id="content_wrapper">
    <div id="page_archive_work" data-post-type="work" data-category-id="1" data-page-title="Test Page"></div>
  </div>
  <nav>
    <img class="off" />
    <a href="#"><img class="off" /></a>
  </nav>
`;

// Mock window properties
Object.defineProperty(window, 'location', {
  value: {
    protocol: 'https:',
    host: 'example.com',
    href: 'https://example.com/'
  },
  writable: true
});

// Mock document properties
Object.defineProperty(document, 'referrer', {
  value: 'https://example.com/referrer',
  writable: true
});

// Mock console.log to avoid cluttering test output
global.console = {
  ...console,
  log: jest.fn(),
  warn: jest.fn(),
  error: jest.fn()
};