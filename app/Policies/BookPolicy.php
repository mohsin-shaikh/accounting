<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is owner of the books.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return mixed
     */
    public function owner(User $user, Book $book)
    {
        return $user->id === $book->user_id
            ? Response::allow()
            : Response::deny('You are not the owner of this book.');
    }
}
