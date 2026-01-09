<?php

declare(strict_types=1);

namespace SharpAPI\ContentProofread;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use SharpAPI\Core\Client\SharpApiClient;

/**
 * @api
 */
class ContentProofreadService extends SharpApiClient
{
    /**
     * Initializes a new instance of the class.
     *
     * @throws InvalidArgumentException if the API key is empty.
     */
    public function __construct()
    {
        parent::__construct(config('sharpapi-content-proofread.api_key'));
        $this->setApiBaseUrl(
            config(
                'sharpapi-content-proofread.base_url',
                'https://sharpapi.com/api/v1'
            )
        );
        $this->setApiJobStatusPollingInterval(
            (int) config(
                'sharpapi-content-proofread.api_job_status_polling_interval',
                5)
        );
        $this->setApiJobStatusPollingWait(
            (int) config(
                'sharpapi-content-proofread.api_job_status_polling_wait',
                180)
        );
        $this->setUserAgent('SharpAPILaravelContentProofread/1.0.0');
    }

    /**
     * Proofreads (and checks grammar) of the provided text.
     *
     * @param string $text The text to proofread
     * @return string The proofread text or an error message
     *
     * @throws GuzzleException
     *
     * @api
     */
    public function proofread(string $text): string
    {
        $response = $this->makeRequest(
            'POST',
            '/content/proofread',
            ['content' => $text]
        );

        return $this->parseStatusUrl($response);
    }
}