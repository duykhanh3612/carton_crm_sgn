<?php

namespace App\Model;

use Illuminate\Validation\Rules\Enum;

abstract class Dictionary extends Enum {
    const Cell = "Cellular";
    const Home = "Home";
    const Work = "Work";
    const OptionItemsKeyNum = "option_items_keynum";
}
