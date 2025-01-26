<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class StoreScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Verifica si el usuario está autenticado (Single Store)
        // if (auth()->check()) {
        //     // Obtén el store_id desde la relación role_user del usuario autenticado
        //     $user = auth()->user();
        //     $storeId = $user->stores()->pluck('store_id')->first();

        //     if ($storeId) {
        //         $builder->where('store_id', $storeId);
        //     }
        // }

        //Multiple Store
        if (auth()->check()) {
            $user = auth()->user();
            $storeIds = $user->stores()->pluck('store_id')->toArray(); // Todas las tiendas del usuario

            if (!empty($storeIds)) {
                $builder->whereIn('store_id', $storeIds);
            }
        }
        
    }
}
