<?php

namespace JointFramework\Http;


use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    private string $uri;
    private string $host;
    private int|null $port = 80;
    private string $path;
    private string $query = '';
    private string $protocol = '';


    function __construct(string $uri = '')
    {
        $this->uri = $uri;
        $uri_p = explode('://', $uri);
        $this->protocol = $uri_p[0];
        $uri_q = explode('?', $uri_p[1]);
        if(isset($uri_q[1])){
            $this->query = $uri_q[1];
        }
        $path_pos = strpos($uri_q[0], '/');
        $hostAndPort = substr($uri_q[0], 0, $path_pos);
        $this->path = substr($uri_q[0], $path_pos, strlen($uri_q[0]));
        $uri_h = explode(':', $hostAndPort);
        $this->host = $uri_h[0];
        if(isset($uri_h[1])){
            $this->port = intval($uri_h[1]);
        }
    }

    public function getScheme(): string
    {

    }

    public function getAuthority(): string
    {

    }

    public function getUserInfo(): string
    {

    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getFragment(): string
    {

    }

    public function withScheme(string $scheme): UriInterface
    {

    }

    public function withUserInfo(string $user, ?string $password = null): UriInterface
    {

    }

    public function withHost(string $host): UriInterface
    {
        $new = clone $this;
        $new->host = $host;
        return $new;
    }

    public function withPort(?int $port): UriInterface
    {
        $new = clone $this;
        $new->port = $port;
        return $new;
    }

    public function withPath(string $path): UriInterface
    {
        $new = clone $this;
        $new->path = $path;
        return $new;
    }

    public function withQuery(string $query): UriInterface
    {
        $new = clone $this;
        $new->query = $query;
        return $new;
    }

    public function withFragment(string $fragment): UriInterface
    {

    }

    public function __toString(): string
    {
        return $this->uri;
    }
}