<?php

namespace DavaHome\Crypto;

class Crypt
{
    const METHOD_AES256_CBC = 'AES-256-CBC';

    /** @var string */
    protected $password;

    /** @var string */
    protected $encryptionMethod;

    public function __construct($password, $encryptionMethod)
    {
        $this->password = $password;
        $this->encryptionMethod = $encryptionMethod;
    }

    /**
     * @return array [$key, $iv]
     */
    protected function getKeyAndIv()
    {
        list($rawKey, $rawIv) = explode('|', $this->password);

        $key = hash('sha256', $rawKey);

        $hashedIv = hash('sha256', $rawIv);
        $start = (crc32($hashedIv) % strlen($hashedIv) - 20);
        $iv = substr($hashedIv, $start, 16);

        return [$key, $iv];
    }

    /**
     * "Safe write" a file (write into a temp file before writing into the main file)
     *
     * @param string $file
     * @param string $data
     *
     * @return bool
     */
    protected function safeWrite($file, $data)
    {
        $tmpFile = $file . '.tmp';

        // Check if write to tmp file was successful
        if (file_put_contents($tmpFile, $data) > 0) {
            if (file_exists($file)) {
                unlink($file);
            }
            rename($tmpFile, $file);

            return true;
        }

        // Clean up after failed safe write
        if (file_exists($tmpFile)) {
            unlink($tmpFile);
        }

        return false;
    }

    /**
     * @param string $inputFile
     * @param string $encryptedFile
     * @param string $checksumFile
     *
     * @return string
     */
    public function encrypt($inputFile, $encryptedFile, $checksumFile)
    {
        $data = file_get_contents($inputFile);
        list($key, $iv) = $this->getKeyAndIv();
        $result = openssl_encrypt($data, $this->encryptionMethod, $key, 0, $iv);

        $this->safeWrite($checksumFile, md5_file($inputFile));

        return $this->safeWrite($encryptedFile, base64_encode($result));
    }

    /**
     * @param string $encryptedFile
     * @param string $outputFile
     * @param string $checksumFile
     *
     * @return string
     */
    public function decrypt($encryptedFile, $outputFile, $checksumFile)
    {
        $data = file_get_contents($encryptedFile);
        list($key, $iv) = $this->getKeyAndIv();
        $result = openssl_decrypt(base64_decode($data), $this->encryptionMethod, $key, 0, $iv);

        $this->safeWrite($outputFile, $result);

        return md5_file($outputFile) === trim(file_get_contents($checksumFile));
    }
}
