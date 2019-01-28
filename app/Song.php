<?php

namespace App;


class Song extends Model
{
  public function review() {
    $this->belongsTo(Review::class);
  }
}
