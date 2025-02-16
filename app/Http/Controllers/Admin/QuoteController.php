<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteRequest;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::latest()->paginate(10);

        return view('admin.quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quotes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuoteRequest $request)
    {
        Quote::create([
            'quote'    => $request->quote,
            'author'   => $request->author,
            'year'     => $request->year,
            'source'   => $request->source,
            'category' => $request->category,
            'likes'    => 0, // По умолчанию 0
        ]);

        // Перенаправляем с сообщением об успешном сохранении
        return redirect()->route('admin.quotes.index')->with('success', 'Цитата успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quote = Quote::findOrFail($id); // findOrFail автоматически выбросит 404, если цитата не найдена.

        return view('admin.quotes.edit', compact('quote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuoteRequest $request, $id)
    {
        $quote = Quote::findOrFail($id);

        $quote->update([
            'quote' => $request->quote,
            'author' => $request->author,
            'year' => $request->year,
            'source' => $request->source,
            'category' => $request->category,
            'likes' => $request->likes,
        ]);

        // Перенаправляем обратно со всплывающим сообщением
        return redirect()->route('admin.quotes.index')->with('success', 'Цитата успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quote::findOrFail($id)->delete();

        return redirect()->route('admin.quotes.index')->with('success', 'Цитата успешно удалена!');
    }
}
