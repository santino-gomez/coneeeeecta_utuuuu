<?php
function generate_otp_code(int $lenght = 6): string {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $lenght; $i++) {
        $code .=$characters[random_int(0, $max)];
    }
    return $code;
}


?>