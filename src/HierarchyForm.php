<?php


namespace Dakine\HierarchySelect;


use Illuminate\Support\Facades\Log;

class HierarchyForm
{

    public function select($name, $list = [], $selected = null, $options = [])
    {

        if (!is_array($list))
        {
            $list = $list->toArray();
        }

        Log::debug('LIST ARRAY '. json_encode($list));

        $options['id'] = $this->getIdAttribute($name, $options);

        if (! isset($options['name'])) {
            $options['name'] = $name;
        }

        Log::debug('OPTIONS : '.json_encode($options));

        $html = [];

        foreach ($list as $item) {
            $html[] = $this->option($item['name'], $item['id'], $selected, $item['depth']);
        }

        Log::debug('SELECT OPTIONS : '.json_encode($html));

        $list = implode('', $html);

        Log::debug('LIST IMPLODE ' . json_encode($list));

        $options = $this->attributes($options);

        Log::debug('RETURN '.json_encode($options));

        return (string) "<select{$options}>{$list}</select>";
    }

    public function getIdAttribute($name, $attributes)
    {
        if (array_key_exists('id', $attributes)) {
            return $attributes['id'];
        }

        return $name;
    }

    protected function getSelectedValue($value, $selected)
    {
        return ((string) $value == (string) $selected) ? 'selected' : null;
    }

    protected function option($display, $value, $selected, $depth = 1)
    {
        $selected = $this->getSelectedValue($value, $selected);

        $options = ['value' => $value, 'selected' => $selected];

        $padding = "";

        if ($depth>1)
        {
            $padding = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $depth-1);
        }

        return '<option' . $this->attributes($options) . '>'. $padding . e($display) . '</option>';
    }

    public function attributes($attributes)
    {
        $html = [];

        foreach ((array) $attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    protected function attributeElement($key, $value)
    {

        if (is_numeric($key)) {
            $key = $value;
        }

        if (! is_null($value)) {
            return $key . '="' . e($value) . '"';
        }
    }
}