<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class LegalController extends Controller
{
    /**
     * Display privacy policy page
     */
    public function privacyPolicy(): View
    {
        return view('auth.privacy-policy');
    }

    /**
     * Display terms & conditions page
     */
    public function termsAndConditions(): View
    {
        return view('auth.terms-and-conditions');
    }
}
