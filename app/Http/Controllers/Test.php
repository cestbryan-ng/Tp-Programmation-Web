<?php

namespace App\Http\Controllers;


class Test extends Controller
{
        /**
     * @OA\Get(
     *     path="/api/test",
     *     summary="Route de test",
     *     @OA\Response(
     *         response=200,
     *         description="Test OK"
     *     )
     * )
     */
    public function test() {
        return response()->noContent(200);
    }
}
