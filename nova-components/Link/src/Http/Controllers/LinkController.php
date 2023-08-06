<?php

namespace Averotech\Link\Http\Controllers;


use Laravel\Nova\Http\Requests\ResourceIndexRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Routing\Controller;
use Laravel\Nova\Fields\FormatsRelatableDisplayValues;

class LinkController extends Controller
{
	use FormatsRelatableDisplayValues;

	public $display;

    public function resources($resource, ResourceIndexRequest $request)
    {        
        $paginator = $this->paginator(
            $request, $resource = $request->resource()
        );

    	return $paginator->getCollection()->mapInto($resource)->map(function($resource) use ($request) {
    		return [
	            'avatar' => $resource->resolveAvatarUrl($request),
	            'display' => $this->formatDisplayValue($resource),
	            'value' => $resource->getKey(),
    		];
    	});
    }



    protected function paginator(ResourceIndexRequest $request, $resource)
    {
        return $request->toQuery()->simplePaginate(
            $request->viaRelationship()
                        ? $resource::$perPageViaRelationship
                        : ($request->perPage ?? $resource::perPageOptions()[0])
        );
    }
}
