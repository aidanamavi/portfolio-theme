module.exports = {
  testEnvironment: 'jsdom',
  setupFilesAfterEnv: ['<rootDir>/tests/js/setup.js'],
  testMatch: [
    '<rootDir>/tests/js/**/*.test.js'
  ],
  collectCoverageFrom: [
    'js/*.js',
    '!js/*.min.js',
    '!js/jquery.min.js'
  ],
  coverageDirectory: 'coverage',
  coverageReporters: ['text', 'lcov', 'html']
}