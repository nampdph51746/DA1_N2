<?php
namespace App\Services;
use App\Models\User;
class Authorization{
    private static $rolePermissions = [
        'admin' => ['view_any', 'create_any', 'edit_any', 'delete_any'],
        'editor' => ['view_any', 'create_any', 'edit_any'],
        'customer' => []
    ];

    private static function getCurrentUser(){
        session_start();
        // $userId = $_SESSION['user_id'] ?? null;
        // if($userId){
        //     return User::find($userId);
        // }
        // return null;
        return $_SESSION['user'] ?? null;
    }

    public static function can($permission){
        $user = self::getCurrentUser();
        if(!$user || empty($user->role)){
            return false;
        }

        $role = $user->role;
        return in_array($permission, self::$rolePermissions[$role] ?? []);
    }
}
?>