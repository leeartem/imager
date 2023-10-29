<?php

namespace App\Domain\Entities\ImageSource;

use GuzzleHttp\Client;
use Illuminate\Http\Response;

abstract class AbstractImageSource
{
    protected int $randomid;

    public function __construct(
        private Client $client,
    ) {
        $this->setRandomId();
    }

    final protected function checkIfExists(string $url): bool
    {
        try {
            $response = $this->client->get($url);
        } catch (\Throwable $exception) {
            return false;
        }

        return $response->getStatusCode() === Response::HTTP_OK;
    }

    final protected function setRandomId(): void
    {
        $this->randomid = rand(0, 1020);
    }
}
