<?php
/*
namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Role;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     /
    public function handle($request, Closure $next, ... $roles)
    {

        // return $next($request);
        if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect('login');

        $user = Auth::user(); // OR $request->user();

        if ($user && count($user) > 0) {

            // if($user->isAdmin()){
            //     return $next($request);
            // }

            foreach($roles as $role) {
                $role = Role::whereName($role)->first();
                // Check if user has the role This check will depend on how your roles are set up
                $checkRole = 0;
                if ($role) {

                    $roleId = $role->id;
                    
                    if($user->isAdmin() && $roleId === 1){
                        $checkRole = 1;
                    }
                    elseif($user->role_id === $roleId && $roleId === 2){
                        $checkRole = 1;
                    }
                     elseif($user->role_id === $roleId && $roleId === 3)
                    {
                        $checkRole = 1;
                    }
                    elseif($user->role_id === $roleId && $roleId === 4)
                    {
                        $checkRole = 1;
                    }
                    elseif($user->role_id === $roleId && $roleId === 5)
                    {
                        $checkRole = 1;
                    }
                }
                
                if($checkRole == 1)
                    return $next($request);
                else
                   return abort(401);
            }
        }

        return redirect('login');
    }
}
*/

/**
<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     /
    public function handle($request, Closure $next, $role='')
    {

        // return $next($request);
        if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect('login');

        $user = Auth::user();

        // if($user->isAdmin())
        //     return $next($request);

        $checkRole = 0;
        if($user->hasRole($role)){
            if($role =='administrator')
            {
                $checkRole = 1;
            }
            elseif($role == 'supervisor')
            {
                $checkRole = 1;
            }
            elseif($role == 'editor')
            {
                $checkRole = 1;
            }
            elseif($role == 'auditor')
            {
                $checkRole = 1;
            }
            elseif($role == 'viewer')
            {
                $checkRole = 1;
            }
        }
        if($checkRole === 1)
            return $next($request);
        else
           return abort(401);
        
        return redirect('login');
    }
}
*/ 

