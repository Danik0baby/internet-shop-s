<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function create(): View
    {
        return view('contacts');
    }

    /**
     * Store a contact message.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());

        return redirect()
            ->route('contacts')
            ->with('status', 'Сообщение отправлено. Мы свяжемся с вами.');
    }
}
