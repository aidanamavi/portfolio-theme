A minimalist [WordPress](https://www.wordpress.org) theme for your portfolio. Open-source, continuously supported, and free to use.

The theme is clean, content-focused, and designed for clarity. It offers simple, straight forward typography readable on a wide variety of screen sizes, and suitable for multiple languages. It is designed using a mobile-first approach, meaning your content takes center-stage, regardless of whether your visitors arrive by smartphone, tablet, laptop, or desktop computer.

![Portfolio Theme Screen Shot](https://raw.githubusercontent.com/aidanamavi/portfolio-theme/master/img/markdown_screenshot.jpg "Portfolio Theme Screen Shot")



## Benefits

* :rocket: **Built with modern open-source technologies.** Built for WordPress, PHP, and jQuery with Matomo analytics integration.
* :zap: **Fast page transitions with AJAX.** Front-end AJAX-powered page loading for smooth navigation.
* :lock: **HTTPS ready.** Compatible with SSL certificates for secure connections.
* :lock_with_ink_pen: **Content Security Policy settings.** Easily add and manage policies to protect your web site (UX improvements in progress).
* :+1: **Standards compliant & validated code.** HTML5, CSS3, and JavaScript code analysis and verification with automated testing.
* :iphone: **Responsive design.** Support for desktops, laptops, tablets, and smartphone screens.
* :bar_chart: **Matomo Analytics integration.** No code necessary. Works with any host.
* :mag: **SEO features included.** Custom meta descriptions, keywords, and page titles for search optimization.
* :page_facing_up: **Printer friendly.** Your content is scaled to bring your colorful imagery to focus.
* :wheelchair: **Basic accessibility features.** Alt text for images and semantic HTML structure.
* :computer: **Flows like a modern web app.** Smart and smooth loading screens and transitions.

## Requirements

* [PHP](https://www.php.net/) >= 7.0
* [WordPress](https://www.wordpress.org) >= 4.1


## Installation

Upload the theme to your WordPress themes directory.
1. Navigate to `Appearance > Themes > Add New > Upload Theme`
2. Upload the theme zip file.

Activate the theme.
1. Navigate to `Appearance > Themes`
2. Click the 'Activate' button.


## Setup

Create your Homepage.
1. Navigate to `Pages > Add New`
2. Enter 'Homepage' as the title.
3. Select the `Page Attributes > Template` named Homepage
4. Click Publish to save the page.

Redirect visitors to your homepage.
1. Navigate to `Customize > Homepage Settings`
2. Select the radio button for "A static page".
3. Select the Homepage to use as your home page.

Create your About page.
1. Navigate to `Pages > Add New`
2. Enter 'About' as the title.
3. Select the `Page Attributes > Template` named About
4. Click Publish to save the page.


### For the best results

1. Use images with 16:9 aspect ratio.
2. Upload your media directly to WordPress.
3. Perform search engine optimizations for every media, post and page.
4. Confirm your permalinks look similar to: yourdomain.com/about/
5. If you experience any issues or have enhancement suggestions, you can report them in the [issue tracker](https://github.com/aidanamavi/portfolio-theme/issues).


## Development & Validation

The theme includes comprehensive code validation and testing tools to ensure quality and standards compliance:

### Code Validation
* **JavaScript**: ESLint for code quality and standards compliance
* **CSS**: Stylelint for stylesheet validation and best practices
* **PHP**: Built-in syntax validation for all PHP files

### Testing
* **Unit Tests**: PHPUnit for PHP functionality testing
* **JavaScript Tests**: Jest for frontend component testing
* **Integration Tests**: Comprehensive theme functionality validation

### Available Commands
```bash
# Install development dependencies
npm install

# Run all validations
npm run validate

# Run all tests
npm run test:all

# Individual validations
npm run lint:js        # JavaScript linting
npm run lint:css       # CSS linting
npm run validate:php   # PHP syntax validation

# Individual tests
npm test              # JavaScript tests
phpunit              # PHP tests
```

## Known Issues
1. UX for Content-Security-Policy needs improvement.
2. JavaScript onLoad needs fixed.


## Maintainers

Active: [Aidan Amavi](https://github.com/AidanAmavi)


