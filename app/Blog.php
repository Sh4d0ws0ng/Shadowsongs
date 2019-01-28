<?php

namespace App;


class Blog extends Model {

  public function tags() {
    return $this->belongsToMany(Tag::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function comments() {
    return $this->hasMany(Comment::class);
  }
}
