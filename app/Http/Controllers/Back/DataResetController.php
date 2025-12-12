<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DataResetController extends Controller
{
    public function resetDB(Request $request)
    {
        if ($request->checkOnly) {
            $valid = Hash::check($request->password, auth()->user()->password);
            return response()->json(['valid' => $valid]);
        }

        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->with('error', 'Password salah!');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $tables = [
            'registrasis',
            'ruangans',
            'menus',
            'menu_categories',
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return back()->with('success', 'Database berhasil direset!');
    }
}
