<?php
namespace App;
class RoleList{
    //XXX roles
    public static $roles=[
        'Super Admin',
        'Admin',
        'Teacher',
        'Accountant',
        'Staff',
        'Student'
    ];
    //XXX Permissions 
    public static $permissions=[
        'setup'=>[
            //XXX manage level
            'manage_level'=>'10001',
            'add_level'=>'10002',
            'update_level'=>'10003',
            'delete_level'=>'10004',
            'add_section'=>'10006',
            'update_section'=>'10007',
            'delete_section'=>'10008', 
            
        ],
    ];
}