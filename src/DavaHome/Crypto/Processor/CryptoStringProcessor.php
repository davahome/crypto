<?php

namespace DavaHome\Crypto\Processor;

/**
 * Simple string encryption and decryption
 */
class CryptoStringProcessor implements CryptoProcessorInterface
{
    use CryptoProcessorAwareTrait;

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function encrypt($data)
    {
        return $this->getCryptoProvider()->encrypt($data);
    }

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function decrypt($data)
    {
        return $this->getCryptoProvider()->decrypt($data);
    }
}
