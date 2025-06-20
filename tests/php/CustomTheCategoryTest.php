<?php
/**
 * Tests for custom_the_category function
 *
 * @package WordPress Portfolio Theme
 */

use PHPUnit\Framework\TestCase;

class CustomTheCategoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Load the function under test
        require_once dirname(dirname(__DIR__)) . '/php/custom_the_category.php';
    }

    protected function tearDown(): void
    {
        \Brain\Monkey\tearDown();
        parent::tearDown();
    }

    /**
     * Test custom_the_category with single category
     */
    public function test_custom_the_category_single_category()
    {
        // Mock WordPress functions
        \Brain\Monkey\Functions\when('get_the_category')->justReturn([
            (object) [
                'term_id' => 1,
                'name' => 'Test Category',
                'cat_name' => 'Test Category'
            ]
        ]);

        \Brain\Monkey\Functions\when('esc_url')->returnArg();
        \Brain\Monkey\Functions\when('esc_attr')->returnArg();
        \Brain\Monkey\Functions\when('get_category_link')->alias(function($id) {
            return "http://example.com/category/{$id}";
        });
        \Brain\Monkey\Functions\when('get_post_type')->justReturn('post');

        // Capture output
        ob_start();
        custom_the_category('', '', 123);
        $output = ob_get_clean();

        // Assertions
        $this->assertStringContainsString('href="http://example.com/category/1"', $output);
        $this->assertStringContainsString('data-link-type="postNavigation"', $output);
        $this->assertStringContainsString('data-view-type="category"', $output);
        $this->assertStringContainsString('data-post-type="post"', $output);
        $this->assertStringContainsString('data-category-id="1"', $output);
        $this->assertStringContainsString('Test Category', $output);
    }

    /**
     * Test custom_the_category with multiple categories
     */
    public function test_custom_the_category_multiple_categories()
    {
        // Mock WordPress functions with multiple categories
        \Brain\Monkey\Functions\when('get_the_category')->justReturn([
            (object) [
                'term_id' => 1,
                'name' => 'First Category',
                'cat_name' => 'First Category'
            ],
            (object) [
                'term_id' => 2,
                'name' => 'Second Category',
                'cat_name' => 'Second Category'
            ]
        ]);

        \Brain\Monkey\Functions\when('esc_url')->returnArg();
        \Brain\Monkey\Functions\when('esc_attr')->returnArg();
        \Brain\Monkey\Functions\when('get_category_link')->alias(function($id) {
            return "http://example.com/category/{$id}";
        });
        \Brain\Monkey\Functions\when('get_post_type')->justReturn('work');

        // Capture output
        ob_start();
        custom_the_category(' | ', '', 123);
        $output = ob_get_clean();

        // Assertions
        $this->assertStringContainsString('First Category', $output);
        $this->assertStringContainsString('Second Category', $output);
        $this->assertStringContainsString(' | ', $output);
        $this->assertStringContainsString('data-post-type="work"', $output);
    }

    /**
     * Test custom_the_category with no categories
     */
    public function test_custom_the_category_no_categories()
    {
        // Mock WordPress functions with empty categories
        \Brain\Monkey\Functions\when('get_the_category')->justReturn([]);

        // Capture output
        ob_start();
        custom_the_category();
        $output = ob_get_clean();

        // Should produce no output when no categories exist
        $this->assertEmpty($output);
    }
}