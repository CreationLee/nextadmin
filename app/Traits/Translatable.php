<?php
namespace App\Traits;

use App\Models\Translation;
use App\Translator;

trait Translatable
{

    /**
     * the relation with table translation
     */
    public function translations()
    {
        return $this->hasMany(Translation::class,'foreign_key',$this->getKeyName())
            ->where('table_name',$this->getTable())
            ->whereIn('local',config('multilingual.locales'));
    }


    /**
     * translate the whole model
     *
     * @param null|string $language
     * @param boll[string $fallback
     *
     * @return Translator
     */
    public function translate($language, $fallback)
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return (new Translator($this))->translate($language, $fallback);
    }

    public function getTranslatableAttributes()
    {
        return property_exists($this,'translateble') ? $this->translateble : [];
    }

    public function getTranslatedAttributeMeta($attribute, $localle=null, $fallback=true)
    {

        if(!in_array($attribute,$this->getTranslatableAttributes())) {
            return [$this->getAttribute($attribute),config('admin.multilingual.default'),false];
        }

    }

}