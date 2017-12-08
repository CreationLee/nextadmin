<?php
namespace App;

use ArrayAccess;
use Illuminate\Database\Eloquent\Model;

class Translator implements ArrayAccess
{

    protected $model;
    protected $attributes = [];
    protected $locale;

    public function __construct(Model $model)
    {
        if(!$model->relationLoaded('translation')){
            $model->load('translation');
        }

        $this->model = $model;
        $this->locale = config('admin.multilingual.default','en');
        $attributes = [];

        foreach ($this->model->getAttributes() as $attribute=>$value) {
            $attributes[$attribute] = [
                'value' => $value,
                'locale' => $this->locale,
                'exists' => true,
                'modified' => false
            ];
        }

        $this->attributes = $attributes;
    }

    public function translate($locale=null, $fallback=true)
    {
        $this->locale = $locale;

        foreach($this->model->getTranslatableAttributes() as $attribute) {
            $this->translateAttribute($attribute,$locale,$fallback);
        }

        return $this;
    }

    protected function translateAttribute($attribute, $locale = null, $fallback = true)
    {
        $this->model->getTranslatedAttributeMeta($attribute,$locale,$fallback);
    }

    public function offsetExists($offset)
    {
        //return isset($this->att);
    }

    public function offsetGet($offset)
    {

    }

    public function offsetSet($offset, $value)
    {

    }

    public function offsetUnset($offset)
    {

    }
}