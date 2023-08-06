<?php

namespace Averotech\Tree;

use Laravel\Nova\Fields\Field;


class Tree extends Field
{
    public $component = 'tree-field';

    public $showOnIndex = false;

    public $fields = [];

    public function fields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function prepareFields()
    {
        return once(function () {
            collect($this->fields)->each(function ($field) {
                $field->resolve(null);
            });
            return $this;
        });
    }


    public function title($title)
    {
        return $this->withMeta(['title' => $title]);
    }

    public function resolve($resource, $attribute = null) 
    {
        $this->prepareFields();
        parent::resolve($resource, $attribute);
    }

    protected function resolveAttribute($resource, $attribute)
    {
        // $this->prepareFields();
        $value = parent::resolveAttribute($resource, $attribute);

        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (!is_array($value)) {
            return [];
        }

        return $value;
    }

    protected function fillAttributeFromRequest($request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = json_decode($request[$requestAttribute], true);
        }
    }

    public function meta()
    {
        return array_merge([
            'fields' => $this->fields,
        ], $this->meta);
    }
}