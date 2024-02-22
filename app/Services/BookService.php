<?php

namespace App\Services;

use App\EnumConstants\S3DiscConstants;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class BookService 
{
	/**
	 * @param array $validated
	 * @return string
	 */

	public static function saveBookFile($validated)
	{
		$filePath = $validated['title'] . "-". $validated['author'] . ".pdf";
 		Storage::disk(S3DiscConstants::Book)->put($filePath, $validated['file_name']);
 		return $filePath;
	}

}