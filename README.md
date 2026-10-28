# Magepow_Preview

**Magepow Preview** is a Magento 2 module that provides quick access to the frontend view of products, categories, and CMS pages directly from the admin panel. Instead of navigating manually to the storefront, administrators get a "Preview" button on the edit pages, allowing them to instantly open the corresponding frontend page in a new tab.

## Features

- Adds a **Preview** button to:
  - Product edit page
  - Category edit page
  - CMS page edit page
- Opens the frontend page of the entity being edited in a new browser tab.
- Works with store view scoping.
- Lightweight, no impact on frontend performance.

## Compatibility

- Magento 2.3.x / 2.4.x
- PHP 7.3+ / 8.x (as supported by your Magento version)

## Installation

### Manual Installation

1. Create the directory `app/code/Magepow/Preview`.
2. Copy the module files into that directory.
3. Enable the module:

```bash
php bin/magento module:enable Magepow_Preview
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
```

### Composer Installation

```bash
composer require magepow/preview
php bin/magento module:enable Magepow_Preview
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
```

## Configuration

No additional configuration is required. The Preview button appears automatically on the relevant admin edit pages once the module is enabled.

## Usage

1. Go to **Catalog > Products** (or Categories / Content > Pages).
2. Open an existing product/category/CMS page for editing.
3. Click the **Preview** button at the top of the edit form.
4. The frontend page opens in a new tab so you can review changes.

## Support

- Website: https://magepow.com
- Email: support@magepow.com

## License

OSL-3.0 / AFL-3.0
