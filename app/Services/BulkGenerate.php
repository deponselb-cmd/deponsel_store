public function store(Request $request)
{
    $package = HotspotPackage::find($request->package_id);
    $mikrotik = new MikrotikService();
    $qty = $request->quantity; // Jumlah voucher yang mau dibuat

    for ($i = 0; $i < $qty; $i++) {
        $code = Str::random(6); // Menghasilkan kode unik 6 karakter
        
        // Kirim ke Mikrotik
        $mikrotik->generateVoucher(
            $code, 
            $package->profile_name, 
            $package->limit_uptime, 
            "NetBill-Batch-" . date('Ymd')
        );
    }

    return back()->with('success', "$qty Voucher berhasil dibuat!");
}