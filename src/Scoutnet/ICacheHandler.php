<?php

namespace Scouterna\Scoutorg\Scoutnet;

interface ICacheHandler
{
    public function store(string $key, $data, $ttl);

    public function load(string $key);
}