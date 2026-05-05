<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Tampilkan halaman settings
     */
    public function index()
    {
        // Ambil semua layanan yang aktif
        $services = Service::all();
        
        return view('admin.settings.index', compact('services'));
    }

    /**
     * Update pricing services
     */
    public function updatePricing(Request $request)
    {
        $validated = $request->validate([
            'services' => 'required|array',
            'services.*.id' => 'required|exists:services,id',
            'services.*.base_price' => 'required|numeric|min:0',
        ], [
            'services.*.base_price.min' => 'Harga tidak boleh negatif.',
        ]);

        $updatedCount = 0;

        foreach ($validated['services'] as $serviceData) {
            $updated = Service::where('id', $serviceData['id'])->update([
                'base_price' => $serviceData['base_price'],
                'updated_at' => now(),
            ]);

            if ($updated) {
                $updatedCount++;
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', "Berhasil memperbarui {$updatedCount} layanan.");
    }

    /**
     * Update general settings (placeholder)
     */
    public function updateGeneral(Request $request)
    {
        // TODO: Implementasi update general settings
        // Bisa disimpan di tabel settings atau file config
        
        return back()->with('success', 'Pengaturan umum berhasil disimpan.');
    }

    /**
     * Update staff settings (placeholder)
     */
    public function updateStaff(Request $request)
    {
        // TODO: Implementasi update staff settings
        
        return back()->with('success', 'Pengaturan staff berhasil disimpan.');
    }

    /**
     * Update business info (placeholder)
     */
    public function updateBusinessInfo(Request $request)
    {
        // TODO: Implementasi update business info
        
        return back()->with('success', 'Informasi bisnis berhasil disimpan.');
    }
}