<?php

namespace App\Traits\Field;
trait ItemKey
{
    protected $itemKey = 'id';

    /**
     * @return string
     */
    public function getItemKey(): string {
        return $this->itemKey;
    }

    /**
     * @param string $itemKey
     */
    public function setItemKey(string $itemKey): void {
        $this->itemKey = $itemKey;
    }
}
