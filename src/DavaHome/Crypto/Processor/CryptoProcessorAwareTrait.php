<?php

namespace DavaHome\Crypto\Processor;

use DavaHome\Crypto\Provider\CryptoProviderInterface;

trait CryptoProcessorAwareTrait
{
    /** @var CryptoProviderInterface */
    protected $cryptoProvider;

    /**
     * @return CryptoProviderInterface
     */
    public function getCryptoProvider()
    {
        return $this->cryptoProvider;
    }

    /**
     * @param CryptoProviderInterface $cryptoProvider
     *
     * @return $this
     */
    public function setCryptoProvider($cryptoProvider)
    {
        $this->cryptoProvider = $cryptoProvider;
        return $this;
    }
}
