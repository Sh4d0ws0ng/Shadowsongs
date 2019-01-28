<?php

namespace App;


class Review extends Model {

  protected $dates = [
    'created_at',
    'updated_at',
    'release_date'
  ];

  public function comments() {
    return $this->hasMany(Comment::class);
  }

  public function songs() {
    return $this->hasMany(Song::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function genres() {
    return $this->belongsToMany(Genre::class);
  }
}
