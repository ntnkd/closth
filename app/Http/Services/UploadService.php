<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;



class UploadService
{
    // public function store($request)
    // {
    //     if ($request->hasFile('file') && $request->file('file')->isValid()) {
    //         try {
    //             $name = $request->file('file')->getClientOriginalName();
    //             $path = $request->file('file')->storeAs(
    //                 'public/upload/' . date('Y-m-d'),
    //                 $name
    //             );

    //             return response()->json([
    //                 'success' => true,
    //                 'path' => $path,
    //                 'url' => Storage::url($path)
    //             ]);
    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Lỗi khi lưu tệp: ' . $e->getMessage()
    //             ], 500);
    //         }
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Không có tệp nào được tải lên hoặc tệp không hợp lệ'
    //     ], 400);
    // }
    public function store($request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Validate file
                if (!$file->isValid()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'File không hợp lệ'
                    ], 400);
                }

                // Generate unique filename
                // $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();

                $pathFull = 'uploads/' . date('Y/m/d'); // Đường dẫn trong storage/app/public
                // Store file trong public disk
                $path = $file->storeAs(
                    $pathFull,
                    $filename,
                    'public' // Disk name
                );

                if ($path) {
                    // Tạo URL cho file
                    $url = Storage::disk('public')->url($path);

                    // Log để debug
                    Log::info('File uploaded:', [
                        'path' => $path,
                        'url' => $url,
                        'full_path' => storage_path('app/public/' . $path)
                    ]);

                    // Kiểm tra file có tồn tại không
                    if (Storage::disk('public')->exists($path)) {
                        return response()->json(['url' => 'storage/' . $path ]);
                    } else {
                        return response()->json(['message' => 'File không được lưu thành công'], 500);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không thể lưu file'
                    ], 500);
                }
            }

            return response()->json([
                'error' => 'Không có file nào được upload'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Upload error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Lỗi server: ' . $e->getMessage()
            ], 500);
        }
    }
}
