<?php

namespace App;


class Tag extends Model {

  public function blogs() {
    return $this->belongsToMany(Blog::class);
  }

  public function getRouteKeyName() {
    return 'name';
  }
}
