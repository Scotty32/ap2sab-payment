<?php declare(strict_types=1);

namespace App\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use ReflectionClass;

trait ToUrl {

    protected string $image_url_attribute = 'image_url';
    protected string $storageDisk = 'public';
    
    
    protected function imageFullUrl(): Attribute
    {

        return Attribute::make(
            get: fn () => $this->attributes[$this->image_url_attribute] ?  asset('storage/'.$this->attributes[$this->image_url_attribute]) : null,
        );
    }
}