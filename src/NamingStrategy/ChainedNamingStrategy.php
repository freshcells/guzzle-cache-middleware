<?php

namespace Csa\GuzzleHttp\Middleware\Cache\NamingStrategy;

use Psr\Http\Message\RequestInterface;

class ChainedNamingStrategy implements NamingStrategyInterface
{
    private array $strategies;

    /**
     * @param NamingStrategyInterface[] $strategies
     */
    public function __construct(array $strategies)
    {
        $this->strategies = (function (NamingStrategyInterface ...$strategies) {
            return $strategies;
        })(...$strategies);
    }

    public function filename(RequestInterface $request)
    {
        foreach ($this->strategies as $strategy) {
            if ($filename = $strategy->filename($request)) {
                return $filename;
            }
        }

        return null;
    }
}
