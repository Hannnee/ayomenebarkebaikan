<?php

namespace App\Traits;

trait TimeTrait
{
    /**
     * @return
     */
    public function created_time()
    {
        return date('d F Y h:i:s', strtotime($this->created_at));
    }

    /**
     * @return
     */
    public function updated_time()
    {
        return date('d F Y h:i:s', strtotime($this->updated_at));
    }
}
