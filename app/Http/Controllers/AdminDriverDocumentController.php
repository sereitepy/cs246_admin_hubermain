<?php

namespace App\Http\Controllers;

use App\Models\DriverDocument;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDriverDocumentController extends Controller
{
    public function index()
    {
        // Get all drivers who have documents
        $drivers = User::where('role', 'driver')
            ->whereHas('driverDocuments')
            ->with('driverDocuments')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.driver_documents.index', compact('drivers'));
    }

    public function show($id)
    {
        $driver = User::where('role', 'driver')->findOrFail($id);
        $driverDocument = DriverDocument::where('user_id', $driver->id)->first();

        return view('admin.driver_documents.show', compact('driver', 'driverDocument'));
    }

    public function verify($id)
    {
        $driver = User::where('role', 'driver')->findOrFail($id);
        $driver->update(['is_verified' => true]);

        return redirect()->route('admin.driver_documents.show', $driver->id)
            ->with('success', 'Driver has been verified successfully!');
    }

    public function unverify($id)
    {
        $driver = User::where('role', 'driver')->findOrFail($id);
        $driver->update(['is_verified' => false]);

        return redirect()->route('admin.driver_documents.show', $driver->id)
            ->with('success', 'Driver verification has been revoked.');
    }

    public function create()
    {
        $drivers = User::where('role', 'driver')->get();
        return view('admin.driver_documents.create', compact('drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id'                  => 'required|exists:users,id',
            'driver_license_file'        => 'nullable|file|image',
            'vehicle_registration_file'  => 'nullable|file|image',
            'insurance_certificate_file' => 'nullable|file|image',
            'vehicle_photo_1'            => 'nullable|file|image',
            'vehicle_photo_2'            => 'nullable|file|image',
            'vehicle_photo_3'            => 'nullable|file|image',
        ]);

        $data = ['user_id' => $request->driver_id];

        foreach (['driver_license_file', 'vehicle_registration_file', 'insurance_certificate_file', 'vehicle_photo_1', 'vehicle_photo_2', 'vehicle_photo_3'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('driver_documents', 'spaces');
            }
        }

        DriverDocument::updateOrCreate(['user_id' => $request->driver_id], $data);

        return redirect()->route('admin.driver_documents.index')
            ->with('success', 'Driver documents saved successfully');
    }

    public function update(Request $request, $id)
    {
        $document = DriverDocument::findOrFail($id);

        $request->validate([
            'driver_license_file'        => 'nullable|file|image',
            'vehicle_registration_file'  => 'nullable|file|image',
            'insurance_certificate_file' => 'nullable|file|image',
            'vehicle_photo_1'            => 'nullable|file|image',
            'vehicle_photo_2'            => 'nullable|file|image',
            'vehicle_photo_3'            => 'nullable|file|image',
        ]);

        $data = [];

        foreach (['driver_license_file', 'vehicle_registration_file', 'insurance_certificate_file', 'vehicle_photo_1', 'vehicle_photo_2', 'vehicle_photo_3'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('driver_documents', 'spaces');
            }
        }

        $document->update($data);

        return redirect()->route('admin.driver_documents.show', $document->user_id)
            ->with('success', 'Driver documents updated successfully');
    }

    public function edit($id)
    {
        $document = DriverDocument::findOrFail($id);
        return view('admin.driver_documents.edit', compact('document'));
    }

    public function destroy($id)
    {
        $document = DriverDocument::findOrFail($id);
        $document->delete();
        return redirect()->route('admin.driver_documents.index')->with('success', 'Driver document deleted successfully');
    }
}
