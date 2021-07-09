<?php

use Hashids\Hashids;
function hash2id($hashid){
    $hashids = new Hashids('magicpay!@#');
    return $hashids->encode($hashid);

}
function id2hash($hashid){
    $hashids = new Hashids('magicpay!@#');
    return $hashids->decode($hashid);

}
?>
