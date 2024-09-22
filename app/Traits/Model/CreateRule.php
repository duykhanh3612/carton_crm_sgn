<?php

namespace App\Traits\Model;

trait CreateRule
{
    public function createRule($username) {
        $rule = array(
            $username  => 'bail|required|max:255',
            'password' => 'bail|required'
        );

        return $rule;
    }
}
