<?php 
$session = Core\Session::instance();
if($session->messageCount()) {
    [$t, $msg] = $session->showFlash();
    $alert = <<<EM
        <div class="alert alert-{$t} alert-dismissible fade show mt-3" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" area-label="Close" onclick="this.parentElement.style.display='none';">&times;</button>
            <strong>{$msg}</strong>
        </div> 
    EM;
    echo $alert;
}