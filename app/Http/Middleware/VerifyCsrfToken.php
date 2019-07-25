<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
      'category/*',
      'product/*',
      'orders/*',
      'payment/*',
      'canceled_orders/*',
      'sub-category/*',
      'admin/contact_us/*',
      'accounts/*',
      'account/*',
      'delivered/order/*',
      'carousel/*',
      'refund/*'
    ];
}
