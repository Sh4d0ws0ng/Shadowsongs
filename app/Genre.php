<?php

namespace App;


class Genre extends Model {

  public function reviews() {
    return $this->belongsToMany(Review::class);
  }

  public function getRouteKeyName() {
    return 'name';
  }
}
