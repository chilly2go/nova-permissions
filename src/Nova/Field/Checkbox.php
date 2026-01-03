<?php

namespace chilly2go\NovaPermissions\Nova\Field;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Checkbox extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'permission-checkboxes';

    public function __construct($name, $attribute = null, ?callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->withMeta(['translation_prefix' => config('nova-permissions.translation_prefix')]);
    }

    /**
     * Specify the available options
     */
    public function options(array $options): Checkbox
    {
        return $this->withMeta(['options' => $options]);
    }

    /**
     * Disable type casting of array keys to numeric values to return the unmodified keys.
     */
    public function withGroups(): Checkbox
    {
        return $this->withMeta(['withGroups' => true]);
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute): void
    {
        if ($request->exists($requestAttribute)) {
            /**
             * When editing entries, they are returned as comma seperated string (unsure why).
             * As a result we need to include this check and explode the values if required.
             */
            $permissions = [];
            if (! is_array($choices = $request[$requestAttribute])) {
                $permissions = collect(explode(',', $choices))->reject(function ($name) {
                    return empty($name);
                })->all();
            }

            $model->syncPermissions($permissions);
        }
    }
}
