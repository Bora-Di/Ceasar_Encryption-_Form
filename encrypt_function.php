<?php 
function caesarEncrypt($plaintext, $shift) {
    $encryptedText = '';
    $textLength = strlen($plaintext);

    for ($i = 0; $i < $textLength; $i++) {
        $char = $plaintext[$i];
        $isUppercase = false; // Initialize to false by default
        $charCode = ord($char); // Initialize charCode with the ASCII value of the character
        if (ctype_alpha($char)) {
            $isUppercase = ctype_upper($char);
            $char = strtolower($char);
            $charCode = ord($char);
            $charCode = (($charCode - ord('a') + $shift) % 26) + ord('a');
        } elseif (ctype_digit($char)) {
            $charCode = ord('0') + (($charCode - ord('0') + $shift) % 10);
        }
        if ($isUppercase) {
            $char = strtoupper(chr($charCode));
        } else {
            $char = chr($charCode);
        }
        $encryptedText .= $char;
    }
    return $encryptedText;
}






?>