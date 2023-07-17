<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\GptCommonSettingRequest;
use App\Models\GptParserUserSetting;
use App\Models\GptParserDefaultSetting;
use Illuminate\Support\Facades\Auth;

class GptParserUserSettingController extends Controller
{
   public function index()
   {
      /** 
       * Получаем настройки по умолчанию и настройки пользователя
       * Объединяем их и отправляем
       */
      $default_settings = GptParserDefaultSetting::get();
      $user_settings = Auth::user()->userSettings->keyBy('default_setting_id');

      foreach ($default_settings as $default_setting) {
         if (isset($user_settings[$default_setting->id])) {
            $default_setting->user_value = $user_settings[$default_setting->id]->value;
         }
      }

      return view('pages.settings.gpt-common-settings', [
         'default_settings' => $default_settings,
         'user_settings' => $user_settings
      ]);
   }

   public function update(GptCommonSettingRequest $request)
   {
      $user = Auth::user();

      // Стандартные настройки из таблицы gpt_parser_default_settings
      foreach (['temperature', 'max_tokens'] as $default_setting_key) {
         // Нашли настройку 
         $default_setting = GptParserDefaultSetting::where('key', $default_setting_key)->first();

         /**
          * Если значение пустое - удалить настройку у пользователя
          * Иначе обновить данные
          */
         $request_value = $request->{$default_setting_key};
         if (!$request_value) {

            $user_setting = GptParserUserSetting::where('default_setting_id', $default_setting->id)->first();
            if ($user_setting) {
               $user_setting->delete();
            }

            continue;
         } else {
            GptParserUserSetting::updateOrCreate(
               [
                  'default_setting_id' => $default_setting->id,
                  'user_id' => $user->id
               ],
               [
                  'value' => $request_value,
               ]
            );
         }
      }

      return redirect()->route('settings.common')->withErrors($request->validator);
   }
}
