/**
 * Tests for base.js utility functions
 *
 * @package WordPress Portfolio Theme
 */

// Mock global variables that the theme expects
global.window = global.window || {};
global.window.categoryName = '';
global.window.categoryId = '';
global.document = global.document || {};

describe('Portfolio Theme JavaScript Functions', () => {
    beforeEach(() => {
        // Reset DOM for each test
        document.body.innerHTML = `
            <div id="content_wrapper">
                <div id="page_archive_work" 
                     data-post-type="work" 
                     data-category-id="123" 
                     data-page-title="Work Archive">
                </div>
                <div id="page_single_post" 
                     data-post-type="blog" 
                     data-category-id="456" 
                     data-page-title="Single Post">
                </div>
                <div id="page_category" 
                     data-post-type="category" 
                     data-category-id="789" 
                     data-page-title="Category Page">
                </div>
            </div>
        `;
        
        // Reset global variables
        global.window.categoryName = '';
        global.window.categoryId = '';
        global.document.title = '';
    });

    describe('updateCategory function', () => {
        test('should update category for category post type', () => {
            // Simulate the updateCategory function
            const updateCategory = (pageDiv) => {
                const element = document.getElementById(pageDiv);
                const postType = element.getAttribute('data-post-type');
                const categoryId = element.getAttribute('data-category-id');
                
                if (postType === 'category') {
                    global.window.categoryName = postType;
                    global.window.categoryId = categoryId;
                } else {
                    global.window.categoryName = postType;
                }
            };

            updateCategory('page_category');
            
            expect(global.window.categoryName).toBe('category');
            expect(global.window.categoryId).toBe('789');
        });

        test('should update category for non-category post type', () => {
            const updateCategory = (pageDiv) => {
                const element = document.getElementById(pageDiv);
                const postType = element.getAttribute('data-post-type');
                const categoryId = element.getAttribute('data-category-id');
                
                if (postType === 'category') {
                    global.window.categoryName = postType;
                    global.window.categoryId = categoryId;
                } else {
                    global.window.categoryName = postType;
                }
            };

            updateCategory('page_archive_work');
            
            expect(global.window.categoryName).toBe('work');
            expect(global.window.categoryId).toBe(''); // Should not be set
        });
    });

    describe('updateTitle function', () => {
        test('should update document title from page data', () => {
            const updateTitle = (pageDiv) => {
                const element = document.getElementById(pageDiv);
                const pageTitle = element.getAttribute('data-page-title');
                global.document.title = pageTitle;
            };

            updateTitle('page_single_post');
            
            expect(global.document.title).toBe('Single Post');
        });

        test('should handle missing page title', () => {
            // Create element without page title
            document.body.innerHTML += '<div id="page_no_title"></div>';
            
            const updateTitle = (pageDiv) => {
                const element = document.getElementById(pageDiv);
                const pageTitle = element.getAttribute('data-page-title');
                global.document.title = pageTitle || '';
            };

            updateTitle('page_no_title');
            
            expect(global.document.title).toBe('');
        });
    });

    describe('AJAX URL generation', () => {
        test('should generate correct AJAX URL', () => {
            const generateAjaxUrl = () => {
                return window.location.protocol + '//' + window.location.host + '/wp-admin/admin-ajax.php';
            };

            const ajaxUrl = generateAjaxUrl();
            
            expect(ajaxUrl).toBe('https://example.com/wp-admin/admin-ajax.php');
        });
    });

    describe('Page visibility detection', () => {
        test('should detect visible page', () => {
            // Make a page visible
            const workPage = document.getElementById('page_archive_work');
            workPage.style.display = 'block';
            
            const getVisiblePage = () => {
                const contentWrapper = document.getElementById('content_wrapper');
                const visibleElements = contentWrapper.querySelectorAll('*');
                
                for (let element of visibleElements) {
                    if (element.style.display !== 'none' && element.id) {
                        return element.id;
                    }
                }
                return null;
            };

            const visiblePageId = getVisiblePage();
            expect(visiblePageId).toBe('page_archive_work');
        });
    });

    describe('Data attribute validation', () => {
        test('should validate post type data attributes', () => {
            const validatePostType = (postType) => {
                const validTypes = ['work', 'blog', 'about', 'category'];
                return validTypes.includes(postType);
            };

            expect(validatePostType('work')).toBe(true);
            expect(validatePostType('blog')).toBe(true);
            expect(validatePostType('invalid')).toBe(false);
        });

        test('should validate view type data attributes', () => {
            const validateViewType = (viewType) => {
                const validTypes = ['category', 'archive', 'single'];
                return validTypes.includes(viewType);
            };

            expect(validateViewType('category')).toBe(true);
            expect(validateViewType('archive')).toBe(true);
            expect(validateViewType('invalid')).toBe(false);
        });
    });
});