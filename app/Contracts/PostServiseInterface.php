<?php

namespace App\Contracts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
interface PostServiseInterface
{
    //
    public function getAll(): ?Collection;
}