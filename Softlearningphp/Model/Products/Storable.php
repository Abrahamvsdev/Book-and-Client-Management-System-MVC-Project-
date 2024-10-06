<?php


interface Storable {
    
    public function volume();
    public function isFragile(): bool;
    public function isHeavy(): bool;
    public function isFlexible(): bool;


}

