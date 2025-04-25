<?php

namespace App\Helpers;

class CryptoHelper
{
    /**
     * decrypt AES-256-CBC payload from frontend.
     *
     * @param string $payload Format: base64(iv) + ":" + base64(cipher)
     * @param string|null $key 32-byte string from env('AES_SECRET')
     * @return string|null
     */
    public static function decryptAES(string $payload, ?string $key = null): ?string
    {
        $key = $key ?? env('AES_SECRET');

        if (strpos($payload, ':') === false) return null;

        [$ivBase64, $encryptedBase64] = explode(':', $payload);
        $iv = base64_decode($ivBase64);
        $encrypted = base64_decode($encryptedBase64);

        if (!$iv || !$encrypted || !$key) return null;

        // hash the key to ensure it's 256-bit
        $hashedKey = hash('sha256', $key, true); // 32-byte binary

        $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $hashedKey, OPENSSL_RAW_DATA, $iv);

        logger('decryptAES result', ['decrypted' => $decrypted]);

        return $decrypted ?: null;
    }
}
