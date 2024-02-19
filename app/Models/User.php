<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function article()
    {
        return $this->hasMany(Article::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Rule access.
     *
     * @var array
     */

    public function getRule()
    {
        return $this->managing_rule;
    }

    public function CanEditArticles() {
        return ($this->getRule() == 'editor' || $this->getRule() == 'system') ? true : false;
    }

    public function CanEditOtherUserArticles() {
        return ($this->getRule() == 'editor' || $this->getRule() == 'system') ? true : false;
    }

    public function CanRemoveOtherUsersArticles() {
        return ($this->getRule() == 'editor') ? false : true;
    }

    public function CanEditPages() {
        return ($this->getRule() == 'system') ? true : false;
    }

    public function CanEditCategories() {
        return ($this->getRule() == 'system') ? true : false;
    }

    public function CanEditTags() {
        return ($this->getRule() == 'system') ? true : false;
    }

    public function CanEditComments() {
        return ($this->getRule() == 'system') ? true : false;
    }

    public function CanEditOtherUsers() {
        return ($this->getRule() == 'system') ? true : false;
    }

    public function CanManageAds() {
        return ($this->getRule() == 'system') ? true : false;
    }

    public function CanManageSettings() {
        return ($this->getRule() == 'system') ? true : false;
    }

    public function CanUseAnalyticsPanel() {
        return ($this->getRule() == 'system') ? true : false;
    }
}
