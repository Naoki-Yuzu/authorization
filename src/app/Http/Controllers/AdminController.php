<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // ゲートを使用した認可
    public function viewAdminPageForGate(Request $request): JsonResponse
    {
        $this->authenticate($request);

        if (!Gate::allows('view-admin-page')) {
            return response()->json(['message' => '未認可']);
        }

        return response()->json(['message' => '認可済み']);
    }

    // ポリシーを使用した認可
    public function deleteUserForPolicy(Request $request): JsonResponse
    {
        $this->authenticate($request);
        /** @var User $user */
        $user = Auth::user();


        // モデル経由パターン
        if (!$user->can('deleteAnotherUsers', $user)) {
            return response()->json(['message' => '未認可 via Userモデル']);
        }

        // Gateファサード経由パターン
        // Gate::authorize('deleteAnotherUsers', $user);

        return response()->json(['message' => '認可済み']);
    }

    private function authenticate(Request $request): ?JsonResponse
    {
        $credentials = $request->all();

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => '未認証']);
        }

        return null;
    }
}
