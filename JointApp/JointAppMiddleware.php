<?php

namespace JointApp;

use JointFramework\Http\ServerRequest;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;

class JointAppMiddleware implements MiddlewareInterface
{

    public ServerRequestInterface $request;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        parse_str($request->getServerParams()["QUERY_STRING"], $REQ_ARR);

        $this->request = $request
            ->withCookieParams($_COOKIE)
            ->withQueryParams($REQ_ARR)
            ->withParsedBody($_POST);

        $this->request->getUploadedFiles();

        return $handler->handle($this->request);
    }
}

