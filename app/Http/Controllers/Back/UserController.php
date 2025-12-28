<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index(){
        if (auth()->user()->role == 1) {
            $users = User::get();
        } else {
            $users = User::whereId(auth()->user()->id)->get();
        }

        return view('back.user.index', [
            'users' => $users
        ]);
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return back()->with('success','Pengguna Sudah Ditambahkan!');
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->validated();
        
        $request->validate([
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            
            $allowedFileTypes = ['jpeg', 'jpg', 'png', 'gif'];
            $extension = $avatar->getClientOriginalExtension();
            
            if (!in_array($extension, $allowedFileTypes)) {
                return back()->withErrors(['avatar' => 'The avatar must be an image (JPEG, JPG, PNG, GIF).'])->withInput();
            }
            
            $filename = 'avatars/' . uniqid() . '_' . time() . '.jpg';
            $fullPath = storage_path('app/public/' . $filename);
            
            $directory = dirname($fullPath);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            
            $imagePath = $avatar->getRealPath();
            list($width, $height, $type) = getimagesize($imagePath);
            
            $source = match($type) {
                IMAGETYPE_JPEG => imagecreatefromjpeg($imagePath),
                IMAGETYPE_PNG => imagecreatefrompng($imagePath),
                IMAGETYPE_GIF => imagecreatefromgif($imagePath),
                IMAGETYPE_WEBP => imagecreatefromwebp($imagePath),
                default => imagecreatefromjpeg($imagePath)
            };
            
            $targetSize = 300;
            $thumb = imagecreatetruecolor($targetSize, $targetSize);
            
            $white = imagecolorallocate($thumb, 255, 255, 255);
            imagefilledrectangle($thumb, 0, 0, $targetSize, $targetSize, $white);
            
            $sourceAspect = $width / $height;
            
            if ($sourceAspect > 1) {
                $newWidth = (int)($height * 1);
                $newHeight = $height;
                $srcX = (int)(($width - $newWidth) / 2);
                $srcY = 0;
            } else {
                $newWidth = $width;
                $newHeight = (int)($width * 1);
                $srcX = 0;
                $srcY = (int)(($height - $newHeight) / 2);
            }
            
            imagecopyresampled(
                $thumb, $source,
                0, 0,
                $srcX, $srcY,
                $targetSize, $targetSize,
                $newWidth, $newHeight
            );
            
            imagejpeg($thumb, $fullPath, 95);
            
            imagedestroy($source);
            imagedestroy($thumb);
            
            $data['avatar'] = $filename;
        }


        if ($request->has('password') && $request->input('password') != '') {
            $data['password'] = bcrypt($data['password']);
        }
        
        $user = User::findOrFail($id);
        
        Log::info('Data before update:', $data);
        
        $user->update([
            'nickname' => $data['nickname'],
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => $data['password'] ?? $user->password,
            'avatar' => $data['avatar'] ?? $user->avatar,
        ]);

        Log::info('Updated user:', $user->toArray());

        return back()->with('success', 'Pengguna Sudah Diedit!');
    }

    public function show()
    {
        return view('back.user.show', [
            'user' => User::whereId(auth()->user()->id)->get()
        ]);
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();

        return back()->with('success','Pengguna Sudah Dihapus!');
    }
}
