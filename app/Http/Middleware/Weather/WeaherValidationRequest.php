<?php

namespace App\Http\Middleware\Weather;

use Closure;
use Illuminate\Http\Request;
use Validator;

class WeaherValidationRequest
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'city'        => 'required|max:255',
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    "message"    => $errors->first(),
                    "errors"     => $errors,
                    "error_code" => trans('weather.wrong_request'),
                ],
                400
            );
        }


        return $next($request);
    }
}
