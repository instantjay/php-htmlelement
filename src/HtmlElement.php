<?php

namespace HtmlElement;

class HtmlElement
{
    private $tagName;
    private $attributes;
    private $value;

    /**
     * HtmlElement constructor.
     * @param $tagName
     * @param null $value
     */
    public function __construct($tagName, $value = null)
    {
        $this->tagName = $tagName;
        $this->attributes = [];
        $this->value = $value;
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     *
     */
    public function deleteValue()
    {
        unset($this->value);
    }

    /**
     * @param $attributeName
     * @param $value
     */
    public function addAttribute($attributeName, $value)
    {
        $this->attributes[$attributeName][] = $value;
    }

    /**
     * @param $attributeName
     */
    public function deleteAttribute($attributeName)
    {
        unset($this->attributes[$attributeName]);
    }

    /**
     * @return string
     */
    public function build()
    {
        $html = "<".$this->tagName;

        foreach($this->attributes as $key => $attributeValues)
        {
            // If there are no values, then we don't bother outputting the attribute.
            if(empty($attributeValues))
                continue;

            $html .= ' '.$key.'="';

            // Add all attribute values.
            $attributes = implode(' ', $attributeValues);
            $html .= $attributes.'"';
        }

        if($this->value !== null)
        {
            $html .= ">".$this->value."</".$this->tagName.">";
        }
        else {
            $html .= "/>";
        }

        return $html;
    }
}