<?php

namespace App\Constants;

final class ConstantsQuery{

    const GET_POST_ADMIN = "WHERE published= 1 ORDER BY creation_date DESC LIMIT ";
    const GET_POST_FRONT = "published= 1 AND id = ? ";
}