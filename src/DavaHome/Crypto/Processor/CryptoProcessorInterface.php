<?php

namespace DavaHome\Crypto\Processor;

use DavaHome\Crypto\DecryptorInterface;
use DavaHome\Crypto\EncryptorInterface;
use DavaHome\Crypto\Provider\CryptoProviderInterface;

interface CryptoProcessorInterface extends EncryptorInterface, DecryptorInterface
{
    /**
     * @param CryptoProviderInterface $cryptoProvider
     *
     * @return $this
     */
    public function setCryptoProvider(CryptoProviderInterface $cryptoProvider);

    /**
     * @return CryptoProviderInterface
     */
    public function getCryptoProvider();

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function encrypt($data);

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function decrypt($data);
}
