<?php

namespace App;


class Comment extends Model {
    public function review() {
      $this->belongsTo(Review::class);
    }

    public function user() {
      return $this->belongsTo(User::class);
    }
}
