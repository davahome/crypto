<?php

namespace DavaHome\Crypto\Processor;

class CryptoFileProcessor extends CryptoStringProcessor
{
    /**
     * @param string      $source
     * @param string|null $target
     *
     * @return mixed
     */
    public function encrypt($source, $target = null)
    {
        $content = file_get_contents($source);
        $encrypted = parent::encrypt($content);

        if ($target !== null) {
            file_put_contents($target, $encrypted);
        }

        return $encrypted;
    }

    /**
     * @param string      $source
     * @param string|null $target
     *
     * @return mixed
     */
    public function decrypt($source, $target = null)
    {
        $content = file_get_contents($source);
        $decrypted = parent::decrypt($content);

        if ($target !== null) {
            file_put_contents($target, $decrypted);
        }

        return $decrypted;
    }

}
