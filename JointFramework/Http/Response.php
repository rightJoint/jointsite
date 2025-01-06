<?php

namespace JointFramework\Http;

use JointFramework\Http\Traits\JointSiteResponseTrait;
use Psr\Http\Message\ResponseInterface;

class Response extends Message implements ResponseInterface
{
    private int $code = 200;
    private string $reasonPhrase = '';

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
    {
        $new = clone $this;
        $new->code = $code;
        $new->reasonPhrase = $reasonPhrase;
        return $new;
    }

    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

}