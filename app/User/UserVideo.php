<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class UserVideo extends Model
{
	public static $root_path = 'uploads/user_videos';

    public $attributes = [
        'title' => null,
    ];
    
    public $fillable = [
        'title',
    ];
    
	public $appends = [
		'file_url',
		'thumbnail_url',
	];

    public function getDirectoryPathAttribute()
    {
    	return implode('/', [
            self::$root_path,
            substr(gmp_base_convert(md5(ceil($this->id / 100 / 100 / 100) . 'wistiti_0'), 36, 62), -8),
            substr(gmp_base_convert(md5(ceil($this->id / 100 / 100) . 'wistiti_1'), 36, 62), -8),
            substr(gmp_base_convert(md5(ceil($this->id / 100) . 'wistiti_2'), 36, 62), -8),
        ]);
    }

    public function getInternalFileNameAttribute()
    {
    	return gmp_base_convert(md5($this->id . 'wistiti_3'), 36, 62) . '.' . pathinfo($this->file_name)['extension'];
    }

    public function getFileUrlAttribute()
    {
    	return '/' . $this->directory_path . '/' . $this->internal_file_name;
    }

    public function getThumbnailUrlAttribute()
    {
    	return '/' . $this->directory_path . '/' . pathinfo($this->internal_file_name)['filename'] . '.jpg';
    }

    public function makeThumbnail()
    {
    	$video_path = public_path($this->directory_path . '/' . $this->internal_file_name);
    	$image_path = public_path($this->directory_path . '/' . pathinfo($this->internal_file_name)['filename'] . '.jpg');
    	exec('ffmpeg -i ' . $video_path . ' -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg ' . $image_path . ' 2>&1');
    }
}
