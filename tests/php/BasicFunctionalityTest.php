<?php
/**
 * Basic functionality tests for the Portfolio Theme
 */

use PHPUnit\Framework\TestCase;

class BasicFunctionalityTest extends TestCase
{
    public function setUp(): void
    {
        // Set up any test fixtures
        parent::setUp();
    }

    /**
     * Test that the theme's main functions file exists
     */
    public function testFunctionsFileExists()
    {
        $functionsFile = __DIR__ . '/../../functions.php';
        $this->assertFileExists($functionsFile);
        $this->assertFileIsReadable($functionsFile);
    }

    /**
     * Test that required PHP files exist
     */
    public function testRequiredFilesExist()
    {
        $requiredFiles = [
            'functions.php',
            'index.php',
            'style.css',
            'header.php',
            'footer.php'
        ];

        foreach ($requiredFiles as $file) {
            $filePath = __DIR__ . '/../../' . $file;
            $this->assertFileExists($filePath, "Required file {$file} should exist");
        }
    }

    /**
     * Test that CSS files are valid (basic syntax check)
     */
    public function testCssFilesBasicSyntax()
    {
        $cssFiles = glob(__DIR__ . '/../../css/*.css');
        
        foreach ($cssFiles as $cssFile) {
            $content = file_get_contents($cssFile);
            
            // Basic checks for CSS syntax
            $this->assertNotEmpty($content, "CSS file should not be empty: " . basename($cssFile));
            
            // Check for balanced braces
            $openBraces = substr_count($content, '{');
            $closeBraces = substr_count($content, '}');
            $this->assertEquals($openBraces, $closeBraces, 
                "CSS file should have balanced braces: " . basename($cssFile));
        }
    }

    /**
     * Test that JavaScript files are syntactically valid
     */
    public function testJsFilesBasicSyntax()
    {
        $jsFiles = glob(__DIR__ . '/../../js/*.js');
        
        foreach ($jsFiles as $jsFile) {
            if (strpos($jsFile, '.min.js') !== false) {
                continue; // Skip minified files
            }
            
            $content = file_get_contents($jsFile);
            $this->assertNotEmpty($content, "JS file should not be empty: " . basename($jsFile));
            
            // Basic check for balanced parentheses and braces
            $openParens = substr_count($content, '(');
            $closeParens = substr_count($content, ')');
            $this->assertEquals($openParens, $closeParens, 
                "JS file should have balanced parentheses: " . basename($jsFile));
        }
    }

    /**
     * Test that PHP files have valid syntax
     */
    public function testPhpFilesValidSyntax()
    {
        $phpFiles = array_merge(
            glob(__DIR__ . '/../../*.php'),
            glob(__DIR__ . '/../../php/*.php'),
            glob(__DIR__ . '/../../pages/*.php'),
            glob(__DIR__ . '/../../templates/*.php')
        );

        foreach ($phpFiles as $phpFile) {
            $output = shell_exec("php -l {$phpFile} 2>&1");
            $this->assertStringContainsString('No syntax errors detected', $output,
                "PHP file should have valid syntax: " . basename($phpFile));
        }
    }
}