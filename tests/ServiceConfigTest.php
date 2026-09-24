<?php

declare(strict_types=1);

use SharpAPI\ContentProofread\ContentProofreadService;

beforeEach(function () {
    config()->set('sharpapi-content-proofread.api_key', 'test-key');
});

it('keeps the server Retry-After polling by default', function () {
    expect((new ContentProofreadService)->isUseCustomInterval())->toBeFalse();
});

it('applies the use-polling-interval flag from config', function () {
    config()->set('sharpapi-content-proofread.api_job_status_use_polling_interval', true);
    config()->set('sharpapi-content-proofread.api_job_status_polling_interval', 7);

    $service = new ContentProofreadService;

    expect($service->isUseCustomInterval())->toBeTrue()
        ->and($service->getApiJobStatusPollingInterval())->toBe(7);
});

it('reads the polling wait from config', function () {
    config()->set('sharpapi-content-proofread.api_job_status_polling_wait', 60);

    expect((new ContentProofreadService)->getApiJobStatusPollingWait())->toBe(60);
});
