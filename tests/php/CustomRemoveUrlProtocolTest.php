<?php
/**
 * Tests for remove_url_protocol function
 *
 * @package WordPress Portfolio Theme
 */

namespace PortfolioTheme\Tests;

use PHPUnit\Framework\TestCase;

class CustomRemoveUrlProtocolTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Load the function under test
        require_once dirname(dirname(__DIR__)) . '/php/custom_remove_url_protocol.php';
    }

    /**
     * Test remove_url_protocol with HTTP URL
     */
    public function test_remove_url_protocol_http()
    {
        $url = 'http://example.com/path?query=value#fragment';
        $result = remove_url_protocol($url);
        
        $this->assertEquals('//example.com/path?query=value#fragment', $result);
    }

    /**
     * Test remove_url_protocol with HTTPS URL
     */
    public function test_remove_url_protocol_https()
    {
        $url = 'https://secure.example.com/secure-path';
        $result = remove_url_protocol($url);
        
        $this->assertEquals('//secure.example.com/secure-path', $result);
    }

    /**
     * Test remove_url_protocol with URL containing port
     */
    public function test_remove_url_protocol_with_port()
    {
        $url = 'https://example.com:8080/path';
        $result = remove_url_protocol($url);
        
        $this->assertEquals('//example.com:8080/path', $result);
    }

    /**
     * Test remove_url_protocol with URL containing user credentials
     */
    public function test_remove_url_protocol_with_credentials()
    {
        $url = 'https://user:pass@example.com/path';
        $result = remove_url_protocol($url);
        
        $this->assertEquals('//user:pass@example.com/path', $result);
    }

    /**
     * Test remove_url_protocol with minimal URL
     */
    public function test_remove_url_protocol_minimal()
    {
        $url = 'http://example.com';
        $result = remove_url_protocol($url);
        
        $this->assertEquals('//example.com', $result);
    }

    /**
     * Test remove_url_protocol with complex URL
     */
    public function test_remove_url_protocol_complex()
    {
        $url = 'https://user:password@subdomain.example.com:9000/long/path/to/resource?param1=value1&param2=value2#section1';
        $result = remove_url_protocol($url);
        
        $expected = '//user:password@subdomain.example.com:9000/long/path/to/resource?param1=value1&param2=value2#section1';
        $this->assertEquals($expected, $result);
    }

    /**
     * Test remove_url_protocol with already protocol-relative URL
     */
    public function test_remove_url_protocol_already_relative()
    {
        $url = '//example.com/path';
        $result = remove_url_protocol($url);
        
        // Should still work and return protocol-relative URL
        $this->assertEquals('//example.com/path', $result);
    }
}