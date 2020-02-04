<?php

namespace Scoutorg\Builder;

class Config
{
    private $providers;

    public function __construct()
    {
        $this->providers = [];
    }

    public function addProvider(string $source, IPartProvider $provider)
    {

        $this->providers[$source] = $provider;
    }

    /**
     * @param string $source 
     * @return IPartProvider|null 
     */
    public function getProvider(string $source)
    {
        return $this->providers[$source] ?? null;
    }

    /**
     * @return \Generator<string,IPartProvider>
     */
    public function providers()
    {
        foreach ($this->providers as $source => $provider) {
            yield $source => $provider;
        }
    }
}
