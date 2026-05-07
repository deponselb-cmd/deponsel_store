<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WhatsappService;

class CustomerController extends Controller
{
    public function submit(Request $request)
    {
        $nama = $request->nama;
        $paket = $request->paket;
        $nomor = $request->nomor;

        // Simpan database
        // Customer::create([...]);

        // Pesan admin
        $pesanAdmin = "
📥 CUSTOMER BARU

👤 Nama: $nama
📦 Layanan: $Layanan
📱 Nomor: $nomor
";

        // Kirim ke admin
        WhatsappService::send(
            '6282187784111',
            $pesanAdmin
        );

        // Balas otomatis ke customer
        $pesanCustomer = "
Halo $nama 👋

Terima kasih sudah mendaftar layanan internet kami.

Tim kami akan segera menghubungi Anda.
";

        WhatsappService::send(
            $nomor,
            $pesanCustomer
        );

        return response()->json([
            'success' => true,
            'message' => 'Form berhasil dikirim'
        ]);
    }
}
