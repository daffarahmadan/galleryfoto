<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function respondToSubmission(Request $request, $id)
{
    $submission = AlbumSubmision::findOrFail($id);

    // Proses pengajuan berdasarkan aksi yang diambil oleh admin
    if ($request->action === 'approve') {
        // Setujui pengajuan
        $submission->update(['status' => 'approved']);
    } elseif ($request->action === 'reject') {
        // Tolak pengajuan
        $submission->update(['status' => 'rejected']);
    }

    return redirect()->back()->with('success', 'Pengajuan album dan foto telah diperbarui.');
}
}
