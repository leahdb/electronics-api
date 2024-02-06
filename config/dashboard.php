<?php

use App\Models\BankAccount;
use App\Models\ShopUser;
use App\Models\Shop;

return [

    'menus' => [
        // 'common' => [
        //     ['title' => 'Dashboard', 'link' => '/admin', 'order' => 1],
        //     ['title' => 'Support', 'link' => '/admin/support', 'order' => 29],
        //     ['title' => 'Settings', 'submenu' => [
        //             ['title' => 'Account Manager', 'link' => '/admin/account-manager', 'order' => 1],
        //             ['title' => 'Profile Settings', 'link' => '/admin/settings/user', 'order' => 2],
        //             ['title' => 'Shop Settings', 'link' => '/admin/settings/shop', 'order' => 3],
        //         ], 'order' => 28
        //     ],
        // ],
        ShopUser::ROLE_SUPER_ADMIN => [
            ['title' => 'Dashboard', 'link' => '/admin'],
            ['title' => 'Products', 'link' => '/admin/products/list'],
            ['title' => 'Orders', 'link' => '/admin/orders/list'],
            ['title' => 'Support', 'link' => '/admin/support'],
        ],
    ],
    // 'settings' => [
    //     'loading' => false,
    //     'activeTab' => 'user',
    //     'documentFieldNames' => [
    //         'user' => [DashboardUser::ATTR_PICTURE, DashboardUser::ATTR_GOVERNMENT_ID],
    //         'shop' => [Shop::ATTR_SHOP_NUMBER, Shop::ATTR_TRADE_LICENSE],
    //     ],
    //     'settings' => [
    //         'user' => [
    //             'label' => 'Profile Settings',
    //             'type' => 'dynamic',
    //             'groups' => [
    //                 [
    //                     'title' => 'PERSONAL INFO',
    //                     'groupIdentifier' => 'user',
    //                     'fields' => [
    //                         DashboardUser::ATTR_FIRST_NAME => ['label' => 'First Name', 'placeholder' => 'John',  'type' => 'text', 'required' => true],
    //                         DashboardUser::ATTR_LAST_NAME => ['label' => 'Last Name', 'placeholder' => 'Doe', 'type' => 'text', 'required' => false],
    //                         DashboardUser::ATTR_EMAIL => ['label' => 'Email', 'placeholder' => 'example@domain.com', 'type' => 'email', 'required' => false],
    //                         DashboardUser::ATTR_PHONE_NUMBER_FULL => ['label' => 'Mobile Number', 'placeholder' => 'Mobile Number', 'type' => 'phone', 'required' => false],
    //                         DashboardUser::ATTR_PICTURE => ['label' => 'Profile Picture', 'placeholder' => '', 'type' => 'image', 'required' => false],
    //                         DashboardUser::ATTR_GOVERNMENT_ID => ['label' => 'Government ID', 'placeholder' => '', 'type' => 'pdf', 'required' => false],
    //                         'id' => ['label' => '', 'placeholder' => '', 'type' => 'paragraph', 'required' => false]
    //                     ],
    //                 ],
    //                 [
    //                     'title' => 'CHANGE PASSWORD',
    //                     'groupIdentifier' => 'passwords',
    //                     'fields' => [
    //                         'password' => ['label' => 'Old Password', 'placeholder' => 'Old Password', 'type' => 'password', 'required' => true],
    //                         'new_password' => ['label' => 'New Password', 'placeholder' => 'New Password', 'type' => 'password', 'required' => true],
    //                         'new_password_confirmation' => ['label' => 'Confirm Password', 'placeholder' => 'Confirm Password', 'type' => 'password', 'required' => true],
    //                     ],
    //                 ],
    //                 [
    //                     'title' => 'FINANCIAL DETAILS',
    //                     'groupIdentifier' => 'bank',
    //                     'fields' => [
    //                         BankAccount::ATTR_BANK_NAME => ['label' => 'Bank Name', 'placeholder' => 'Bank Name', 'type' => 'text', 'required' => false],
    //                         BankAccount::ATTR_ACCOUNT_CATEGORY => ['label' => 'Category', 'placeholder' => 'Category', 'type' => 'select', 'options' => [
    //                             ['label' => 'Personal Account', 'value' => 'personal'],
    //                             ['label' => 'Company Account', 'value' => 'business']
    //                         ], 'required' => false],
    //                         BankAccount::ATTR_ACCOUNT_NUMBER => ['label' => 'Account Number', 'placeholder' => '_ _ _ _   _ _ _ _  _ _ _ _    _ _ _ _ ', 'type' => 'text', 'required' => false],
    //                         BankAccount::ATTR_ACCOUNT_IBAN => ['label' => 'Account IBAN', 'placeholder' => 'EX: AL35202111090000000001234567 ', 'type' => 'text', 'required' => false],
    //                     ],
    //                 ],
    //             ],
    //         ],
    //         'shop' => [
    //             'label' => 'Shop Settings',
    //             'type' => 'dynamic',
    //             'groups' => [
    //                 [
    //                     'title' => 'SHOP INFO',
    //                     'groupIdentifier' => 'shop',
    //                     'fields' => [
    //                         Shop::ATTR_NAME => ['label' => 'Shop Name', 'type' => 'text', 'required' => true],
    //                         Shop::ATTR_PHONE_NUMBER => ['label' => 'Contact Number', 'type' => 'phone', 'required' => true],
    //                         Shop::ATTR_DESCRIPTION => ['label' => 'Shop Description', 'type' => 'textarea', 'required' => false, 'containerClass' => 'col-md-12 mb-2'],
    //                         Shop::ATTR_LOGO => ['label' => 'Shop Logo', 'type' => 'image', 'required' => false],
    //                         Shop::ATTR_TRADE_LICENSE => ['label' => 'Trade License', 'type' => 'image', 'required' => false],
    //                         'id' => ['label' => '', 'placeholder' => '', 'type' => 'paragraph', 'required' => false]
    //                     ],
    //                 ],
    //             ],
    //         ],
    //     ],
    // ]
];
