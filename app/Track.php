<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
	public function label()
	{
		return $this->belongsTo(Label::class);
	}
}
