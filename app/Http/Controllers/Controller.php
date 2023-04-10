<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Redirect ke route tertentu dengan menampilkan pesan sukses
    protected function successRedirect($route, $message, $parameters = [])
    {
        return Helper::redirectSuccessMessageResponse($route, $message, $parameters);
    }

    // Redirect ke route tertentu dengan menampilkan pesan peringatan
    protected function warningRedirect($route, $message, $parameters = [])
    {
        return Helper::redirectWarningMessageResponse($route, $message, $parameters);
    }

    // Redirect ke route tertentu dengan menampilkan pesan kesalahan
    protected function errorRedirect($route, $message, $parameters = [])
    {
        return Helper::redirectErrorMessageResponse($route, $message, $parameters);
    }

    // Redirect kembali ke halaman sebelumnya dengan menampilkan pesan kesalahan
    protected function errorRedirectBack($message)
    {
        return Helper::redirectBackErrorMessageResponse($message);
    }
}
