
public function generateVoucher($code, $profile, $limitUptime, $comment)
{
    if (!$this->client) return false;

    $request = new RouterOS\Request('/ip/hotspot/user/add');
    $request->setArgument('name', $code);
    $request->setArgument('password', $code); // Password disamakan dengan kode
    $request->setArgument('profile', $profile);
    $request->setArgument('limit-uptime', $limitUptime);
    $request->setArgument('comment', $comment);

    try {
        $this->client->sendSync($request);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}
