<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{

    public function __construct(\Illuminate\Database\Eloquent\Model $resource)
    {
        parent::__construct($resource);

        return $resource->subDepartment;
    }



    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public static function tree()
    {
        // 我这里默认把 users 给加上去了，大家可以根据自己的需求来决定
        $departments = Department::with('users')->get();

        return self::departmentsTree($departments, \collect([]));
    }

    protected static function departmentsTree(Collection $departments, Collection $parents)
    {
        $departments->map(function ($department, $key) use ($departments, $parents) {
            $department->children = \collect([]);

            if (empty($department->parent_id)) {
                $parents->push($department);

                $departments->forget($key);
            }

            $parents->map(function ($parentDepartment, $parentKey) use ($key, $department, $departments, $parents) {
                if ($department->parent_id == $parentDepartment->id) {
                    $parents->get($parentKey)->children->push($department);

                    $departments->forget($key);
                }
            });
        });

        $parents->map(function ($parentDepartment, $key) use ($departments, $parents) {
            if ($parentDepartment->children->isNotEmpty()) {
                $parents->get($key)->children = self::departmentsTree($departments, $parentDepartment->children);
            }
        });

        return $parents;
    }
}
