<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingList;

class ReadingListController extends Controller
{
      public function index(Request $request)
    {
        $items = ReadingList::with(['cerita.kategori', 'bab'])
            ->where('user_id', $request->user()->id)
            ->latest('updated_at')
            ->get();

        return view('reading_list.index', compact('items'));
    }

    public function destroy(Request $request, ReadingList $readingList)
    {
        abort_if($readingList->user_id !== $request->user()->id, 403);
        $readingList->delete();

        return redirect()->route('reading-list.index')->with('sukses', 'Dihapus dari Reading List.');
    }
}
