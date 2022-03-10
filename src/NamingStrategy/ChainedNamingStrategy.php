<?php

namespace Csa\GuzzleHttp\Middleware\Cache\NamingStrategy;

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


}
