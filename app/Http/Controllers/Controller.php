<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerFormController extends Controller
{
    public function submit(Request $request)
    {
        // Simpan database
        // Customer::create([...]);

        $nama = $request->namalengkap;
        $pesan = $request->pesan;
        $layanan = $request->jenislayanan;

        // Kirim Telegram
        Http::post(
            "https://api.telegram.org/botTOKEN/sendMessage",
            [
                'chat_id' => '7318840466:AAE_hqruNxhwyEekXNSCLFhtMcNnAh1nokA',
                'text' => "Form baru masuk!\n\nNama: $nama\nPesan: $pesan\nlayanan: $layanan"
            ]
        );

        return response()->json([
            'success' => true
        ]);
    }
}
