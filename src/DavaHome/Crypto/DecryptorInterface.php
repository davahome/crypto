<?php

namespace DavaHome\Crypto;

interface DecryptorInterface
{
    /**
     * @param mixed $encryptedData
     *
     * @return mixed
     */
    public function decrypt($encryptedData);
}
