<?php

namespace App\Traits;

trait CallbackTrait
{
    public function callback($url, $e)
    {
        if($e['status'] == 500) {
            alert('danger', 'Ops, something went wrong '. $e['message']);
            return back();
        }
        alert('success', 'Successfully update data');
        return to_route($url);
    }
}
