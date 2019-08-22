<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空表
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \Illuminate\Support\Facades\DB::table('model_has_permissions')->truncate();
        \Illuminate\Support\Facades\DB::table('model_has_roles')->truncate();
        \Illuminate\Support\Facades\DB::table('role_has_permissions')->truncate();
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        \Illuminate\Support\Facades\DB::table('roles')->truncate();
        \Illuminate\Support\Facades\DB::table('permissions')->truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        //用户
        $user = \App\Models\User::create([
            'name' => 'admin',
            'nickname' => '超级管理员',
            'email' => 'admin@admin.net',
            'password' => bcrypt('123456'),
            'uuid' => \Faker\Provider\Uuid::uuid()
        ]);

        //角色
        $role = \App\Models\Role::create([
            'name' => 'root',
            'display_name' => '超级管理员'
        ]);

        //权限
        $permissions = [
            [
                'name' => 'system.manage',
                'display_name' => '系统管理',
                'route' => '',
                'icon_id' => '100',
                'child' => [
                    [
                        'name' => 'system.user',
                        'display_name' => '用户管理',
                        'route' => 'admin.user',
                        'icon_id' => '123',
                        'child' => [
                            ['name' => 'system.user.create', 'display_name' => '添加用户','route'=>'admin.user.create'],
                            ['name' => 'system.user.edit', 'display_name' => '编辑用户','route'=>'admin.user.edit'],
                            ['name' => 'system.user.destroy', 'display_name' => '删除用户','route'=>'admin.user.destroy'],
                            ['name' => 'system.user.role', 'display_name' => '分配角色','route'=>'admin.user.role'],
                            ['name' => 'system.user.permission', 'display_name' => '分配权限','route'=>'admin.user.permission'],
                        ]
                    ],
                    [
                        'name' => 'system.role',
                        'display_name' => '角色管理',
                        'route' => 'admin.role',
                        'icon_id' => '121',
                        'child' => [
                            ['name' => 'system.role.create', 'display_name' => '添加角色','route'=>'admin.role.create'],
                            ['name' => 'system.role.edit', 'display_name' => '编辑角色','route'=>'admin.role.edit'],
                            ['name' => 'system.role.destroy', 'display_name' => '删除角色','route'=>'admin.role.destroy'],
                            ['name' => 'system.role.permission', 'display_name' => '分配权限','route'=>'admin.role.permission'],
                        ]
                    ],
                    [
                        'name' => 'system.permission',
                        'display_name' => '权限管理',
                        'route' => 'admin.permission',
                        'icon_id' => '12',
                        'child' => [
                            ['name' => 'system.permission.create', 'display_name' => '添加权限','route'=>'admin.permission.create'],
                            ['name' => 'system.permission.edit', 'display_name' => '编辑权限','route'=>'admin.permission.edit'],
                            ['name' => 'system.permission.destroy', 'display_name' => '删除权限','route'=>'admin.permission.destroy'],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'config.manage',
                'display_name' => '配置管理',
                'route' => '',
                'icon_id' => '28',
                'child' => [
                    [
                        'name' => 'config.system',
                        'display_name' => '站点配置',
                        'route' => 'admin.system',
                        'icon_id' => '25',
                        'child' => [
                            ['name' => 'config.system.create', 'display_name' => '添加配置','route'=>'admin.system.create'],
                            ['name' => 'config.system.edit', 'display_name' => '编辑配置','route'=>'admin.system.edit'],
                            ['name' => 'config.system.destroy', 'display_name' => '删除配置','route'=>'admin.system.destroy']

                        ]
                    ],
                    [
                        'name' => 'config.position',
                        'display_name' => '广告位置',
                        'route' => 'admin.position',
                        'icon_id' => '30',
                        'child' => [
                            ['name' => 'config.position.create', 'display_name' => '添加广告位','route'=>'admin.position.create'],
                            ['name' => 'config.position.edit', 'display_name' => '编辑广告位','route'=>'admin.position.edit'],
                            ['name' => 'config.position.destroy', 'display_name' => '删除广告位','route'=>'admin.position.destroy'],
                        ]
                    ],
                    [
                        'name' => 'config.advert',
                        'display_name' => '广告信息',
                        'route' => 'admin.advert',
                        'icon_id' => '107',
                        'child' => [
                            ['name' => 'config.advert.create', 'display_name' => '添加信息','route'=>'admin.advert.create'],
                            ['name' => 'config.advert.edit', 'display_name' => '编辑信息','route'=>'admin.advert.edit'],
                            ['name' => 'config.advert.destroy', 'display_name' => '删除信息','route'=>'admin.advert.destroy'],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'zixun.manage',
                'display_name' => '资讯管理',
                'route' => '',
                'icon_id' => '100',
                'child' => [
                    [
                        'name' => 'zixun.category',
                        'display_name' => '分类管理',
                        'route' => 'admin.category',
                        'icon_id' => '29',
                        'child' => [
                            ['name' => 'zixun.category.create', 'display_name' => '添加分类','route'=>'admin.category.create'],
                            ['name' => 'zixun.category.edit', 'display_name' => '编辑分类','route'=>'admin.category.edit'],
                            ['name' => 'zixun.category.destroy', 'display_name' => '删除分类','route'=>'admin.category.destroy'],
                        ]
                    ],
                    [
                        'name' => 'zixun.tag',
                        'display_name' => '标签管理',
                        'route' => 'admin.tag',
                        'icon_id' => '15',
                        'child' => [
                            ['name' => 'zixun.tag.create', 'display_name' => '添加标签','route'=>'admin.tag.create'],
                            ['name' => 'zixun.tag.edit', 'display_name' => '编辑标签','route'=>'admin.tag.edit'],
                            ['name' => 'zixun.tag.destroy', 'display_name' => '删除标签','route'=>'admin.tag.destroy'],
                        ]
                    ],
                    [
                        'name' => 'zixun.article',
                        'display_name' => '文章管理',
                        'route' => 'admin.article',
                        'icon_id' => '89',
                        'child' => [
                            ['name' => 'zixun.article.create', 'display_name' => '添加文章','route'=>'admin.article.create'],
                            ['name' => 'zixun.article.edit', 'display_name' => '编辑文章','route'=>'admin.article.edit'],
                            ['name' => 'zixun.article.destroy', 'display_name' => '删除文章','route'=>'admin.article.destroy'],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'products.manage',
                'display_name' => '产品管理',
                'route' => '',
                'icon_id' => '100',
                'child' => [
                    [
                        'name' => 'products.cate',
                        'display_name' => '产品分类',
                        'route' => 'admin.products_cate',
                        'icon_id' => '29',
                        'child' => [
                            ['name' => 'products.cate.create', 'display_name' => '添加产品','route'=>'admin.products_cate.create'],
                            ['name' => 'products.cate.edit', 'display_name' => '编辑产品','route'=>'admin.products_cate.edit'],
                            ['name' => 'products.cate.destroy', 'display_name' => '删除产品','route'=>'admin.products_cate.destroy'],
                        ]
                    ],
                    [
                        'name' => 'products.product',
                        'display_name' => '产品管理',
                        'route' => 'admin.products',
                        'icon_id' => '15',
                        'child' => [
                            ['name' => 'products.product.create', 'display_name' => '添加产品','route'=>'admin.products.create'],
                            ['name' => 'products.product.edit', 'display_name' => '编辑产品','route'=>'admin.products.edit'],
                            ['name' => 'products.product.destroy', 'display_name' => '删除产品','route'=>'admin.products.destroy'],
                        ]
                    ]
                ]
            ],
            [
                'name' => 'crawler.manage',
                'display_name' => '采集管理',
                'route' => '',
                'icon_id' => '100',
                'child' => [
                    [
                        'name' => 'crawler.rule',
                        'display_name' => '规则管理',
                        'route' => 'admin.crawler_rule',
                        'icon_id' => '29',
                        'child' => [
                            ['name' => 'crawler_rule.create', 'display_name' => '添加规则','route'=>'admin.crawler_rule.create'],
                            ['name' => 'crawler_rule.edit', 'display_name' => '编辑规则','route'=>'admin.crawler_rule.edit'],
                            ['name' => 'crawler_rule.destroy', 'display_name' => '删除规则','route'=>'admin.crawler_rule.destroy'],
                        ]
                    ],
                    [
                        'name' => 'crawler.power',
                        'display_name' => '采集列表',
                        'route' => 'admin.crawler_power',
                        'icon_id' => '15',
                        'child' => [
                            ['name' => 'crawler_power.create', 'display_name' => '添加采集','route'=>'admin.crawler_power.create'],
                            ['name' => 'crawler_power.edit', 'display_name' => '编辑采集','route'=>'admin.crawler_power.edit'],
                            ['name' => 'crawler_power.destroy', 'display_name' => '删除采集','route'=>'admin.crawler_power.destroy'],
                        ]
                    ]
                ]
            ],
            [
                'name' => 'member.manage',
                'display_name' => '会员管理',
                'route' => '',
                'icon_id' => '59',
                'child' => [
                    [
                        'name' => 'member.member',
                        'display_name' => '账号管理',
                        'route' => 'admin.member',
                        'icon_id' => '10',
                        'child' => [
                            ['name' => 'member.member.create', 'display_name' => '添加账号','route'=>'admin.member.create'],
                            ['name' => 'member.member.edit', 'display_name' => '编辑账号','route'=>'admin.member.edit'],
                            ['name' => 'member.member.destroy', 'display_name' => '删除账号','route'=>'admin.member.destroy'],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'message.manage',
                'display_name' => '消息管理',
                'route' => '',
                'icon_id' => '24',
                'child' => [
                    [
                        'name' => 'message.message.mine',
                        'display_name' => '我的消息',
                        'route' => 'admin.message.mine',
                        'icon_id' => '124',
                    ],
                    [
                        'name' => 'message.message',
                        'display_name' => '消息管理',
                        'route' => 'admin.message',
                        'icon_id' => '24',
                        'child' => [
                            ['name' => 'message.message.create', 'display_name' => '推送消息','route'=>'admin.message.create'],
                            ['name' => 'message.message.destroy', 'display_name' => '删除消息','route'=>'admin.message.destroy'],
                        ]
                    ],
                ]
            ]
        ];

        foreach ($permissions as $pem1) {
            //生成一级权限
            $p1 = \App\Models\Permission::create([
                'name' => $pem1['name'],
                'display_name' => $pem1['display_name'],
                'route' => $pem1['route']??'',
                'icon_id' => $pem1['icon_id']??1,
            ]);
            //为角色添加权限
            $role->givePermissionTo($p1);
            //为用户添加权限
            $user->givePermissionTo($p1);
            if (isset($pem1['child'])) {
                foreach ($pem1['child'] as $pem2) {
                    //生成二级权限
                    $p2 = \App\Models\Permission::create([
                        'name' => $pem2['name'],
                        'display_name' => $pem2['display_name'],
                        'parent_id' => $p1->id,
                        'route' => $pem2['route']??1,
                        'icon_id' => $pem2['icon_id']??1,
                    ]);
                    //为角色添加权限
                    $role->givePermissionTo($p2);
                    //为用户添加权限
                    $user->givePermissionTo($p2);
                    if (isset($pem2['child'])) {
                        foreach ($pem2['child'] as $pem3) {
                            //生成三级权限
                            $p3 = \App\Models\Permission::create([
                                'name' => $pem3['name'],
                                'display_name' => $pem3['display_name'],
                                'parent_id' => $p2->id,
                                'route' => $pem3['route']??'',
                                'icon_id' => $pem3['icon_id']??1,
                            ]);
                            //为角色添加权限
                            $role->givePermissionTo($p3);
                            //为用户添加权限
                            $user->givePermissionTo($p3);
                        }
                    }

                }
            }
        }

        //为用户添加角色
        $user->assignRole($role);

        //初始化的角色
        $roles = [
            ['name' => 'business', 'display_name' => '商务'],
            ['name' => 'assessor', 'display_name' => '审核员'],
            ['name' => 'channel', 'display_name' => '渠道专员'],
            ['name' => 'editor', 'display_name' => '编辑人员'],
            ['name' => 'admin', 'display_name' => '管理员'],
        ];
        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }

        //生成会员
        factory(\App\Models\User::class,20)->create([
            'password' => bcrypt('123456'),
            'uuid' => \Faker\Provider\Uuid::uuid()
        ]);
    }
}
