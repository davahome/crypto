<?php

namespace DavaHome\Crypto\Provider;

use DavaHome\Crypto\DecryptorInterface;
use DavaHome\Crypto\EncryptorInterface;

interface CryptoProviderInterface extends EncryptorInterface, DecryptorInterface
{

}
