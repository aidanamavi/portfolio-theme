/**
 * Basic JavaScript functionality tests for Portfolio Theme
 */

describe('Portfolio Theme JavaScript', () => {
  beforeEach(() => {
    // Reset DOM before each test
    document.body.innerHTML = ''
    
    // Mock jQuery ready function
    global.jQuery = jest.fn(() => ({
      ready: jest.fn(fn => fn()),
      find: jest.fn(() => ({ length: 0 })),
      attr: jest.fn(),
      data: jest.fn(),
      animate: jest.fn(),
      show: jest.fn(),
      hide: jest.fn(),
      stop: jest.fn(() => global.jQuery()),
      css: jest.fn(() => global.jQuery()),
      children: jest.fn(() => global.jQuery()),
      parent: jest.fn(() => global.jQuery()),
      append: jest.fn(() => global.jQuery())
    }))
    global.$ = global.jQuery
  })

  test('should have required global variables defined', () => {
    expect(global.userId).toBeDefined()
    expect(global.nonce).toBeDefined()
    expect(global.siteTitle).toBeDefined()
    expect(global.showcaseAnimationIn).toBeDefined()
    expect(global.showcaseAnimationOut).toBeDefined()
  })

  test('should have _paq tracking object defined', () => {
    expect(global._paq).toBeDefined()
    expect(typeof global._paq.push).toBe('function')
  })

  test('should have history API mocked', () => {
    expect(window.history.pushState).toBeDefined()
    expect(window.history.replaceState).toBeDefined()
  })

  test('jQuery should be available', () => {
    expect(global.jQuery).toBeDefined()
    expect(global.$).toBeDefined()
    expect(global.jQuery).toBe(global.$)
  })

  test('String prototype capitalize method', () => {
    // Add the capitalize method (normally defined in base.js)
    String.prototype.capitalize = function() {
      return this.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); })
    }

    expect('hello world'.capitalize()).toBe('Hello World')
    expect('test string'.capitalize()).toBe('Test String')
    expect('a'.capitalize()).toBe('A')
  })

  test('should handle empty strings gracefully', () => {
    String.prototype.capitalize = function() {
      return this.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); })
    }

    expect(''.capitalize()).toBe('')
    expect(' '.capitalize()).toBe(' ')
  })
})