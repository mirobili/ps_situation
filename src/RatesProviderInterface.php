<?php

namespace App;

interface RatesProviderInterface
{
    public function get_rates();

    public function get_rate($currency);
}