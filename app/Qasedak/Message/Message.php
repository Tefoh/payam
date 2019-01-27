<?php

namespace App\Qasedak\Message;

use App\User;
use App\Qasedak\File\File;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    //
    protected $fillable = [
        'title', 'user_id', 'author', 'body', 'label', 'is_stared',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files() {
        return $this->belongsToMany(File::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender() {
        return $this->belongsTo(User::class,'author');
    }

    public static function messages() {

    }

    /**
     * @return string
     */
    public function time() {
        $time =  $this->created_at;
        $v = Verta::instance($time);
        return $v->format('%B %d، %Y');
    }

    /**
     * @return string
     */
    public function formatDifference() {
        return Verta::instance($this->created_at)->formatDifference();
    }

    /**
     *
     */
    public function isStar() {
        if ($this->is_stared){
            echo 'class="starred"';
        }
    }

    /**
     *
     */
    public function labels() {

        if ($this->label == 'work'){
            echo '<span id="label-'. $this->id .'"><span class="label label-success">کاری</span></span>';
        }elseif ($this->label == 'important'){
            echo '<span id="label-'. $this->id .'"><span class="label label-primary">مهم</span></span>';
        }elseif ($this->label == 'personal'){
            echo '<span id="label-'. $this->id .'"><span class="label label-danger">شخصی</span></span>';
        }elseif ($this->label == 'document'){
            echo '<span id="label-'. $this->id .'"><span class="label label-warning">سند</span></span>';
        }else{
            echo '<span id="label-'. $this->id .'"><span class="label "></span></span>';
        }
    }

    /**
     * @return string
     */
    public function has_file() {
        if ($this->files){
            $echo = '<a href="#" class="attachment"><i class="fa fa-paperclip"></i></a>';
            return $echo;
        }
    }
}
