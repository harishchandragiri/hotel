<?php

function alert($type,$msg){
    echo <<<alert
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong class="me-3">$msg</strong> You should check in on some of those fields below.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
     alert;
}



?>