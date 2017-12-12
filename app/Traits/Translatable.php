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

    public function getTranslatedAttributeMeta($attribute, $locale=null, $fallback=true)
    {

        if(!in_array($attribute,$this->getTranslatableAttributes())) {
            return [$this->getAttribute($attribute),config('admin.multilingual.default'),false];
        }

        if(!$this->relationLoaded('translations')) {
            $this->load('rtranslations');
        }

        if(is_null($locale)) {
            $locale = app()->getLocale();
        }

        if($fallback===true) {
            $fallback = config('app.fallback_locale','en');
        }

        $default = config('admin.multilingual.default');

        $translations = $this->getRalation('translations')
            ->where('column_name',$attribute);

        if($default == $locale) {
            return [$this->getAttribute($attribute),$default,true];
        }

        $localeTranslation = $translations->where('locale',$locale)->first();

        if($localeTranslation) {
            return [$localeTranslation->value,$locale,true];
        }

        if($fallback == $locale) {
            return [$this->getAttribute($attribute),$locale,false];
        }

        $fallbacktranslation = $translations->where('locale',$fallback)->first();

        if ($fallbacktranslation&&$fallback !== false) {
            return [$fallbacktranslation->value,$locale,true];
        }

        return [null,$locale,false];
    }

}