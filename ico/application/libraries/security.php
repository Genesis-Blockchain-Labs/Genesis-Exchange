<?php

    class UnsafeCrypto
    {
        const METHOD = 'aes-256-ctr';
		
        public static function encrypt($message, $key, $encode = false)
        {
            $nonceSize = openssl_cipher_iv_length(self::METHOD);
            $nonce = openssl_random_pseudo_bytes($nonceSize);
            
            $ciphertext = openssl_encrypt(
                $message,
                self::METHOD,
                $key,
                OPENSSL_RAW_DATA,
                $nonce
            );
            
           
		   
            if ($encode) {
                return base64_encode($nonce.$ciphertext);
            }
            return $nonce.$ciphertext;
        }
       
	   
        public static function decrypt($message, $key, $encoded = false)
        {
            if ($encoded) {
                $message = base64_decode($message, true);
                if ($message === false) {
                    throw new Exception('Encryption failure');
                }
            }

            $nonceSize = openssl_cipher_iv_length(self::METHOD);
            $nonce = mb_substr($message, 0, $nonceSize, '8bit');
            $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
            
            $plaintext = openssl_decrypt(
                $ciphertext,
                self::METHOD,
                $key,
                OPENSSL_RAW_DATA,
                $nonce
            );
            
            return $plaintext;
        }
    }

	//$message = 'rM2vDzfm1aPsoyChIDwlAQdInDLQ3w==';
	//$key = MD5('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f'); 
	

	//$encrypted = UnsafeCrypto::encrypt($message, $key, true);
	//$decrypted = UnsafeCrypto::decrypt($message, $key, true);

	//echo $encrypted."<br/>";
	//echo $decrypted; 