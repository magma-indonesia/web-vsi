<?php

namespace App;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\MessageBag;

class Helper
{
    // Redirect ke route tertentu dengan menampilkan pesan sukses
    public static function redirectSuccessMessageResponse($route, $message, array $parameters = [])
    {
        $message = is_array($message) ? $message : [$message];

        return redirect()->route($route, $parameters)->withSuccess(new MessageBag($message));
    }

    // Redirect ke route tertentu dengan menampilkan pesan peringatan
    public static function redirectWarningMessageResponse($route, $message, array $parameters = [])
    {
        $message = is_array($message) ? $message : [$message];

        return redirect()->route($route, $parameters)->withWarning(new MessageBag($message));
    }

    // Redirect ke route tertentu dengan menampilkan pesan kesalahan
    public static function redirectErrorMessageResponse($route, $message, array $parameters = [])
    {
        if ($message instanceof QueryException) {
            $message = [config('app.debug') ? $message->getMessage() : 'Terjadi kesalahan proses pada sistem!. Silahkan kontak Admin.'];
        } else if ($message instanceof Exception) {
            $message = [$message->getMessage()];
        }

        logger()->debug($message);

        $message = is_array($message) ? $message : [$message];

        return redirect()->route($route, $parameters)->withErrors(new MessageBag($message));
    }

    // Redirect kembali ke halaman sebelumnya dengan menampilkan pesan kesalahan
    public static function redirectBackErrorMessageResponse($message)
    {
        if ($message instanceof QueryException) {
            $message = [config('app.debug') ? $message->getMessage() : 'Terjadi kesalahan proses pada sistem!. Silahkan kontak Admin.'];
        } else if ($message instanceof Exception) {
            $message = [$message->getMessage()];
        }

        logger()->debug($message);

        $message = is_array($message) ? $message : [$message];

        return redirect()->back()->withInput()->withErrors(new MessageBag($message));
    }
}
