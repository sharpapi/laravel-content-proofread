# AI Content Proofreader for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sharpapi/laravel-content-proofread.svg?style=flat-square)](https://packagist.org/packages/sharpapi/laravel-content-proofread)
[![Total Downloads](https://img.shields.io/packagist/dt/sharpapi/laravel-content-proofread.svg?style=flat-square)](https://packagist.org/packages/sharpapi/laravel-content-proofread)

This package provides a Laravel integration for the SharpAPI Content Proofreading service. It allows you to check and correct grammar, spelling, and style issues in text content, which is perfect for ensuring high-quality content in your applications.

## Installation

You can install the package via composer:

```bash
composer require sharpapi/laravel-content-proofread
```

## Configuration

Publish the config file with:

```bash
php artisan vendor:publish --tag="sharpapi-content-proofread"
```

This is the contents of the published config file:

```php
return [
    'api_key' => env('SHARP_API_KEY'),
    'base_url' => env('SHARP_API_BASE_URL', 'https://sharpapi.com/api/v1'),
    'api_job_status_polling_wait' => env('SHARP_API_JOB_STATUS_POLLING_WAIT', 180),
    'api_job_status_polling_interval' => env('SHARP_API_JOB_STATUS_POLLING_INTERVAL', 10),
    'api_job_status_use_polling_interval' => env('SHARP_API_JOB_STATUS_USE_POLLING_INTERVAL', false),
];
```

Make sure to set your SharpAPI key in your .env file:

```
SHARP_API_KEY=your-api-key
```

## Usage

```php
use SharpAPI\ContentProofread\ContentProofreadService;

$service = new ContentProofreadService();

// Proofread text
$proofreadText = $service->proofread(
    'This text has some gramatical errors and typos that need to be corected.'
);

// proofread() returns a status URL; fetchResults() polls until the job is done
$job = $service->fetchResults($proofreadText);
$corrected = $job->result->proofread;
```

## Parameters

- `text` (string): The text content to proofread and check for grammar issues

## Response Format

```json
{
    "data": {
        "type": "api_job_result",
        "id": "2432f9ee-528a-4709-9916-2ab031df27ab",
        "attributes": {
            "status": "success",
            "type": "content_proofread",
            "result": {
                "proofread": "Red Bull's Max Verstappen says this weekend's Las Vegas Grand Prix is \"99% show and 1% sporting event\". ...",
                "output_format": "text",
                "output_html_css": null
            }
        }
    }
}
```

## Features

- Corrects spelling errors
- Fixes grammatical mistakes
- Improves sentence structure
- Enhances readability
- Maintains the original meaning of the text

## AI agents (Laravel Boost)

This package ships a [Laravel Boost](https://github.com/laravel/boost) skill, `sharpapi-content-proofread`. It teaches AI coding agents the async submit-then-`fetchResults()` flow, the queued-job recipe, the result shape and the testing approach. Boost 2 or newer is required. In your app:

```bash
composer require laravel/boost --dev
php artisan boost:install          # first time
php artisan boost:update --discover # already using Boost
```

Select `sharpapi/laravel-content-proofread` when Boost lists the packages it found. The skill loads on demand; no always-on guideline is added.

## Credits

- [Dawid Makowski](https://github.com/dawidmakowski)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.