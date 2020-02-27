<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Upload
 *
 * @property int $id
 * @property string $file_name
 * @property string $client_file_name
 * @property string $extension
 * @property int $size
 * @property string $mime
 * @property string $upload_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $dir
 * @property-read mixed $download_path
 * @property-read string $url
 * @property-read \App\Models\User $uploader
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereClientFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereDir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Upload whereUploadBy($value)
 * @mixin \Eloquent
 */
class Upload extends Model
{
    protected $guarded = ['id'];
    protected $appends = [
        'url',
    ];

    /**
     * Store file in database and copy file from temp to directory
     *
     * @todo validasi file dan database
     * @param  UploadedFile $file
     * @param  string $dir directory to be stored
     * @return Upload
     */
    public static function store($file, $dir = null, $user = null)
    {
        // Modify filename
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid(date('YmdHis') . '_', true);
        $directory = $dir;

        // New instance for database resource
        $instance = new static (
            [
                'file_name'        => $filename,
                'client_file_name' => $file->getClientOriginalName(),
                'extension'        => $extension,
                'size'             => $file->getSize(),
                'mime'             => $file->getMimeType(),
                'upload_by'        => auth()->user()->id,
                'dir'              => $dir === null ? '/' : '/' . $dir,
            ]
        );

        // Copy to dir and store to database
        $file->storeAs($directory, $filename . '.' . $extension);

        $instance->save();

        return $instance;
    }

    /**
     * Laravel accessor for Url
     *
     * @todo validate the filename
     * @return string filename with url
     */
    public function getUrlAttribute()
    {
        $path = $this->file_name . '.' . $this->extension;
        // if (Storage::exists('public' . $path)) {
        //     return Storage::url($path);
        // }
        return route('file_getter', $path);
    }

    public function getDownloadPathAttribute()
    {
        return ('public/' . $this->dir . '/' . $this->file_name . '.' . $this->extension);
    }

    /**
     * Delete instance of resource and delete file
     *
     * @todo delete from database
     * @return bool
     * @throws \Exception
     */
    public function delete()
    {
        parent::delete();

        return Storage::delete('public' . $this->dir . '/' . $this->file_name . '.' . $this->extension);
    }

    /**
     * Laravel relation to User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uploader()
    {
        return $this->belongsTo(User::class);
    }
}
