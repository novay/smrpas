<?php

namespace Novay\Smrpas\Traits;

trait TokenTrait
{
    public function token_smrpas()
    {
        return $this->hasOne(\Novay\Smrpas\Models\OAuth::class);
    }
}