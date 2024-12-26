<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\Exceptions\DropboxClientException;


class DropboxController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        $file = $request->file('file');
        $filePath = 'laporan/' . $file->getClientOriginalName();

        Storage::disk('dropbox')->put($filePath, file_get_contents($file));

        return response()->json([
            'message' => 'File berhasil diunggah ke Dropbox!',
            'path' => $filePath,
        ]);
    }

    protected $dropbox;

    public function __construct()
    {
        $app = new DropboxApp(
            env('DROPBOX_APP_KEY'),
            env('DROPBOX_APP_SECRET'),
            env('DROPBOX_ACCESS_TOKEN') // Optional: set manually
        );

        $this->dropbox = new Dropbox($app);
    }

    // Step 1: Redirect to Dropbox Authorization URL
    public function authorize()
    {
        $authHelper = $this->dropbox->getAuthHelper();
        $authUrl = $authHelper->getAuthUrl(env('DROPBOX_REDIRECT_URI'));
        return redirect($authUrl);
    }

    // Step 2: Handle Callback and Save Tokens
    public function callback(Request $request)
    {
        $authHelper = $this->dropbox->getAuthHelper();

        // Exchange code for access token
        $accessToken = $authHelper->getAccessToken($request->get('code'), env('DROPBOX_REDIRECT_URI'));

        // Save Access and Refresh Tokens
        $refreshToken = $accessToken->getRefreshToken();
        $accessTokenString = $accessToken->getToken();

        // Save tokens to .env or database
        file_put_contents(base_path('.env'), "\nDROPBOX_ACCESS_TOKEN=" . $accessTokenString, FILE_APPEND);
        file_put_contents(base_path('.env'), "\nDROPBOX_REFRESH_TOKEN=" . $refreshToken, FILE_APPEND);

        return redirect()->route('home')->with('success', 'Dropbox connected successfully.');
    }


    public function uploadReport(Request $request)
    {
        try {
            $file = $request->file('report');
            $filePath = $file->getRealPath();
            $dropboxPath = '/laporan/' . $file->getClientOriginalName();

            $this->dropbox->upload($filePath, $dropboxPath, ['autorename' => true]);
            return back()->with('success', 'Laporan berhasil diupload ke Dropbox!');
        } catch (DropboxClientException $e) {
            // Jika token expired, perbarui token
            $authHelper = $this->dropbox->getAuthHelper();
            $newAccessToken = $authHelper->refreshAccessToken(env('DROPBOX_REFRESH_TOKEN'));

            // Simpan token baru
            file_put_contents(base_path('.env'), "\nDROPBOX_ACCESS_TOKEN=" . $newAccessToken->getToken(), FILE_APPEND);

            return back()->with('error', 'Access token diperbarui, coba lagi.');
        }
    }

    public function listFiles()
    {
        $files = $this->dropbox->listFolder('/laporan')->getItems();
        return view('laporan.index', ['files' => $files]);
    }


}
