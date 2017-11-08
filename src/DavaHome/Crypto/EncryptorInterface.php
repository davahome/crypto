<?php

namespace DavaHome\Crypto;

interface EncryptorInterface
{
    /**
     * @param mixed $rawData
     *
     * @return mixed
     */
    public function encrypt($rawData);
}
