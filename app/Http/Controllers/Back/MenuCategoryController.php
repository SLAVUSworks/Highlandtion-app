<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $menuCategories = MenuCategory::all();
        return view('back.menu-category.index', compact('menuCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $recentEntry = MenuCategory::where('name', $request->name)
            ->where('created_at', '>=', now()->subSeconds(2))
            ->first();
    
        if ($recentEntry) {
            return back()->with('error', 'Kategori ini baru saja ditambahkan!');
        }
    
        $iconPath = $request->file('icon')->store('menu-icons', 'public');
    
        MenuCategory::create([
            'name' => $request->name,
            'icon' => $iconPath,
        ]);
    
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }
    

    public function update(Request $request, $id)
    {
        $category = MenuCategory::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('icon')) {

            if (!empty($category->icon)) {
                @unlink(storage_path('app/public/' . $category->icon));
            }

            $icon = $request->file('icon');

            $allowedFileTypes = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
            $extension = strtolower($icon->getClientOriginalExtension());

            if (!in_array($extension, $allowedFileTypes)) {
                return back()
                    ->withErrors(['icon' => 'Icon must be JPEG, JPG, PNG, GIF, or WEBP'])
                    ->withInput();
            }

            $filename = 'menu-icons/' . uniqid() . '_' . time() . '.jpg';
            $fullPath = storage_path('app/public/' . $filename);

            if (!is_dir(dirname($fullPath))) {
                mkdir(dirname($fullPath), 0755, true);
            }

            $imagePath = $icon->getRealPath();
            [$width, $height, $type] = getimagesize($imagePath);

            $source = match ($type) {
                IMAGETYPE_JPEG => imagecreatefromjpeg($imagePath),
                IMAGETYPE_PNG  => imagecreatefrompng($imagePath),
                IMAGETYPE_GIF  => imagecreatefromgif($imagePath),
                IMAGETYPE_WEBP => imagecreatefromwebp($imagePath),
                default        => imagecreatefromjpeg($imagePath),
            };

            $targetSize = 300;
            $canvas = imagecreatetruecolor($targetSize, $targetSize);

            $white = imagecolorallocate($canvas, 255, 255, 255);
            imagefilledrectangle($canvas, 0, 0, $targetSize, $targetSize, $white);

            $sourceAspect = $width / $height;

            if ($sourceAspect > 1) {
                $newHeight = $height;
                $newWidth  = $height;
                $srcX = (int)(($width - $newWidth) / 2);
                $srcY = 0;
            } else {
                $newWidth  = $width;
                $newHeight = $width;
                $srcX = 0;
                $srcY = (int)(($height - $newHeight) / 2);
            }

            imagecopyresampled(
                $canvas, $source,
                0, 0,
                $srcX, $srcY,
                $targetSize, $targetSize,
                $newWidth, $newHeight
            );

            imagejpeg($canvas, $fullPath, 95);

            imagedestroy($source);
            imagedestroy($canvas);

            $category->icon = $filename;
        }
    
        $category->name = $request->name;
        $category->save();
    
        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menuCategory = MenuCategory::findOrFail($id);

        if ($menuCategory->menus()->exists()) {
            return redirect()
                ->route('back.menu-category.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh Event!');
        }

        $menuCategory->delete();

        return redirect()
            ->route('back.menu-category.index')
            ->with('success', 'Menu Kategori Berhasil Dihapus!');
    }
}
