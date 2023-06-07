<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\GptApiKeyRequest;
use App\Models\GptApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GptApiKeyController extends Controller
{
    public function index()
    {
        return view('pages.settings.gpt-api-keys', [
            'api_keys' => Auth::user()->gptApiKeys()->get()
        ]);
    }

    public function create(GptApiKeyRequest $request)
    {
        /** Если новый ключ активный - снимаем статус активного у прошлого ключа */
        if ($request->active) {
            $active_api_key = Auth::user()->getActiveGptApiKey();
            $active_api_key?->update(['active' => 0]);
            $request->active = true;
        } else {
            $request->active = false;
        }

        GptApiKey::create([
            'name' => $request->name,
            'key' => $request->key,
            'active' => $request->active,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('settings.gpt-api-keys');
    }

    public function update()
    {
    }
}
