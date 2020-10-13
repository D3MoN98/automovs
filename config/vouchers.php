<?php

return [

    /*
     * Database table name that will be used in migration
     */
    'table' => 'coupons',

    /*
     * Database pivot table name for coupons and users relation
     */
    'relation_table' => 'user_coupons',

    /*
     * List of characters that will be used for coupon code generation.
     */
    'characters' => '23456789ABCDEFGHJKLMNPQRSTUVWXYZ',

    /*
     * coupon code prefix.
     *
     * Example: foo
     * Generated Code: foo-AGXF-1NH8
     */
    'prefix' => null,

    /*
     * coupon code suffix.
     *
     * Example: foo
     * Generated Code: AGXF-1NH8-foo
     */
    'suffix' => null,

    /*
     * Code mask.
     * All asterisks will be removed by random characters.
     */
    'mask' => '****-****',

    /*
     * Separator to be used between prefix, code and suffix.
     */
    'separator' => '-',

    /*
     * The user model that belongs to coupons.
     */
    'user_model' => \App\User::class,
];