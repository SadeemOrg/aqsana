<?php

namespace Averotech\Link;
use Laravel\Nova\Nova;
use Laravel\Nova\Fields\Field;

class Link extends Field
{
    public $component = 'link-field';

    public $resources;

    public function resources($resources)
    {
        $this->resources = collect($resources)->map(function($resource) {
            $res = new $resource([]);
            return [
                'resource' => $resource,
                'label' => $res->label(),
                'key' => $res->uriKey(),
            ];
        });

        return $this->withMeta([
            'resources' => $this->resources
        ]);
    }

    protected function resolveAttribute($resource, $attribute)
    {
        $value = parent::resolveAttribute($resource, $attribute);

        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (!is_array($value)) {
            $value = [];
        }

        if (!isset($value['resource'])) {
            $value['resource'] = '';
        }

        if (!isset($value['id'])) {
            $value['id'] = '';
        }

        return $value;
    }
}
